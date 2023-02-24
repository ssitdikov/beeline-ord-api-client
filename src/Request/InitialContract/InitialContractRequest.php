<?php

namespace BeelineOrd\Request\InitialContract;

use BeelineOrd\Data\Contract\InitialContract;
use BeelineOrd\Request\AbstractRequest;

/**
 * @extends AbstractRequest<InitialContract>
 */
class InitialContractRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return 'GET /data/initialContract/all/ByInn';
    }

    public function __construct(string $customerInn, string $executorInn, \DateTimeInterface $date = null)
    {
        $this->query = [
            'customerInn' => $customerInn,
            'executorInn' => $executorInn,
        ];
        if ($date) {
            $this->query['date'] = $date->format(DATE_RFC3339);
        }
    }


    public function createResponse(array $body): InitialContract
    {
        return InitialContract::create($body);
    }

}