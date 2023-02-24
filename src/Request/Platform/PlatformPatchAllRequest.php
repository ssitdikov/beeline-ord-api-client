<?php

namespace BeelineOrd\Request\Platform;

use BeelineOrd\Data\Creative\CreativeEditModel;
use BeelineOrd\Data\Creative\CreativeViewModel;
use BeelineOrd\Data\CreativeContent\CreativeContentCreateModel;
use BeelineOrd\Data\CreativeContent\CreativeContentEditModel;
use BeelineOrd\Data\Platform\PlatformCreateModel;
use BeelineOrd\Data\Platform\PlatformEditModel;
use BeelineOrd\Data\Platform\PlatformViewModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<int[]>
 */
class PlatformPatchAllRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return 'PATCH /data/platform/all';
    }

    /**
     * @param array<PlatformCreateModel> $create
     * @param array<int, PlatformEditModel> $update
     */
    public function __construct(array $create = [], array $update = [])
    {
        $this->body = [];
        if ($create) {
            $this->body['create'] = array_map(fn(PlatformCreateModel $m) => $m, array_values($create));
        }
        if ($update) {
            $this->body['update'] = array_map(fn(PlatformEditModel $m) => $m, $update);
        }
    }

    public function createResponse(array $body)
    {
        return $body;
    }


}