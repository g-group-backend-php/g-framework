<?php

namespace App;

use Globe\ConfigManager\ConfigManager;
use Globe\ConfigManager\ConfigManagerFactory;
use Globe\Container\Container;
use ReflectionClass;

abstract class Kernel
{
    protected Container $container;
    protected ConfigManager $configManager;

    public function __construct()
    {
        $this->createContainer();

        $configManagerFactory = new ConfigManagerFactory();
        $this->configManager = $configManagerFactory->createConfigManager();
    }

    abstract public function run(): void;

    protected function createContainer(): void
    {
        if (!isset($this->container)) {
            $this->container = new Container();
            $this->container->set($this);
        }
    }

    protected function callMethod(string $className, string $methodName, array $pathParams)
    {
        $instance = $this->container->has($className)
            ? $this->container->get($className)
            : $this->instantiate($className)
        ;

        $class = new ReflectionClass($instance);
        $method = $class->getMethod($methodName);

        $parameters = [];
        foreach ($method->getParameters() as $parameter) {
            if ($parameter->getType()->isBuiltin()) {
                $parameterValue = $pathParams[$parameter->getName()];
                settype($parameterValue, $parameter->getType()->getName());

                $parameters[] = $parameterValue;

                continue;
            }

            if ($this->container->has($parameter->getType()->getName())) {
                $parameters[] = $this->container->get($parameter->getType()->getName());
            } else {
                $parameters[] = $this->instantiate($parameter->getType()->getName());
            }
        }

        return $method->invokeArgs($instance, $parameters);
    }

    protected function instantiate(string $className): object
    {
        $class = new ReflectionClass($className);

        if ($class->getConstructor()) {
            $constructor = $class->getConstructor();
            $parameters = $constructor->getParameters();
            $arguments = [];

            foreach ($parameters as $parameter) {
                if ($this->container->has($parameter->getType()->getName())) {
                    $arguments[] = $this->container->get($parameter->getType()->getName());
                } else {
                    $arguments[] = $this->instantiate($parameter->getType()->getName());
                }
            }

            $instance = $class->newInstance(...$arguments);
        } else {
            $instance = $class->newInstance();
        }

        $this->container->set($instance);

        return $instance;
    }
}
