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
        Schema::create('pinjaman_anggotas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pinjaman_id');
            $table->foreign('pinjaman_id')->references('id')->on('pinjaman')->onDelete('cascade');
            $table->unsignedBigInteger('anggota_id');
            $table->foreign('anggota_id')->references('id')->on('anggota_kelompoks')->onDelete('cascade');
            $table->integer('jumlah_pinjaman')->nullable();
            $table->integer('nilai_angsuran')->nullable();
            $table->integer('pokok')->nullable();
            $table->integer('iuran')->nullable();
            $table->string('jaminan')->nullable();;
            $table->integer('nilai_jaminan')->nullable();;
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjaman_anggotas');
    }
};
