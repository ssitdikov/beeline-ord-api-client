<?php

namespace BeelineOrd\Request\Creative;

use BeelineOrd\Data\Creative\CreativeListModel;
use BeelineOrd\Data\Creative\CreativeViewModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<CreativeViewModel[]>
 */
class CreativeGetAllRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return 'GET /data/creative/list/byUser';
    }

    public function getQuery(): array
    {
        return [ 'onlyMine' => 'false' ];
    }

    public function createResponse(array $body)
    {
        return array_map(fn($item) => CreativeListModel::create($item), $body);
    }
}