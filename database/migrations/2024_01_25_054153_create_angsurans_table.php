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
        Schema::create('angsurans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pinjaman_id');
            $table->foreign('pinjaman_id')->references('id')->on('pinjaman')->onDelete('cascade');
            $table->dateTime('tgl_angsuran');
            $table->integer('angsuran_ke');
            $table->dateTime('tgl_jatuh_tempo');
            $table->float('iuran')->comment('nilai iuran/jasa per bulan')->nullable();
            $table->integer('pokok')->comment('nilai pokok per bulan')->nullable();
            $table->integer('angsuran_dibayarkan')->comment('nilai yang dibayarkan')->nullable();
            $table->integer('simpanan')->comment('nilai simpanan saat membayar')->nullable();
            $table->integer('total_pokok_dibayarkan')->comment('total pokok yang selama ini dibayarkan')->nullable();
            $table->integer('total_iuran_dibayarkan')->comment('total iuran yang selama ini dibayarkan')->nullable();
            $table->integer('pokok_tunggakan')->comment('jumlah_pinjaman - total_pokok_dibayarkan')->nullable();
            // $table->integer('iuran_tunggakan')->comment('(nilai iuran/jasa per bulan * bulan berjalan sejak pinjaman) - total_iuran_dibayarkan')->nullable();
            $table->integer('total_simpanan')->comment('total simpanan yang selama ini mengendap')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angsurans');
    }
};
