<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjam_id');
            $table->foreign('peminjam_id')->references('id')->on('peminjams')->onDelete('cascade');
            $table->dateTime('tgl_pinjaman');
            $table->integer('periode_pinjaman')->comment('pinjaman ke berapa');
            $table->integer('jangka_waktu')->default(12)->comment('jangka waktu pinjaman (bulan)');
            $table->bigInteger('jumlah_pinjaman')->default(0);
            $table->bigInteger('jumlah_iuran')->default(0);
            $table->bigInteger('jumlah_pokok')->default(0);
            $table->bigInteger('jumlah_angsuran')->default(0);
            $table->dateTime('tgl_pencairan')->nullable();
            $table->dateTime('tgl_pelunasan')->nullable();
            $table->dateTime('tgl_jatuh_tempo')->nullable();
            $table->string('keperluan');
            $table->unsignedBigInteger('keterangan')->comment('0: Belum Lunas; 1: Lunas {if total_pokok_dibayarkan >= jumlah_pinjaman then lunas}');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjamen');
    }
};
