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
class CreativeContentUploadResultFileError implements \JsonSerializable
{
    protected ?string $fileName;
    protected ?string $error;

    public function __construct(?string $fileName = null, ?string $error = null)
    {
        $this->fileName = $fileName;
        $this->error = $error;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "fileName":
            case "error":
                yield \Closure::fromCallable('strval');
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

        /** @psalm-suppress PossiblyNullArgument */
        // create
        return new static(
            $constructorParams["fileName"] ?? null,
            $constructorParams["error"] ?? null
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

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        $array = [];
        foreach (get_mangled_object_vars($this) as $var => $value) {
            $var = preg_replace("/.+\0/", "", $var);
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
