<?php

namespace SONFin;


use Xtreamwayz\Pimple\Container;

class ServiceContainer implements ServiceContainerInterface
{

    private $container;

    /**
     * ServiceContainer constructor.
     */
    public function __construct()
    {
        $this->container = new Container();
    }

    public function add(string $name, $service)
    {
        $this->container[$name] = $service;
    }

    public function addLazy(string $name, callable $callback)
    {
        $this->container[$name] = $this->container->factory($callback);
    }

    public function get(string $name)
    {
        return $this->container->get($name);
    }

    public function has(string $name)
    {
        return $this->container->has($name);
    }
}
