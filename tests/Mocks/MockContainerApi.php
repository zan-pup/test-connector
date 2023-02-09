<?php

namespace App\Tests\Mocks;

use App\ContainerApi\ContainerApiInterface;

class MockContainerApi implements ContainerApiInterface
{
    private array $expectedProducts = [];
    private array $products = [];

    public function writeToOutputFile(array $product): void
    {
        $this->products[] = $product;
    }

    public function addExpectedProduct(array $product): void{
        $this->expectedProducts[] = $product;
    }

    public function getExpectedProducts(): array
    {
        return $this->expectedProducts;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    private array $expectedLogs = [];
    private array $logs = [];

    public function log(string $level, string $message): void
    {
        $this->logs[] = [
            'level' => $level,
            'message' => $message
        ];
    }

    public function addExpectedLog(string $level, string $message): void
    {
        $this->expectedLogs[] = [
            'level' => $level,
            'message' => $message
        ];
    }

    public function getExpectedLogs(): array
    {
        return $this->expectedLogs;
    }

    public function getLogs(): array
    {
        return $this->logs;
    }
}