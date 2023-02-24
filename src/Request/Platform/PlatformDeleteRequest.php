<?php

namespace BeelineOrd\Request\Platform;

use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<mixed>
 * @deprecated
 */
class PlatformDeleteRequest extends AbstractRequest
{
    protected $id;

    public function __construct(int $platformId)
    {
        $this->id = $platformId;
    }

    public function getMethod(): string
    {
        return 'DELETE /data/platform/' . $this->id;
    }

}