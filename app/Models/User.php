<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable Implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nomor_wa',
        'alamat',
        'tanggal_lahir',
        'tempat_lahir',
        'nrp',
        'jenis_kelamin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    const ROLE_ADMIN = 'admin';
    const ROLE_PESERTA = 'peserta';

    // Cek jika user adalah admin
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    // Cek jika user adalah peserta
    public function isPeserta()
    {
        return $this->role === self::ROLE_PESERTA;
    }

    public function jawaban() {
        return $this->hasMany(Jawaban::class);
    }

    public function pelaksanaanUjian() {
        return $this->hasMany(PelaksanaanUjian::class);
    }
}
