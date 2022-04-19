<?php

namespace App\Services;

use App\Models\ProductMaterial;

class ProductMaterialServices
{
    public function store($data){
        $product_material                   =   new ProductMaterial();
        $product_material->product_id       =   $data[ 'product_id' ];
        $product_material->material_id      =   $data[ 'material_id' ];
        $product_material->quantity         =   $data[ 'quantity' ];
        $product_material->save();
        return [
            'status'    =>  'success',
            'message'   =>  __( 'product_material has been correctly saved.' ),
            'data'      =>  compact( 'product_material' )
        ];
    }

    public function update($data, $id){
        $product_material                   =   ProductMaterial::findOrFail($id);
        $product_material->product_id       =   $data[ 'product_id' ];
        $product_material->material_id      =   $data[ 'material_id' ];
        $product_material->quantity         =   $data[ 'quantity' ];
        $product_material->save();
        return [
            'status'    =>  'success',
            'message'   =>  __( 'product_material has been correctly update.' ),
            'data'      =>  compact( 'product_material' )
        ];
    }

}
