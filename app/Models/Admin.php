<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'nama',
        'nip',
        'no_telepon',
    ];

    // Relationship ke User
    public function user()
    {
        return $this->hasOne(User::class, 'id_admin', 'id_admin');
    }
}
