<?php
namespace BeelineOrd\Request;

use Psr\Http\Message\StreamInterface;

/**
 * @template TResponse
 */
interface RequestInterface
{
    public function getMethod(): string;
    public function shouldBeAuthorized(): bool;
    public function getHeaders(): array;
    public function getQuery(): array;

    /** @return null|string|array|\JsonSerializable|StreamInterface */
    public function getBody();

    /**
     * @param array $body
     * @return TResponse|mixed
     */
    public function createResponse(array $body);
}