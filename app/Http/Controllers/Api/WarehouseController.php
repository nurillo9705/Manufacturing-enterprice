<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WarehouseRequest;
use App\Services\WarehouseServices;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * @var WarehouseServices
     */
    protected $warehouseServices;
    public function __construct(WarehouseServices $warehouseServices){
        $this->warehouseServices=$warehouseServices;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarehouseRequest $request)
    {
        $validated = $request->validated();
        $data   =   $request->only([ 'material_id', 'quantity','price']);
        $result =   $this->warehouseServices->store($data);
        return response()->json($result);
    }

    public function productHistory(Request $request)
    {
        $request_products =$request['products'];
        if ($request_products) {
            $result = $this->warehouseServices->history($request_products);
            return response()->json($result);
        }
        return response()->json(['status'=>'error', 'message'=>'Request data not found!']);
    }
}
