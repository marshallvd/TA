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
        'bobot',
    ];

    protected $casts = [
        'bobot' => 'decimal:2',
    ];

    // Jika Anda ingin menggunakan timestamp, gunakan ini:
    // const CREATED_AT = 'tanggal_dibuat';
    // const UPDATED_AT = 'tanggal_diperbarui';
}