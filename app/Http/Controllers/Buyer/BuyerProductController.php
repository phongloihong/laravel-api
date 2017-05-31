<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class BuyerProductController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        // because buyer has many transaction. So we can call product by default way.
        // this way will fetch every transaction 
        $product = $buyer->transactions()->with('product')->get()->pluck('product');

        return $this->showAll($product);
    }
}
