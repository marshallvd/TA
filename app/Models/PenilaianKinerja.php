<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKinerja extends Model
{
    use HasFactory;

    protected $table = 'tb_penilaian_kinerja';
    protected $primaryKey = 'id_penilaian_kinerja';
    public $timestamps = false;

    protected $fillable = [
        'id_pegawai',
        'periode_penilaian',
        'id_penilaian_kpi',
        'id_penilaian_kompetensi',
        'id_penilaian_core_values',
        'nilai_akhir',
        'predikat',
        'catatan'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function penilaianKPI()
    {
        return $this->belongsTo(PenilaianKPI::class, 'id_penilaian_kpi', 'id_penilaian_kpi');
    }

    public function penilaianKompetensi()
    {
        return $this->belongsTo(PenilaianKompetensi::class, 'id_penilaian_kompetensi', 'id_penilaian_kompetensi');
    }

    public function penilaianCoreValues()
    {
        return $this->belongsTo(PenilaianCoreValues::class, 'id_penilaian_core_values', 'id_penilaian_core_values');
    }
}