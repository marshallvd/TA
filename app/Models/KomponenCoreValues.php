<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenCoreValues extends Model
{
    use HasFactory;

    protected $table = 'tb_komponen_core_values';
    protected $primaryKey = 'id_komponen_core_values';
    public $timestamps = false;

    protected $fillable = [
        'nama_core_values',
        'bobot',
    ];

    protected $casts = [
        'bobot' => 'decimal:2',
    ];

    // Jika Anda ingin menggunakan timestamp, gunakan ini:
    // const CREATED_AT = 'tanggal_dibuat';
    // const UPDATED_AT = 'tanggal_diperbarui';
}