<?php
require_once(__DIR__.'/../../vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use App\Service\Cart\Cart;
use App\Service\Product\Product;

class CartTest extends TestCase
{
    protected function setUp(): void
    {}

    public function test_商品を追加、取得できる()
    {
        $cart = new Cart();
        $product = new Product('p', 1000, 1);
        
        $cart->add($product);

        $this->assertEquals([$product], $cart->products());
    }

    public function test_商品を複数追加できる()
    {
        $cart = new Cart();
        $product1 = new Product('a', 1000, 1);
        $product2 = new Product('b', 2000, 2);

        $cart->add($product1);
        $cart->add($product2);

        $this->assertEquals([$product1, $product2], $cart->products());
    }

    public function test_カート内の合計金額を取得できる()
    {
        $cart = new Cart();
        $product1 = new Product('a', 1000, 1);
        $product2 = new Product('b', 2000, 2);
        $product3 = new Product('c', 3000, 3);
        $cart->add($product1);
        $cart->add($product2);
        $cart->add($product3);

        $result = $cart->totalPrice();

        $this->assertEquals(14000, $result);
    }

    public function test_支払い金額を取得できる()
    {
        $cart = new Cart();
        $product1 = new Product('a', 1000, 1);
        $product2 = new Product('b', 2000, 2);
        $product3 = new Product('c', 5000, 1);
        $cart->add($product1);
        $cart->add($product2);
        $cart->add($product3);

        $result = $cart->paymentPrice();

        $this->assertEquals(11000, $result);
    }
}