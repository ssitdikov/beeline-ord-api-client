<?php

namespace BeelineOrd\Endpoint;

use BeelineOrd\ApiClient;
use BeelineOrd\Request\CreativeStatistics\CreativeStatisticsAllByCreative;

class CreativeStatisticsEndpoint
{
    protected ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function allByCreative(int $creativeId)
    {
        return $this->client->send(
            new CreativeStatisticsAllByCreative($creativeId)
        );
    }
}
