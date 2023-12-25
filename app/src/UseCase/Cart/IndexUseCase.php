<?php
namespace App\UseCase\Cart;

use App\Service\Cart\Cart;
use App\Service\Product\Product;
use App\Repository\ProductRepository;
use App\UseCase\Cart\IndexRequest;
use App\UseCase\Cart\IndexResponse;

class IndexUseCase
{
    private $productRepository;
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function execute(IndexRequest $req): IndexResponse
    {
        try {
            $productData = $this->productRepository->findByCartId($req->cartId());

            $cart = new Cart();
            foreach ($productData as $row) {
                $product = new Product($row['name'], $row['price'], $row['quantity']);
                $cart->add($product);
            }

            $res = new IndexResponse($cart->paymentPrice());
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        return $res;
    }
}