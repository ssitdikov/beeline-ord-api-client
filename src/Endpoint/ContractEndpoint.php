<?php

namespace BeelineOrd\Endpoint;

use BeelineOrd\ApiClient;
use BeelineOrd\Data\Contract\ContractCreateModel;
use BeelineOrd\Data\Contract\ContractEditModel;
use BeelineOrd\Data\Contract\ContractViewModel;
use BeelineOrd\Request\Contract\ContractGetAllRequest;
use BeelineOrd\Request\Contract\ContractGetRequest;
use BeelineOrd\Request\Contract\ContractPatchAllRequest;
use BeelineOrd\Request\Contract\ContractPatchRequest;
use BeelineOrd\Request\Contract\ContractSetErirRequest;
use BeelineOrd\Request\InitialContract\InitialContractRequest;

class ContractEndpoint
{
    protected ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function getInitial(string $customerInn, string $executorInn, \DateTimeInterface $date = null)
    {
        return $this->client->send(new InitialContractRequest($customerInn, $executorInn, $date));
    }

    /**
     * @return array<ContractViewModel>
     */
    public function getAll(): array
    {
        return $this->client->send(new ContractGetAllRequest());
    }

    public function get(int $contractId): ContractViewModel
    {
        return $this->client->send(new ContractGetRequest($contractId));
    }

    public function create(ContractCreateModel $createModel): int
    {
        $result = $this->import([ $createModel ]);
        if (count($result) !== 1) {
            throw new \UnexpectedValueException('Method did not return created ID');
        }

        return array_pop($result);
    }

    public function update(int $id, ContractEditModel $editModel)
    {
        return $this->client->send(new ContractPatchRequest($id, $editModel));
    }

    public function import(array $create = [], array $update = [])
    {
        return $this->client->send(new ContractPatchAllRequest($create, $update));
    }

    /**
     * @param bool $isReady
     * @param int[] $contractIds
     * @return void|mixed
     */
    public function setReadyForErir(bool $isReady, array $contractIds)
    {
        return $this->client->send(new ContractSetErirRequest($isReady, $contractIds));
    }

}
