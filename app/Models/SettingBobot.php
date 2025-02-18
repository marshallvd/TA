<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingBobot extends Model
{
    protected $table = 'tb_setting_bobot';
    protected $primaryKey = 'id_setting_bobot';
    
    protected $fillable = [
        'bobot_kpi',
        'bobot_kompetensi',
        'bobot_core_values'
    ];

    protected static function boot()
    {
        parent::boot();
        
        // Ensure total bobot equals 100%
        static::saving(function ($model) {
            $total = $model->bobot_kpi + $model->bobot_kompetensi + $model->bobot_core_values;
            if ($total != 100) {
                throw new \Exception('Total bobot harus 100%');
            }
        });
    }
}