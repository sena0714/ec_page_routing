<?php
namespace App\Service\Cart;

class PriceCalculator
{
    const TAX_RATE = 1.1;

    public function __construct()
    {}

    public function calcTotalPrice(array $products)
    {
        $result = 0;
        foreach ($products as $product) {
            $result += $product->price() * $product->quantity();
        }

        return $result;
    }

    public function calcPaymentPrice(array $products) {
        return $this->calcTotalPrice($products) * self::TAX_RATE;
    }
}