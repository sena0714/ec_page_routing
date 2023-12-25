<?php
namespace App\Service\Cart;

use App\Service\Product\Product;
use App\Service\Cart\PriceCalculator;

class Cart
{
    private $priceCalculator;
    private $products;
    public function __construct()
    {
        $this->priceCalculator = new PriceCalculator();
    }

    public function add(Product $product): void
    {
        $this->products[] = $product;
    }

    public function products(): array
    {
        return $this->products;
    }

    public function paymentPrice(): int
    {
        return $this->priceCalculator->calcPaymentPrice($this->products);
    } 

    public function totalPrice(): int
    {
        return $this->priceCalculator->calcTotalPrice($this->products);
    }
}