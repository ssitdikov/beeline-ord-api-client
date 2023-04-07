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
 *
 * ---
 *
 * @property-read string $name
 * @property-read string $value
 */
final class CreativeForm implements \JsonSerializable
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
            new self('BANNER', 'Banner'),
            new self('TEXT_BLOCK', 'TextBlock'),
            new self('TEXT_GRAPHIC_BLOCK', 'TextGraphicBlock'),
            new self('VIDEO', 'Video'),
            new self('AUDIO_RECORD', 'AudioRecord'),
            new self('LIVE_AUDIO', 'LiveAudio'),
            new self('LIVE_VIDEO', 'LiveVideo'),
            new self('OTHER', 'Other'),
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
                trigger_error("Undefined property: CreativeForm::$propertyName");
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

    public static function BANNER(): self
    {
        return self::from('Banner');
    }

    public static function TEXT_BLOCK(): self
    {
        return self::from('TextBlock');
    }

    public static function TEXT_GRAPHIC_BLOCK(): self
    {
        return self::from('TextGraphicBlock');
    }

    public static function VIDEO(): self
    {
        return self::from('Video');
    }

    public static function AUDIO_RECORD(): self
    {
        return self::from('AudioRecord');
    }

    public static function LIVE_AUDIO(): self
    {
        return self::from('LiveAudio');
    }

    public static function LIVE_VIDEO(): self
    {
        return self::from('LiveVideo');
    }

    public static function OTHER(): self
    {
        return self::from('Other');
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
