<?php

namespace App\Service\Handler\SourceApi;

use App\Entity\SourceApi;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HandlerSourceApi
{
//    private HttpClientInterface $client;
//
//    /**
//     * @param HttpClientInterface $client
//     */
//    public function __construct(HttpClientInterface $client)
//    {
//        $this->client = $client;
//    }
//
//    /**
//     * @throws TransportExceptionInterface
//     * @throws ServerExceptionInterface
//     * @throws RedirectionExceptionInterface
//     * @throws DecodingExceptionInterface
//     * @throws ClientExceptionInterface
//     */
//    public function fetchSourceApi(SourceApi $api): array
//    {
//        $response = $this->client->request(
//            'GET',
//            $api->getBaseEndpoint()
//        );
//
//        return $response->toArray();
//
//    }

}