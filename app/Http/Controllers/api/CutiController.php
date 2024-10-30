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
                'id_jenis_cuti' => 'required|exists:tb_jenis_cuti,id_jenis_cuti',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'alasan' => 'required|string',
            ]);

            $jenisCuti = JenisCuti::findOrFail($request->id_jenis_cuti);
            $jumlahHari = date_diff(date_create($request->tanggal_mulai), date_create($request->tanggal_selesai))->days + 1;

            if ($jenisCuti->kategori === 'Umum') {
                $jatahCuti = JatahCuti::where('id_pegawai', Auth::id())
                    ->where('tahun', date('Y'))
                    ->firstOrFail();

                if ($jumlahHari > $jatahCuti->sisa_cuti) {
                    throw new \Exception('Jatah cuti umum tidak mencukupi');
                }
            } elseif ($jenisCuti->kategori === 'Khusus' && $jenisCuti->nama_jenis_cuti === 'Cuti Melahirkan') {
                if ($jumlahHari > 90) {
                    throw new \Exception('Cuti melahirkan maksimal 90 hari');
                }
            }

            $cuti = Cuti::create([
                'id_pegawai' => Auth::id(),
                'id_jenis_cuti' => $request->id_jenis_cuti,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'jumlah_hari' => $jumlahHari,
                'alasan' => $request->alasan,
                'status' => 'menunggu',
            ]);

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

    public function index()
    {
        try {
            $cuti = Cuti::with('jenisCuti')
                ->where('id_pegawai', Auth::id())
                ->orderBy('tanggal_dibuat', 'desc')
                ->get();

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
            $cuti = Cuti::with('jenisCuti')
                ->where('id_pegawai', Auth::id())
                ->findOrFail($id);

            return response()->json([
                'message' => 'Detail cuti berhasil diambil',
                'data' => $cuti
            ]);

        } catch (\Exception $e) {
            Log::error('Error in CutiController@show: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan pada server',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    private function handleCutiUmum($idPegawai, $jumlahHari)
    {
        $jatahCuti = JatahCuti::firstOrCreate(
            [
                'id_pegawai' => $idPegawai,
                'tahun' => date('Y')
            ],
            ['sisa_cuti' => 12]
        );

        if ($jumlahHari > $jatahCuti->sisa_cuti) {
            throw new \Exception('Jatah cuti umum Anda tidak mencukupi. Sisa cuti: ' . $jatahCuti->sisa_cuti);
        }

        $jatahCuti->sisa_cuti -= $jumlahHari;
        $jatahCuti->save();

        return $jatahCuti;
    }

    private function handleCutiMelahirkan($idPegawai, $jumlahHari)
    {
        if ($jumlahHari > 90) {
            throw new \Exception('Cuti melahirkan maksimal 90 hari');
        }

        $cutiMelahirkan = Cuti::where('id_pegawai', $idPegawai)
            ->whereHas('jenisCuti', function ($query) {
                $query->where('nama_jenis_cuti', 'Cuti Melahirkan');
            })
            ->whereYear('tanggal_mulai', date('Y'))
            ->where('status', 'disetujui')
            ->first();

        if ($cutiMelahirkan) {
            throw new \Exception('Anda sudah mengambil cuti melahirkan tahun ini');
        }
    }

    public function diterima(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $cuti = Cuti::with('jenisCuti')->findOrFail($id);
            
            if ($cuti->status === 'disetujui') {
                throw new \Exception('Cuti sudah disetujui sebelumnya');
            }

            if ($cuti->jenisCuti->kategori === 'Umum') {
                $jatahCuti = JatahCuti::where('id_pegawai', $cuti->id_pegawai)
                    ->where('tahun', date('Y'))
                    ->firstOrFail();
                
                if ($cuti->jumlah_hari > $jatahCuti->sisa_cuti) {
                    throw new \Exception('Jatah cuti umum tidak mencukupi');
                }
                
                $jatahCuti->sisa_cuti -= $cuti->jumlah_hari;
                $jatahCuti->save();
            } elseif ($cuti->jenisCuti->kategori === 'Khusus' && $cuti->jenisCuti->nama_jenis_cuti === 'Cuti Melahirkan') {
                if ($cuti->jumlah_hari > 90) {
                    throw new \Exception('Cuti melahirkan maksimal 90 hari');
                }
            }

            $cuti->update([
                'status' => 'disetujui',
                'keterangan' => null
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Cuti berhasil disetujui',
                'data' => $cuti
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in CutiController@diterima: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan pada server',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
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
            
            // Jika cuti sebelumnya disetujui, kembalikan jatah cuti
            if ($cuti->status === 'disetujui' && $cuti->jenisCuti->kategori === 'Umum') {
                $jatahCuti = JatahCuti::where('id_pegawai', $cuti->id_pegawai)
                    ->where('tahun', date('Y'))
                    ->firstOrFail();
                
                $jatahCuti->sisa_cuti += $cuti->jumlah_hari;
                $jatahCuti->save();
            }
    
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
            Log::error('Error in CutiController@ditolak: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan pada server',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}