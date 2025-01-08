<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSeleksi extends Model
{
    use HasFactory;

    protected $table = 'tb_hasil_seleksi';
    protected $primaryKey = 'id_hasil_seleksi';
    
    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = 'tanggal_diperbarui';

    protected $fillable = [
        'id_pelamar',
        'id_lowongan_pekerjaan',
        'id_wawancara', 
        'status',
        'catatan'
    ];

    public function pelamar()
    {
        return $this->belongsTo(UserPelamar::class, 'id_pelamar', 'id_pelamar');
    }

    public function lowonganPekerjaan()
    {
        return $this->belongsTo(LowonganPekerjaan::class, 'id_lowongan_pekerjaan', 'id_lowongan_pekerjaan');
    }
    public function wawancara()
    {
        return $this->belongsTo(Wawancara::class, 'id_wawancara', 'id_wawancara');
    }
    public function lamaran()
    {
        return $this->belongsTo(LamaranPekerjaan::class, 'id_lamaran_pekerjaan');
    }
}