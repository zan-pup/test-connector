<?php

namespace App\Service;

use App\ContainerApi\ContainerApiInterface;
use Productsup\ContainerApi\Client\Client;
use Productsup\ContainerApi\Client\Endpoint\WriteToOutputFile;
use Productsup\ContainerApi\Client\Exception\ApiException;
use Productsup\ContainerApi\Client\Exception\ServerException;
use Productsup\ContainerApi\Client\Model\WriteToOutputFileInput;
use Psr\Http\Client\ClientExceptionInterface;

class InsertProducts
{
    public function __construct(
        private ContainerApiInterface $containerApi
    )
    {
    }

    public function insertProducts(): void
    {
        $sampleProducts = [
            [
                'id' => '1',
                'name' => 'Monitor',
                'price' => '99.99'
            ],
            [
                'id' => '2',
                'name' => 'Desktop PC',
                'price' => '499.99'
            ]
        ];

        $this->containerApi->log(ContainerApiInterface::LOG_LEVEL_NOTICE, "Starting import of sample products");

        $this->containerApi->writeToOutputFile($sampleProducts);

        $this->containerApi->log(ContainerApiInterface::LOG_LEVEL_SUCCESS, "Successfully imported sample products");
    }
}