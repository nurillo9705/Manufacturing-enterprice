<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => "Ko'ylak", 'code' => '1234'],
            ['name' => 'Shim', 'code' => '1235'],
        ];
        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
}
