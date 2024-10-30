<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserPelamar extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'tb_user_pelamar';
    protected $primaryKey = 'id_pelamar';
    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = 'tanggal_diperbarui';
    
    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
        'alamat',
        'pendidikan_terakhir',
        'pengalaman_kerja',
        'cv_path'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'tanggal_dibuat',
        'tanggal_diperbarui'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function lamaran()
    {
        return $this->hasMany(LamaranPekerjaan::class, 'id_pelamar');
    }

    public function lowongan()
    {
        return $this->belongsToMany(LowonganPekerjaan::class, 'tb_lamaran_pekerjaan', 'id_pelamar', 'id_lowongan_pekerjaan');
    }
}