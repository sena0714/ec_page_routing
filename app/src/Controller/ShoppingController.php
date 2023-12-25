<?php
namespace App\Controller;

use App\Service\Unit\Debug;
use App\UseCase\Cart\IndexRequest;
use App\UseCase\Cart\IndexUseCase;

class ShoppingController extends Controller
{
    private $indexUseCase;
    public function __construct()
    {
        $this->indexUseCase = new IndexUseCase();
    }

    public function index(array $params)
    {
        $req = new IndexRequest($params['cart_id']);
        
        $res = $this->indexUseCase->execute($req);
        
        Debug::outputOnWeb($res->paymentPrice());
    }

    public function edit(array $params)
    {
        Debug::outputOnWeb($params);
    }
}