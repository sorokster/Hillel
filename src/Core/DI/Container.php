<?php declare(strict_types=1);

namespace Hillel\Project\Core\DI;

use Closure;
use Hillel\Project\Core\Exceptions\NotFoundException;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;

/**
 * Container implementation
 */
class Container implements ContainerInterface
{
    private array $services = [];

    /**
     * @param string $id
     * @return mixed
     * @throws NotFoundException
     * @throws ReflectionException
     */
    public function get(string $id): mixed
    {
        $item = $this->resolve($id);
        if (!($item instanceof ReflectionClass)) {
            return $item;
        }

        return $this->getInstance($item);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        try {
            $item = $this->resolve($id);
        } catch (NotFoundException) {
            return false;
        }

        if ($item instanceof ReflectionClass) {
            return $item->isInstantiable();
        }

        return isset($item);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function add(string $key, mixed $value): self
    {
        $this->services[$key] = $value;
        return $this;
    }

    /**
     * @param string $id
     * @return mixed
     * @throws NotFoundException
     */
    private function resolve(string $id): mixed
    {
        if (isset($this->services[$name = $id])) {
            if ($this->services[$name] instanceof Closure) {
                return $this->services[$name]($this);
            }

            if (is_callable($this->services[$name])) {
                return $name();
            }
        }

        try {
            return (new ReflectionClass($name));
        } catch (ReflectionException $e) {
            throw new NotFoundException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param ReflectionClass $entry
     * @return mixed
     * @throws NotFoundException
     * @throws ReflectionException
     */
    private function getInstance(ReflectionClass $entry): mixed
    {
        $constructor = $entry->getConstructor();
        if (is_null($constructor) || $constructor->getNumberOfRequiredParameters() == 0) {
            return $entry->newInstance();
        }

        $params = [];
        foreach ($constructor->getParameters() as $param) {
            if ($type = $param->getType()) {
                $params[] = $this->get($type->getName());
            }
        }

        return $entry->newInstanceArgs($params);
    }
}
