<?php
declare(strict_types=1);

namespace BeelineOrd\Data\Platform;

/**
 * This class is auto-generated with klkvsk/dto-generator
 * Do not modify it, any changes might be overwritten!
 *
 * @see project://src/Data/dto.schema.php
 *
 * @link https://github.com/klkvsk/dto-generator
 * @link https://packagist.org/klkvsk/dto-generator
 */
class PlatformViewModel extends PlatformCreateModel implements \JsonSerializable
{
    protected int $id;
    protected ?\DateTimeInterface $erirExportedOn;
    protected ?\DateTimeInterface $erirPlannedExportDate;
    protected ?bool $isEditable;

    public function __construct(
        string $name,
        string $url,
        bool $isOwned,
        PlatformType $type,
        int $id,
        ?int $organizationId = null,
        ?\DateTimeInterface $erirExportedOn = null,
        ?\DateTimeInterface $erirPlannedExportDate = null,
        ?bool $isEditable = null
    ) {
        parent::__construct($name, $url, $isOwned, $type, $organizationId);
        $this->id = $id;
        $this->erirExportedOn = $erirExportedOn;
        $this->erirPlannedExportDate = $erirPlannedExportDate;
        $this->isEditable = $isEditable;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getErirExportedOn(): ?\DateTimeInterface
    {
        return $this->erirExportedOn;
    }

    public function getErirPlannedExportDate(): ?\DateTimeInterface
    {
        return $this->erirPlannedExportDate;
    }

    public function getIsEditable(): ?bool
    {
        return $this->isEditable;
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
                yield \Closure::fromCallable('intval');
                break;

            case "erirExportedOn":
            case "erirPlannedExportDate":
                yield static fn ($d) => new \DateTimeImmutable($d);
                break;

            case "isEditable":
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

        // create
        /** @psalm-suppress PossiblyNullArgument */
        return new static(
            $constructorParams["name"],
            $constructorParams["url"],
            $constructorParams["isOwned"],
            $constructorParams["type"],
            $constructorParams["id"],
            $constructorParams["organizationId"] ?? null,
            $constructorParams["erirExportedOn"] ?? null,
            $constructorParams["erirPlannedExportDate"] ?? null,
            $constructorParams["isEditable"] ?? null
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
