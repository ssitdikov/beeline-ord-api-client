<?php

namespace BeelineOrd\Request\Creative;

use BeelineOrd\Data\Creative\CreativeEditModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<mixed>
 */
class CreativePatchRequest extends AbstractRequest
{
    protected $id;
    protected $model;

    public function __construct(int $creativeId, CreativeEditModel $creativeEditModel)
    {
        $this->id = $creativeId;
        $this->model = $creativeEditModel;
    }

    public function getMethod(): string
    {
        return 'PATCH /data/creative/' . $this->id;
    }

    public function getBody()
    {
        return $this->model;
    }

    public function createResponse(array $body)
    {
        return $body;
    }


}