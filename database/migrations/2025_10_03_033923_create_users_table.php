<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100)->unique();  // NIP atau NIS
            $table->string('password');
            $table->enum('level', ['siswa', 'admin']);

            // Foreign keys
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->unsignedBigInteger('id_siswa')->nullable();

            $table->rememberToken();
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
