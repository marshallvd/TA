<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\UserPelamar;
use App\Exports\PelamarExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash; // Tambahkan ini

class PelamarController extends Controller
{
    public function index(Request $request)
    {
        $query = UserPelamar::query();

        // Filter berdasarkan status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Search berdasarkan nama atau email
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Sorting - Ubah created_at menjadi tanggal_dibuat
        $sortField = $request->get('sort', 'tanggal_dibuat'); // Ubah default sort field
        $sortOrder = $request->get('order', 'desc');
        
        // Pastikan field sorting ada di tabel
        $allowedSortFields = ['tanggal_dibuat', 'tanggal_diperbarui', 'nama', 'email']; // tambahkan field yang diizinkan
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'tanggal_dibuat'; // default ke tanggal_dibuat jika field tidak valid
        }
        
        $query->orderBy($sortField, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 10);
        
        return response()->json([
            'status' => 'success',
            'data' => $query->paginate($perPage)
        ]);
    }
    
    public function show($id)
    {
        Log::info("Fetching pelamar with ID: $id");
        $pelamar = UserPelamar::with([
            'lamaranPekerjaan', 
            'lamaranPekerjaan.lowonganPekerjaan', 
            'lamaranPekerjaan.wawancara'
        ])->findOrFail($id);
    
        return response()->json([
            'status' => 'success',
            'data' => $pelamar
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
            'keterangan' => 'nullable|string'
        ]);

        $pelamar = Pelamar::findOrFail($id);
        $pelamar->status = $request->status;
        $pelamar->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status pelamar berhasil diupdate',
            'data' => $pelamar
        ]);
    }

    public function statistics()
    {
        $totalPelamar = UserPelamar::count();
        $pelamarAktif = UserPelamar::where('status', 'active')->count();
        
        $pelamarPerPosisi = UserPelamar::join('lamaran', 'pelamar.id', '=', 'lamaran.pelamar_id')
            ->join('lowongan', 'lamaran.lowongan_id', '=', 'lowongan.id')
            ->selectRaw('lowongan.posisi, count(*) as total')
            ->groupBy('lowongan.posisi')
            ->get();

        $pelamarPerStatus = UserPelamar::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->get()
            ->pluck('total', 'status');

        return response()->json([
            'status' => 'success',
            'data' => [
                'total_pelamar' => $totalPelamar,
                'pelamar_aktif' => $pelamarAktif,
                'pelamar_per_posisi' => $pelamarPerPosisi,
                'pelamar_per_status' => $pelamarPerStatus
            ]
        ]);
    }

    public function export(Request $request)
    {
        $format = $request->get('format', 'excel');
        
        return Excel::download(new PelamarExport, 'pelamar.' . ($format == 'excel' ? 'xlsx' : 'csv'));
    }


    
    public function destroy($id)
    {
        try {
            // Konversi ID ke tipe integer jika diperlukan
            $id = intval($id);
    
            $pelamar = UserPelamar::findOrFail($id);
            
            // Cek apakah pelamar memiliki lamaran
            if ($pelamar->lamaran()->exists()) {
                return response()->json([
                    'message' => 'Tidak dapat menghapus pelamar yang memiliki lamaran aktif',
                    'status' => 'error'
                ], 400);
            }
            
            $pelamar->delete();
            
            return response()->json([
                'message' => 'Pelamar berhasil dihapus',
                'status' => 'success'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Gagal menghapus pelamar: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Gagal menghapus pelamar: ' . $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|unique:tb_user_pelamar,email|max:255',
                'password' => 'required|string|min:6',
                'no_hp' => 'nullable|string|max:20',
                'alamat' => 'nullable|string|max:255',
                'pendidikan_terakhir' => 'nullable|string|max:100',
                'pengalaman_kerja' => 'nullable|string',
                'cv_path' => 'nullable|string|url|max:255' // Ubah menjadi validasi URL
            ]);
    
            // Enkripsi password
            $validatedData['password'] = bcrypt($validatedData['password']);
    
            // Buat pelamar baru
            $pelamar = UserPelamar::create($validatedData);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Pelamar berhasil ditambahkan',
                'data' => $pelamar
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Gagal membuat pelamar: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat pelamar: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            Log::info('Data yang diterima untuk update:', $request->all());
    
            // Find the pelamar to update
            $pelamar = UserPelamar::findOrFail($id);
        
            // Validate input with flexible rules
            $validatedData = $request->validate([
                'nama' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:tb_user_pelamar,email,'.$id.',id_pelamar|max:255',
                'password' => 'nullable|string|min:6',
                'no_hp' => 'nullable|string|max:20',
                'alamat' => 'nullable|string|max:255',
                'pendidikan_terakhir' => 'nullable|in:SMA,D3,S1,S2,S3',
                'pengalaman_kerja' => 'nullable|string',
                'cv_path' => 'nullable|url|max:255'
            ]);
        
            Log::info('Data yang akan diupdate:', $validatedData);
    
            // Hash password only if it's provided
            if (isset($validatedData['password']) && !empty($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {
                unset($validatedData['password']); // Hapus password jika tidak ada
            }
        
            // Update pelamar
            $pelamar->update($validatedData);
        
            Log::info('Data pelamar setelah update:', $pelamar->toArray());
    
            return response()->json([
                'status' => 'success',
                'message' => 'Data pelamar berhasil diperbarui',
                'data' => $pelamar
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validasi gagal:', $e->errors());
    
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui pelamar: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui pelamar',
                'details' => $e->getMessage()
            ], 500);
        }
    }

}
