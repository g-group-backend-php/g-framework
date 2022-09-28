<?php

namespace Globe\ConfigManager;

class ConfigManager
{
    public function __construct(
        protected array $items
    ) {}

    public function get(string $id)
    {
        if (!$this->has($id)) {
            throw new \RuntimeException(sprintf('%s key not found in config.', $id));
        }

        return $this->items[$id];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->items);
    }

    public function set($value, string $key): self
    {
        $this->items[$key] = $value;

        return $this;
    }
}
