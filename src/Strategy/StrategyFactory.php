<?php

declare(strict_types=1);

namespace Hyperf\DesignPattern\Strategy;

use Hyperf\DesignPattern\Strategy\Collector\StrategyCollector;
use Hyperf\DesignPattern\Strategy\Exception\InvalidStrategyException;
use Hyperf\DesignPattern\Strategy\Exception\NotFoundStrategyException;

use function Hyperf\Support\make;
use function sprintf;

class StrategyFactory
{
    /**
     * 根据策略约束类、类型实例化策略类.
     */
    public static function create(string $strategyInterface, string|int $type, array $parameters = []): object
    {
        $strategy = StrategyCollector::getStrategy($strategyInterface, (string) $type);
        if (! $strategy) {
            throw new NotFoundStrategyException(sprintf('No strategy for type %s was found in %s', $type, $strategyInterface));
        }
        $strategy = make($strategy, ...$parameters);
        if (! $strategy instanceof $strategyInterface) {
            throw new InvalidStrategyException(sprintf('Strategy %s not instance of %s', $strategy::class, $strategyInterface));
        }
        return $strategy;
    }
}
