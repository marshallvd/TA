<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenilaianCoreValues extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_penilaian_core_values';
    protected $primaryKey = 'id_detail_penilaian_core_values';
    public $timestamps = false;

    protected $fillable = [
        'id_penilaian_core_values',
        'id_komponen_core_values',
        'nilai',
    ];

    public function penilaianCoreValues()
    {
        return $this->belongsTo(PenilaianCoreValues::class, 'id_penilaian_core_values', 'id_penilaian_core_values');
    }

    public function komponenCoreValues()
    {
        return $this->belongsTo(KomponenCoreValues::class, 'id_komponen_core_values', 'id_komponen_core_values');
    }
}