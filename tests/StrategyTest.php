<?php

declare(strict_types=1);

namespace HyperfTest\DesignPattern;

use Hyperf\DesignPattern\Strategy\Collector\StrategyCollector;
use Hyperf\DesignPattern\Strategy\Exception\NotFoundStrategyException;
use Hyperf\DesignPattern\Strategy\StrategyFactory;
use Mockery;
use PHPUnit\Framework\TestCase;
use HyperfTest\DesignPattern\Stub\Bar;
use HyperfTest\DesignPattern\Stub\FooInterface;

/**
 * @internal
 * @coversNothing
 */
class StrategyTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testStrategyCollector()
    {
        StrategyCollector::collectClass('interface', 'type', 'class');
        $this->assertSame(['type' => 'class'], StrategyCollector::getStrategies('interface'));
        $this->assertSame('class', StrategyCollector::getStrategy('interface', 'type'));
    }

    public function testStrategyFactoryFail()
    {
        $this->expectException(NotFoundStrategyException::class);
        $this->expectExceptionMessage('No strategy for type 1 was found in HyperfTest\DesignPattern\Stub\FooInterface');
        StrategyFactory::create(FooInterface::class, 1);
    }

    public function testStrategyFactory()
    {
        StrategyCollector::collectClass(FooInterface::class, '1', Bar::class);
        $strategy = StrategyFactory::create(FooInterface::class, 1);
        $this->assertInstanceOf(FooInterface::class, $strategy);
    }
}
