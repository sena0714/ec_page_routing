<?php
namespace App\UseCase\Cart;

class IndexRequest
{
    private $cartId;
    public function __construct(int $cartId)
    {
        $this->cartId = $cartId;
    }

    public function cartId(): int
    {
        return $this->cartId;
    }
}