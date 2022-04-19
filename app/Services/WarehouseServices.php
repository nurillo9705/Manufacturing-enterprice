<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\Warehouse;

class WarehouseServices
{
    public function store($data){
        $warehouse                  =   new Warehouse();
        $warehouse->material_id     =   $data[ 'material_id' ];
        $warehouse->remainder       =   $data[ 'remainder' ];
        $warehouse->price           =   $data[ 'price' ];
        $warehouse->save();
        return [
            'status'    =>  'success',
            'message'   =>  __( 'warehouse has been correctly saved.' ),
            'data'      =>  compact( 'warehouse' )
        ];
    }

    public function update($data, $id){
        $warehouse                  =   Warehouse::findOrFail($id);
        $warehouse->material_id     =   $data[ 'material_id' ];
        $warehouse->remainder       =   $data[ 'remainder' ];
        $warehouse->price           =   $data[ 'price' ];
        $warehouse->save();
        return [
            'status'    =>  'success',
            'message'   =>  __( 'warehouse has been correctly update.' ),
            'data'      =>  compact( 'warehouse' )
        ];
    }

    public function history($request_products)
    {
        $result = [];
        $material_ids = array_unique(ProductMaterial::whereIn('product_id', array_column($request_products, 'id'))->pluck('material_id')->toArray());
        $warehouse = Warehouse::query()->whereIn('material_id',$material_ids)->orderBy('created_at','desc')->get()->toArray();
        foreach ($request_products as $item) {
            $product = Product::query()->find($item["id"]);
            $count = $item["count"];
            $warehouse_get_product_material =
                [
                    'product_name'      =>  $product->name,
                    'product_qty'       =>  $count,
                    'product_materials' =>  []
                ];
            foreach ($product->materials as $material) {
                //maxsulot miqdorini hisoblash
                $qty = $material->quantity * $count;
                //maxsulot miqdori  dan kichik yoki teng bo'liguncha sikl davom etadi
                while ($qty > 0) {
                    //warehouseni indexsini tayinlab olish bo'lmasa false qaytaradi
                    $i = array_search($material->material_id, array_column($warehouse, 'material_id'));
                    if ($i === false) {
                        $warehouse_get_product_material['product_materials'][] =
                        [
                            'warehouse_id'      =>  null,
                            'material_name'     =>  $material->material->name,
                            'qty'               =>  $qty, 'price' => null
                        ];
                        $warehouse[$i]['material_id'] = null;
                        break;
                    }
                    if ($warehouse[$i]['remainder'] - $qty >= 0) {
                        $warehouse[$i]['remainder'] -= $qty;
                        $warehouse_get_product_material['product_materials'][] =
                        [
                            'warehouse_id'      =>  $warehouse[$i]['id'],
                            'material_name'     =>  $material->material->name,
                            'qty'               =>  $qty,
                            'price'             =>  $warehouse[$i]['price']
                        ];
                        $qty = 0;
                    }
                    else {
                        $qty -= $warehouse[$i]['remainder'];
                        $warehouse_get_product_material['product_materials'][] =
                        [
                            'warehouse_id'      =>  $warehouse[$i]['id'],
                            'material_name'     =>  $material->material->name,
                            'qty'               =>  $warehouse[$i]['remainder'],
                            'price'             =>  $warehouse[$i]['price']
                        ];
                        $warehouse[$i]['material_id'] = null;
                    }
                }
            }
            array_push($result, $warehouse_get_product_material);
        }
        return $result;
    }

}
