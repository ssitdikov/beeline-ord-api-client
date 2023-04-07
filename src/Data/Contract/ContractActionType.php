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
 *
 * ---
 *
 * @property-read string $name
 * @property-read string $value
 */
final class ContractActionType implements \JsonSerializable
{
    private static ?array $map;
    private string $name;
    private string $value;

    private function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return static[]
     */
    public static function cases(): array
    {
        return self::$map = self::$map ?? [
            new self('OTHER', 'Other'),
            new self('DISTRIBUTION', 'Distribution'),
            new self('CONCLUDE', 'Conclude'),
            new self('COMMERCIAL', 'Commercial'),
            new self('NONE', 'None'),
        ];
    }

    public function __get($propertyName)
    {
        switch ($propertyName) {
            case "name":
                return $this->name;
            case "value":
                return $this->value;
            default:
                trigger_error("Undefined property: ContractActionType::$propertyName");
                return null;
        }
    }

    public static function tryFrom(string $value): ?self
    {
        $cases = self::cases();
        return $cases[$value] ?? null;
    }

    public static function from(string $value): self
    {
        $case = self::tryFrom($value);
        if (!$case) {
            throw new \ValueError(sprintf(
                "%s is not a valid backing value for enum %s",
                var_export($value, true), self::class
            ));
        }
        return $case;
    }

    public static function OTHER(): self
    {
        return self::from('Other');
    }

    public static function DISTRIBUTION(): self
    {
        return self::from('Distribution');
    }

    public static function CONCLUDE(): self
    {
        return self::from('Conclude');
    }

    public static function COMMERCIAL(): self
    {
        return self::from('Commercial');
    }

    public static function NONE(): self
    {
        return self::from('None');
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
