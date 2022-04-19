<?php

namespace App\Services;

use App\Models\Product;

class ProductServices
{
    public function store($data){
        $product            =   new Product();
        $product->name      =   $data[ 'name' ];
        $product->code      =   $data[ 'code' ];
        $product->save();
        return [
            'status'    =>  'success',
            'message'   =>  __( 'product has been correctly saved.' ),
            'data'      =>  compact( 'product' )
        ];
    }
    public function update($data, $id){
        $product            =   Product::findOrFail($id);
        $product->name      =   $data[ 'name' ];
        $product->code      =   $data[ 'code' ];
        $product->save();
        return [
            'status'    =>  'success',
            'message'   =>  __( 'product has been correctly update.' ),
            'data'      =>  compact( 'product' )
        ];
    }

}
