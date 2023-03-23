<?php

namespace App\Hydrators\Common;

use App\Exceptions\InvalidDtoInputDataException;
use Illuminate\Contracts\Container\BindingResolutionException;
use ReflectionClass;
use ReflectionException;

/**
 * Hydrate dataset
 */
class Hydrator
{
    /**
     * @throws ReflectionException
     * @throws InvalidDtoInputDataException
     * @throws BindingResolutionException
     */
    public function hydrate(
        string $class,
        array $data,
        bool $replaceSnakeCaseInData = false
    ) {
        if (empty($data)) {
            return null;
        }

        if ($replaceSnakeCaseInData) {
            foreach ($data as $key => $value) {
                if (str_contains($key, '_')) {
                    $newPropName = lcfirst(
                        implode('', array_map(fn($string) => ucfirst($string), explode("_", $key)))
                    );
                    $data[$newPropName] = $value;
                    unset($data[$key]);
                }
            }
        }

        $params = [];
        $reflection = new ReflectionClass($class);
        foreach ($reflection->getProperties() as $prop) {
            $propName = $prop->getName();

            if (!array_key_exists($propName, $data)) {
                throw new InvalidDtoInputDataException('Invalid data set supplied for ' . $class . '::'
                . $propName . ' property hydration; Keys of invalid data set: ' . json_encode(
                    array_keys($data),
                    JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES
                ));
            }

            if ($prop->getType()->getName() === 'array' && $extra = $prop->getDocComment()) {
                if ($propClass = $this->parseArrayClass($extra)) {
                    $nestedClass = $reflection->getNamespaceName() . '\\' . $propClass;
                    if (!class_exists($nestedClass)) {
                        app()->make($nestedClass);
                    }
                    foreach ($data[$propName] as $collectionElement) {
                        $params[$propName][] = $this->hydrate(
                            $nestedClass,
                            $collectionElement,
                            $replaceSnakeCaseInData
                        );
                    }
                    if (!isset($params[$propName])) {
                        $params[$propName] = null;
                    }
                    continue;
                }
            }
            $params[$propName] = $data[$propName] ?? null;
        }

        return new $class(...$params);
    }

    /**
     * @param string $extra
     *
     * @return false|string
     */
    private function parseArrayClass(string $extra): false|string
    {
        preg_match('/([A-z]*)(?=\[\]|$)/', $extra, $matches);

        return $matches[0] ?? false;
    }
}
