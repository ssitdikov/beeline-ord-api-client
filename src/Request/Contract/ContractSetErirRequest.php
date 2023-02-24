<?php

namespace BeelineOrd\Request\Contract;

use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<mixed>
 */
class ContractSetErirRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return 'GET /data/contract/setErir';
    }

    public function __construct(bool $isReady, array $contractIds)
    {
        $this->query = [
            'isReadyForErir' => $isReady ? 'true' : 'false'
        ];
        $this->body = array_values($contractIds);
    }
}