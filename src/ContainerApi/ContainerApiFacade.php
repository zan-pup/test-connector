<?php

namespace App\ContainerApi;

use Productsup\ContainerApi\Client\Client;
use Productsup\ContainerApi\Client\Exception\ApiException;
use Productsup\ContainerApi\Client\Model\WriteLogInput;
use Productsup\ContainerApi\Client\Model\WriteToOutputFileInput;

class ContainerApiFacade implements ContainerApiInterface
{
    public function __construct(
        private Client $client
    )
    {
    }

    public function writeToOutputFile(array $product): void
    {
        $body = new WriteToOutputFileInput();
        $body->setData($product);

        try {
            $this->client->writeToOutputFile('output', $body);
        } catch (ApiException $exception) {
            throw new \Exception();
        }
    }

    public function log(string $level, string $message): void
    {
        $body = new WriteLogInput();
        $body->setMessage($message);

        try{
            $this->client->writeLog($level, $body);
        }
        catch (ApiException $exception){
            throw new \Exception();
        }
    }
}