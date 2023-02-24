<?php

namespace BeelineOrd\Endpoint;

use BeelineOrd\ApiClient;
use BeelineOrd\Authorization\AuthorizationToken;
use BeelineOrd\Authorization\Credentials;
use BeelineOrd\Request\Auth\AuthSigninRequest;
use BeelineOrd\Request\Auth\AuthSigninWithCredentialsRequest;
use BeelineOrd\Request\Auth\AuthSigninWithTokenRequest;

class AuthorizationEndpoint
{
    protected ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function signIn(Credentials $credentials): AuthorizationToken
    {
        return $this->client->send(new AuthSigninWithCredentialsRequest($credentials));
    }

    public function refresh(AuthorizationToken $token): AuthorizationToken
    {
        return $this->client->send(new AuthSigninWithTokenRequest($token, true));
    }

}
