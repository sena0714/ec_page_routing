<?php
namespace App\UseCase\Cart;

class IndexResponse
{
    private $paymentPrice;
    public function __construct(int $paymentPrice)
    {
        $this->paymentPrice = $paymentPrice;
    }

    public function paymentPrice(): int
    {
        return $this->paymentPrice;
    }
}