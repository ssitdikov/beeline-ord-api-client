<?php

namespace BeelineOrd\Request\CreativeContent;

use BeelineOrd\Data\Creative\CreativeEditModel;
use BeelineOrd\Data\CreativeContent\CreativeContentEditModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<mixed>
 */
class CreativeContentPatchRequest extends AbstractRequest
{
    protected int $id;
    protected CreativeContentEditModel $model;

    public function __construct(int $contentId, CreativeContentEditModel $contentEditModel)
    {
        $this->id = $contentId;
        $this->model = $contentEditModel;
    }

    public function getMethod(): string
    {
        return 'PATCH /data/creativeContent/' . $this->id;
    }

    public function getBody()
    {
        return $this->model;
    }

}