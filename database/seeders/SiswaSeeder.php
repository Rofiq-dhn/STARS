<?php

// Deklarasi namespace seeder
namespace Database\Seeders;

// Import class yang diperlukan
use Illuminate\Database\Seeder;  // Class Seeder bawaan Laravel
use App\Models\Siswa;             // Model Siswa
use App\Models\User;              // Model User

// Deklarasi class SiswaSeeder
class SiswaSeeder extends Seeder
{
    /**
     * Method run() akan dijalankan saat seeder dieksekusi
     */
    public function run(): void
    {
        // 1. Buat data siswa di tabel siswas
        // Siswa::create() = INSERT INTO siswas
        $siswa = Siswa::create([
            'nis' => '12345678',              // NIS 8 digit
            'nama' => 'Budi Santoso',         // Nama siswa
            'kelas_siswa' => '10',            // Kelas (hanya angka)
            'jurusan' => 'IPA',               // Jurusan siswa
            'angkatan' => '25',               // Angkatan (2 digit terakhir tahun)
        ]);

        // 2. Buat user untuk login siswa
        // User::create() = INSERT INTO users
        User::create([
            'username' => $siswa->nis,        // Username pakai NIS
            'password' => 'siswa123',         // Password (auto di-hash oleh model)
            'level' => 'siswa',               // Level = siswa
            'id_admin' => null,               // Tidak ada id_admin (karena siswa)
            'id_siswa' => $siswa->id_siswa,   // id_siswa dari siswa yang baru dibuat
        ]);
    }
}
