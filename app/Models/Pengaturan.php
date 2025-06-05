<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'jumlah_soal',
        'durasi',
        // 'kategori_soal_id'
    ];

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class);
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriSoal::class, 'kategori_soal_id');
    }

    public function detail()
    {
        return $this->hasMany(PengaturanDetail::class);
    }

    protected $casts = [
        'kategori_soal_id' => 'array',
        'jumlah_soal' => 'array',
    ];
}
