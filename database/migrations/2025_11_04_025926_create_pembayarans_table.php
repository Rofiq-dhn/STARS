<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->bigIncrements('id_pembayaran');
            $table->unsignedBigInteger('id_biaya');
            $table->unsignedBigInteger('id_siswa');
            $table->string('bulan', 20);
            $table->string('nominal_dibayar', 255);
            $table->string('sisa_pembayaran', 255)->nullable();
            $table->enum('status', ['belum lunas','lunas'])->default('belum lunas');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('kwitansi')->nullable();
            $table->char('tahun', 4);
            $table->timestamps();

            $table->foreign('id_biaya')->references('id_biaya')->on('biayas')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
};
