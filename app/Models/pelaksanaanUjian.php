<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelaksanaanUjian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'pengaturan_id', 'skor', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pengaturan() {
        return $this->belongsTo(Pengaturan::class, 'pengaturan_id');
    }
}
