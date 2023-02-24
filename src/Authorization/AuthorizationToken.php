<?php

namespace BeelineOrd\Authorization;

class AuthorizationToken implements \JsonSerializable
{
    protected string $accessToken;
    protected string $refreshToken;

    public function __construct(string $accessToken, string $password)
    {
        $this->accessToken = $accessToken;
        $this->refreshToken = $password;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    public function jsonSerialize(): array
    {
        return [ 'accessToken' => $this->accessToken, 'refreshToken' => $this->refreshToken ];
    }


}