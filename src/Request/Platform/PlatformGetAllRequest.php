<?php

namespace BeelineOrd\Request\Platform;

use BeelineOrd\Data\Platform\PlatformViewModel;
use BeelineOrd\Request\AbstractRequest;
use Psr\Http\Message\ResponseInterface;

/**
 * @extends AbstractRequest<PlatformViewModel[]>
 */
class PlatformGetAllRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return 'GET /data/platform/all/byOrganization';
    }

    public function createResponse(array $body)
    {
        return array_map(fn ($item) => PlatformViewModel::create($item), $body);
    }
}