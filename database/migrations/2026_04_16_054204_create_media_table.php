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
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');
            $table->foreignId('mahasiswa_id')->references('mahasiswa_id')->on('mahasiswa');
            $table->foreignId('kategori_id')->references('kategori_id')->on('kategori');
            $table->string('judul');
            $table->string('deskripsi');
            $table->string('judul_penelitian');
            $table->string('tahun_terbit');
            $table->string('link_media');
            $table->string('gambar_cover');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
