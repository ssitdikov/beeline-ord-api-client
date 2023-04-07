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
final class ContractOrganizationType implements \JsonSerializable
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
            new self('PHYSICAL_PERSON', 'PhysicalPerson'),
            new self('LEGAL_PERSON', 'LegalPerson'),
            new self('INDIVIDUAL_ENTREPRENEUR', 'IndividualEntrepreneur'),
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
                trigger_error("Undefined property: ContractOrganizationType::$propertyName");
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

    public static function PHYSICAL_PERSON(): self
    {
        return self::from('PhysicalPerson');
    }

    public static function LEGAL_PERSON(): self
    {
        return self::from('LegalPerson');
    }

    public static function INDIVIDUAL_ENTREPRENEUR(): self
    {
        return self::from('IndividualEntrepreneur');
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
