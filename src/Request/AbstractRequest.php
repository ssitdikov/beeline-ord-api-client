<?php
namespace BeelineOrd\Request;

use BeelineOrd\Request\RequestInterface;

/**
 * @template TResponse
 * @implements RequestInterface<TResponse>
 */
abstract class AbstractRequest implements RequestInterface
{
    protected array $query = [];
    protected $body = null;

    public function shouldBeAuthorized(): bool
    {
        return true;
    }

    public function getQuery(): array
    {
        return $this->query;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * @param array $body
     * @return TResponse|mixed
     */
    public function createResponse(array $body)
    {
        return $body;
    }
}