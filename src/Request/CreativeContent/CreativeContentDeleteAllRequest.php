<?php

namespace BeelineOrd\Request\CreativeContent;

use BeelineOrd\Data\CreativeContent\CreativeContentViewModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<mixed>
 */
class CreativeContentDeleteAllRequest extends AbstractRequest
{
    protected array $ids;

    public function __construct(array $contentIds)
    {
        $this->ids = array_values($contentIds);
    }

    public function getMethod(): string
    {
        return 'DELETE /data/creativeContent/all';
    }

    public function getBody()
    {
        return $this->ids;
    }

}