<?php

namespace App\Dto\Common;

use ReflectionClass;
use ReflectionProperty;

abstract class BasicDto
{
    protected function __array(?int $propertiesFilter = ReflectionProperty::IS_READONLY): array
    {
        $class = new ReflectionClass($this);

        return $class->getProperties($propertiesFilter);
    }
}
