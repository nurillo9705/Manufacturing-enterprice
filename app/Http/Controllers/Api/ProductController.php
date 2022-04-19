<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\ProductServices;

class ProductController extends Controller
{
      /**
     * @var ProductServices
     */
    protected $productService;
    public function __construct(ProductServices $productService){
        $this->productService=$productService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $data = $request->only([ 'name', 'code']);
        $result=$this->productService->store($data);
        return response()->json($result);
    }

}
