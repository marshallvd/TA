<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingGaji extends Model
{
    protected $table = 'tb_setting_gaji';
    protected $primaryKey = 'id_setting_gaji';
    
    protected $fillable = [
        'insentif_sangat_baik',
        'insentif_baik',
        'insentif_cukup',
        'insentif_kurang',
        'insentif_sangat_kurang',
        'bonus_per_kehadiran',
        'potongan_bpjs',
        'persentase_pajak',
        'hitung_gaji_pokok',
        'hitung_insentif',
        'hitung_bonus_kehadiran',
        'hitung_tunjangan_lembur'
    ];

    // Method untuk mendapatkan persentase insentif berdasarkan predikat
    public function getInsentifByPredikat($predikat)
    {
        $predikat = strtolower($predikat);
        switch ($predikat) {
            case 'sangat baik':
                return $this->insentif_sangat_baik;
            case 'baik':
                return $this->insentif_baik;
            case 'cukup':
                return $this->insentif_cukup;
            case 'kurang':
                return $this->insentif_kurang;
            case 'sangat kurang':
                return $this->insentif_sangat_kurang;
            default:
                return 0;
        }
    }

    // Method untuk mendapatkan setting aktif
    public static function getActive()
    {
        return self::latest()->first();
    }
}