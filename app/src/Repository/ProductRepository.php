<?php
namespace App\Repository;

class ProductRepository
{
    public function __construct()
    {}

    public function findByCartId(int $cartId): array
    {
        return [
            [
                'name' => 'a',
                'price' => 1000,
                'quantity' => 1
            ],
            [
                'name' => 'b',
                'price' => 2000,
                'quantity' => 2
            ],
            [
                'name' => 'c',
                'price' => 3000,
                'quantity' => 3
            ],
        ];
    }
}