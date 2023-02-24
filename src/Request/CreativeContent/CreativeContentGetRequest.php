<?php

namespace BeelineOrd\Request\CreativeContent;

use BeelineOrd\Data\CreativeContent\CreativeContentViewModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<CreativeContentViewModel>
 */
class CreativeContentGetRequest extends AbstractRequest
{
    protected $id;

    public function __construct(int $contentId)
    {
        $this->id = $contentId;
    }

    public function getMethod(): string
    {
        return 'GET /data/creativeContent/' . $this->id;
    }

    public function createResponse(array $body)
    {
        return CreativeContentViewModel::create($body);
    }
}