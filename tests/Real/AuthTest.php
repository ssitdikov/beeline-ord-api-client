<?php
namespace Real;

use BeelineOrd\Authorization\AuthorizationToken;
use TestEnv;

class AuthTest extends \PHPUnit\Framework\TestCase
{
    protected function assertPreConditions(): void
    {
        $this->assertNotNull(TestEnv::$credentials, 'credentials were not set!');
    }

    public function testNewSignin()
    {
        $client = new \BeelineOrd\ApiClient(
            TestEnv::$credentials, null, TestEnv::$httpClient
        );

        $token = $client->getToken();
        $this->assertInstanceOf(AuthorizationToken::class, $token);

        return $token;
    }

    /**
     * @depends testNewSignin
     * @return void
     */
    public function testAccessToken(AuthorizationToken $token)
    {
        $client = new \BeelineOrd\ApiClient(
            TestEnv::$credentials, $token, TestEnv::$httpClient
        );

        $newToken = $client->getToken();
        $this->assertInstanceOf(AuthorizationToken::class, $newToken);
        $this->assertEquals($token->getAccessToken(), $newToken->getAccessToken());
        $this->assertEquals($token->getRefreshToken(), $newToken->getRefreshToken());
    }

    /**
     * @depends testNewSignin
     * @return void
     */
    public function testRefreshToken(AuthorizationToken $token)
    {
        $oldToken = new AuthorizationToken(
            strrev($token->getAccessToken()), // simulate out-of-date token
            $token->getRefreshToken(),
        );
        $client = new \BeelineOrd\ApiClient(
            TestEnv::$credentials, $oldToken, TestEnv::$httpClient
        );

        /** @var AuthorizationToken $authResponse */
        $newToken = $client->send(new \BeelineOrd\Request\Auth\AuthSigninWithTokenRequest($oldToken, true));
        $this->assertInstanceOf(AuthorizationToken::class, $newToken);
        $this->assertNotEquals($oldToken->getAccessToken(), $newToken->getAccessToken());
        $this->assertNotEquals($oldToken->getRefreshToken(), $newToken->getRefreshToken());
    }
}
