<?php

namespace BeelineOrd\Request\Contract;

use BeelineOrd\Data\Contract\ContractViewModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<ContractViewModel>
 */
class ContractGetRequest extends AbstractRequest
{
    protected int $contractId;

    public function getMethod(): string
    {
        return 'GET /data/contract/' . $this->contractId;
    }

    public function __construct(int $contractId)
    {
        $this->contractId = $contractId;
    }

    public function createResponse(array $body): ContractViewModel
    {
        return ContractViewModel::create($body);
    }

}