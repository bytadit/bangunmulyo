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
        Schema::create('perorangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjam_id');
            $table->foreign('peminjam_id')->references('id')->on('peminjams')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_kelamin')->comment('1: laki-laki; 2: perempuan');
            // $table->dateTime('tgl_lahir');
            $table->integer('umur');
            $table->string('pekerjaan');
            $table->string('jaminan')->nullable();
            $table->integer('nilai_jaminan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perorangans');
    }
};
