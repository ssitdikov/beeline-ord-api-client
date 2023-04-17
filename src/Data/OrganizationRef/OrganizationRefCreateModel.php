<?php
declare(strict_types=1);

namespace BeelineOrd\Data\OrganizationRef;

/**
 * This class is auto-generated with klkvsk/dto-generator
 * Do not modify it, any changes might be overwritten!
 *
 * @see project://src/Data/dto.schema.php
 *
 * @link https://github.com/klkvsk/dto-generator
 * @link https://packagist.org/klkvsk/dto-generator
 */
class OrganizationRefCreateModel implements \JsonSerializable
{
    protected string $name;
    protected string $okmsNumber;
    protected OrganizationRefType $type;
    protected ?string $mobilePhone;
    protected ?string $epayNumber;
    protected ?string $regNumber;
    protected ?string $alternativeInn;

    public function __construct(
        string $name,
        string $okmsNumber,
        OrganizationRefType $type,
        ?string $mobilePhone = null,
        ?string $epayNumber = null,
        ?string $regNumber = null,
        ?string $alternativeInn = null
    ) {
        $this->name = $name;
        $this->okmsNumber = $okmsNumber;
        $this->type = $type;
        $this->mobilePhone = $mobilePhone;
        $this->epayNumber = $epayNumber;
        $this->regNumber = $regNumber;
        $this->alternativeInn = $alternativeInn;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOkmsNumber(): string
    {
        return $this->okmsNumber;
    }

    public function getType(): OrganizationRefType
    {
        return $this->type;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    public function getEpayNumber(): ?string
    {
        return $this->epayNumber;
    }

    public function getRegNumber(): ?string
    {
        return $this->regNumber;
    }

    public function getAlternativeInn(): ?string
    {
        return $this->alternativeInn;
    }

    protected static function required(): array
    {
        return ['name', 'okmsNumber', 'type'];
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "name":
            case "okmsNumber":
            case "mobilePhone":
            case "epayNumber":
            case "regNumber":
            case "alternativeInn":
                yield \Closure::fromCallable('strval');
                break;

            case "type":
                yield fn ($data) => call_user_func([ '\BeelineOrd\Data\OrganizationRef\OrganizationRefType', 'from' ], $data);
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
            $constructorParams["okmsNumber"],
            $constructorParams["type"],
            $constructorParams["mobilePhone"] ?? null,
            $constructorParams["epayNumber"] ?? null,
            $constructorParams["regNumber"] ?? null,
            $constructorParams["alternativeInn"] ?? null
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
