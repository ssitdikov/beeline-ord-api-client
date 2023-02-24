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
final class ContractType implements \JsonSerializable
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
            'Intermediary' => new self('INTERMEDIARY', 'Intermediary'),
            'Original' => new self('ORIGINAL', 'Original'),
            'Additional' => new self('ADDITIONAL', 'Additional'),
            'SelfPromotion' => new self('SELF_PROMOTION', 'SelfPromotion'),
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

    public static function INTERMEDIARY(): self
    {
        return self::from('Intermediary');
    }

    public static function ORIGINAL(): self
    {
        return self::from('Original');
    }

    public static function ADDITIONAL(): self
    {
        return self::from('Additional');
    }

    public static function SELF_PROMOTION(): self
    {
        return self::from('SelfPromotion');
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->value;
    }
}
