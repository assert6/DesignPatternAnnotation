<?php

declare(strict_types=1);

namespace Hyperf\DesignPattern;

use Hyperf\DesignPattern\Strategy\Collector\StrategyCollector;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'annotations' => [
                'scan' => [
                    'collectors' => [
                        StrategyCollector::class,
                    ],
                ],
            ],
        ];
    }
}
