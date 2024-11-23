<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JatahCuti extends Model
{
    protected $table = 'tb_jatah_cuti';
    protected $primaryKey = 'id_jatah_cuti';
    const CREATED_AT = 'tanggal_dibuat';
    const UPDATED_AT = 'tanggal_diperbarui';
    
    protected $fillable = [
        'id_pegawai',
        'tahun',
        'jatah_cuti_umum',
        'jatah_cuti_menikah',
        'jatah_cuti_melahirkan'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }


    public function saveQuietly(array $options = [])
    {
        return static::withoutEvents(function () use ($options) {
            return $this->save($options);
        });
    }
    // Method untuk menghitung sisa cuti
    public function hitungSisaCuti()
    {
        try {
            $currentYear = $this->tahun ?? date('Y');
    
            // Cuti Umum
            $cutiUmum = Cuti::where('id_pegawai', $this->id_pegawai)
                ->whereYear('tanggal_mulai', $currentYear)
                ->where('status', 'disetujui')
                ->where('id_jenis_cuti', 1) // Cuti Umum
                ->sum('jumlah_hari');
                
            // Cuti Menikah
            $cutiMenikah = Cuti::where('id_pegawai', $this->id_pegawai)
                ->whereYear('tanggal_mulai', $currentYear)
                ->where('status', 'disetujui')
                ->where('id_jenis_cuti', 4) // Cuti Menikah
                ->sum('jumlah_hari');
                
            // Cuti Melahirkan
            $cutiMelahirkan = Cuti::where('id_pegawai', $this->id_pegawai)
                ->whereYear('tanggal_mulai', $currentYear)
                ->where('status', 'disetujui')
                ->where('id_jenis_cuti', 3) // Cuti Melahirkan
                ->sum('jumlah_hari');
    
            // Pastikan tidak melebihi jatah awal
            $this->sisa_cuti_umum = max(0, $this->jatah_cuti_umum - $cutiUmum);
            $this->sisa_cuti_menikah = max(0, $this->jatah_cuti_menikah - $cutiMenikah);
            $this->sisa_cuti_melahirkan = max(0, $this->jatah_cuti_melahirkan - $cutiMelahirkan);
    
            // Simpan perubahan tanpa memicu event
            $this->saveQuietly();
    
            return $this;
        } catch (\Exception $e) {
            \Log::error('Error menghitung sisa cuti: ' . $e->getMessage());
            return $this;
        }
    }


}