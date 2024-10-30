<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKompetensi extends Model
{
    use HasFactory;

    protected $table = 'tb_penilaian_kompetensi';
    protected $primaryKey = 'id_penilaian_kompetensi';
    public $timestamps = false;

    protected $fillable = [
        'nilai_rata_rata',
    ];

    protected $dates = [
        'tanggal_dibuat',
        'tanggal_diperbarui',
    ];
    
    public function detailPenilaianKompetensi()
    {
        return $this->hasMany(DetailPenilaianKompetensi::class, 'id_penilaian_kompetensi', 'id_penilaian_kompetensi');
    }
}