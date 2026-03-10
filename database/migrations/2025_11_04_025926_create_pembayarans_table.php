<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('id_pembayaran');

            $table->unsignedBigInteger('id_biaya');
            $table->unsignedBigInteger('id_siswa');

            // Bulan pembayaran (untuk SPP: Juli, Agustus, dst. Untuk PPDB/Daftar Ulang: NULL)
            $table->string('bulan', 255)->nullable();

            // Nominal yang dibayar
            $table->string('nominal_dibayar', 255);

            // Sisa pembayaran
            $table->string('sisa_pembayaran', 255);

            // Status: lunas / belum lunas
            $table->enum('status', ['belum lunas', 'lunas'])->default('belum lunas');

            // File bukti pembayaran
            $table->string('bukti_pembayaran', 255)->nullable();

            // File kwitansi (generate by admin)
            $table->string('kwitansi')->nullable();

            // Tahun ajaran (misal: 2025/2026)
            $table->string('tahun_ajaran', 20);

            // TAMBAHAN BARU: Untuk cicilan
            $table->integer('cicilan_ke')->default(1);        // Cicilan ke berapa (1, 2)
            $table->integer('total_cicilan')->default(1);     // Total cicilan (1=lunas, 2=cicil 2x)

            $table->timestamps();

            $table->foreign('id_biaya')->references('id_biaya')->on('biayas')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
