<?php

namespace BeelineOrd\Request\CreativeContent;

use BeelineOrd\Data\CreativeContent\CreativeContentUploadResult;
use BeelineOrd\Exception\FileException;
use BeelineOrd\Request\AbstractRequest;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * @extends AbstractRequest<CreativeContentUploadResult>
 */
class CreativeContentPostFilesRequest extends AbstractRequest
{
    protected MultipartStreamBuilder $multipartStreamBuilder;

    const FIELD_NAME = 'files';

    public function __construct(int $contentId, array $filenames)
    {
        $this->query = ['creativeId' => $contentId];

        $this->multipartStreamBuilder = new MultipartStreamBuilder();
        foreach ($filenames as $filename) {
            if (! file_exists($filename)) {
                throw new FileException('file not found: ' . $filename);
            }
            if (! is_readable($filename)) {
                throw new FileException('file is not readable: ' . $filename);
            }
            $this->multipartStreamBuilder->addResource(
                static::FIELD_NAME,
                fopen($filename, 'r'),
                ['filename' => basename($filename)]
            );
        }
    }

    public function getMethod(): string
    {
        return 'PUT /data/creativeContent/files';
    }

    public function getHeaders(): array
    {
        return array_merge(
            parent::getHeaders(),
            [
                'Content-Type' => "multipart/form-data; boundary=\"{$this->multipartStreamBuilder->getBoundary()}\"",
            ]
        );
    }

    public function getBody()
    {
        return $this->multipartStreamBuilder->build();
    }

    public function createResponse(array $body): CreativeContentUploadResult
    {
        return CreativeContentUploadResult::create($body);
    }
}