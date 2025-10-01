<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssetCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Komputer & Laptop',
                'description' => 'Perangkat komputer desktop, laptop, dan aksesorinya',
                'code' => 'KOMP',
            ],
            [
                'name' => 'Peralatan Jaringan',
                'description' => 'Router, switch, access point, dan perangkat jaringan lainnya',
                'code' => 'NET',
            ],
            [
                'name' => 'Furniture',
                'description' => 'Meja, kursi, lemari, dan perabotan kantor',
                'code' => 'FURN',
            ],
            [
                'name' => 'Elektronik',
                'description' => 'Printer, scanner, proyektor, dan perangkat elektronik lainnya',
                'code' => 'ELEK',
            ],
            [
                'name' => 'Kendaraan',
                'description' => 'Mobil, motor, dan kendaraan operasional',
                'code' => 'VHCL',
            ],
            [
                'name' => 'Peralatan Kantor',
                'description' => 'ATK, whiteboard, dan perlengkapan kantor umum',
                'code' => 'OFFC',
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\AssetCategory::create($category);
        }
    }
}
