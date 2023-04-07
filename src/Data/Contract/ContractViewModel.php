<?php
declare(strict_types=1);

namespace BeelineOrd\Data\Contract;

/**
 * This class is auto-generated with klkvsk/dto-generator
 * Do not modify it, any changes might be overwritten!
 *
 * @see project://src/Data/dto.schema.php
 *
 * @link https://github.com/klkvsk/dto-generator
 * @link https://packagist.org/klkvsk/dto-generator
 */
class ContractViewModel extends ContractModel implements \JsonSerializable
{
    protected int $id;
    protected ?int $parentContractId;
    protected ?\DateTimeInterface $erirExportedOn;
    protected ?\DateTimeInterface $erirPlannedExportDate;

    public function __construct(
        ContractType $type,
        bool $executorIsObligedForRegistration,
        ContractActionType $actionType,
        string $subjectType,
        string $number,
        \DateTimeInterface $date,
        bool $isVat,
        int $id,
        ?float $amount = null,
        ?int $parentContractId = null,
        ?int $customerId = null,
        ?int $executorId = null,
        ?bool $isInitialContract = null,
        ?string $customerInn = null,
        ?string $customerName = null,
        ?ContractOrganizationType $customerType = null,
        ?string $executorInn = null,
        ?string $executorName = null,
        ?ContractOrganizationType $executorType = null,
        ?\DateTimeInterface $erirExportedOn = null,
        ?\DateTimeInterface $erirPlannedExportDate = null
    ) {
        parent::__construct(
            $type,
            $executorIsObligedForRegistration,
            $actionType,
            $subjectType,
            $number,
            $date,
            $isVat,
            $amount,
            $parentContractId,
            $customerId,
            $executorId,
            $isInitialContract,
            $customerInn,
            $customerName,
            $customerType,
            $executorInn,
            $executorName,
            $executorType
        );
        $this->id = $id;
        $this->parentContractId = $parentContractId;
        $this->erirExportedOn = $erirExportedOn;
        $this->erirPlannedExportDate = $erirPlannedExportDate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getParentContractId(): ?int
    {
        return $this->parentContractId;
    }

    public function getErirExportedOn(): ?\DateTimeInterface
    {
        return $this->erirExportedOn;
    }

    public function getErirPlannedExportDate(): ?\DateTimeInterface
    {
        return $this->erirPlannedExportDate;
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
            ['id']
        );
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "id":
            case "parentContractId":
                yield \Closure::fromCallable('intval');
                break;

            case "erirExportedOn":
            case "erirPlannedExportDate":
                yield static fn ($d) => new \DateTimeImmutable($d);
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
            $constructorParams["executorIsObligedForRegistration"],
            $constructorParams["actionType"],
            $constructorParams["subjectType"],
            $constructorParams["number"],
            $constructorParams["date"],
            $constructorParams["isVat"],
            $constructorParams["id"],
            $constructorParams["amount"] ?? null,
            $constructorParams["parentContractId"] ?? null,
            $constructorParams["customerId"] ?? null,
            $constructorParams["executorId"] ?? null,
            $constructorParams["isInitialContract"] ?? null,
            $constructorParams["customerInn"] ?? null,
            $constructorParams["customerName"] ?? null,
            $constructorParams["customerType"] ?? null,
            $constructorParams["executorInn"] ?? null,
            $constructorParams["executorName"] ?? null,
            $constructorParams["executorType"] ?? null,
            $constructorParams["erirExportedOn"] ?? null,
            $constructorParams["erirPlannedExportDate"] ?? null
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
