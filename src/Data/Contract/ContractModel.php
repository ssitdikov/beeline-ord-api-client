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
class ContractModel implements \JsonSerializable
{
    protected ContractType $type;
    protected bool $executorIsObligedForRegistration;
    protected ContractActionType $actionType;
    protected string $subjectType;
    protected string $number;
    protected \DateTimeInterface $date;
    protected ?float $amount;
    protected bool $isVat;
    protected ?int $parentContractId;
    protected ?int $customerId;
    protected ?int $executorId;
    protected ?bool $isInitialContract;
    protected ?string $customerInn;
    protected ?string $customerName;
    protected ?ContractOrganizationType $customerType;
    protected ?string $executorInn;
    protected ?string $executorName;
    protected ?ContractOrganizationType $executorType;

    public function __construct(
        ContractType $type,
        bool $executorIsObligedForRegistration,
        ContractActionType $actionType,
        string $subjectType,
        string $number,
        \DateTimeInterface $date,
        bool $isVat,
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
        ?ContractOrganizationType $executorType = null
    ) {
        $this->type = $type;
        $this->executorIsObligedForRegistration = $executorIsObligedForRegistration;
        $this->actionType = $actionType;
        $this->subjectType = $subjectType;
        $this->number = $number;
        $this->date = $date;
        $this->amount = $amount;
        $this->isVat = $isVat;
        $this->parentContractId = $parentContractId;
        $this->customerId = $customerId;
        $this->executorId = $executorId;
        $this->isInitialContract = $isInitialContract;
        $this->customerInn = $customerInn;
        $this->customerName = $customerName;
        $this->customerType = $customerType;
        $this->executorInn = $executorInn;
        $this->executorName = $executorName;
        $this->executorType = $executorType;
    }

    public function getType(): ContractType
    {
        return $this->type;
    }

    public function getExecutorIsObligedForRegistration(): bool
    {
        return $this->executorIsObligedForRegistration;
    }

    public function getActionType(): ContractActionType
    {
        return $this->actionType;
    }

    public function getSubjectType(): string
    {
        return $this->subjectType;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function getIsVat(): bool
    {
        return $this->isVat;
    }

    public function getParentContractId(): ?int
    {
        return $this->parentContractId;
    }

    public function getCustomerId(): ?int
    {
        return $this->customerId;
    }

    public function getExecutorId(): ?int
    {
        return $this->executorId;
    }

    public function getIsInitialContract(): ?bool
    {
        return $this->isInitialContract;
    }

    public function getCustomerInn(): ?string
    {
        return $this->customerInn;
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function getCustomerType(): ?ContractOrganizationType
    {
        return $this->customerType;
    }

    public function getExecutorInn(): ?string
    {
        return $this->executorInn;
    }

    public function getExecutorName(): ?string
    {
        return $this->executorName;
    }

    public function getExecutorType(): ?ContractOrganizationType
    {
        return $this->executorType;
    }

    protected static function required(): array
    {
        return ['type', 'executorIsObligedForRegistration', 'actionType', 'subjectType', 'number', 'date', 'isVat'];
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "type":
                yield fn ($data) => call_user_func([ '\BeelineOrd\Data\Contract\ContractType', 'from' ], $data);
                break;

            case "executorIsObligedForRegistration":
            case "isVat":
            case "isInitialContract":
                yield \Closure::fromCallable('boolval');
                break;

            case "actionType":
                yield fn ($data) => call_user_func([ '\BeelineOrd\Data\Contract\ContractActionType', 'from' ], $data);
                break;

            case "subjectType":
            case "number":
            case "customerInn":
            case "customerName":
            case "executorInn":
            case "executorName":
                yield \Closure::fromCallable('strval');
                break;

            case "date":
                yield static fn ($d) => new \DateTimeImmutable($d);
                break;

            case "amount":
                yield \Closure::fromCallable('floatval');
                break;

            case "parentContractId":
            case "customerId":
            case "executorId":
                yield \Closure::fromCallable('intval');
                break;

            case "customerType":
            case "executorType":
                yield fn ($data) => call_user_func([ '\BeelineOrd\Data\Contract\ContractOrganizationType', 'from' ], $data);
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
            $constructorParams["type"],
            $constructorParams["executorIsObligedForRegistration"],
            $constructorParams["actionType"],
            $constructorParams["subjectType"],
            $constructorParams["number"],
            $constructorParams["date"],
            $constructorParams["isVat"],
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
            $constructorParams["executorType"] ?? null
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
