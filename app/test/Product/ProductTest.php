<?php
require_once(__DIR__.'/../../vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use App\Service\Product\Product;

class ProductTest extends TestCase
{
    protected function setUp(): void
    {}

    public function test_値が取得できる()
    {
        $product = new Product('p', 1000, 2);
        $this->assertEquals('p', $product->name());
        $this->assertEquals(1000, $product->price());
        $this->assertEquals(2, $product->quantity());
    }
}