<?php

namespace BeelineOrd\Request\Platform;

use BeelineOrd\Data\Creative\CreativeEditModel;
use BeelineOrd\Data\Platform\PlatformEditModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<mixed>
 */
class PlatformPatchRequest extends AbstractRequest
{
    protected $id;
    protected $model;

    public function __construct(int $platformId, PlatformEditModel $platformEditModel)
    {
        $this->id = $platformId;
        $this->model = $platformEditModel;
    }

    public function getMethod(): string
    {
        return 'PATCH /data/platform/' . $this->id;
    }

    public function getBody()
    {
        return $this->model;
    }
}