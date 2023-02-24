<?php

namespace BeelineOrd\Request\Auth;

use BeelineOrd\Authorization\Credentials;

class AuthSigninWithCredentialsRequest extends AuthSigninRequest
{
    protected Credentials $credentials;

    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }

    public function getMethod(): string
    {
        return 'POST /auth/signin';
    }

    public function getBody()
    {
        return [
            'username' => $this->credentials->getUsername(),
            'password' => $this->credentials->getPassword(),
        ];
    }
}