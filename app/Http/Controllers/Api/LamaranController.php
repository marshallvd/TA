<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\LamaranPekerjaan;
use App\Models\LowonganPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LamaranController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:pelamar'); // Middleware untuk melindungi route
    }

    // Mendapatkan semua lamaran dari pelamar yang sedang login
    public function index()
    {
        try {
            // Dapatkan user yang sedang login
            // Debug log
            \Log::info('Auth Check:', [
                'is_authenticated' => Auth::guard('pelamar')->check(),
                'user' => Auth::guard('pelamar')->user(),
                'token' => request()->header('Authorization')
            ]);

            // Dapatkan user yang sedang login
            $pelamar = Auth::guard('pelamar')->user();
            
            if (!$pelamar) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User tidak terautentikasi'
                ], 401);
            }

            // Ambil semua lamaran dari pelamar
            $lamaran = LamaranPekerjaan::with(['lowonganPekerjaan' => function($query) {
                    $query->select('id_lowongan_pekerjaan', 'judul_pekerjaan', 'lokasi_pekerjaan');
                }])
                ->where('id_pelamar', $pelamar->id_pelamar)
                ->orderBy('tanggal_dibuat', 'desc')
                ->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Data lamaran berhasil diambil',
                'data' => $lamaran
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Lamaran Index Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data lamaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Mendapatkan detail satu lamaran
    public function show($id)
    {
        try {

            $lamaran = LamaranPekerjaan::with(['lowonganPekerjaan'])
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

    // Membatalkan lamaran
    public function cancel($id)
    {
        try {
            $pelamar = Auth::guard('pelamar')->user();
            $lamaran = LamaranPekerjaan::where('id_pelamar', $pelamar->id_pelamar)
                ->where('id_lamaran_pekerjaan', $id)
                ->first();

            if (!$lamaran) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lamaran tidak ditemukan'
                ], 404);
            }

            // Cek apakah lamaran masih bisa dibatalkan
            $allowedStatus = ['menunggu', 'dikirim'];
            if (!in_array($lamaran->status_lamaran, $allowedStatus)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lamaran tidak dapat dibatalkan karena status sudah ' . $lamaran->status_lamaran
                ], 422);
            }

            $lamaran->update([
                'status_lamaran' => 'dibatalkan',
                'tanggal_diperbarui' => Carbon::now()
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Lamaran berhasil dibatalkan',
                'data' => $lamaran
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membatalkan lamaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Mengedit lamaran
    public function update(Request $request, $id)
    {
        try {
            $pelamar = Auth::guard('pelamar')->user();
            $lamaran = LamaranPekerjaan::where('id_pelamar', $pelamar->id_pelamar)
                ->where('id_lamaran_pekerjaan', $id)
                ->first();

            if (!$lamaran) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lamaran tidak ditemukan'
                ], 404);
            }

            // Cek apakah lamaran masih bisa diedit
            $allowedStatus = ['menunggu', 'dikirim'];
            if (!in_array($lamaran->status_lamaran, $allowedStatus)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lamaran tidak dapat diedit karena status sudah ' . $lamaran->status_lamaran
                ], 422);
            }

            // Update data dari profil terbaru pelamar
            $lamaran->update([
                'nama_pelamar' => $pelamar->nama,
                'email_pelamar' => $pelamar->email,
                'telepon_pelamar' => $pelamar->no_hp,
                'alamat_pelamar' => $pelamar->alamat,
                'pendidikan_terakhir' => $pelamar->pendidikan_terakhir,
                'pengalaman_kerja' => $pelamar->pengalaman_kerja,
                'tanggal_diperbarui' => Carbon::now()
            ]);

            return response()->json([
                'status' => 'success',
                'message' => ' Lamaran berhasil diperbarui',
                'data' => $lamaran
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui lamaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Menghapus lamaran
    public function destroy($id)
    {
        try {
            $pelamar = Auth::guard('pelamar')->user();
            $lamaran = LamaranPekerjaan::where('id_pelamar', $pelamar->id_pelamar)
                ->where('id_lamaran_pekerjaan', $id)
                ->first();

            if (!$lamaran) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lamaran tidak ditemukan'
                ], 404);
            }

            // Cek apakah lamaran masih bisa dihapus
            $allowedStatus = ['menunggu', 'dikirim', 'dibatalkan'];
            if (!in_array($lamaran->status_lamaran, $allowedStatus)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lamaran tidak dapat dihapus karena status sudah ' . $lamaran->status_lamaran
                ], 422);
            }

            $lamaran->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Lamaran berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus lamaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_lowongan_pekerjaan' => 'required|exists:tb_lowongan_pekerjaan,id_lowongan_pekerjaan',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $pelamar = Auth::guard('pelamar')->user();

            $existingApplication = LamaranPekerjaan::where('id_pelamar', $pelamar->id_pelamar)
                ->where('id_lowongan_pekerjaan', $request->id_lowongan_pekerjaan)
                ->first();

            if ($existingApplication) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda sudah pernah melamar untuk lowongan ini'
                ], 422);
            }

            if (!$this->isProfileComplete($pelamar)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Profil belum lengkap. Harap lengkapi profil Anda terlebih dahulu.',
                    'missing_fields' => $this->getMissingFields($pelamar)
                ], 422);
            }

            $lowongan = LowonganPekerjaan::find($request->id_lowongan_pekerjaan);
            if (!$lowongan || $lowongan->status !== 'aktif') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lowongan tidak tersedia atau sudah ditutup'
                ], 422);
            }

            $lamaran = LamaranPekerjaan::create([
                'id_lowongan_pekerjaan' => $request->id_lowongan_pekerjaan,
                'id_pelamar' => $pelamar->id_pelamar,
                'nama_pelamar' => $pelamar->nama,
                'email_pelamar' => $pelamar->email,
                'telepon_pelamar' => $pelamar->no_hp,
                'alamat_pelamar' => $pelamar->alamat,
                'pendidikan_terakhir' => $pelamar->pendidikan_terakhir,
                'pengalaman_kerja' => $pelamar->pengalaman_kerja,
                'status_lamaran' => 'menunggu',
                'status_seleksi' => 'dikirim',
                'tanggal_dibuat' => Carbon::now(),
                'tanggal_diperbarui' => Carbon::now()
            ]);

            $lamaran->load(['lowonganPekerjaan', 'pelamar']);

            return response()->json([
                'status' => 'success',
                'message' => 'Lamaran berhasil dikirim',
                'data' => $lamaran
            ],  201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengirim lamaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function isProfileComplete($pelamar)
    {
        $requiredFields = [
            'nama',
            'email', 
            'no_hp',
            'alamat',
            'pendidikan_terakhir',
            'pengalaman_kerja'
            // cv_path dihapus dari required fields
        ];

        foreach ($requiredFields as $field) {
            if (empty($pelamar->$field)) {
                return false;
            }
        }

        return true;
    }

    private function getMissingFields($pelamar)
    {
        $missingFields = [];
        $requiredFields = [
            'nama' => 'Nama Lengkap',
            'email' => 'Email',
            'no_hp' => 'Nomor Telepon',
            'alamat' => 'Alamat',
            'pendidikan_terakhir' => 'Pendidikan Terakhir',
            'pengalaman_kerja' => 'Pengalaman Kerja'
            // cv_path dihapus dari required fields
        ];

        foreach ($requiredFields as $field => $label) {
            if (empty($pelamar->$field)) {
                $missingFields[] = $label;
            }
        }

        return $missingFields;
    }
}