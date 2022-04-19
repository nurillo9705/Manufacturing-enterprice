<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductMaterialRequest;
use App\Services\ProductMaterialServices;
use Illuminate\Http\Request;

class ProductMaterialController extends Controller
{
    /**
     * @var ProductMaterialServices
     */
    protected $productMaterialServices;
    public function __construct(ProductMaterialServices $productMaterialServices){
        $this->productMaterialServices=$productMaterialServices;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductMaterialRequest $request)
    {
        $validated = $request->validated();
        $data = $request->only([ 'product_id', 'material_id', 'quantity']);
        $result=$this->productMaterialServices->store($data);
        return $result;
    }
}
