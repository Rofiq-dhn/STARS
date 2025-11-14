<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // Primary key
            $table->id('id_user');

            // Username untuk login (NIP/NIS)
            $table->string('username', 100)->unique();

            // Password - PENTING: Harus varchar tanpa limit atau minimal 255
            // Karena bcrypt hash = 60 karakter
            $table->string('password');  // ← UBAH INI (hapus angka)

            // Level user (admin/siswa)
            $table->enum('level', ['siswa', 'admin']);

            // Foreign keys
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->unsignedBigInteger('id_siswa')->nullable();

            // Remember token untuk "Remember Me"
            $table->rememberToken();

            // Timestamps
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
