<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenKompetensi extends Model 
{
    use HasFactory;

    protected $table = 'tb_komponen_kompetensi';
    protected $primaryKey = 'id_komponen_kompetensi';
    public $timestamps = false;

    protected $fillable = [
        'nama_kompetensi',
        'perilaku_utama',
        'bobot',
    ];

    protected $casts = [
        'bobot' => 'decimal:2',
    ];
}