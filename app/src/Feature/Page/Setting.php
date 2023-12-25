<?php
namespace App\Feature\Page;

use App\Controller\ShoppingController;

class Setting
{
    public function __construct()
    {}

    public function pages(): array
    {
        return [
            [
                'path' => '/cart/{cart_id}',
                'controller' => new ShoppingController(),
                'method' => 'index',
            ],
            [
                'path' => '/edit/cart/{cart_id}',
                'controller' => new ShoppingController(),
                'method' => 'edit',
            ],
        ];
    }
}