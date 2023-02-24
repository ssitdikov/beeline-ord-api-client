<?php
declare(strict_types=1);

namespace BeelineOrd\Data\User;

/**
 * This class is auto-generated with klkvsk/dto-generator
 * Do not modify it, any changes might be overwritten!
 *
 * @see project://src/Data/dto.schema.php
 *
 * @link https://github.com/klkvsk/dto-generator
 * @link https://packagist.org/klkvsk/dto-generator
 */
class UserViewModel implements \JsonSerializable
{
    protected ?int $id;
    protected ?int $organizationId;
    protected ?string $username;
    protected ?string $inn;
    protected ?string $email;
    protected ?string $role;

    /** @var array<string> $permissions */
    protected array $permissions;

    public function __construct(
        ?int $id = null,
        ?int $organizationId = null,
        ?string $username = null,
        ?string $inn = null,
        ?string $email = null,
        ?string $role = null,
        array $permissions = []
    ) {
        $this->id = $id;
        $this->organizationId = $organizationId;
        $this->username = $username;
        $this->inn = $inn;
        $this->email = $email;
        $this->role = $role;
        (function(string ...$_) {})( ...$permissions);
        $this->permissions = $permissions;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrganizationId(): ?int
    {
        return $this->organizationId;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getInn(): ?string
    {
        return $this->inn;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @return array<string>
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "id":
            case "organizationId":
                yield \Closure::fromCallable('intval');
                break;

            case "username":
            case "inn":
            case "email":
            case "role":
                yield \Closure::fromCallable('strval');
                break;

            case "permissions":
                yield fn ($array) => array_map(
                    \Closure::fromCallable('strval'),
                    (array)$array
                );
                break;
        };
    }

    /**
     * @return static
     */
    public static function create(array $data): self
    {
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
            $constructorParams["id"] ?? null,
            $constructorParams["organizationId"] ?? null,
            $constructorParams["username"] ?? null,
            $constructorParams["inn"] ?? null,
            $constructorParams["email"] ?? null,
            $constructorParams["role"] ?? null,
            $constructorParams["permissions"]
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
