<?php

declare(strict_types=1);

namespace Hyperf\DesignPattern\Strategy\Annotation;

use Hyperf\DesignPattern\Strategy\Collector\StrategyCollector;
use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;
use InvalidArgumentException;

#[Attribute(Attribute::TARGET_CLASS)]
class Strategy extends AbstractAnnotation
{
    public function __construct(
        public string $interface,
        public string|int $type,
    ) {
        if (interface_exists($this->interface)) {
            throw new InvalidArgumentException(sprintf('The interface %s is not exist', $this->interface));
        }
    }

    public function collectClass(string $className): void
    {
        StrategyCollector::collectClass($this->interface, (string) $this->type, $className);
    }
}
