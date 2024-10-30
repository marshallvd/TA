<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKPI extends Model
{
    use HasFactory;

    protected $table = 'tb_penilaian_kpi';
    protected $primaryKey = 'id_penilaian_kpi';
    public $timestamps = false;

    protected $fillable = [
        'nilai_rata_rata',
    ];

    protected $dates = [
        'tanggal_dibuat',
        'tanggal_diperbarui',
    ];

    public function detailPenilaianKPI()
    {
        return $this->hasMany(DetailPenilaianKPI::class, 'id_penilaian_kpi');
    }
}

