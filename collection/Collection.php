<?php

namespace Globe\Collection;

use Iterator;
use Countable;
use ArrayAccess;
use ReflectionClass;
use UnexpectedValueException;

class Collection implements Countable, Iterator, ArrayAccess
{
    public function __construct(
        protected array $items = []
    ) {}

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function where(string $field, string $operator, $value): Collection
    {
        $class = new ReflectionClass($this->getType());
        $property = $class->getProperty($field);
        $property->setAccessible(true);

        $function = [
            '=' => fn ($item) => $property->getValue($item) === $value,
            '!=' => fn ($item) => $property->getValue($item) !== $value,
        ];

        return new Collection(array_filter($this->items, $function[$operator]));
    }

    public function getType(): ?string
    {
        $type = null;

        foreach ($this->items as $item) {
            $itemType = gettype($item) === 'object' ? get_class($item) : gettype($item);

            if ($type === null) {
                $type = $itemType;
            } elseif ($type !== $itemType) {
                return null;
            }
        }

        return $type;
    }

    public function oneOrNull()
    {
        if ($this->count() > 1) {
            throw new UnexpectedValueException('Collection contains more than one element.');
        }

        return $this->items[0] ?? null;
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($offset !== null) {
            $this->items[$offset] = $value;
        } else {
            $this->items[] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        if ($this->isSequential()) {
            array_splice($this->items, $offset, 1);
        } else {
            unset($this->items[$offset]);
        }
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function current(): mixed
    {
        return current($this->items);
    }

    public function next(): void
    {
        next($this->items);
    }

    public function key(): mixed
    {
        return key($this->items);
    }

    public function valid(): bool
    {
        return isset($this->items[key($this->items)]);
    }

    public function rewind(): void
    {
        reset($this->items);
    }

    public function isSequential(): bool
    {
        return array_keys($this->items) === range(0, count($this->items) - 1);
    }
}
