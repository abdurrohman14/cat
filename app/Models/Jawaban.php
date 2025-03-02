<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $fillable = [
        'soal_acak_id', 'jawaban', 'benar', 'pelaksanaan_ujian_id'
    ];

    // public function user() {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function soalAcak() {
        return $this->belongsTo(Soal::class, 'soal_acak_id');
    }

    public function pelaksanaanUjian() {
        return $this->belongsTo(pelaksanaanUjian::class, 'pelaksanaan_ujian_id');
    }
}
