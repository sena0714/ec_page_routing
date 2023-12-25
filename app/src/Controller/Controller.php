<?php
namespace App\Controller;

class Controller
{
    public function __call($method, $params): void
    {
        throw new \Exception(sprintf('Method %s::%s does not exist.', static::class, $method));
    }
}