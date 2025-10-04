<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';
    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'nis',
        'nama',
        'kelas_siswa',
        'jenis_kelamin',
    ];

    // Relationship ke User
    public function user()
    {
        return $this->hasOne(User::class, 'id_siswa', 'id_siswa');
    }
}
