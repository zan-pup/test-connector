<?php

namespace App\Tests\Command;

use App\Command\DatasourceCommand;
use App\ContainerApi\ContainerApiInterface;
use App\Tests\Mocks\MockContainerApi;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class DatasourceCommandTest extends KernelTestCase
{
    private MockHandler $handler;
    private array $guzzleHistory = [];

    public function testImport()
    {
        self::bootKernel();
        $container = static::getContainer();

        $containerApiMock = $container->get(MockContainerApi::class);

        $containerApiMock->addExpectedLog(ContainerApiInterface::LOG_LEVEL_NOTICE, 'Starting import of sample products');
        $containerApiMock->addExpectedLog(ContainerApiInterface::LOG_LEVEL_SUCCESS, 'Successfully imported sample products');
        $containerApiMock->addExpectedProduct([
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
        ]);

        $commandTester = new CommandTester($container->get(DatasourceCommand::class));
        $returnCode = $commandTester->execute([]);

        $this->assertSame(0, $returnCode);
        $this->assertSame($containerApiMock->getExpectedLogs(), $containerApiMock->getLogs());
        $this->assertSame($containerApiMock->getExpectedProducts(), $containerApiMock->getProducts());
    }

    private function buildMockClient($container): void
    {
        $history = Middleware::history($this->guzzleHistory);
        $this->handler = new MockHandler();

        $stack = HandlerStack::create($this->handler);
        $stack->push($history);

        $container->set(HandlerStack::class, $stack);
    }

}