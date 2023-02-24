<?php

namespace BeelineOrd\Request\CreativeContent;

class CreativeContentPostAllRequest extends CreativeContentPostFilesRequest
{
    const FIELD_NAME = 'file';

    public function __construct(int $contentId, string $archiveFilename)
    {
        parent::__construct($contentId, [ $archiveFilename ]);
    }

    public function getMethod(): string
    {
        return 'POST /data/creativeContent/all';
    }

}