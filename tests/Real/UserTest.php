<?php
namespace Real;

use TestEnv;

class UserTest extends \PHPUnit\Framework\TestCase
{
    protected function assertPreConditions(): void
    {
        $this->assertNotNull(TestEnv::$credentials, 'credentials were not set!');
    }

    public function testGetUser()
    {
        $client = new \BeelineOrd\ApiClient(
            TestEnv::$credentials, null, TestEnv::$httpClient
        );

        $userResponse = $client->send(new \BeelineOrd\Request\User\GetUserRequest());

    }
}