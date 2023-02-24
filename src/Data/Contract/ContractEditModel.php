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
class ContractEditModel extends ContractModel implements \JsonSerializable
{
    protected bool $isReadyForErir;

    public function __construct(
        ContractType $type,
        bool $executorIsObligedForRegistration,
        ContractActionType $actionType,
        string $subjectType,
        string $number,
        \DateTimeInterface $date,
        bool $isVat,
        bool $isReadyForErir,
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
        $this->isReadyForErir = $isReadyForErir;
    }

    public function getIsReadyForErir(): bool
    {
        return $this->isReadyForErir;
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
            ['isReadyForErir']
        );
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "isReadyForErir":
                yield \Closure::fromCallable('boolval');
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
            $constructorParams["type"],
            $constructorParams["executorIsObligedForRegistration"],
            $constructorParams["actionType"],
            $constructorParams["subjectType"],
            $constructorParams["number"],
            $constructorParams["date"],
            $constructorParams["isVat"],
            $constructorParams["isReadyForErir"],
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
