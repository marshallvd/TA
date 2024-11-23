<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    protected $table = 'tb_jenis_cuti';
    protected $primaryKey = 'id_jenis_cuti';

    protected $fillable = [
        'nama_jenis_cuti',
        'kategori',
        'jumlah_hari_diizinkan'
    ];

    public $timestamps = false; // Menonaktifkan timestamps

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'id_jenis_cuti');
    }

    public function scopeUmum($query)
    {
        return $query->where('kategori', 'Umum');
    }

    public function scopeKhusus($query)
    {
        return $query->where('kategori', 'Khusus');
    }
}
