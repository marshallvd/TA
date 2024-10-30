<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wawancara extends Model
{
    use HasFactory;

    protected $table = 'tb_wawancara';
    protected $primaryKey = 'id_wawancara';
    
    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = 'tanggal_diperbarui';

    protected $fillable = [
        'id_lamaran_pekerjaan',
        'id_pelamar',
        'tanggal_wawancara',
        'lokasi',
        'catatan',
        'hasil'
    ];

    protected $casts = [
        'tanggal_wawancara' => 'datetime',
        'tanggal_dibuat' => 'datetime',
        'tanggal_diperbarui' => 'datetime'
    ];

    public function lamaranPekerjaan()
    {
        return $this->belongsTo(LamaranPekerjaan::class, 'id_lamaran_pekerjaan', 'id_lamaran_pekerjaan');
    }

    public function pelamar()
    {
        return $this->belongsTo(UserPelamar::class, 'id_pelamar', 'id_pelamar');
    }
}