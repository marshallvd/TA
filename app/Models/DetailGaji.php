<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DetailGaji extends Model
{
    protected $table = 'tb_detail_gaji';
    protected $primaryKey = 'id_detail';
    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = 'tanggal_diperbarui';
    public $timestamps = true; // Menghilangkan penggunaan created_at dan updated_at

    protected $fillable = [
        'id_gaji',
        'id_komponen',
        'jumlah',
        'tanggal_dibuat',
        'tanggal_diperbarui'
    ];

    protected $dates = [
        'tanggal_dibuat',
        'tanggal_diperbarui'
    ];

    public function gaji()
    {
        return $this->belongsTo(Gaji::class, 'id_gaji');
    }

    public function komponenGaji()
    {
        return $this->belongsTo(KomponenGaji::class, 'id_komponen');
    }
}