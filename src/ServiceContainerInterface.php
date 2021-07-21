<?php

declare(strict_types=1);

namespace SONFin;


interface ServiceContainerInterface
{
    public function add(string $name,$service);

    public function addLazy(string $name, callable $callback);

    public function get(string $name);

    public function has(string $name);
}
