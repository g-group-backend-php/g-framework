<?php

namespace Globe\Finder;

class ClassFinder
{
    public static function findClass(string $directory): array
    {
        $workingDirectory = getcwd();
        $composer = json_decode(file_get_contents($workingDirectory . '/composer.json'), true);

        $namespacePrefix = array_key_first($composer['autoload']['psr-4']);
        $pathPrefix = array_shift($composer['autoload']['psr-4']);

        $files = glob($directory . '/*.php');

        foreach ($files as &$file) {
            $file = str_replace($pathPrefix, $namespacePrefix, $file);
            $file = str_replace('.php', '', $file);
            $file = str_replace('/', '\\', $file);
        }

        return $files;
    }
}
