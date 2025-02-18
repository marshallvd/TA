<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\LowonganPekerjaan;
use Illuminate\Validation\Rule;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongan = LowonganPekerjaan::with(['jabatan', 'divisi'])
            ->orderBy('tanggal_dibuat', 'desc')
            ->get();
            
        return response()->json([
            'status' => 'success',
            'data' => $lowongan
        ])->header('Access-Control-Allow-Origin', '*')
          ->header('Access-Control-Allow-Methods', 'GET');
    }

    public function store(Request $request)
    {
        $dataTervalidasi = $request->validate([
            'judul_pekerjaan' => 'required|string|max:255',
            'id_jabatan' => 'required|exists:tb_jabatan,id_jabatan',
            'id_divisi' => 'required|exists:tb_divisi,id_divisi',
            'lokasi_pekerjaan' => 'required|string|max:255',
            'jumlah_lowongan' => 'required|integer|min:1',
            'pengalaman_minimal' => 'required|integer|min:0',
            'usia_minimal' => 'required|integer|min:17',
            'usia_maksimal' => 'required|integer|gt:usia_minimal',
            'gaji_minimal' => 'required|numeric|min:0',
            'gaji_maksimal' => 'required|numeric|gt:gaji_minimal',
            'jenis_pekerjaan' => ['required', Rule::in(['full time', 'part time'])],
            'status' => ['required', Rule::in(['aktif', 'tutup'])],
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'deskripsi' => 'required|string',
            'persyaratan' => 'required|string'
        ]);

        try {
            $lowongan = LowonganPekerjaan::create($dataTervalidasi);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Lowongan pekerjaan berhasil dibuat',
                'data' => $lowongan
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat lowongan pekerjaan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        \Log::info("Fetching lowongan with ID: " . $id); // Tambahkan log ini
        try {
            $lowongan = LowonganPekerjaan::with(['jabatan', 'divisi'])->findOrFail($id);
            
            return response()->json([
                'status' => 'success',
                'data' => $lowongan
            ]);
        } catch (\Exception $e) {
            \Log::error("Error fetching lowongan: " . $e->getMessage()); // Tambahkan log ini
            return response()->json([
                'status' => 'error',
                'message' => 'Lowongan pekerjaan tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $lowongan = LowonganPekerjaan::findOrFail($id);
            
            $dataTervalidasi = $request->validate([
                'judul_pekerjaan' => 'sometimes|string|max:255',
                'id_jabatan' => 'sometimes|exists:tb_jabatan,id_jabatan',
                'id_divisi' => 'sometimes|exists:tb_divisi,id_divisi',
                'lokasi_pekerjaan' => 'sometimes|string|max:255',
                'jumlah_lowongan' => 'sometimes|integer|min:1',
                'pengalaman_minimal' => 'sometimes|integer|min:0',
                'usia_minimal' => 'sometimes|integer|min:17',
                'usia_maksimal' => 'sometimes|integer|gt:usia_minimal',
                'gaji_minimal' => 'sometimes|numeric|min:0',
                'gaji_maksimal' => 'sometimes|numeric|gt:gaji_minimal',
                'jenis_pekerjaan' => ['sometimes', Rule::in(['full time', 'part time'])],
                'status' => ['sometimes', Rule::in(['aktif', 'tutup'])],
                'tanggal_mulai' => 'sometimes|date',
                'tanggal_selesai' => 'sometimes|date|after:tanggal_mulai',
                'deskripsi' => 'sometimes|string',
                'persyaratan' => 'sometimes|string'
            ]);

            $lowongan->update($dataTervalidasi);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Lowongan pekerjaan berhasil diperbarui',
                'data' => $lowongan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui lowongan pekerjaan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $lowongan = LowonganPekerjaan::findOrFail($id);
            $lowongan->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Lowongan pekerjaan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus lowongan pekerjaan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $lowongan = LowonganPekerjaan::with(['jabatan', 'divisi'])->findOrFail($id);
            
            return response()->json([
                'status' => 'success',
                'data' => $lowongan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lowongan pekerjaan tidak ditemukan'
            ], 404);
        }
    }
}