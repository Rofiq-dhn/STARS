<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('biayas', function (Blueprint $table) {
            $table->id('id_biaya');
            $table->string('kategori', 20);
            $table->string('tahun', 20);
            $table->string('biaya', 255);
            $table->string('kelas', 4)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biayas');
    }
};
