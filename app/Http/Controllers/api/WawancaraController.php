<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Wawancara;

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
        $wawancara = Wawancara::with(['lamaranPekerjaan', 'pelamar'])->get();
        
        return response()->json([
            'status' => 'sukses',
            'data' => $wawancara
        ]);
    }

    public function show($id)
    {
        $wawancara = Wawancara::with(['lamaranPekerjaan', 'pelamar'])
            ->findOrFail($id);
            
        return response()->json([
            'status' => 'sukses',
            'data' => $wawancara
        ]);
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
}