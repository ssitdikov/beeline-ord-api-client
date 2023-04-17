<?php

namespace BeelineOrd\Request\CreativeContent;

use BeelineOrd\Data\Creative\CreativeCreateResult;
use BeelineOrd\Data\CreativeContent\CreativeContentCreateModel;
use BeelineOrd\Data\CreativeContent\CreativeContentEditModel;
use BeelineOrd\Data\CreativeContent\CreativeContentPatchAllResult;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<CreativeCreateResult[]>
 */
class CreativeContentPatchAllRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return 'PATCH /data/creativeContent/v2/all';
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
     * @return CreativeContentPatchAllResult
     */
    public function createResponse(array $body)
    {
        return CreativeContentPatchAllResult::create($body);
    }

}
