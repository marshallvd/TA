<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenilaianKompetensi extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_penilaian_kompetensi';
    protected $primaryKey = 'id_detail_penilaian_kompetensi';
    public $timestamps = false;

    protected $fillable = [
        'id_penilaian_kompetensi',
        'id_komponen_kompetensi',
        'nilai',
    ];

    protected $dates = [
        'tanggal_dibuat',
        'tanggal_diperbarui',
    ];

    public function penilaianKompetensi()
    {
        return $this->belongsTo(PenilaianKompetensi::class, 'id_penilaian_kompetensi');
    }

    public function komponenKompetensi()
    {
        return $this->belongsTo(KomponenKompetensi::class, 'id_komponen_kompetensi');
    }
}