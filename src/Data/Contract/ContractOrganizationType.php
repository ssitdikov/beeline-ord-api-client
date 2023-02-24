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
final class ContractOrganizationType implements \JsonSerializable
{
    public static ?array $map;
    public string $name;
    public $value;

    private function __construct(string $name, $value)
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
            'PhysicalPerson' => new self('PHYSICAL_PERSON', 'PhysicalPerson'),
            'LegalPerson' => new self('LEGAL_PERSON', 'LegalPerson'),
            'IndividualEntrepreneur' => new self('INDIVIDUAL_ENTREPRENEUR', 'IndividualEntrepreneur'),
        ];
    }

    public function name(): string
    {
        return $this->name;
    }

    public function value()
    {
        return $this->value;
    }

    public static function tryFrom($value): ?self
    {
        $cases = self::cases();
        return $cases[$value] ?? null;
    }

    public static function from($value): self
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

    public function jsonSerialize(): array
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
