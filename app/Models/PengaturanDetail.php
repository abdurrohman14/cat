<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanDetail extends Model
{
    protected $fillable = ['pengaturan_id', 'kategori_soal_id', 'jumlah_soal'];

    public function pengaturan()
    {
        return $this->belongsTo(Pengaturan::class);
    }

    public function kategoriSoal()
    {
        return $this->belongsTo(KategoriSoal::class);
    }
}
