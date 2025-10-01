<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $categories = AssetCategory::all();

        // Laptop Assets
        $laptopCategory = $categories->where('name', 'Komputer & Laptop')->first();
        if ($laptopCategory) {
            Asset::create([
                'asset_category_id' => $laptopCategory->id,
                'code' => 'LT-001',
                'name' => 'Laptop Dell Latitude 5520',
                'description' => 'Laptop untuk keperluan kantor dengan spesifikasi tinggi',
                'brand' => 'Dell',
                'model' => 'Latitude 5520',
                'serial_number' => 'DL5520001',
                'purchase_date' => now()->subMonths(6),
                'purchase_price' => 12500000,
                'condition' => 'baik',
                'status' => 'digunakan',
                'location' => 'Ruang Marketing',
                'assigned_to' => $users->random()->id,
                'notes' => 'Laptop untuk tim marketing',
            ]);

            Asset::create([
                'asset_category_id' => $laptopCategory->id,
                'code' => 'LT-002',
                'name' => 'Laptop HP EliteBook 840',
                'description' => 'Laptop bisnis untuk keperluan administrasi',
                'brand' => 'HP',
                'model' => 'EliteBook 840 G8',
                'serial_number' => 'HP840G8002',
                'purchase_date' => now()->subMonths(3),
                'purchase_price' => 15000000,
                'condition' => 'baik',
                'status' => 'digunakan',
                'location' => 'Ruang Finance',
                'assigned_to' => $users->random()->id,
                'notes' => 'Laptop untuk keperluan finance',
            ]);

            Asset::create([
                'asset_category_id' => $laptopCategory->id,
                'code' => 'LT-003',
                'name' => 'Laptop Lenovo ThinkPad X1',
                'description' => 'Laptop premium untuk manajemen',
                'brand' => 'Lenovo',
                'model' => 'ThinkPad X1 Carbon',
                'serial_number' => 'LV-X1C003',
                'purchase_date' => now()->subYear(),
                'purchase_price' => 22000000,
                'condition' => 'rusak_ringan',
                'status' => 'dalam_perbaikan',
                'location' => 'IT Room',
                'assigned_to' => null,
                'notes' => 'Keyboard ada yang rusak, sedang perbaikan',
            ]);
        }

        // Network Equipment
        $networkCategory = $categories->where('name', 'Jaringan & Komunikasi')->first();
        if ($networkCategory) {
            Asset::create([
                'asset_category_id' => $networkCategory->id,
                'code' => 'SW-001',
                'name' => 'Switch Cisco 24 Port',
                'description' => 'Switch manageable untuk jaringan kantor',
                'brand' => 'Cisco',
                'model' => 'Catalyst 2960-24TC-L',
                'serial_number' => 'CS2960001',
                'purchase_date' => now()->subYears(2),
                'purchase_price' => 8500000,
                'condition' => 'baik',
                'status' => 'digunakan',
                'location' => 'Server Room',
                'assigned_to' => null,
                'notes' => 'Switch utama untuk lantai 1',
            ]);

            Asset::create([
                'asset_category_id' => $networkCategory->id,
                'code' => 'RT-001',
                'name' => 'Router MikroTik RB4011',
                'description' => 'Router untuk gateway internet',
                'brand' => 'MikroTik',
                'model' => 'RB4011iGS+RM',
                'serial_number' => 'MT4011001',
                'purchase_date' => now()->subYear(),
                'purchase_price' => 3200000,
                'condition' => 'baik',
                'status' => 'digunakan',
                'location' => 'Server Room',
                'assigned_to' => null,
                'notes' => 'Router utama untuk akses internet',
            ]);
        }

        // Furniture
        $furnitureCategory = $categories->where('name', 'Furniture')->first();
        if ($furnitureCategory) {
            Asset::create([
                'asset_category_id' => $furnitureCategory->id,
                'code' => 'MJ-001',
                'name' => 'Meja Kerja Kayu Jati',
                'description' => 'Meja kerja ukuran 120x60cm',
                'brand' => 'Custom',
                'model' => 'Jati Premium',
                'serial_number' => 'MJ120001',
                'purchase_date' => now()->subMonths(8),
                'purchase_price' => 2500000,
                'condition' => 'baik',
                'status' => 'digunakan',
                'location' => 'Ruang Direktur',
                'assigned_to' => null,
                'notes' => 'Meja kerja untuk ruang direktur',
            ]);

            Asset::create([
                'asset_category_id' => $furnitureCategory->id,
                'code' => 'KR-001',
                'name' => 'Kursi Ergonomis Executive',
                'description' => 'Kursi kantor dengan sandaran tinggi',
                'brand' => 'Herman Miller',
                'model' => 'Aeron Chair',
                'serial_number' => 'HM-AER001',
                'purchase_date' => now()->subMonths(4),
                'purchase_price' => 5500000,
                'condition' => 'baik',
                'status' => 'digunakan',
                'location' => 'Ruang Manager',
                'assigned_to' => $users->random()->id,
                'notes' => 'Kursi premium untuk manager',
            ]);
        }

        // Printer
        $printerCategory = $categories->where('name', 'Printer')->first();
        if ($printerCategory) {
            Asset::create([
                'asset_category_id' => $printerCategory->id,
                'code' => 'PR-001',
                'name' => 'Printer Laser HP LaserJet Pro',
                'description' => 'Printer laser monochrome untuk keperluan kantor',
                'brand' => 'HP',
                'model' => 'LaserJet Pro M404dn',
                'serial_number' => 'HP-M404-001',
                'purchase_date' => now()->subMonths(10),
                'purchase_price' => 3500000,
                'condition' => 'perlu_perbaikan',
                'status' => 'dalam_perbaikan',
                'location' => 'IT Room',
                'assigned_to' => null,
                'notes' => 'Toner habis dan perlu service rutin',
            ]);

            Asset::create([
                'asset_category_id' => $printerCategory->id,
                'code' => 'PR-002',
                'name' => 'Printer Canon PIXMA G3010',
                'description' => 'Printer inkjet dengan tangki tinta',
                'brand' => 'Canon',
                'model' => 'PIXMA G3010',
                'serial_number' => 'CN-G3010-001',
                'purchase_date' => now()->subMonths(5),
                'purchase_price' => 2200000,
                'condition' => 'baik',
                'status' => 'tersedia',
                'location' => 'Storage Room',
                'assigned_to' => null,
                'notes' => 'Printer cadangan, siap pakai',
            ]);
        }
    }
}
