<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LamaranPekerjaan;
use App\Models\UserPelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AdminLamaranController extends Controller
{


    // Mendapatkan semua lamaran untuk admin
    public function index(Request $request)
    {
        try {
            $query = LamaranPekerjaan::with(['lowonganPekerjaan', 'pelamar']);

            // Filter berdasarkan status jika ada
            if ($request->has('status_lamaran')) {
                $query->where('status_lamaran', $request->status_lamaran);
            }

            // Filter berdasarkan tanggal
            if ($request->has('from_date') && $request->has('to_date')) {
                $query->whereBetween('tanggal_dibuat', [
                    Carbon::parse($request->from_date),
                    Carbon::parse($request->to_date)
                ]);
            }

            // Sorting
            $sortBy = $request->get('sort_by', 'tanggal_dibuat');
            $sortDir = $request->get('sort_dir', 'desc');
            $query->orderBy($sortBy, $sortDir);

            // Pagination
            $perPage = $request->get('per_page', 10);
            $lamaran = $query->paginate($perPage);

            return response()->json([
                'status' => 'success',
                'message' => 'Data lamaran berhasil diambil',
                'data' => $lamaran
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data lamaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    // Mendapatkan detail lamaran untuk admin
    public function show($id)
    {
        try {
            $lamaran = LamaranPekerjaan::with([
                'pelamar', 
                'lowonganPekerjaan'
            ])->findOrFail($id);
    
            // Gabungkan data pelamar ke dalam lamaran
            $lamaran->setAttribute('nama', $lamaran->pelamar->nama ?? '-');
            $lamaran->setAttribute('email', $lamaran->pelamar->email ?? '-');
            $lamaran->setAttribute('no_hp', $lamaran->pelamar->no_hp ?? '-');
            $lamaran->setAttribute('alamat', $lamaran->pelamar->alamat ?? '-');
            $lamaran->setAttribute('pendidikan_terakhir', $lamaran->pelamar->pendidikan_terakhir ?? '-');
            $lamaran->setAttribute('pengalaman_kerja', $lamaran->pelamar->pengalaman_kerja ?? '-');
            $lamaran->setAttribute('cv_path', $lamaran->pelamar->cv_path ?? null);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Detail lamaran berhasil diambil',
                'data' => $lamaran
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching lamaran detail: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail lamaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Update status lamaran oleh admin
// Metode untuk update status lamaran
    public function updateStatus(Request $request, $id)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'status_lamaran' => 'required|in:diterima,ditolak,dalam_proses,menunggu',
                'catatan' => 'nullable|string|max:500'
            ]);

            // Jika validasi gagal
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Cari lamaran
            $lamaran = LamaranPekerjaan::findOrFail($id);

            // Update status lamaran
            $lamaran->update([
                'status_lamaran' => $request->input('status_lamaran'),
                'catatan_admin' => $request->input('catatan', null),
                'tanggal_diperbarui' => Carbon::now()
            ]);

            // Respon sukses
            return response()->json([
                'status' => 'success',
                'message' => 'Status lamaran berhasil diperbarui',
                'data' => $lamaran
            ]);

        } catch (\Exception $e) {
            // Tangani error
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui status lamaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    // public function showDetail($id)
    // {
    //     try {
    //         $lamaran = LamaranPekerjaan::with([
    //             'pelamar', 
    //             'lowonganPekerjaan'
    //         ])->findOrFail($id);
    
    //         Log::info('Lamaran fetched successfully', [
    //             'id' => $id,
    //             'pelamar' => $lamaran->pelamar->nama ?? 'No Pelamar'
    //         ]);
    
    //         return response()->json([
    //             'status' => 'success',
    //             'data' => $lamaran
    //         ]);
    //     } catch (\Exception $e) {
    //         Log::error('Error fetching lamaran', [
    //             'id' => $id,
    //             'message' => $e->getMessage()
    //         ]);

    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Data lamaran tidak ditemukan'
    //         ], 404);
    //     }
    // }
}