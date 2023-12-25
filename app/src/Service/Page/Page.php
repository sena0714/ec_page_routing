<?php
namespace App\Service\Page;

use App\Controller\Controller;

class Page
{
    private $controller;
    private $method;
    private $params;
    public function __construct(Controller $controller, string $method, array $params)
    {
        $this->controller = $controller;
        $this->method = $method;
        $this->params = $params;
    }

    public function controller(): Controller
    {
        return $this->controller;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function params(): array
    {
        return $this->params;
    }
}