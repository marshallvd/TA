<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenGaji extends Model
{
    protected $table = 'tb_komponen_gaji';
    protected $primaryKey = 'id_komponen';
    public $timestamps = false;

    protected $fillable = [
        'nama_komponen',
        'jenis',
        'keterangan'
    ];

    protected $dates = [
        'tanggal_dibuat',
        'tanggal_diperbarui'
    ];
}