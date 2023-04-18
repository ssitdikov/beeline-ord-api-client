<?php

namespace BeelineOrd\Endpoint;

use BeelineOrd\ApiClient;
use BeelineOrd\Data\Creative\CreativeCreateModel;
use BeelineOrd\Data\Creative\CreativeEditModel;
use BeelineOrd\Data\Creative\CreativeImportResult;
use BeelineOrd\Data\Creative\CreativeViewModel;
use BeelineOrd\Data\CreativeContent\CreativeContentCreateModel;
use BeelineOrd\Data\CreativeContent\CreativeContentEditModel;
use BeelineOrd\Data\CreativeContent\CreativeContentImportResult;
use BeelineOrd\Data\CreativeContent\CreativeContentImportResultErid;
use BeelineOrd\Data\CreativeContent\CreativeContentUploadResult;
use BeelineOrd\Data\CreativeContent\CreativeContentViewModel;
use BeelineOrd\Exception\FileException;
use BeelineOrd\Request\Creative\CreativeGetAllRequest;
use BeelineOrd\Request\Creative\CreativeGetRequest;
use BeelineOrd\Request\Creative\CreativePatchAllRequest;
use BeelineOrd\Request\Creative\CreativePatchRequest;
use BeelineOrd\Request\Creative\CreativeSetErirRequest;
use BeelineOrd\Request\CreativeContent\CreativeContentDeleteAllRequest;
use BeelineOrd\Request\CreativeContent\CreativeContentDeleteRequest;
use BeelineOrd\Request\CreativeContent\CreativeContentGetAllRequest;
use BeelineOrd\Request\CreativeContent\CreativeContentGetRequest;
use BeelineOrd\Request\CreativeContent\CreativeContentPatchAllRequest;
use BeelineOrd\Request\CreativeContent\CreativeContentPatchRequest;
use BeelineOrd\Request\CreativeContent\CreativeContentPostAllRequest;
use BeelineOrd\Request\CreativeContent\CreativeContentPostFilesRequest;

class CreativeEndpoint
{
    protected ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return array<CreativeViewModel>
     */
    public function getAll(): array
    {
        return $this->client->send(new CreativeGetAllRequest());
    }

    public function get(int $creativeId): CreativeViewModel
    {
        return $this->client->send(new CreativeGetRequest($creativeId));
    }

    public function create(CreativeCreateModel $createModel): int
    {
        $result = $this->import([$createModel]);
        $ids = $result->getIds();
        if (empty($ids)) {
            throw new \UnexpectedValueException('Method did not return created ID');
        }

        return array_pop($ids);
    }

    public function update(int $id, CreativeEditModel $editModel)
    {
        return $this->client->send(new CreativePatchRequest($id, $editModel));
    }

    public function import(array $create = [], array $update = []): CreativeImportResult
    {
        return $this->client->send(new CreativePatchAllRequest($create, $update));
    }

    /**
     * @param int[] $creativeIds
     */
    public function setReadyForErir(bool $isReady, array $creativeIds)
    {
        return $this->client->send(new CreativeSetErirRequest($isReady, $creativeIds));
    }

    /**
     * @return CreativeContentViewModel[]
     */
    public function getAllContent(int $creativeId): array
    {
        return $this->client->send(new CreativeContentGetAllRequest($creativeId));
    }

    public function getContent(int $creativeContentId): CreativeContentViewModel
    {
        return $this->client->send(new CreativeContentGetRequest($creativeContentId));
    }

    public function createContent(CreativeContentCreateModel $createModel): CreativeContentImportResultErid
    {
        $result = $this->importContent([$createModel]);
        $erids = $result->getErids();
        if (empty($erids)) {
            throw new \UnexpectedValueException('Method did not return created ID');
        }
        return array_pop($erids);
    }

    public function updateContent(int $creativeContentId, CreativeContentEditModel $editModel)
    {
        return $this->client->send(new CreativeContentPatchRequest($creativeContentId, $editModel));
    }

    /**
     * @param list<CreativeContentCreateModel> $create
     * @param array<int, CreativeContentEditModel> $update
     * @return CreativeContentImportResult
     */
    public function importContent(array $create = [], array $update = [])
    {
        return $this->client->send(new CreativeContentPatchAllRequest($create, $update));
    }


    public function deleteContent(int $creativeContentId)
    {
        return $this->client->send(new CreativeContentDeleteRequest($creativeContentId));
    }

    public function deleteAllContent(array $creativeContentIds)
    {
        return $this->client->send(new CreativeContentDeleteAllRequest($creativeContentIds));
    }

    /**
     * @param int $creativeContentId
     * @param string[] $filenames
     * @throws FileException
     */
    public function uploadContent(int $creativeContentId, array $filenames): CreativeContentUploadResult
    {
        return $this->client->send(new CreativeContentPostFilesRequest($creativeContentId, $filenames));
    }

    /** @throws FileException */
    public function uploadContentArchive(int $creativeContentId, string $archiveFilename): CreativeContentUploadResult
    {
        return $this->client->send(new CreativeContentPostAllRequest($creativeContentId, $archiveFilename));
    }
}
