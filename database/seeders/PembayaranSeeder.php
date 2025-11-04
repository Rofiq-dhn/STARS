<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;  // Import Model Pembayaran

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        // Buat data pembayaran dummy untuk testing

        // Pembayaran 1: SPP Januari - Lunas
        Pembayaran::create([
            'id_biaya' => 1,                  // ID biaya (harus sudah ada di tabel biayas)
            'id_siswa' => 1,                  // ID siswa (harus sudah ada di tabel siswas)
            'bulan' => 'Januari',             // Bulan pembayaran
            'nominal_dibayar' => '500000',    // Nominal yang dibayar
            'sisa_pembayaran' => '0',         // Sisa (0 = lunas)
            'status' => 'lunas',              // Status lunas
            'bukti_pembayaran' => null,       // Belum ada bukti (nanti diupload siswa)
            'kwitansi' => null,               // Belum ada kwitansi (nanti digenerate admin)
            'tahun' => '2025',                // Tahun pembayaran
        ]);

        // Pembayaran 2: SPP Februari - Belum Lunas
        Pembayaran::create([
            'id_biaya' => 1,
            'id_siswa' => 1,
            'bulan' => 'Februari',
            'nominal_dibayar' => '200000',    // Baru bayar 200rb
            'sisa_pembayaran' => '300000',    // Sisa 300rb
            'status' => 'belum lunas',        // Status belum lunas
            'bukti_pembayaran' => null,
            'kwitansi' => null,
            'tahun' => '2025',
        ]);

        // Pembayaran 3: PPDB - Lunas
        Pembayaran::create([
            'id_biaya' => 2,                  // ID biaya PPDB (harus sudah ada)
            'id_siswa' => 1,
            'bulan' => '-',                   // PPDB tidak pakai bulan
            'nominal_dibayar' => '2000000',
            'sisa_pembayaran' => '0',
            'status' => 'lunas',
            'bukti_pembayaran' => null,
            'kwitansi' => null,
            'tahun' => '2025',
        ]);
    }
}
