<?php

namespace BeelineOrd\Endpoint;

use BeelineOrd\ApiClient;
use BeelineOrd\Data\User\UserViewModel;
use BeelineOrd\Request\User\GetUserRequest;

class UserEndpoint
{
    protected ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function get(): UserViewModel
    {
        return $this->client->send(new GetUserRequest());
    }
}
