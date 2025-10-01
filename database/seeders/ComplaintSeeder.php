<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $staffIT = User::where('role', 'staff_it')->first();
        $assets = Asset::all();

        // Complaint 1 - Asset related
        Complaint::create([
            'asset_id' => $assets->where('code', 'LT-001')->first()?->id,
            'user_id' => $users->random()->id,
            'title' => 'Laptop sering hang saat buka aplikasi berat',
            'description' => 'Laptop Dell Latitude sering mengalami freeze ketika menjalankan software design seperti Photoshop atau AutoCAD. Performa sangat lambat dan sering not responding.',
            'priority' => 'tinggi',
            'status' => 'baru',
            'assigned_to' => null,
        ]);

        // Complaint 2 - Network issue
        Complaint::create([
            'asset_id' => null,
            'user_id' => $users->random()->id,
            'title' => 'Koneksi internet sering putus di ruang marketing',
            'description' => 'Internet di ruang marketing sering terputus, terutama pada jam 09.00-11.00 dan 14.00-16.00. Hal ini mengganggu produktivitas tim dalam melakukan video call dengan client.',
            'priority' => 'sedang',
            'status' => 'diproses',
            'assigned_to' => $staffIT->id,
        ]);

        // Complaint 3 - Printer issue
        Complaint::create([
            'asset_id' => $assets->where('code', 'PR-001')->first()?->id,
            'user_id' => $users->random()->id,
            'title' => 'Printer HP LaserJet tidak bisa print dokumen',
            'description' => 'Printer menampilkan error "Paper Jam" padahal tidak ada kertas yang tersangkut. Sudah dicoba restart berkali-kali tapi masih sama.',
            'priority' => 'urgent',
            'status' => 'selesai',
            'assigned_to' => $staffIT->id,
            'resolution' => 'Sudah dilakukan pembersihan roller printer dan penggantian toner. Printer kembali normal.',
            'resolved_at' => now()->subDays(2),
        ]);

        // Complaint 4 - Software issue
        Complaint::create([
            'asset_id' => $assets->where('code', 'LT-002')->first()?->id,
            'user_id' => $users->random()->id,
            'title' => 'Microsoft Office tidak bisa dibuka',
            'description' => 'Aplikasi Word, Excel, dan PowerPoint tidak bisa dibuka. Muncul pesan error "The application was unable to start correctly (0xc0000142)".',
            'priority' => 'tinggi',
            'status' => 'diproses',
            'assigned_to' => $staffIT->id,
        ]);

        // Complaint 5 - Hardware issue
        Complaint::create([
            'asset_id' => $assets->where('code', 'LT-003')->first()?->id,
            'user_id' => $users->random()->id,
            'title' => 'Keyboard laptop beberapa tombol tidak berfungsi',
            'description' => 'Tombol W, S, dan spasi pada keyboard laptop tidak berfungsi dengan baik. Harus ditekan keras-keras baru bisa muncul karakter.',
            'priority' => 'sedang',
            'status' => 'baru',
            'assigned_to' => null,
        ]);

        // Complaint 6 - General IT Support
        Complaint::create([
            'asset_id' => null,
            'user_id' => $users->random()->id,
            'title' => 'Request instalasi software Adobe Creative Suite',
            'description' => 'Membutuhkan instalasi Adobe Photoshop, Illustrator, dan InDesign untuk keperluan design marketing materials. Mohon dibantu untuk proses instalasi dan aktivasi.',
            'priority' => 'rendah',
            'status' => 'baru',
            'assigned_to' => null,
        ]);

        // Complaint 7 - Security issue
        Complaint::create([
            'asset_id' => null,
            'user_id' => $users->random()->id,
            'title' => 'Akun email terkena spam dan suspicious activity',
            'description' => 'Email kantor saya terkena serangan spam yang sangat banyak. Juga ada notifikasi login dari lokasi yang tidak dikenal. Khawatir akun sudah dikompromikan.',
            'priority' => 'urgent',
            'status' => 'diproses',
            'assigned_to' => $staffIT->id,
        ]);
    }
}
