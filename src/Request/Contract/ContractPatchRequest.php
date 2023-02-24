<?php

namespace BeelineOrd\Request\Contract;

use BeelineOrd\Data\Contract\ContractEditModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<mixed>
 */
class ContractPatchRequest extends AbstractRequest
{
    protected int $contractId;

    public function getMethod(): string
    {
        return 'PATCH /data/contract/' . $this->contractId;
    }

    public function __construct(int $contractId, ContractEditModel $contractEditModel)
    {
        $this->contractId = $contractId;
        $this->body = $contractEditModel;
    }

}