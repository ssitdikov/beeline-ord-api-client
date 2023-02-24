<?php

namespace BeelineOrd\Request\Auth;

use BeelineOrd\Authorization\AuthorizationToken;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<AuthorizationToken>
 */
class AuthSigninRequest extends AbstractRequest
{
    public function shouldBeAuthorized(): bool
    {
        return false;
    }

    public function getMethod(): string
    {
        return 'GET /auth/signin';
    }

    public function createResponse(array $body): AuthorizationToken
    {
        return new AuthorizationToken(
            $body['accessToken'],
            $body['refreshToken']
        );
    }
}