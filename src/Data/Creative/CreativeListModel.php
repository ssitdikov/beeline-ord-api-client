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
class CreativeListModel implements \JsonSerializable
{
    protected int $id;
    protected string $description;
    protected string $erid;
    protected ?\DateTimeInterface $erirExportedOn;
    protected ?\DateTimeInterface $erirPlannedExportDate;

    public function __construct(
        int $id,
        string $description,
        string $erid,
        ?\DateTimeInterface $erirExportedOn = null,
        ?\DateTimeInterface $erirPlannedExportDate = null
    ) {
        $this->id = $id;
        $this->description = $description;
        $this->erid = $erid;
        $this->erirExportedOn = $erirExportedOn;
        $this->erirPlannedExportDate = $erirPlannedExportDate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getErid(): string
    {
        return $this->erid;
    }

    public function getErirExportedOn(): ?\DateTimeInterface
    {
        return $this->erirExportedOn;
    }

    public function getErirPlannedExportDate(): ?\DateTimeInterface
    {
        return $this->erirPlannedExportDate;
    }

    protected static function required(): array
    {
        return ['id', 'description', 'erid'];
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "id":
                yield \Closure::fromCallable('intval');
                break;

            case "description":
            case "erid":
                yield \Closure::fromCallable('strval');
                break;

            case "erirExportedOn":
            case "erirPlannedExportDate":
                yield static fn ($d) => new \DateTimeImmutable($d);
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
            $constructorParams["id"],
            $constructorParams["description"],
            $constructorParams["erid"],
            $constructorParams["erirExportedOn"] ?? null,
            $constructorParams["erirPlannedExportDate"] ?? null
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
