<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat data admin di table admins
        $admin = Admin::create([
            'nama' => 'Admin Utama',
            'nip' => '123456789012345678',  // 18 digit
            'no_telepon' => '081234567890',
        ]);

        // 2. Buat user untuk login (username = NIP)
        User::create([
            'username' => $admin->nip,  // Username pakai NIP
            'password' => 'admin123',   // Auto di-hash
            'level' => 'admin',
            'id_admin' => $admin->id_admin,
            'id_siswa' => null,
        ]);
    }
}
