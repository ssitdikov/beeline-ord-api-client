<?php
declare(strict_types=1);

namespace BeelineOrd\Data\InvoiceItemStatistics;

/**
 * This class is auto-generated with klkvsk/dto-generator
 * Do not modify it, any changes might be overwritten!
 *
 * @see project://src/Data/dto.schema.php
 *
 * @link https://github.com/klkvsk/dto-generator
 * @link https://packagist.org/klkvsk/dto-generator
 */
class InvoiceItemStatisticsEditModel implements \JsonSerializable
{
    protected int $actualImpressionsCount;
    protected int $plannedImpressionsCount;
    protected \DateTimeInterface $plannedStartDate;
    protected \DateTimeInterface $plannedEndDate;
    protected \DateTimeInterface $actualStartDate;
    protected \DateTimeInterface $actualEndDate;
    protected float $totalAmount;
    protected float $amountPerShow;
    protected bool $isVat;

    public function __construct(
        int $actualImpressionsCount,
        int $plannedImpressionsCount,
        \DateTimeInterface $plannedStartDate,
        \DateTimeInterface $plannedEndDate,
        \DateTimeInterface $actualStartDate,
        \DateTimeInterface $actualEndDate,
        float $totalAmount,
        float $amountPerShow,
        bool $isVat
    ) {
        $this->actualImpressionsCount = $actualImpressionsCount;
        $this->plannedImpressionsCount = $plannedImpressionsCount;
        $this->plannedStartDate = $plannedStartDate;
        $this->plannedEndDate = $plannedEndDate;
        $this->actualStartDate = $actualStartDate;
        $this->actualEndDate = $actualEndDate;
        $this->totalAmount = $totalAmount;
        $this->amountPerShow = $amountPerShow;
        $this->isVat = $isVat;
    }

    public function getActualImpressionsCount(): int
    {
        return $this->actualImpressionsCount;
    }

    public function getPlannedImpressionsCount(): int
    {
        return $this->plannedImpressionsCount;
    }

    public function getPlannedStartDate(): \DateTimeInterface
    {
        return $this->plannedStartDate;
    }

    public function getPlannedEndDate(): \DateTimeInterface
    {
        return $this->plannedEndDate;
    }

    public function getActualStartDate(): \DateTimeInterface
    {
        return $this->actualStartDate;
    }

    public function getActualEndDate(): \DateTimeInterface
    {
        return $this->actualEndDate;
    }

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function getAmountPerShow(): float
    {
        return $this->amountPerShow;
    }

    public function getIsVat(): bool
    {
        return $this->isVat;
    }

    protected static function required(): array
    {
        return [
            'actualImpressionsCount',
            'plannedImpressionsCount',
            'plannedStartDate',
            'plannedEndDate',
            'actualStartDate',
            'actualEndDate',
            'totalAmount',
            'amountPerShow',
            'isVat',
        ];
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "actualImpressionsCount":
            case "plannedImpressionsCount":
                yield \Closure::fromCallable('intval');
                break;

            case "plannedStartDate":
            case "plannedEndDate":
            case "actualStartDate":
            case "actualEndDate":
                yield static fn ($d) => new \DateTimeImmutable($d);
                break;

            case "totalAmount":
            case "amountPerShow":
                yield \Closure::fromCallable('floatval');
                break;

            case "isVat":
                yield \Closure::fromCallable('boolval');
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
            $constructorParams["actualImpressionsCount"],
            $constructorParams["plannedImpressionsCount"],
            $constructorParams["plannedStartDate"],
            $constructorParams["plannedEndDate"],
            $constructorParams["actualStartDate"],
            $constructorParams["actualEndDate"],
            $constructorParams["totalAmount"],
            $constructorParams["amountPerShow"],
            $constructorParams["isVat"]
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
