<?php

declare(strict_types=1);

namespace Hyperf\DesignPattern\Strategy\Collector;

use Hyperf\Di\MetadataCollector;

class StrategyCollector extends MetadataCollector
{
    protected static array $container = [];

    public static function collectClass(string $interface, string $type, string $className): void
    {
        static::$container[$interface][$type] = $className;
    }

    /**
     * @return array<string, string>
     */
    public static function getStrategies(string $interface): array
    {
        return static::$container[$interface] ?? [];
    }

    public static function getStrategy(string $interface, string $type): ?string
    {
        return static::$container[$interface][$type] ?? null;
    }
}
