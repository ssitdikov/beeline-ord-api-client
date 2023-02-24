<?php
declare(strict_types=1);

namespace BeelineOrd\Data\InvoiceItem;

/**
 * This class is auto-generated with klkvsk/dto-generator
 * Do not modify it, any changes might be overwritten!
 *
 * @see project://src/Data/dto.schema.php
 *
 * @link https://github.com/klkvsk/dto-generator
 * @link https://packagist.org/klkvsk/dto-generator
 */
class InvoiceItemEditModel implements \JsonSerializable
{
    protected ?string $name;
    protected float $amount;
    protected bool $isVat;
    protected int $initialContractId;

    public function __construct(float $amount, bool $isVat, int $initialContractId, ?string $name = null)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->isVat = $isVat;
        $this->initialContractId = $initialContractId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getIsVat(): bool
    {
        return $this->isVat;
    }

    public function getInitialContractId(): int
    {
        return $this->initialContractId;
    }

    protected static function required(): array
    {
        return ['amount', 'isVat', 'initialContractId'];
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "name":
                yield \Closure::fromCallable('strval');
                break;

            case "amount":
                yield \Closure::fromCallable('floatval');
                break;

            case "isVat":
                yield \Closure::fromCallable('boolval');
                break;

            case "initialContractId":
                yield \Closure::fromCallable('intval');
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

        /** @psalm-suppress PossiblyNullArgument */
        // create
        return new static(
            $constructorParams["amount"],
            $constructorParams["isVat"],
            $constructorParams["initialContractId"],
            $constructorParams["name"] ?? null
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
