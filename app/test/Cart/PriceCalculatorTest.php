<?php
require_once(__DIR__.'/../../vendor/autoload.php');

use PHPUnit\Framework\TestCase;
use App\Service\Cart\PriceCalculator;
use App\Service\Product\Product;

class PriceCalculatorTest extends TestCase
{
    protected function setUp(): void
    {}

    public function test_カート内の合計金額を計算できる()
    {
        $calculator = new PriceCalculator();
        $products = [
            new Product('a', 1000, 1),
            new Product('b', 2000, 2),
            new Product('c', 5000, 1),
        ];

        $result = $calculator->calcTotalPrice($products);

        $this->assertEquals(10000, $result);
    }

    public function test_支払い金額を計算できる()
    {
        $calculator = new PriceCalculator();
        $products = [
            new Product('a', 1000, 1),
            new Product('b', 2000, 2),
            new Product('c', 5000, 1),
        ];

        $result = $calculator->calcPaymentPrice($products);

        $this->assertEquals(11000, $result);
    }
}