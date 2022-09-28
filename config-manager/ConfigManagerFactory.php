<?php

namespace Globe\ConfigManager;

class ConfigManagerFactory
{
    public function createConfigManager(): ConfigManager
    {
        $files = glob('config/*.yaml');

        $config = [];
        foreach ($files as $file) {
            $config = [...$config, ...yaml_parse_file($file)];
        }

        return new ConfigManager($config);
    }
}
