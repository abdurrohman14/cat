<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_soal', 'soal', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e', 'jawaban_benar'
    ];

    public function kategori() {
        return $this->belongsTo(KategoriSoal::class, 'kategori_soal');
    }

    public function jawaban() {
        return $this->hasMany(Jawaban::class);
    }
}
