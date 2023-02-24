<?php

namespace BeelineOrd\Request\Auth;

use BeelineOrd\Authorization\AuthorizationToken;

class AuthSigninWithTokenRequest extends AuthSigninRequest
{
    protected AuthorizationToken $token;
    protected bool $refresh = false;

    public function __construct(AuthorizationToken $token, bool $refresh = false)
    {
        $this->token = $token;
        $this->refresh = $refresh;
    }

    public function getHeaders(): array
    {
        $actualToken = $this->refresh ? $this->token->getRefreshToken() : $this->token->getAccessToken();
        return [
            'Authorization' => "Bearer $actualToken"
        ];
    }

}