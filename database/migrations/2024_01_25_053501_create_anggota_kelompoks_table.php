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
        Schema::create('anggota_kelompoks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelompok_id');
            $table->foreign('kelompok_id')->references('id')->on('peminjams')->onDelete('cascade');
            $table->string('nik');
            $table->string('nama');
            $table->unsignedBigInteger('jabatan_id');
            $table->foreign('jabatan_id')->references('id')->on('referensi_jabatans')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_kelamin')->comment('1: laki-laki; 2: perempuan');
            $table->string('noHP');
            $table->text('alamat');
            $table->dateTime('tgl_lahir');
            // $table->integer('umur');
            $table->string('pekerjaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_kelompoks');
    }
};
