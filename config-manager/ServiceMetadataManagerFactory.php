<?php

namespace Globe\ConfigManager;

class ServiceMetadataManagerFactory
{
    public function createServiceMetadataManager(ConfigManager $configManager): ServiceMetadataManager
    {
        $servicesMetadata = [];

        foreach ($configManager->get('services') as $namespace => $serviceConfig) {
            $servicesMetadata[$namespace] = new ServiceMetadata(
                $serviceConfig['arguments'] ?? [],
                $serviceConfig['tags'] ?? []
            );
        }

        return new ServiceMetadataManager($servicesMetadata);
    }
}
