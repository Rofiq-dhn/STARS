<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->char('nis', 8)->unique();  // NIS sebagai username
            $table->string('nama', 20);
            $table->string('kelas_siswa', 255);
            $table->string('jenis_kelamin', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
