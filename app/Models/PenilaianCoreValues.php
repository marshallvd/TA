<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianCoreValues extends Model
{
    use HasFactory;

    protected $table = 'tb_penilaian_core_values';
    protected $primaryKey = 'id_penilaian_core_values';
    public $timestamps = false;

    protected $fillable = [
        'nilai_rata_rata',
    ];

    protected $dates = [
        'tanggal_dibuat',
        'tanggal_diperbarui',
    ];

    public function detailPenilaianCoreValues()
    {
        return $this->hasMany(DetailPenilaianCoreValues::class, 'id_penilaian_core_values', 'id_penilaian_core_values');
    }
}