<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Wawancara;
use App\Models\LamaranPekerjaan;
use Illuminate\Support\Facades\DB;

class WawancaraController extends Controller
{
    public function store(Request $request)
    {
        $dataTervalidasi = $request->validate([
            'id_lamaran_pekerjaan' => 'required|exists:tb_lamaran_pekerjaan,id_lamaran_pekerjaan',
            'id_pelamar' => 'required|exists:tb_user_pelamar,id_pelamar',
            'tanggal_wawancara' => 'required|date',
            'lokasi' => 'required|string',
            'catatan' => 'nullable|string',
            'hasil' => 'nullable|in:lulus,gagal,tertunda'
        ]);

        $wawancara = Wawancara::create($dataTervalidasi);
        
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Jadwal wawancara berhasil dibuat',
            'data' => $wawancara // Pastikan ini mengembalikan data wawancara yang baru dibuat
        ], 201);
    }

    public function index()
    {
        $wawancara = Wawancara::with([
            'lamaranPekerjaan' => function($query) {
                $query->with('lowonganPekerjaan');
            }, 
        ])->get();
        
        // Transform data untuk memastikan judul pekerjaan tersedia
        $transformedWawancara = $wawancara->map(function($item) {
            return [
                'id_wawancara' => $item->id_wawancara,
                'id_lamaran_pekerjaan' => $item->id_lamaran_pekerjaan,
                'tanggal_wawancara' => $item->tanggal_wawancara,
                'lokasi' => $item->lokasi,
                'catatan' => $item->catatan,
                'hasil' => $item->hasil,
                'tanggal_dibuat' => $item->tanggal_dibuat,
                'tanggal_diperbarui' => $item->tanggal_diperbarui,
                'id_pelamar' => $item->id_pelamar,
                'judul_pekerjaan' => $item->lamaranPekerjaan->lowonganPekerjaan->judul_pekerjaan ?? 'Tidak Diketahui',
                'lamaran_pekerjaan' => $item->lamaranPekerjaan,
                'pelamar' => $item->pelamar
            ];
        });
        
        return response()->json([
            'status' => 'sukses',
            'data' => $transformedWawancara
        ]);
    }

    // public function show($id)
    // {
    //     try {
    //         $wawancara = Wawancara::with([
    //             'pelamar', 
    //             'lamaranPekerjaan.lowonganPekerjaan'
    //         ])->findOrFail($id);
    
    //         return response()->json([
    //             'status' => 'sukses',
    //             'data' => [
    //                 'pelamar' => $wawancara->pelamar,
    //                 'lowongan_pekerjaan' => $wawancara->lamaranPekerjaan->lowonganPekerjaan,
    //                 'wawancara' => $wawancara
    //             ]
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Data wawancara tidak ditemukan: ' . $e->getMessage()
    //         ], 404);
    //     }
    // }
    public function show($id)
{
    try {
        $wawancara = Wawancara::with(['pelamar', 'lamaranPekerjaan.lowonganPekerjaan'])
            ->findOrFail($id);
    
        return response()->json([
            'status' => 'success',
            'data' => $wawancara
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Data wawancara tidak ditemukan'
        ], 404);
    }
}

    public function update(Request $request, $id)
    {
        $wawancara = Wawancara::findOrFail($id);
        
        $dataTervalidasi = $request->validate([
            'tanggal_wawancara' => 'date',
            'lokasi' => 'string',
            'catatan' => 'nullable|string',
            'hasil' => 'in:lulus,gagal,tertunda'
        ]);

        $wawancara->update($dataTervalidasi);
        
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Data wawancara berhasil diperbarui',
            'data' => $wawancara
        ]);
    }

    public function destroy($id)
    {
        $wawancara = Wawancara::findOrFail($id);
        $wawancara->delete();
        
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Data wawancara berhasil dihapus'
        ]);
    }

    public function updateStatus(Request $request, $id)
{
    try {
        $wawancara = Wawancara::findOrFail($id);
        
        $validatedData = $request->validate([
            'hasil' => 'required|in:lulus,gagal,tertunda',
            'catatan' => 'nullable|string'
        ]);

        $wawancara->update([
            'hasil' => $validatedData['hasil'],
            'catatan' => $validatedData['catatan'] ?? $wawancara->catatan
        ]);
        
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Status wawancara berhasil diperbarui',
            'data' => $wawancara
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'pesan' => 'Gagal memperbarui status wawancara: ' . $e->getMessage()
        ], 500);
    }
}
public function prepareJadwal($lamaranId)
{
    try {
        // Gunakan Eloquent dengan relasi yang sudah didefinisikan
        $lamaran = LamaranPekerjaan::with([
            'pelamar' => function($query) {
                $query->select('id_pelamar', 'nama', 'email');
            },
            'lowonganPekerjaan' => function($query) {
                $query->select('id_lowongan_pekerjaan', 'judul_pekerjaan');
            }
        ])->where('id_lamaran_pekerjaan', $lamaranId)
          ->first();

        if (!$lamaran) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lamaran tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'lamaran' => [
                    'id' => $lamaran->id_lamaran_pekerjaan
                ],
                'pelamar' => [
                    'id' => $lamaran->pelamar->id_pelamar,
                    'nama' => $lamaran->pelamar->nama,
                    'email' => $lamaran->pelamar->email
                ],
                'lowongan' => [
                    'id' => $lamaran->lowonganPekerjaan->id_lowongan_pekerjaan,
                    'judul_pekerjaan' => $lamaran->lowonganPekerjaan->judul_pekerjaan
                ]
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Gagal memuat data: ' . $e->getMessage()
        ], 500);
    }
}

public function jadwalkan(Request $request)
{
    $validated = $request->validate([
        'id_lamaran_pekerjaan' => 'required|exists:tb_lamaran_pekerjaan,id_lamaran_pekerjaan',
        'tanggal_wawancara' => 'required|date',
        'lokasi' => 'required|string',
        'catatan' => 'nullable|string'
    ]);

    try {
        DB::beginTransaction();

        // Ambil id_pelamar dari lamaran
        $lamaran = LamaranPekerjaan::findOrFail($validated['id_lamaran_pekerjaan']);

        // Buat wawancara menggunakan model
        $wawancara = Wawancara::create([
            'id_lamaran_pekerjaan' => $validated['id_lamaran_pekerjaan'],
            'id_pelamar' => $lamaran->id_pelamar,
            'tanggal_wawancara' => $validated['tanggal_wawancara'],
            'lokasi' => $validated['lokasi'],
            'catatan' => $validated['catatan'] ?? null,
            'hasil' => null, // Default hasil masih kosong
        ]);

        // Update status lamaran
        $lamaran->update([
            'status' => 'wawancara'
        ]);

        DB::commit();

        return response()->json([
            'status' => 'success',
            'message' => 'Wawancara berhasil dijadwalkan',
            'data' => [
                'id' => $wawancara->id_wawancara
            ]
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'status' => 'error',
            'message' => 'Gagal menjadwalkan wawancara: ' . $e->getMessage()
        ], 500);
    }
}
}

