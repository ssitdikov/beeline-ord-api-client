<?php

namespace BeelineOrd;

use BeelineOrd\Authorization\HttpClientAuthWrapper;
use BeelineOrd\Authorization\AuthorizationToken;
use BeelineOrd\Authorization\Credentials;
use BeelineOrd\Endpoint\AuthorizationEndpoint;
use BeelineOrd\Endpoint\ContractEndpoint;
use BeelineOrd\Endpoint\CreativeEndpoint;
use BeelineOrd\Endpoint\CreativeStatisticsEndpoint;
use BeelineOrd\Endpoint\PlatformEndpoint;
use BeelineOrd\Endpoint\UserEndpoint;
use BeelineOrd\Exception\ResponseValidationException;
use BeelineOrd\Request\RequestInterface as ApiRequestInterface;
use BeelineOrd\Exception\ApiException;
use BeelineOrd\Exception\BadRequestException;
use BeelineOrd\Exception\BadResponseException;
use BeelineOrd\Exception\NotFoundException;
use BeelineOrd\Exception\UnauthorizedException;
use Http\Client\Common\Plugin\LoggerPlugin;
use Http\Client\Common\PluginClientBuilder;
use Http\Discovery\Psr17Factory;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Message\Formatter\FullHttpMessageFormatter;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface as HttpRequestInterface;
use Psr\Http\Message\ResponseInterface as HttpResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class ApiClient
{
    protected string $apiEndpoint = 'https://ord.beeline.ru/ordapi';

    protected HttpClientInterface $httpClient;
    protected HttpClientAuthWrapper $authHttpClient;
    protected RequestFactoryInterface $requestFactory;
    protected UriFactoryInterface $uriFactory;

    protected AuthorizationEndpoint $authEndpoint;
    protected UserEndpoint $userEndpoint;
    protected PlatformEndpoint $platformEndpoint;
    protected ContractEndpoint $contractEndpoint;
    protected CreativeEndpoint $creativeEndpoint;
    protected CreativeStatisticsEndpoint $creativeStatisticsEndpoint;

    public function __construct(
        Credentials         $credentials,
        AuthorizationToken  $token = null,
        HttpClientInterface $httpClient = null,
        LoggerInterface     $logger = null
    )
    {
        $httpClientBuilder = new PluginClientBuilder();
        if ($logger instanceof LoggerInterface && class_exists(LoggerPlugin::class)) {
            $httpClientBuilder
                ->addPlugin(new LoggerPlugin($logger, new FullHttpMessageFormatter()));
        }

        $this->httpClient = $httpClientBuilder->createClient($httpClient ?: Psr18ClientDiscovery::find());

        // TODO: convert to httplug plugin
        $this->authHttpClient = new HttpClientAuthWrapper($this, $this->httpClient, $credentials, $token);

        $this->requestFactory = $this->uriFactory = new Psr17Factory();

        $this->authEndpoint = new AuthorizationEndpoint($this);
        $this->userEndpoint = new UserEndpoint($this);
        $this->platformEndpoint = new PlatformEndpoint($this);
        $this->contractEndpoint = new ContractEndpoint($this);
        $this->creativeEndpoint = new CreativeEndpoint($this);
        $this->creativeStatisticsEndpoint = new CreativeStatisticsEndpoint($this);
    }

    public function getToken(): AuthorizationToken
    {
        return $this->authHttpClient->getToken();
    }

    public function auth(): AuthorizationEndpoint
    {
        return $this->authEndpoint;
    }

    public function platform(): PlatformEndpoint
    {
        return $this->platformEndpoint;
    }

    public function contract(): ContractEndpoint
    {
        return $this->contractEndpoint;
    }

    public function creative(): CreativeEndpoint
    {
        return $this->creativeEndpoint;
    }

    public function creativeStatistics(): CreativeStatisticsEndpoint
    {
        return $this->creativeStatisticsEndpoint;
    }

    /**
     * @template TResult
     * @param ApiRequestInterface<TResult> $request
     * @return TResult
     */
    public function send(ApiRequestInterface $request)
    {
        $httpRequest = $this->createHttpRequest($request);

        if ($request->shouldBeAuthorized()) {
            $httpClient = $this->authHttpClient;
        } else {
            $httpClient = $this->httpClient;
        }

        $httpResponse = $httpClient->sendRequest($httpRequest);

        $body = $this->readResponseBody($httpRequest, $httpResponse);

        switch ($httpResponse->getStatusCode()) {
            case 200:
            case 201:
            case 202:
            case 204:
                try {
                    return $request->createResponse($body);
                } catch (\InvalidArgumentException $e) {
                    throw new ResponseValidationException($httpRequest, $httpResponse, $body, $e->getMessage(), 0, $e);
                }

            case 400:
                throw new BadRequestException($httpRequest, $httpResponse, $body);

            case 401:
                throw new UnauthorizedException($httpRequest, $httpResponse, $body);

            case 404:
                throw new NotFoundException($httpRequest, $httpResponse, $body);

            default:
                throw new ApiException($httpRequest, $httpResponse, $body);
        }
    }

    protected function createHttpRequest(ApiRequestInterface $request): HttpRequestInterface
    {
        $method = $request->getMethod();
        if (preg_match('/^(GET|POST|PUT|PATCH|DELETE)\s+(.+)$/i', $method, $match)) {
            $verb = strtoupper($match[1]);
            $method = $match[2];
        } else {
            $verb = 'GET';
        }
        $queryParameters = $request->getQuery();
        if ($queryParameters) {
            $query = http_build_query($queryParameters);
        } else {
            $query = null;
        }

        $method = ltrim($method, ' /');
        $httpUri = $this->getUriFactory()->createUri("{$this->apiEndpoint}/{$method}?{$query}");

        $httpRequest = $this->getRequestFactory()->createRequest($verb, $httpUri);
        foreach ($request->getHeaders() as $key => $value) {
            $httpRequest = $httpRequest->withHeader($key, $value);
        }

        $body = $request->getBody();
        if (is_array($body) || $body instanceof \JsonSerializable) {
            $httpRequest->getBody()->write(json_encode($body, JSON_PRETTY_PRINT));
        } else if (is_string($body)) {
            $httpRequest->getBody()->write($body);
        } else if ($body instanceof StreamInterface) {
            $httpRequest = $httpRequest->withBody($body);
        }

        return $httpRequest;
    }

    protected function getRequestFactory(): RequestFactoryInterface
    {
        return $this->requestFactory;
    }

    protected function getUriFactory(): UriFactoryInterface
    {
        return $this->uriFactory;
    }

    protected function readResponseBody(HttpRequestInterface $request, HttpResponseInterface $response): array
    {
        $body = (string)$response->getBody();
        if (empty($body)) {
            return [];
        }

        $contentType = $response->getHeaderLine('Content-Type');
        if (strpos($contentType, 'application/json') !== false) {
            try {
                return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {
                throw new BadResponseException(
                    $request, $response, $body,
                    'Error at parsing JSON: ' . $e->getMessage(), $e->getCode(), $e
                );
            }
        } elseif (strpos($contentType, 'application/problem+json') !== false) {
            throw new BadResponseException(
                $request, $response, $body,
                'Error returned: ' . $body,
            );
        } elseif (strpos($contentType, 'text/plain') !== false) {
            return [ 'text' => $body ];
        } else {
            throw new BadResponseException(
                $request, $response, null,
                'Unknown Content-Type: ' . $contentType
            );
        }
    }
}
