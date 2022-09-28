<?php

namespace Globe\ConfigManager;

class ServiceMetadataManager
{
    public function __construct(
        protected array $items
    ) {}

    public function get(string $id): ServiceMetadata
    {
        if (!$this->has($id)) {
            throw new \RuntimeException(sprintf('%s service not present in manager.', $id));
        }

        return $this->items[$id];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->items);
    }

    public function set(string $key, ServiceMetadata $value): self
    {
        $this->items[$key] = $value;

        return $this;
    }
}
