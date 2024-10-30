<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'tb_gaji';
    protected $primaryKey = 'id_gaji';
    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = 'tanggal_diperbarui';
    public $timestamps = true;

    protected $fillable = [
        'id_pegawai',
        'periode_bulan',
        'periode_tahun',
        'jumlah_kehadiran',
        'jumlah_hari_lembur',
        'total_pendapatan',
        'total_potongan',
        'gaji_bersih',
        'tanggal_pembayaran',
        'status',
        'tanggal_dibuat',
        'tanggal_diperbarui'
    ];

    protected $dates = [
        'tanggal_pembayaran',
        'tanggal_dibuat',
        'tanggal_diperbarui'
    ];

    // Relasi dengan Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

        // Tambahkan relasi dengan DetailGaji
        public function detailGaji()
        {
            return $this->hasMany(DetailGaji::class, 'id_gaji', 'id_gaji');
        }

}