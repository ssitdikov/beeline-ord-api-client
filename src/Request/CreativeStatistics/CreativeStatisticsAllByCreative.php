<?php

namespace BeelineOrd\Request\CreativeStatistics;

use BeelineOrd\Request\AbstractRequest;

class CreativeStatisticsAllByCreative extends AbstractRequest
{

    private int $creativeId;

    public function __construct(int $creativeId)
    {
        $this->creativeId = $creativeId;
    }

    public function getMethod(): string
    {
        return 'GET /data/creativeStatistics/all/byCreative?creativeId=' . $this->creativeId;
    }

    public function createResponse(array $body)
    {
        return $body;
    }
}
