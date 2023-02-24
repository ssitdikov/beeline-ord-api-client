<?php
declare(strict_types=1);

namespace BeelineOrd\Data\Platform;

/**
 * This class is auto-generated with klkvsk/dto-generator
 * Do not modify it, any changes might be overwritten!
 *
 * @see project://src/Data/dto.schema.php
 *
 * @link https://github.com/klkvsk/dto-generator
 * @link https://packagist.org/klkvsk/dto-generator
 */
class PlatformEditModel implements \JsonSerializable
{
    protected string $name;
    protected string $url;
    protected bool $isOwned;
    protected PlatformType $type;

    public function __construct(string $name, string $url, bool $isOwned, PlatformType $type)
    {
        $this->name = $name;
        $this->url = $url;
        $this->isOwned = $isOwned;
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getIsOwned(): bool
    {
        return $this->isOwned;
    }

    public function getType(): PlatformType
    {
        return $this->type;
    }

    protected static function required(): array
    {
        return ['name', 'url', 'isOwned', 'type'];
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "name":
            case "url":
                yield \Closure::fromCallable('strval');
                break;

            case "isOwned":
                yield \Closure::fromCallable('boolval');
                break;

            case "type":
                yield fn ($data) => call_user_func([ '\BeelineOrd\Data\Platform\PlatformType', 'from' ], $data);
                break;
        };
    }

    /**
     * @return static
     */
    public static function create(array $data): self
    {
        // check required
        if ($diff = array_diff(static::required(), array_keys($data))) {
            throw new \InvalidArgumentException("missing keys: " . implode(", ", $diff));
        }

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
            $constructorParams["name"],
            $constructorParams["url"],
            $constructorParams["isOwned"],
            $constructorParams["type"]
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
