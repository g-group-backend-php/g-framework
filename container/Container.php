<?php

namespace Globe\Container;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $items;

    public function __construct()
    {
        $this->items[self::class] = $this;
    }

    public function get(string $id)
    {
        if (!$this->has($id)) {
            throw new NotFoundException(sprintf('%s key not found in the container.', $id));
        }

        return $this->items[$id];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->items);
    }

    public function set($value, ?string $key = null): self
    {
        $this->items[$key ?? get_class($value)] = $value;

        return $this;
    }
}
