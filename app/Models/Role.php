<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'tb_role';
    protected $primaryKey = 'id_role';
    public $timestamps = false;

    protected $fillable = [
        'nama_role',
    ];

    // Jika ada relasi dengan User, bisa ditambahkan seperti ini:
    // public function users()
    // {
    //     return $this->hasMany(User::class, 'id_role', 'id_role');
    // }
}