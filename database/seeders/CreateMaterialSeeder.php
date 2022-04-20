<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = [
                ['name' => 'Mato'],
                ['name' => 'Ip'],
                ['name' => 'Tugma'],
                ['name' => 'Zamok'],
            ];
            foreach ($materials as $key => $value) {
                Material::create($value);
            }

    }
}
