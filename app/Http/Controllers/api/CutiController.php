<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\JenisCuti;
use App\Models\JatahCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CutiController extends Controller
{
    
    public function store(Request $request)
{
    try {
        DB::beginTransaction();

        $request->validate([
            'id_pegawai' => 'required|exists:tb_pegawai,id_pegawai', // Tambahkan validasi id_pegawai
            'id_jenis_cuti' => 'required|exists:tb_jenis_cuti,id_jenis_cuti',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);

        // Gunakan id_pegawai dari request, bukan dari Auth
        $idPegawai = $request->id_pegawai;

        // Ambil data jenis cuti
        $jenisCuti = JenisCuti::findOrFail($request->id_jenis_cuti);
        
        // Hitung jumlah hari cuti
        $tanggalMulai = new \DateTime($request->tanggal_mulai);
        $tanggalSelesai = new \DateTime($request->tanggal_selesai);
        $jumlahHari = $tanggalMulai->diff($tanggalSelesai)->days + 1;

        // Cek jatah cuti berdasarkan jenis
        $jatahCuti = JatahCuti::where('id_pegawai', $idPegawai)
            ->where('tahun', date('Y'))
            ->firstOrFail();

        switch ($jenisCuti->kategori) {
            case 'Umum':
                if ($jumlahHari > $jatahCuti->sisa_cuti_umum) {
                    throw new \Exception('Jatah cuti umum tidak mencukupi');
                }
                break;
            
            case 'Khusus':
                switch ($jenisCuti->nama_jenis_cuti) {
                    case 'Cuti Menikah':
                        if ($jumlahHari > $jatahCuti->sisa_cuti_menikah) {
                            throw new \Exception('Jatah cuti menikah tidak mencukupi');
                        }
                        break;
                    
                    case 'Cuti Melahirkan':
                        if ($jumlahHari > $jatahCuti->sisa_cuti_melahirkan) {
                            throw new \Exception('Jatah cuti melahirkan tidak mencukupi');
                        }
                        break;
                }
                break;
        }

        // Buat pengajuan cuti
        $cuti = Cuti::create([
            'id_pegawai' => $idPegawai, // Gunakan id_pegawai dari request
            'id_jenis_cuti' => $request->id_jenis_cuti,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jumlah_hari' => $jumlahHari,
            'alasan' => $request->alasan,
            'status' => 'menunggu',
        ]);

        // Update sisa cuti setelah pengajuan
        $jatahCuti->hitungSisaCuti(); // Pastikan ini dipanggil setelah cuti dibuat

        DB::commit();

        return response()->json([
            'message' => 'Pengajuan cuti berhasil dibuat',
            'data' => $cuti
        ], 201);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error in CutiController@store: ' . $e->getMessage());
        return response()->json([
            'message' => 'Terjadi kesalahan pada server',
            'error' => config('app.debug') ? $e->getMessage() : null
        ], 500);
    }
}

    public function index(Request $request)
{
    try {
        $query = Cuti::with('jenisCuti');

        // Jika ada parameter start_date dan end_date
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->where(function($q) use ($request) {
                $q->whereBetween('tanggal_mulai', [$request->start_date, $request->end_date])
                  ->orWhereBetween('tanggal_selesai', [$request->start_date, $request->end_date]);
            });
        }

        $cuti = $query->orderBy('tanggal_dibuat', 'desc')->get();

        return response()->json([
            'message' => 'Data cuti berhasil diambil',
            'data' => $cuti
        ]);

    } catch (\Exception $e) {
        Log::error('Error in CutiController@index: ' . $e->getMessage());
        return response()->json([
            'message' => 'Terjadi kesalahan pada server',
            'error' => config('app.debug') ? $e->getMessage() : null
        ], 500);
    }
}

public function show($id)
{
    try {
        // Gunakan eager loading dengan relasi
        $cuti = Cuti::with([
            'pegawai' => function($query) {
                $query->select('id_pegawai', 'nama_lengkap');
            },
            'jenisCuti' => function($query) {
                $query->select('id_jenis_cuti', 'nama_jenis_cuti');
            }
        ])->findOrFail($id);

        return response()->json([
            'message' => 'Detail cuti berhasil diambil',
            'data' => $cuti
        ]);

    } catch (ModelNotFoundException $e) {
        Log::error('Cuti not found: ' . $e->getMessage());
        return response()->json([
            'message' => 'Data cuti tidak ditemukan',
            'error' => $e->getMessage()
        ], 404);

    } catch (\Exception $e) {
        Log::error('Error in CutiController@show: ' . $e->getMessage());
        return response()->json([
            'message' => 'Terjadi kesalahan pada server',
            'error' => config('app.debug') ? $e->getMessage() : null
        ], 500);
    }
}

   
public function diterima(Request $request, $id)
{
    try {
        DB::beginTransaction();

        $cuti = Cuti::with('jenisCuti')->findOrFail($id);
        
        // Hapus pengecekan status sebelumnya agar bisa diubah dari status apapun
        
        // Update status cuti
        $cuti->update([
            'status' => 'disetujui',
            'keterangan' => null
        ]);

        // Jika sebelumnya belum disetujui, kurangi jatah cuti
        if ($cuti->getOriginal('status') !== 'disetujui') {
            $jatahCuti = JatahCuti::where('id_pegawai', $cuti->id_pegawai)
                ->where('tahun', date('Y'))
                ->firstOrFail();

            if ($cuti->jenisCuti->kategori === 'Umum') {
                if ($cuti->jumlah_hari > $jatahCuti->sisa_cuti_umum) {
                    throw new \Exception('Jatah cuti umum tidak mencukupi');
                }
                $jatahCuti->sisa_cuti_umum -= $cuti->jumlah_hari;
                $jatahCuti->save();
            }
        }

        DB::commit();

        return response()->json([
            'message' => 'Cuti berhasil disetujui',
            'data' => $cuti
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'message' => $e->getMessage()
        ], 400);
    }
}

public function ditolak(Request $request, $id)
{
    try {
        DB::beginTransaction();

        $request->validate([
            'keterangan' => 'required|string',
        ]);

        $cuti = Cuti::with('jenisCuti')->findOrFail($id);
        
        // Jika sebelumnya disetujui, kembalikan jatah cuti
        if ($cuti->getOriginal('status') === 'disetujui') {
            $jatahCuti = JatahCuti::where('id_pegawai', $cuti->id_pegawai)
                ->where('tahun', date('Y'))
                ->firstOrFail();
            
            if ($cuti->jenisCuti->kategori === 'Umum') {
                $jatahCuti->sisa_cuti_umum += $cuti->jumlah_hari;
                $jatahCuti->save();
            }
        }

        // Update status cuti menjadi ditolak
        $cuti->update([
            'status' => 'ditolak',
            'keterangan' => $request->keterangan,
        ]);

        DB::commit();

        return response()->json([
            'message' => 'Cuti berhasil ditolak',
            'data' => $cuti
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'message' => $e->getMessage()
        ], 400);
    }
}

public function update(Request $request, $id)
{
    try {
        DB::beginTransaction();

        $request->validate([
            'id_jenis_cuti' => 'required|exists:tb_jenis_cuti,id_jenis_cuti',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);

        // Cari cuti yang akan diupdate
        $cuti = Cuti::findOrFail($id);

        // Hitung jumlah hari cuti
        $tanggalMulai = new \DateTime($request->tanggal_mulai);
        $tanggalSelesai = new \DateTime($request->tanggal_selesai);
        $jumlahHari = $tanggalMulai->diff($tanggalSelesai)->days + 1;

        // Ambil data jenis cuti
        $jenisCuti = JenisCuti::findOrFail($request->id_jenis_cuti);

        // Cek jatah cuti
        $jatahCuti = JatahCuti::where('id_pegawai', $cuti->id_pegawai)
            ->where('tahun', date('Y'))
            ->firstOrFail();

        // Kembalikan jumlah hari dari cuti sebelumnya jika berbeda
        if ($cuti->jumlah_hari !== $jumlahHari) {
            switch ($jenisCuti->kategori) {
                case 'Umum':
                    // Kembalikan hari cuti lama
                    $jatahCuti->sisa_cuti_umum += $cuti->jumlah_hari;
                    
                    // Periksa apakah cuti baru melebihi sisa cuti
                    if ($jumlahHari > $jatahCuti->sisa_cuti_umum) {
                        throw new \Exception('Jatah cuti umum tidak mencukupi');
                    }
                    
                    // Kurangi sisa cuti dengan jumlah hari baru
                    $jatahCuti->sisa_cuti_umum -= $jumlahHari;
                    $jatahCuti->save();
                    break;
            }
        }

        // Update cuti
        $cuti->update([
            'id_jenis_cuti' => $request->id_jenis_cuti,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jumlah_hari' => $jumlahHari,
            'alasan' => $request->alasan,
            'status' => 'menunggu', // Kembalikan status ke menunggu
        ]);

        DB::commit();

        return response()->json([
            'message' => 'Pengajuan cuti berhasil diperbarui',
            'data' => $cuti
        ], 200);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error in CutiController@update: ' . $e->getMessage());
        return response()->json([
            'message' => 'Terjadi kesalahan pada server',
            'error' => config('app.debug') ? $e->getMessage() : null
        ], 500);
    }
}

public function destroy($id)
{
    Log::info("Attempting to delete cuti with ID: $id");

    try {
        $cuti = Cuti::findOrFail($id);
        Log::info("Cuti found: ", [$cuti]);

        // Hapus cuti
        Log::info("Deleting cuti...");
        $cuti->delete();
        Log::info("Cuti deleted successfully");

        return response()->json([
            'message' => 'Cuti berhasil dihapus'
        ], 200);

    } catch (ModelNotFoundException $e) {
        Log::error('Cuti not found: ' . $e->getMessage());
        return response()->json([
            'message' => 'Cuti tidak ditemukan',
            'error' => $e->getMessage()
        ], 404);

    } catch (\Exception $e) {
        Log::error('Error in CutiController@destroy: ' . $e->getMessage());
        return response()->json([
            'message' => 'Terjadi kesalahan pada server',
            'error' => config('app.debug') ? $e->getMessage() : null
        ], 500);
    }
}
// private function handleCutiUmum($idPegawai, $jumlahHari)
// {
//     $jatahCuti = JatahCuti::firstOrCreate(
//         [
//             'id_pegawai' => $idPegawai,
//             'tahun' => date('Y')
//         ],
//         ['sisa_cuti' => 12]
//     );

//     if ($jumlahHari > $jatahCuti->sisa_cuti) {
//         throw new \Exception('Jatah cuti umum Anda tidak mencukupi. Sisa cuti: ' . $jatahCuti->sisa_cuti);
//     }

//     $jatahCuti->sisa_cuti -= $jumlahHari;
//     $jatahCuti->save();

//     return $jatahCuti;
// }

// private function handleCutiMelahirkan($idPegawai, $jumlahHari)
// {
//     if ($jumlahHari > 90) {
//         throw new \Exception('Cuti melahirkan maksimal 90 hari');
//     }

//     $cutiMelahirkan = Cuti::where('id_pegawai', $idPegawai)
//         ->whereHas('jenisCuti', function ($query) {
//             $query->where('nama_jenis_cuti', 'Cuti Melahirkan');
//         })
//         ->whereYear('tanggal_mulai', date('Y'))
//         ->where('status', 'disetujui')
//         ->first();

//     if ($cutiMelahirkan) {
//         throw new \Exception('Anda sudah mengambil cuti melahirkan tahun ini');
//     }
// }
}