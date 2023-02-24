<?php

namespace BeelineOrd\Request\CreativeContent;

use BeelineOrd\Data\CreativeContent\CreativeContentViewModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<CreativeContentViewModel[]>
 */
class CreativeContentGetAllRequest extends AbstractRequest
{
    public function __construct(int $creativeId)
    {
        $this->query = ['creativeId' => $creativeId];
    }

    public function getMethod(): string
    {
        return 'GET /data/creativeContent/all/byCreative/';
    }

    /**
     * @return CreativeContentViewModel[]
     */
    public function createResponse(array $body): array
    {
        return array_map(fn($item) => CreativeContentViewModel::create($item), $body);
    }
}