<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JatahCuti;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class JatahCutiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $tahun = $request->query('tahun', date('Y'));
            \Log::info("Fetching jatah cuti for year: " . $tahun);

            $jatahCuti = JatahCuti::with(['pegawai' => function($query) {
                $query->select('id_pegawai', 'nama_lengkap')
                    ->with('jabatan:id_jabatan,nama_jabatan');
            }])->where('tahun', $tahun)->get();

            // Hitung ulang sisa cuti untuk setiap record
            $jatahCuti->each(function($item) {
                $item->hitungSisaCuti();
            });

            if ($jatahCuti->isEmpty()) {
                return response()->json(['message' => 'Data tidak ditemukan untuk tahun tersebut'], 404);
            }

            // Map data untuk format respons
            $result = $jatahCuti->map(function ($item) {
                return [
                    'id_jatah_cuti' => $item->id_jatah_cuti,
                    'id_pegawai' => $item->id_pegawai,
                    'nama_lengkap' => $item->pegawai->nama_lengkap,
                    'nama_jabatan' => $item->pegawai->jabatan->nama_jabatan ?? '-',
                    'jatah_cuti_umum' => $item->jatah_cuti_umum,
                    'sisa_cuti_umum' => $item->sisa_cuti_umum,
                    'jatah_cuti_menikah' => $item->jatah_cuti_menikah,
                    'sisa_cuti_menikah' => $item->sisa_cuti_menikah,
                    'jatah_cuti_melahirkan' => $item->jatah_cuti_melahirkan,
                    'sisa_cuti_melahirkan' => $item->sisa_cuti_melahirkan,
                    'tahun' => $item->tahun
                ];
            });

            return response()->json($result);
        } catch (\Exception $e) {
            \Log::error('Error fetching jatah cuti: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan pada server'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'id_pegawai' => 'required|exists:tb_pegawai,id_pegawai',
                'tahun' => 'required|integer',
                'jatah_cuti_umum' => 'required|integer|min:0',
                'jatah_cuti_menikah' => 'required|integer|min:0',
                'jatah_cuti_melahirkan' => 'required|integer|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Cek apakah jatah cuti sudah ada
            $existingJatahCuti = JatahCuti::where('id_pegawai', $request->id_pegawai)
                ->where('tahun', $request->tahun)
                ->first();

            if ($existingJatahCuti) {
                return response()->json([
                    'message' => 'Jatah cuti untuk pegawai ini di tahun tersebut sudah ada'
                ], 422);
            }

            // Buat jatah cuti baru
            $jatahCuti = JatahCuti::create([
                'id_pegawai' => $request->id_pegawai,
                'tahun' => $request->tahun,
                'jatah_cuti_umum' => $request->jatah_cuti_umum,
                'sisa_cuti_umum' => $request->jatah_cuti_umum,
                'jatah_cuti_menikah' => $request->jatah_cuti_menikah,
                'sisa_cuti_menikah' => $request->jatah_cuti_menikah,
                'jatah_cuti_melahirkan' => $request->jatah_cuti_melahirkan,
                'sisa_cuti_melahirkan' => $request->jatah_cuti_melahirkan
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Jatah cuti berhasil ditambahkan',
                'data' => $jatahCuti
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error creating jatah cuti: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan pada server',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $jatahCuti = JatahCuti::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'jatah_cuti_umum' => 'required|integer|min:0',
                'jatah_cuti_menikah' => 'required|integer|min:0',
                'jatah_cuti_melahirkan' => 'required|integer|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Update jatah cuti
            $jatahCuti->update([
                'jatah_cuti_umum' => $request->jatah_cuti_umum,
                'jatah_cuti_menikah' => $request->jatah_cuti_menikah,
                'jatah_cuti_melahirkan' => $request->jatah_cuti_melahirkan
            ]);

            // Hitung ulang sisa cuti
            $jatahCuti->hitungSisaCuti();

            DB::commit();

            return response()->json([
                'message' => 'Jatah cuti berhasil diperbarui',
                'data' => $jatahCuti
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error updating jatah cuti: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan pada server',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $jatahCuti = JatahCuti::findOrFail($id);
            $jatahCuti->delete();

            return response()->json([
                'message' => 'Jatah cuti berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error deleting jatah cuti: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan pada server',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function checkJatahCuti($idPegawai)
    {
        try {
            $currentYear = date('Y');
            
            // Hanya cek keberadaan data tanpa membuat otomatis
            $jatahCuti = JatahCuti::where('id_pegawai', $idPegawai)
                ->where('tahun', $currentYear)
                ->first();

            return response()->json([
                'status' => 'success',
                'exists' => (bool)$jatahCuti,
                'data' => $jatahCuti
            ]);
        } catch (\Exception $e) {
            \Log::error('Error checking jatah cuti: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan pada server',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $jatahCuti = JatahCuti::with(['pegawai' => function($query) {
                $query->select('id_pegawai', 'nama_lengkap')
                    ->with('jabatan:id_jabatan,nama_jabatan');
            }])->findOrFail($id);

            // Hitung ulang sisa cuti
            $jatahCuti->hitungSisaCuti();

            return response()->json([
                'status' => 'success',
                'data' => $jatahCuti
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching jatah cuti detail: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan pada server',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}