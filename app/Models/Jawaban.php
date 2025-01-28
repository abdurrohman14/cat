<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'soal_acak_id', 'jawaban', 'benar', 'status', 'skor', 'pengaturan_id'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function soalAcak() {
        return $this->belongsTo(Soal::class, 'soal_acak_id');
    }

    public function pengaturan() {
        return $this->belongsTo(Pengaturan::class, 'pengaturan_id');
    }
}
