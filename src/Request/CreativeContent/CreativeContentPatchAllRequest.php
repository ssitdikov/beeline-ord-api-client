<?php

namespace BeelineOrd\Request\CreativeContent;

use BeelineOrd\Data\Creative\CreativeCreateResult;
use BeelineOrd\Data\CreativeContent\CreativeContentCreateModel;
use BeelineOrd\Data\CreativeContent\CreativeContentEditModel;
use BeelineOrd\Data\CreativeContent\CreativeContentUploadResult;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<CreativeCreateResult[]>
 */
class CreativeContentPatchAllRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return 'PATCH /data/creativeContent/all';
    }

    /**
     * @param array<CreativeContentCreateModel> $create
     * @param array<int, CreativeContentEditModel> $update
     */
    public function __construct(array $create = [], array $update = [])
    {
        $this->body = [];
        if ($create) {
            $this->body['create'] = array_map(fn(CreativeContentCreateModel $m) => $m, array_values($create));
        }
        if ($update) {
            $this->body['update'] = array_map(fn(CreativeContentEditModel $m) => $m, $update);
        }
    }

    /**
     * @param array $body
     * @return CreativeCreateResult[]
     */
    public function createResponse(array $body)
    {
        return array_map(fn($item) => CreativeCreateResult::create($item), $body);
    }

}