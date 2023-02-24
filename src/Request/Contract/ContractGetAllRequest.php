<?php

namespace BeelineOrd\Request\Contract;

use BeelineOrd\Data\Contract\ContractViewModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<ContractViewModel[]>
 */
class ContractGetAllRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return 'GET /data/contract/all/byOrganization';
    }

    public function createResponse(array $body)
    {
        return array_map(fn($item) => ContractViewModel::create($item), $body);
    }
}