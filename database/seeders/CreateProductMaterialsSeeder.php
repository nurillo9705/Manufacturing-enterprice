<?php

namespace Database\Seeders;

use App\Models\ProductMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateProductMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_materials = [
            ['product_id' => 1, 'material_id' => 1, 'quantity' => "0.8"],
            ['product_id' => 1, 'material_id' => 2, 'quantity' => "10"],
            ["product_id" => 1, "material_id" => 3, "quantity" => "5"],
            ["product_id" => 2, "material_id" => 1, "quantity" => "1.4"],
            ["product_id" => 2, "material_id" => 2, "quantity" => "15"],
            ["product_id" => 2, "material_id" => 4, "quantity" => "1"],
        ];
        foreach ($product_materials as $key => $value) {
            ProductMaterial::create($value);
        }
    }
}
