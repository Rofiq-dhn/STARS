<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_biaya',
        'id_siswa',
        'bulan',
        'tahun_ajaran',
        'nominal_dibayar',
        'sisa_pembayaran',
        'status',
        'opsi_pembayaran',    // TAMBAHAN BARU
        'cicilan_ke',         // TAMBAHAN BARU
        'bukti_pembayaran',
        'kwitansi',
        'tahun',
    ];

    public function biaya()
    {
        return $this->belongsTo(Biaya::class, 'id_biaya', 'id_biaya');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
