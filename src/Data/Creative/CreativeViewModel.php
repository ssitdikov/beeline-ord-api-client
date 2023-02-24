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
class CreativeViewModel extends CreativeListModel implements \JsonSerializable
{
    protected CreativeType $type;
    protected CreativeForm $form;
    protected string $description;
    protected bool $isSocial;
    protected bool $isNative;

    /** @var array<string> $urls */
    protected array $urls;

    /** @var array<string> $okveds */
    protected array $okveds;
    protected ?string $targetAudienceDescription;
    protected bool $isReadyForErir;
    protected int $initialContractId;
    protected ?int $organizationId;

    public function __construct(
        int $id,
        string $description,
        string $erid,
        CreativeType $type,
        CreativeForm $form,
        bool $isSocial,
        bool $isNative,
        bool $isReadyForErir,
        int $initialContractId,
        ?\DateTimeInterface $erirExportedOn = null,
        ?\DateTimeInterface $erirPlannedExportDate = null,
        array $urls = [],
        array $okveds = [],
        ?string $targetAudienceDescription = null,
        ?int $organizationId = null
    ) {
        parent::__construct($id, $description, $erid, $erirExportedOn, $erirPlannedExportDate);
        $this->type = $type;
        $this->form = $form;
        $this->description = $description;
        $this->isSocial = $isSocial;
        $this->isNative = $isNative;
        (function(string ...$_) {})( ...$urls);
        $this->urls = $urls;
        (function(string ...$_) {})( ...$okveds);
        $this->okveds = $okveds;
        $this->targetAudienceDescription = $targetAudienceDescription;
        $this->isReadyForErir = $isReadyForErir;
        $this->initialContractId = $initialContractId;
        $this->organizationId = $organizationId;
    }

    public function getType(): CreativeType
    {
        return $this->type;
    }

    public function getForm(): CreativeForm
    {
        return $this->form;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getIsSocial(): bool
    {
        return $this->isSocial;
    }

    public function getIsNative(): bool
    {
        return $this->isNative;
    }

    /**
     * @return array<string>
     */
    public function getUrls(): array
    {
        return $this->urls;
    }

    /**
     * @return array<string>
     */
    public function getOkveds(): array
    {
        return $this->okveds;
    }

    public function getTargetAudienceDescription(): ?string
    {
        return $this->targetAudienceDescription;
    }

    public function getIsReadyForErir(): bool
    {
        return $this->isReadyForErir;
    }

    public function getInitialContractId(): int
    {
        return $this->initialContractId;
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
            ['type', 'form', 'description', 'isSocial', 'isNative', 'urls', 'isReadyForErir', 'initialContractId']
        );
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "type":
                yield fn ($data) => call_user_func([ '\BeelineOrd\Data\Creative\CreativeType', 'from' ], $data);
                break;

            case "form":
                yield fn ($data) => call_user_func([ '\BeelineOrd\Data\Creative\CreativeForm', 'from' ], $data);
                break;

            case "description":
            case "targetAudienceDescription":
                yield \Closure::fromCallable('strval');
                break;

            case "isSocial":
            case "isNative":
            case "isReadyForErir":
                yield \Closure::fromCallable('boolval');
                break;

            case "urls":
            case "okveds":
                yield fn ($array) => array_map(
                    \Closure::fromCallable('strval'),
                    (array)$array
                );
                break;

            case "initialContractId":
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

        /** @psalm-suppress PossiblyNullArgument */
        // create
        return new static(
            $constructorParams["id"],
            $constructorParams["description"],
            $constructorParams["erid"],
            $constructorParams["type"],
            $constructorParams["form"],
            $constructorParams["isSocial"],
            $constructorParams["isNative"],
            $constructorParams["isReadyForErir"],
            $constructorParams["initialContractId"],
            $constructorParams["erirExportedOn"] ?? null,
            $constructorParams["erirPlannedExportDate"] ?? null,
            $constructorParams["urls"],
            $constructorParams["okveds"],
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
