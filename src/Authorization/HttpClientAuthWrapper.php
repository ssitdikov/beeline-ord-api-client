<?php

namespace BeelineOrd\Authorization;

use BeelineOrd\ApiClient;
use BeelineOrd\Exception\UnauthorizedException;
use BeelineOrd\Request\Auth\AuthSigninWithCredentialsRequest;
use BeelineOrd\Request\Auth\AuthSigninWithTokenRequest;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\RequestInterface as HttpRequestInterface;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

final class HttpClientAuthWrapper implements HttpClientInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    private ApiClient $client;
    private HttpClientInterface $baseHttpClient;
    private Credentials $credentials;
    private ?AuthorizationToken $token;

    public function __construct(
        ApiClient           $client,
        HttpClientInterface $baseHttpClient,
        Credentials         $credentials,
        AuthorizationToken  $token = null
    )
    {
        $this->client = $client;
        $this->baseHttpClient = $baseHttpClient;
        $this->credentials = $credentials;
        $this->token = $token;
    }

    public function getToken(): AuthorizationToken
    {
        if (! $this->token) {
            $this->signinWithCredentials();
        }
        assert($this->token !== null);

        return $this->token;
    }

    public function sendRequest(HttpRequestInterface $request): HttpResponseInterface
    {
        foreach ([true, false] as $allowRetry) {
            if ($this->token) {
                $response = $this->baseHttpClient->sendRequest(
                    $request->withHeader('Authorization', 'Bearer ' . $this->token->getAccessToken())
                );

                if ($response->getStatusCode() != 401) {
                    return $response;
                }

                if ($allowRetry) {
                    try {
                        $this->refreshToken();
                    } catch (UnauthorizedException $e) {
                        $this->token = null;
                    }

                } else {
                    throw new UnauthorizedException($request, $response, null,
                        'Failed to authorize with newly refreshed accessToken'
                        . ' (probably this is an error on API server side)'
                    );
                }
            }
            if (!$this->token && $allowRetry) {
                $this->signinWithCredentials();
            }
        }

        throw new \LogicException('unreachable');
    }

    private function signinWithCredentials(): void
    {
        $request = new AuthSigninWithCredentialsRequest($this->credentials);
        $response = $this->client->send($request);
        assert($response instanceof AuthorizationToken);
        $this->token = $response;
    }

    private function refreshToken(): void
    {
        assert($this->token != null);
        $request = new AuthSigninWithTokenRequest($this->token, true);
        $response = $this->client->send($request);
        assert($response instanceof AuthorizationToken);
        $this->token = $response;
    }
}
