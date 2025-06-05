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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            // $table->date('jadwal');
            // $table->time('waktu_mulai');
            // $table->time('waktu_selesai');
            // $table->foreignId('kategori_soal_id')->references('id')->on('kategori_soals')->onDelete('cascade');
            // $table->integer('jumlah_soal')->default(0);
            $table->integer('durasi')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};
