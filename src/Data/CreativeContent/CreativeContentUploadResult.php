<?php
declare(strict_types=1);

namespace BeelineOrd\Data\CreativeContent;

/**
 * This class is auto-generated with klkvsk/dto-generator
 * Do not modify it, any changes might be overwritten!
 *
 * @see project://src/Data/dto.schema.php
 *
 * @link https://github.com/klkvsk/dto-generator
 * @link https://packagist.org/klkvsk/dto-generator
 */
class CreativeContentUploadResult implements \JsonSerializable
{
    protected ?int $filesCount;
    protected ?int $uploadedFilesCount;

    /** @var ?array<CreativeContentUploadResultFileError> $fileErrors */
    protected ?array $fileErrors;

    public function __construct(?int $filesCount = null, ?int $uploadedFilesCount = null, ?array $fileErrors = [])
    {
        $this->filesCount = $filesCount;
        $this->uploadedFilesCount = $uploadedFilesCount;
        $fileErrors && (function(CreativeContentUploadResultFileError ...$_) {})( ...$fileErrors);
        $this->fileErrors = $fileErrors;
    }

    public function getFilesCount(): ?int
    {
        return $this->filesCount;
    }

    public function getUploadedFilesCount(): ?int
    {
        return $this->uploadedFilesCount;
    }

    /**
     * @return ?array<CreativeContentUploadResultFileError>
     */
    public function getFileErrors(): ?array
    {
        return $this->fileErrors;
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "filesCount":
            case "uploadedFilesCount":
                yield \Closure::fromCallable('intval');
                break;

            case "fileErrors":
                yield fn ($array) => array_map(
                    fn ($data) => call_user_func([ '\BeelineOrd\Data\CreativeContent\CreativeContentUploadResultFileError', 'create' ], $data),
                    (array)$array
                );
                break;
        };
    }

    /**
     * @return static
     */
    public static function create(array $data): self
    {
        // import
        $constructorParams = [];
        foreach ($data as $key => $value) {
            foreach (static::importers($key) as $importer) if ($value !== null) {
                $value = call_user_func($importer, $value);
            }
            if (property_exists(static::class, $key)) {
                $constructorParams[$key] = $value;
            }
        }

        // create
        /** @psalm-suppress PossiblyNullArgument */
        return new static(
            $constructorParams["filesCount"] ?? null,
            $constructorParams["uploadedFilesCount"] ?? null,
            $constructorParams["fileErrors"] ?? null
        );
    }

    public function toArray(): array
    {
        $array = [];
        foreach (get_mangled_object_vars($this) as $var => $value) {
            $var = preg_replace("/.+\0/", "", $var);
            if ($value instanceof \DateTimeInterface) {
                $value = $value->format('Y-m-d\TH:i:sP');
            }
            if (is_object($value) && method_exists($value, 'toArray')) {
                $value = $value->toArray();
            }
            $array[$var] = $value;
        }
        return $array;
    }

    public function jsonSerialize(): array
    {
        $array = [];
        foreach (get_mangled_object_vars($this) as $var => $value) {
            $var = substr($var, strrpos($var, "\0") ?: 0);
            if ($value instanceof \DateTimeInterface) {
                $value = $value->format('Y-m-d\TH:i:sP');
            }
            if ($value instanceof \JsonSerializable) {
                $value = $value->jsonSerialize();
            }
            $array[$var] = $value;
        }
        return $array;
    }
}
