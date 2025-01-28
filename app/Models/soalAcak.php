<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soalAcak extends Model
{
    use HasFactory;

    protected $fillable = ['soal_id', 'user_id', 'index_soal'];

    public function soal() {
        return $this->belongsTo(Soal::class, 'soal_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
