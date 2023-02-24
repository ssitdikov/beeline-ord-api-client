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
class InitialContract implements \JsonSerializable
{
    protected int $id;
    protected ?string $number;
    protected ?\DateTimeInterface $date;

    public function __construct(int $id, ?string $number = null, ?\DateTimeInterface $date = null)
    {
        $this->id = $id;
        $this->number = $number;
        $this->date = $date;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    protected static function required(): array
    {
        return ['id'];
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

            case "number":
                yield \Closure::fromCallable('strval');
                break;

            case "date":
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
            $constructorParams["number"] ?? null,
            $constructorParams["date"] ?? null
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
