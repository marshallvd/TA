<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'tb_divisi';
    protected $primaryKey = 'id_divisi';
    public $timestamps = false;

    protected $fillable = [
        'nama_divisi',
        
    ];

    // Relasi dengan Jabatan jika diperlukan
    public function jabatan()
    {
        return $this->hasMany(Jabatan::class, 'id_divisi');
    }
}