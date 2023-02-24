<?php

namespace BeelineOrd\Endpoint;

use BeelineOrd\ApiClient;
use BeelineOrd\Data\Platform\PlatformCreateModel;
use BeelineOrd\Data\Platform\PlatformEditModel;
use BeelineOrd\Data\Platform\PlatformViewModel;
use BeelineOrd\Request\Platform\PlatformDeleteRequest;
use BeelineOrd\Request\Platform\PlatformGetAllRequest;
use BeelineOrd\Request\Platform\PlatformGetRequest;
use BeelineOrd\Request\Platform\PlatformPatchAllRequest;
use BeelineOrd\Request\Platform\PlatformPatchRequest;

class PlatformEndpoint
{
    protected ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return array<PlatformViewModel>
     */
    public function all(): array
    {
        return $this->client->send(new PlatformGetAllRequest());
    }

    public function get(int $platformId): PlatformViewModel
    {
        return $this->client->send(new PlatformGetRequest($platformId));
    }

    public function create(PlatformCreateModel $createModel): int
    {
        $result = $this->import([ $createModel ]);
        if (count($result) !== 1) {
            throw new \UnexpectedValueException('Method did not return created ID');
        }

        return array_pop($result);
    }

    public function update(int $id, PlatformEditModel $editModel)
    {
        return $this->client->send(new PlatformPatchRequest($id, $editModel));
    }

    /** @deprecated */
    public function delete(int $id)
    {
        return $this->client->send(new PlatformDeleteRequest($id));
    }

    /**
     * @param array<PlatformCreateModel> $create
     * @param array<int,PlatformEditModel> $update
     */
    public function import(array $create = [], array $update = [])
    {
        return $this->client->send(new PlatformPatchAllRequest($create, $update));
    }

}
