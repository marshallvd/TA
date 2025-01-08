<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LamaranPekerjaan extends Model
{
    protected $table = 'tb_lamaran_pekerjaan';
    protected $primaryKey = 'id_lamaran_pekerjaan';
    
    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = 'tanggal_diperbarui';
    
    public $timestamps = false;
    
    protected $fillable = [
        'id_lowongan_pekerjaan',
        'id_pelamar',
        'nama_pelamar',
        'email_pelamar',
        'telepon_pelamar',
        'alamat_pelamar',
        'pendidikan_terakhir',
        'pengalaman_kerja',
        'status_lamaran',
        'status_seleksi'
    ];

    protected $casts = [
        'tanggal_dibuat' => 'datetime',
        'tanggal_diperbarui' => 'datetime',
    ];

    // Relasi dengan Pelamar
    public function pelamar()
    {
        return $this->belongsTo(UserPelamar::class, 'id_pelamar', 'id_pelamar');
    }

    // Relasi dengan LowonganPekerjaan
    public function lowonganPekerjaan()
    {
        return $this->belongsTo(LowonganPekerjaan::class, 'id_lowongan_pekerjaan', 'id_lowongan_pekerjaan');
    }

    public function wawancara()
    {
        return $this->hasOne(Wawancara::class, 'id_lamaran_pekerjaan', 'id_lamaran_pekerjaan');
    }
}