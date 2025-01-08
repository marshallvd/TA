<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HasilSeleksi;
use App\Models\Pegawai;
use App\Models\UserPelamar;
use App\Models\LowonganPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilSeleksiController extends Controller
{
    public function index()
    {
        $hasilSeleksi = HasilSeleksi::with(['pelamar', 'lowonganPekerjaan'])->get();
        
        return response()->json([
            'status' => 'sukses',
            'data' => $hasilSeleksi
        ]);
    }

// app/Http/Controllers/Api/HasilSeleksiController.php
public function store(Request $request)
{
    try {
        DB::beginTransaction();

        $request->validate([
            'id_pelamar' => 'required|exists:tb_user_pelamar,id_pelamar',
            'id_lowongan_pekerjaan' => 'required|exists:tb_lowongan_pekerjaan,id_lowongan_pekerjaan',
            'id_wawancara' => 'required|exists:tb_wawancara,id_wawancara',
            'status' => 'required|in:lulus,gagal',
            'catatan' => 'nullable|string'
        ]);

        // Cek apakah sudah ada hasil seleksi untuk wawancara ini
        $existingHasil = HasilSeleksi::where('id_wawancara', $request->id_wawancara)->first();
        if ($existingHasil) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Hasil seleksi untuk wawancara ini sudah ada'
            ], 422);
        }

        $hasilSeleksi = HasilSeleksi::create([
            'id_pelamar' => $request->id_pelamar,
            'id_lowongan_pekerjaan' => $request->id_lowongan_pekerjaan,
            'id_wawancara' => $request->id_wawancara,
            'status' => $request->status,
            'catatan' => $request->catatan,
            'sudah_dimigrasi' => false
        ]);

        // Proses migrasi ke pegawai jika lulus (sama seperti sebelumnya)
        if ($request->status === 'lulus') {
            $pegawai = $this->migrasiKePegawai($request->id_pelamar, $request->id_lowongan_pekerjaan);
            $hasilSeleksi->update(['sudah_dimigrasi' => true]);
        }

        DB::commit();

        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Hasil seleksi berhasil disimpan',
            'data' => $hasilSeleksi
        ], 201);

    } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'status' => 'error',
            'pesan' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}


public function show($id)
{
    try {
        $hasilSeleksi = HasilSeleksi::with(['pelamar', 'lowonganPekerjaan'])
            ->findOrFail($id);
    
        return response()->json([
            'status' => 'success',
            'data' => $hasilSeleksi
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Data hasil seleksi tidak ditemukan'
        ], 404);
    }
}



    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $hasilSeleksi = HasilSeleksi::findOrFail($id);

            $request->validate([
                'status' => 'required|in:lulus,gagal',
                'catatan' => 'nullable|string'
            ]);

            $statusSebelumnya = $hasilSeleksi->status;
            
            // Update hasil seleksi
            $hasilSeleksi->update([
                'status' => $request->status,
                'catatan' => $request->catatan
            ]);

            // Jika status berubah dari gagal ke lulus
            if ($statusSebelumnya === 'gagal' && $request->status === 'lulus') {
                // Cek apakah sudah pernah dimigrasi
                if (!$hasilSeleksi->sudah_dimigrasi) {
                    $pegawai = $this->migrasiKePegawai($hasilSeleksi->id_pelamar, $hasilSeleksi->id_lowongan_pekerjaan);
                    $hasilSeleksi->update(['sudah_dimigrasi' => true]);
                } else {
                    // Jika sudah pernah dimigrasi, aktifkan kembali status pegawai
                    $pegawai = Pegawai::where('email', $hasilSeleksi->pelamar->email)->first();
                    if ($pegawai) {
                        $pegawai->update(['status_kepegawaian' => 'aktif']);
                    }
                }
            }
            // Jika status berubah dari lulus ke gagal
            elseif ($statusSebelumnya === 'lulus' && $request->status === 'gagal') {
                // Non-aktifkan status pegawai
                $pegawai = Pegawai::where('email', $hasilSeleksi->pelamar->email)->first();
                if ($pegawai) {
                    $pegawai->update([
                        'status_kepegawaian' => 'tidak',
                        'tanggal_keluar' => date('Y-m-d')
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => 'sukses',
                'pesan' => $this->generateUpdateMessage($statusSebelumnya, $request->status),
                'data' => $hasilSeleksi
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'pesan' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    private function migrasiKePegawai($idPelamar, $idLowongan)
    {
        // Ambil data pelamar dan lowongan
        $pelamar = UserPelamar::findOrFail($idPelamar);
        $lowongan = LowonganPekerjaan::findOrFail($idLowongan);

        // Cek apakah email sudah terdaftar sebagai pegawai
        $pegawaiExisting = Pegawai::where('email', $pelamar->email)->first();
        if ($pegawaiExisting) {
            // Jika sudah ada, aktifkan kembali
            $pegawaiExisting->update([
                'status_kepegawaian' => 'aktif',
                'tanggal_masuk' => date('Y-m-d'),
                'tanggal_keluar' => null
            ]);
            return $pegawaiExisting;
        }

        // Buat data pegawai baru dengan data minimal
        $pegawai = new Pegawai();
        
        // Data yang diambil dari pelamar
        $pegawai->nama_lengkap = $pelamar->nama;
        $pegawai->email = $pelamar->email;
        $pegawai->telepon = $pelamar->no_hp;
        $pegawai->alamat = $pelamar->alamat;
        $pegawai->pendidikan_terakhir = $pelamar->pendidikan_terakhir;
        
        // Data yang diambil dari lowongan
        $pegawai->id_jabatan = $lowongan->id_jabatan;
        $pegawai->id_divisi = $lowongan->id_divisi;
        
        // Data default
        $pegawai->status_kepegawaian = 'aktif';
        $pegawai->tanggal_masuk = date('Y-m-d');
        
        // Simpan pegawai
        $pegawai->save();

        return $pegawai;
    }
    
    private function generateUpdateMessage($statusSebelumnya, $statusBaru)
    {
        if ($statusSebelumnya === $statusBaru) {
            return 'Hasil seleksi berhasil diperbarui';
        }
        
        if ($statusBaru === 'lulus') {
            return 'Hasil seleksi berhasil diperbarui dan data telah dimigrasi ke pegawai';
        }
        
        return 'Hasil seleksi berhasil diperbarui dan status kepegawaian telah dinonaktifkan';
    }


    public function destroy($id)
    {
        $hasilSeleksi = HasilSeleksi::findOrFail($id);
        $hasilSeleksi->delete();

        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Hasil seleksi berhasil dihapus'
        ]);
    }
}