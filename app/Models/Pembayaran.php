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
        'nominal_dibayar',
        'sisa_pembayaran',
        'status',
        'bukti_pembayaran',
        'kwitansi',
        'tahun'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function biaya()
    {
        return $this->belongsTo(Biaya::class, 'id_biaya');
    }
}
