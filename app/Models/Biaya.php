<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    protected $table = 'biayas';
    protected $primaryKey = 'id_biaya';

    // Kolom-kolom yang boleh diisi mass assignment (insert/update sekaligus banyak field)
    protected $fillable = ['biaya', 'kategori', 'tahun', 'kelas'];
}
