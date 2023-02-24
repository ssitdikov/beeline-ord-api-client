<?php

namespace BeelineOrd\Request\Platform;

use BeelineOrd\Data\Creative\CreativeEditModel;
use BeelineOrd\Data\Creative\CreativeViewModel;
use BeelineOrd\Data\Platform\PlatformViewModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<PlatformViewModel>
 */
class PlatformGetRequest extends AbstractRequest
{
    protected $id;

    public function __construct(int $platformId)
    {
        $this->id = $platformId;
    }

    public function getMethod(): string
    {
        return 'GET /data/platform/' . $this->id;
    }

    public function createResponse(array $body)
    {
        return PlatformViewModel::create($body);
    }
}