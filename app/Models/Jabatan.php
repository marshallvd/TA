<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'tb_jabatan';
    protected $primaryKey = 'id_jabatan';
    public $timestamps = false;

    protected $fillable = [
        'nama_jabatan',
        'id_divisi',
        'gaji_pokok',
        'tarif_lembur_per_hari'
    ];

    // Relasi dengan Divisi
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id_divisi');
    }

    // Relasi dengan Pegawai
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'id_jabatan', 'id_jabatan');
    }
}