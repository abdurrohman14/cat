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
        Schema::create('jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('soal_acak_id')->references('id')->on('soal_acaks')->onDelete('cascade');
            $table->foreignId('pengaturan_id')->references('id')->on('pengaturans')->onDelete('cascade');
            $table->char('jawaban');
            $table->boolean('benar')->default(0);
            $table->boolean('status')->default(0);
            $table->integer('skor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawabans');
    }
};
