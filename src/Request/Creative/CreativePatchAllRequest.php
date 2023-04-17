<?php

namespace BeelineOrd\Request\Creative;

use BeelineOrd\Data\Creative\CreativeCreateModel;
use BeelineOrd\Data\Creative\CreativeCreateResult;
use BeelineOrd\Data\Creative\CreativeEditModel;
use BeelineOrd\Data\CreativeContent\CreativeContentCreateModel;
use BeelineOrd\Data\CreativeContent\CreativeContentEditModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<CreativeCreateResult[]>
 */
class CreativePatchAllRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return 'PATCH /data/creative/v2/all';
    }

    /**
     * @param array<CreativeCreateModel> $create
     * @param array<CreativeEditModel> $update
     */
    public function __construct(array $create = [], array $update = [])
    {
        $this->body = [];
        if ($create) {
            $this->body['create'] = array_map(fn(CreativeCreateModel $m) => $m, array_values($create));
        }
        if ($update) {
            $this->body['update'] = array_map(fn(CreativeEditModel $m) => $m, $update);
        }
    }

    /**
     * @param array $body
     * @return CreativeCreateResult[]
     */
    public function createResponse(array $body): array
    {
        return array_map(fn($item) => CreativeCreateResult::create($item), $body);
    }

}
