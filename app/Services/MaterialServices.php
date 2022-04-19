<?php

namespace App\Services;

use App\Models\Material;

class MaterialServices
{
    public function store($data){
        $material           =   new Material();
        $material->name     =   $data[ 'name' ];
        $material->save();
        return [
            'status'    =>  'success',
            'message'   =>  __( 'material has been correctly saved.' ),
            'data'      =>  compact( 'material' )
        ];
    }

    public function update($data, $id){
        $material           =   Material::findOrFail($id);
        $material->name     =   $data[ 'name' ];
        $material->save();
        return [
            'status'    =>  'success',
            'message'   =>  __( 'material has been correctly update.' ),
            'data'      =>  compact( 'material' )
        ];
    }

}
