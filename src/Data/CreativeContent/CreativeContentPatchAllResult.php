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
class CreativeContentPatchAllResult implements \JsonSerializable
{
    /** @var ?array<CreativeContentPatchAllResultErid> $erids */
    protected ?array $erids;

    /** @var ?array<int> $ids */
    protected ?array $ids;

    public function __construct(?array $erids = [], ?array $ids = [])
    {
        $erids && (function(CreativeContentPatchAllResultErid ...$_) {})( ...$erids);
        $this->erids = $erids;
        $ids && (function(int ...$_) {})( ...$ids);
        $this->ids = $ids;
    }

    /**
     * @return ?array<CreativeContentPatchAllResultErid>
     */
    public function getErids(): ?array
    {
        return $this->erids;
    }

    /**
     * @return ?array<int>
     */
    public function getIds(): ?array
    {
        return $this->ids;
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "erids":
                yield fn ($array) => array_map(
                    fn ($data) => call_user_func([ '\BeelineOrd\Data\CreativeContent\CreativeContentPatchAllResultErid', 'create' ], $data),
                    (array)$array
                );
                break;

            case "ids":
                yield fn ($array) => array_map(
                    \Closure::fromCallable('intval'),
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
            $constructorParams["erids"] ?? null,
            $constructorParams["ids"] ?? null
        );
    }

    public function toArray(): array
    {
        $array = [];
        foreach (get_object_vars($this) as $var => $value) {
            if ($value instanceof \DateTimeInterface) {
                $value = $value->format('Y-m-d\TH:i:sP');
            }
            if (is_object($value) && method_exists($value, 'toArray')) {
                $value = $value->toArray();
            }
            if (class_exists(\UnitEnum::class) && $value instanceof \UnitEnum) {
                $value = $value->value;
            }
            if (is_object($value) && method_exists($value, "__toString")) {
                $value = (string)$value;
            }
            $array[$var] = $value;
        }
        return $array;
    }

    public function jsonSerialize(): array
    {
        $array = [];
        foreach (get_object_vars($this) as $var => $value) {
            if ($value instanceof \DateTimeInterface) {
                $value = $value->format('Y-m-d\TH:i:sP');
            }
            if ($value instanceof \JsonSerializable) {
                $value = $value->jsonSerialize();
            }
            if (class_exists(\UnitEnum::class) && $value instanceof \UnitEnum) {
                $value = $value->value;
            }
            if (is_object($value) && method_exists($value, "__toString")) {
                $value = (string)$value;
            }
            $array[$var] = $value;
        }
        return $array;
    }
}
