<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jadwal','waktu_mulai', 'waktu_selesai', 'jumlah_soal', 'durasi'
    ];

    public function jawaban() {
        return $this->hasMany(Jawaban::class);
    }
}
