<?php

namespace App;

use ReflectionClass;
use App\Controller\GlobeController;
use Container\Container;

class App
{
    protected Container $container;

    public function __construct()
    {
        $this->createContainer();
    }

    public function run(): void
    {
        // Nie mamy routera, więc z łapy wywołujemy metodę show kontrolera
        $this->callMethod(GlobeController::class, 'show');
    }

    public function createContainer(): void
    {
        if (!isset($this->container)) {
            $this->container = new Container();
            $this->container->set($this);
        }
    }

    public function callMethod(string $className, string $methodName)
    {
        // Pobieramy lub tworzymy instancję kontrolera przy pomocy kontenera
        $instance = $this->container->has($className)
            ? $this->container->get($className)
            : $this->instantiate($className)
        ;

        // Pobieramy refleksję wywoływanej metody
        $class = new ReflectionClass($instance);
        $method = $class->getMethod($methodName);

        // Instancjonujemy każdy z parametrów metody
        $parameters = [];
        foreach ($method->getParameters() as $parameter) {
            if ($this->container->has($parameter->getType()->getName())) {
                $parameters[] = $this->container->get($parameter->getType()->getName());
            } else {
                $parameters[] = $this->instantiate($parameter->getType()->getName());
            }
        }

        // I callujemy zadaną metodę ze zinstancjonowanymi parametrami
        return $method->invokeArgs($instance, $parameters);
    }

    public function instantiate(string $className): object
    {
        $class = new ReflectionClass($className);

        // Jeżeli klasa ma zdefiniowany konstruktor, to prawdopodobnie ma tam jakieś parametry
        if ($class->getConstructor()) {
            $constructor = $class->getConstructor();
            $parameters = $constructor->getParameters();
            $arguments = [];

            // Instancjonujemy lub pobieramy z kontenera każdy parametr konstruktora
            foreach ($parameters as $parameter) {
                if ($this->container->has($parameter->getType()->getName())) {
                    $arguments[] = $this->container->get($parameter->getType()->getName());
                } else {
                    $arguments[] = $this->instantiate($parameter->getType()->getName());
                }
            }

            // I wywołujemy konstruktor podając ustalone argumenty
            $instance = $class->newInstance(...$arguments);
        } else {
            $instance = $class->newInstance();
        }

        // Zapisujemy instancję do kontenera
        $this->container->set($instance);

        return $instance;
    }
}
