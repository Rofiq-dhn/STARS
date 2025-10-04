<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
        'level',
        'id_admin',
        'id_siswa',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relationship ke Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    // Relationship ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    // Helper method cek role
    public function isAdmin()
    {
        return $this->level === 'admin';
    }

    public function isSiswa()
    {
        return $this->level === 'siswa';
    }

    // Helper method untuk ambil nama (dari admin atau siswa)
    public function getNama()
    {
        if ($this->isAdmin() && $this->admin) {
            return $this->admin->nama;
        }

        if ($this->isSiswa() && $this->siswa) {
            return $this->siswa->nama;
        }

        return 'Unknown';
    }
}
