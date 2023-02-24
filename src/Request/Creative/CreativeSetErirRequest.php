<?php

namespace BeelineOrd\Request\Creative;

use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<mixed>
 */
class CreativeSetErirRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return 'GET /data/creative/setErir';
    }

    public function __construct(bool $isReady, array $creativeIds)
    {
        $this->query = [
            'isReadyForErir' => $isReady ? 'true' : 'false'
        ];
        $this->body = array_values($creativeIds);
    }
}