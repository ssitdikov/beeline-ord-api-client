<?php
declare(strict_types=1);

namespace BeelineOrd\Data\Invoice;

/**
 * This class is auto-generated with klkvsk/dto-generator
 * Do not modify it, any changes might be overwritten!
 *
 * @see project://src/Data/dto.schema.php
 *
 * @link https://github.com/klkvsk/dto-generator
 * @link https://packagist.org/klkvsk/dto-generator
 */
final class InvoiceOrganizationRole implements \JsonSerializable
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
            'AdvertisingAgency' => new self('ADVERTISING_AGENCY', 'AdvertisingAgency'),
            'AdvertisingDistributor' => new self('ADVERTISING_DISTRIBUTOR', 'AdvertisingDistributor'),
            'AdvertisingSystemOperator' => new self('ADVERTISING_SYSTEM_OPERATOR', 'AdvertisingSystemOperator'),
            'Advertiser' => new self('ADVERTISER', 'Advertiser'),
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

    public static function ADVERTISING_AGENCY(): self
    {
        return self::from('AdvertisingAgency');
    }

    public static function ADVERTISING_DISTRIBUTOR(): self
    {
        return self::from('AdvertisingDistributor');
    }

    public static function ADVERTISING_SYSTEM_OPERATOR(): self
    {
        return self::from('AdvertisingSystemOperator');
    }

    public static function ADVERTISER(): self
    {
        return self::from('Advertiser');
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->value;
    }
}
