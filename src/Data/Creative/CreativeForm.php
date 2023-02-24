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
final class CreativeForm implements \JsonSerializable
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
            'Banner' => new self('BANNER', 'Banner'),
            'TextBlock' => new self('TEXT_BLOCK', 'TextBlock'),
            'TextGraphicBlock' => new self('TEXT_GRAPHIC_BLOCK', 'TextGraphicBlock'),
            'Video' => new self('VIDEO', 'Video'),
            'AudioRecord' => new self('AUDIO_RECORD', 'AudioRecord'),
            'LiveAudio' => new self('LIVE_AUDIO', 'LiveAudio'),
            'LiveVideo' => new self('LIVE_VIDEO', 'LiveVideo'),
            'Other' => new self('OTHER', 'Other'),
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

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->value;
    }
}
