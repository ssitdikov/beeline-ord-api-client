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
final class CreativeType implements \JsonSerializable
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
            'Other' => new self('OTHER', 'Other'),
            'PayForViews' => new self('PAY_FOR_VIEWS', 'PayForViews'),
            'PayForClicks' => new self('PAY_FOR_CLICKS', 'PayForClicks'),
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

    public static function OTHER(): self
    {
        return self::from('Other');
    }

    public static function PAY_FOR_VIEWS(): self
    {
        return self::from('PayForViews');
    }

    public static function PAY_FOR_CLICKS(): self
    {
        return self::from('PayForClicks');
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
