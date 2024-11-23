<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'tb_pegawai';
    protected $primaryKey = 'id_pegawai';
    public $timestamps = false;

    protected $fillable = [
        'nama_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'telepon',
        'email',
        'nik',
        'id_jabatan',
        'id_divisi',
        'tanggal_masuk',
        'tanggal_keluar',
        'agama',
        'pendidikan_terakhir',
        'status_kepegawaian',
        'foto',
    ];

    protected $dates = [
        'tanggal_lahir',
        'tanggal_dibuat',
        'tanggal_diperbarui',
    ];

    // Relasi dengan User jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Relasi dengan Jabatan
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    // Relasi dengan Divisi
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id_divisi');
    }

    // Relasi dengan Penilaian Kinerja
    public function penilaianKinerja()
    {
        return $this->hasMany(PenilaianKinerja::class, 'id_pegawai', 'id_pegawai');
    }
}