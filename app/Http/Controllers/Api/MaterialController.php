<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialRequest;
use App\Services\MaterialServices;
class MaterialController extends Controller
{
    /**
     * @var MaterialServices
     */
    protected $materialService;
    public function __construct(MaterialServices $materialService){
        $this->materialService=$materialService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialRequest $request)
    {
        $validated = $request->validated();
        $data = $request->only([ 'name']);
        $result=$this->materialService->store($data);
        return response()->json($result);
    }

}
