<?php

namespace BeelineOrd\Request\CreativeContent;

use BeelineOrd\Data\CreativeContent\CreativeContentViewModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<mixed>
 */
class CreativeContentDeleteRequest extends AbstractRequest
{
    protected $id;

    public function __construct(int $contentId)
    {
        $this->id = $contentId;
    }

    public function getMethod(): string
    {
        return 'DELETE /data/creativeContent/' . $this->id;
    }

}