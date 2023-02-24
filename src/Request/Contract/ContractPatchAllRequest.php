<?php

namespace BeelineOrd\Request\Contract;

use BeelineOrd\Data\Contract\ContractCreateModel;
use BeelineOrd\Data\Contract\ContractEditModel;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<array>
 */
class ContractPatchAllRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return 'PATCH /data/contract/all';
    }

    /**
     * @param array<ContractCreateModel> $create
     * @param array<ContractEditModel> $update
     */
    public function __construct(array $create = [], array $update = [])
    {
        $this->body = [];
        if ($create) {
            $this->body['create'] = array_map(fn(ContractCreateModel $m) => $m, array_values($create));
        }
        if ($update) {
            $this->body['update'] = array_map(fn(ContractEditModel $m) => $m, $update);
        }
    }

    public function createResponse(array $body)
    {
        return array_map('intval', $body);
    }

}