<?php
namespace App\Service\Product;

class Product
{
    private $name;
    private $price;
    private $quantity;
    public function __construct(string $name, int $price, int $quantity)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function name()
    {
        return $this->name;
    }

    public function price()
    {
        return $this->price;
    }

    public function quantity()
    {
        return $this->quantity;
    }
}