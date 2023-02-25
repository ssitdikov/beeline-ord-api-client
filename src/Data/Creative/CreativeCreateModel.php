<?php
declare(strict_types=1);

namespace BeelineOrd\Data\Creative;

/**
 * This class is auto-generated with klkvsk/dto-generator
 * Do not modify it, any changes might be overwritten!
 *
 * @see project://src/Data/dto.schema.php
 *
 * @link https://github.com/klkvsk/dto-generator
 * @link https://packagist.org/klkvsk/dto-generator
 */
class CreativeCreateModel extends CreativeEditModel implements \JsonSerializable
{
    protected ?int $organizationId;

    public function __construct(
        CreativeType $type,
        CreativeForm $form,
        string $description,
        bool $isSocial,
        bool $isNative,
        bool $isReadyForErir,
        int $initialContractId,
        array $urls = [],
        ?array $okveds = [],
        ?string $targetAudienceDescription = null,
        ?int $organizationId = null
    ) {
        parent::__construct(
            $type,
            $form,
            $description,
            $isSocial,
            $isNative,
            $isReadyForErir,
            $initialContractId,
            $urls,
            $okveds,
            $targetAudienceDescription
        );
        $this->organizationId = $organizationId;
    }

    public function getOrganizationId(): ?int
    {
        return $this->organizationId;
    }

    protected static function defaults(): array
    {
        return array_merge(
            method_exists(parent::class, "defaults") ? parent::defaults() : [],
            []
        );
    }

    protected static function required(): array
    {
        return array_merge(
            method_exists(parent::class, "required") ? parent::required() : [],
            []
        );
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "organizationId":
                yield \Closure::fromCallable('intval');
                break;

            default:
                if (method_exists(parent::class, "importers")) {
                    yield from parent::importers($key);
                };
        };
    }

    /**
     * @return static
     */
    public static function create(array $data): self
    {
        // defaults
        $data += static::defaults();

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
            $constructorParams["type"],
            $constructorParams["form"],
            $constructorParams["description"],
            $constructorParams["isSocial"],
            $constructorParams["isNative"],
            $constructorParams["isReadyForErir"],
            $constructorParams["initialContractId"],
            $constructorParams["urls"],
            $constructorParams["okveds"] ?? null,
            $constructorParams["targetAudienceDescription"] ?? null,
            $constructorParams["organizationId"] ?? null
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
