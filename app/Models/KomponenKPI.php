<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenKpi extends Model
{
    use HasFactory;

    protected $table = 'tb_komponen_kpi';
    protected $primaryKey = 'id_komponen_kpi';
    public $timestamps = false;

    protected $fillable = [
        'id_divisi',
        'nama_indikator',
        'bobot'
    ];

    protected $dates = [
        'tanggal_dibuat',
        'tanggal_diperbarui'
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi');
    }

    public function penilaianKpi()
    {
        return $this->hasMany(PenilaianKpi::class, 'id_komponen_kpi');
    }
}