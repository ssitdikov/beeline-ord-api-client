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
class CreativeEditModel implements \JsonSerializable
{
    protected CreativeType $type;
    protected CreativeForm $form;
    protected string $description;
    protected bool $isSocial;
    protected bool $isNative;

    /** @var array<mixed> $urls */
    protected array $urls;

    /** @var array<string> $okveds */
    protected array $okveds;
    protected ?string $targetAudienceDescription;
    protected bool $isReadyForErir;
    protected int $initialContractId;

    public function __construct(
        CreativeType $type,
        CreativeForm $form,
        string $description,
        bool $isSocial,
        bool $isNative,
        bool $isReadyForErir,
        int $initialContractId,
        array $urls = [],
        array $okveds = [],
        ?string $targetAudienceDescription = null
    ) {
        $this->type = $type;
        $this->form = $form;
        $this->description = $description;
        $this->isSocial = $isSocial;
        $this->isNative = $isNative;
        (function( ...$_) {})( ...$urls);
        $this->urls = $urls;
        (function(string ...$_) {})( ...$okveds);
        $this->okveds = $okveds;
        $this->targetAudienceDescription = $targetAudienceDescription;
        $this->isReadyForErir = $isReadyForErir;
        $this->initialContractId = $initialContractId;
        $this->validate([
            'urls' => [
                'should be at least one' => fn (array $urls) => \count($urls) > 0,
                'should be [ {url: ...}, ]' => function (array $urls) {
                    foreach ($urls as $url) {
                        if (!\is_array($url) || !isset($url['url'])) {
                            return false;
                        }
                    }
                    return true;
                },
            ],
        ]);
    }

    public function getType(): CreativeType
    {
        return $this->type;
    }

    public function getForm(): CreativeForm
    {
        return $this->form;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getIsSocial(): bool
    {
        return $this->isSocial;
    }

    public function getIsNative(): bool
    {
        return $this->isNative;
    }

    /**
     * @return array<mixed>
     */
    public function getUrls(): array
    {
        return $this->urls;
    }

    /**
     * @return array<string>
     */
    public function getOkveds(): array
    {
        return $this->okveds;
    }

    public function getTargetAudienceDescription(): ?string
    {
        return $this->targetAudienceDescription;
    }

    public function getIsReadyForErir(): bool
    {
        return $this->isReadyForErir;
    }

    public function getInitialContractId(): int
    {
        return $this->initialContractId;
    }

    protected function validate(array $rules): void
    {
        array_walk($rules, fn(&$vs, $f) => array_walk($vs, fn(&$v) => $v = false === call_user_func($v, $this->{$f})));
        $failedRules = array_filter(array_map(fn($r) => array_keys(array_filter($r)), $rules));
        if ($failedRules) throw new \InvalidArgumentException(json_encode($failedRules));
    }

    protected static function required(): array
    {
        return ['type', 'form', 'description', 'isSocial', 'isNative', 'urls', 'isReadyForErir', 'initialContractId'];
    }

    /**
     * @return iterable<int,\Closure>
     */
    protected static function importers(string $key): iterable
    {
        switch ($key) {
            case "type":
                yield fn ($data) => call_user_func([ '\BeelineOrd\Data\Creative\CreativeType', 'from' ], $data);
                break;

            case "form":
                yield fn ($data) => call_user_func([ '\BeelineOrd\Data\Creative\CreativeForm', 'from' ], $data);
                break;

            case "description":
            case "targetAudienceDescription":
                yield \Closure::fromCallable('strval');
                break;

            case "isSocial":
            case "isNative":
            case "isReadyForErir":
                yield \Closure::fromCallable('boolval');
                break;

            case "urls":
                yield static fn ($array) => (array)$array;
                break;

            case "okveds":
                yield fn ($array) => array_map(
                    \Closure::fromCallable('strval'),
                    (array)$array
                );
                break;

            case "initialContractId":
                yield \Closure::fromCallable('intval');
                break;
        };
    }

    /**
     * @return static
     */
    public static function create(array $data): self
    {
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
            $constructorParams["type"],
            $constructorParams["form"],
            $constructorParams["description"],
            $constructorParams["isSocial"],
            $constructorParams["isNative"],
            $constructorParams["isReadyForErir"],
            $constructorParams["initialContractId"],
            $constructorParams["urls"],
            $constructorParams["okveds"],
            $constructorParams["targetAudienceDescription"] ?? null
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
