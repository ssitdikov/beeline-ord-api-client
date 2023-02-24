<?php

namespace BeelineOrd\Request\Creative;

use BeelineOrd\Data\Creative\CreativeEditModel;
use BeelineOrd\Data\Creative\CreativeViewModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<CreativeViewModel>
 */
class CreativeGetRequest extends AbstractRequest
{
    protected $id;

    public function __construct(int $creativeId)
    {
        $this->id = $creativeId;
    }

    public function getMethod(): string
    {
        return 'GET /data/creative/' . $this->id;
    }

    public function createResponse(array $body)
    {
        return CreativeViewModel::create($body);
    }
}