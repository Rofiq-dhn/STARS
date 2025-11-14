<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    // Nama tabel di database
    // Laravel secara default akan pakai 'siswas' (plural dari Siswa)
    // Tapi kita define manual biar lebih jelas
    protected $table = 'siswas';

    // Primary key tabel
    // Default Laravel pakai 'id', tapi kita pakai 'id_siswa'
    protected $primaryKey = 'id_siswa';

    // Kolom yang boleh diisi secara mass assignment
    // Mass assignment = insert/update banyak field sekaligus
    // Contoh: Siswa::create(['nama' => 'Budi', 'nis' => '12345'])
    protected $fillable = [
        'nis',            // Nomor Induk Siswa (8 karakter)
        'nama',           // Nama lengkap siswa
        'kelas_siswa',    // Kelas saat ini (contoh: X, XI, XII)
        'jurusan',        // Jurusan siswa (contoh: RPL, TKJ, MM)
        'angkatan',       // Angkatan siswa (4 digit, contoh: 2025)
    ];

    // ============================================
    // RELATIONSHIPS (Relasi ke Tabel Lain)
    // ============================================

    /**
     * Relasi One-to-One ke tabel Users
     * Satu siswa punya satu akun user untuk login
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        // hasOne() = relasi one-to-one
        // Parameter 1: Model yang direlasikan (User::class)
        // Parameter 2: Foreign key di tabel users ('id_siswa')
        // Parameter 3: Local key di tabel siswas ('id_siswa')
        return $this->hasOne(User::class, 'id_siswa', 'id_siswa');
    }

    /**
     * Relasi One-to-Many ke tabel Pembayarans
     * Satu siswa bisa punya banyak pembayaran (history pembayaran)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pembayarans()
    {
        // hasMany() = relasi one-to-many
        // Parameter 1: Model yang direlasikan (Pembayaran::class)
        // Parameter 2: Foreign key di tabel pembayarans ('id_siswa')
        // Parameter 3: Local key di tabel siswas ('id_siswa')
        return $this->hasMany(Pembayaran::class, 'id_siswa', 'id_siswa');
    }

    // ============================================
    // HELPER METHODS (Method Tambahan)
    // ============================================

    /**
     * Get kelas dan jurusan siswa dalam format lengkap
     * Contoh: "XI RPL" atau "X TKJ"
     *
     * @return string
     */
    public function getKelasLengkap()
    {
        // Gabungkan kelas + jurusan dengan spasi
        return $this->kelas_siswa . ' ' . $this->jurusan;
    }

    /**
     * Get angkatan dalam format tahun lengkap
     * Contoh: angkatan "25" → "2025"
     *
     * @return string
     */
    public function getAngkatanLengkap()
    {
        // Kalau angkatan cuma 2 digit, tambahkan "20" di depan
        // strlen() = hitung panjang string
        if (strlen($this->angkatan) == 2) {
            return '20' . $this->angkatan;
        }

        // Kalau sudah 4 digit, return apa adanya
        return $this->angkatan;
    }
}
