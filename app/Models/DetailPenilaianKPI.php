<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenilaianKPI extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_penilaian_kpi';
    protected $primaryKey = 'id_detail_penilaian_kpi';
    public $timestamps = false;

    protected $fillable = [
        'id_penilaian_kpi',
        'id_komponen_kpi',
        'nilai',
    ];

    protected $dates = [
        'tanggal_dibuat',
        'tanggal_diperbarui',
    ];

    public function penilaianKPI()
    {
        return $this->belongsTo(PenilaianKPI::class, 'id_penilaian_kpi');
    }

    public function komponenKPI()
    {
        return $this->belongsTo(KomponenKpi::class, 'id_komponen_kpi');
    }
}
