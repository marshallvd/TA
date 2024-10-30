<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LamaranPekerjaan;
use Illuminate\Http\Request;

class AdminLamaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('role:admin,hrd');
    }

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
                $query->whereBetween('tanggal_dibuat', [$request->from_date, $request->to_date]);
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
            $lamaran = LamaranPekerjaan::with(['lowonganPekerjaan', 'pelamar'])
                ->where('id_lamaran_pekerjaan', $id)
                ->first();

            if (!$lamaran) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lamaran tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Detail lamaran berhasil diambil',
                'data' => $lamaran
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail lamaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Update status lamaran oleh admin
    public function updateStatus(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status_lamaran' => 'required|in:diterima,ditolak,dalam_proses,menunggu',
                'catatan' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $lamaran = LamaranPekerjaan::find($id);

            if (!$lamaran) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lamaran tidak ditemukan'
                ], 404);
            }

            $lamaran->update([
                'status_lamaran' => $request->status_lamaran,
                'catatan_admin' => $request->catatan,
                'tanggal_diperbarui' => Carbon::now()
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Status lamaran berhasil diperbarui',
                'data' => $lamaran
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui status lamaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}