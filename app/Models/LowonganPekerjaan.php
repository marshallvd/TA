<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganPekerjaan extends Model
{
    use HasFactory;

    protected $table = 'tb_lowongan_pekerjaan';
    protected $primaryKey = 'id_lowongan_pekerjaan';
    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = 'tanggal_diperbarui';
    public $timestamps = true;
    
    protected $fillable = [
        'judul_pekerjaan',
        'id_jabatan',
        'id_divisi',
        'lokasi_pekerjaan',
        'jumlah_lowongan',
        'pengalaman_minimal',
        'usia_minimal',
        'usia_maksimal',
        'gaji_minimal',
        'gaji_maksimal',
        'jenis_pekerjaan',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
        'persyaratan'
    ];

    // Tambahkan relasi ke model Jabatan dan Divisi
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id_divisi');
    }
    public function lamaran()
    {
        return $this->hasMany(LamaranPekerjaan::class, 'id_lowongan_pekerjaan', 'id_lowongan_pekerjaan');
    }
    public function lamaranPekerjaan()
    {
        return $this->hasMany(LamaranPekerjaan::class, 'id_lowongan_pekerjaan', 'id_lowongan_pekerjaan');
    }
}