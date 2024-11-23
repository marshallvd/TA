<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\PenilaianKinerja;
use App\Models\PenilaianKPI;
use App\Models\PenilaianKompetensi;
use App\Models\PenilaianCoreValues;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenilaianKinerjaController extends Controller
{
    // public function index(Request $request)
    // {
    //     $query = PenilaianKinerja::with(['pegawai', 'penilaianKPI', 'penilaianKompetensi', 'penilaianCoreValues']);
    
    //     if ($request->has('periode')) {
    //         $query->where('periode_penilaian', 'like', $request->periode . '%');
    //     }
    
    //     $penilaianKinerja = $query->get();
    
    //     // Ambil semua pegawai
    //     $allPegawai = Pegawai::all();
    
    //     // Siapkan array untuk hasil akhir
    //     $result = [];
    
    //     // Loop through semua pegawai
    //     foreach ($allPegawai as $pegawai) {
    //         // Cek apakah pegawai sudah memiliki penilaian
    //         $penilaian = $penilaianKinerja->first(function ($item) use ($pegawai) {
    //             return $item->id_pegawai === $pegawai->id_pegawai;
    //         });
    
    //         if ($penilaian) {
    //             // Jika sudah ada penilaian, masukkan data penilaian
    //             $result[] = $penilaian;
    //         } else {
    //             // Jika belum ada penilaian, masukkan data pegawai saja
    //             $result[] = [
    //                 'id_pegawai' => $pegawai->id_pegawai,
    //                 'pegawai' => $pegawai,
    //                 'periode_penilaian' => $request->periode ?? date('Y-m'),
    //                 'nilai_akhir' => null,
    //                 'predikat' => null,
    //                 'penilaianKPI' => null,
    //                 'penilaianKompetensi' => null,
    //                 'penilaianCoreValues' => null
    //             ];
    //         }
    //     }
    
    //     return response()->json(['data' => $result], 200);
    // }


    public function index(Request $request)
{
    // Ambil semua pegawai
    $allPegawai = Pegawai::all();
    
    // Ambil penilaian kinerja yang sesuai dengan periode jika ada
    $penilaianKinerja = PenilaianKinerja::with(['pegawai', 'penilaianKPI', 'penilaianKompetensi', 'penilaianCoreValues'])
        ->when($request->has('periode'), function ($query) use ($request) {
            return $query->where('periode_penilaian', 'like', $request->periode . '%');
        })
        ->get()
        ->keyBy('id_pegawai'); // Menggunakan keyBy untuk memudahkan pencarian

    // Siapkan array untuk hasil akhir
    $result = [];

    // Loop through semua pegawai
    foreach ($allPegawai as $pegawai) {
        // Cek apakah pegawai sudah memiliki penilaian
        $penilaian = $penilaianKinerja->get($pegawai->id_pegawai);

        if ($penilaian) {
            // Jika sudah ada penilaian, masukkan data penilaian
            $result[] = $penilaian;
        } else {
            // Jika belum ada penilaian, masukkan data pegawai saja
            $result[] = [
                'id_pegawai' => $pegawai->id_pegawai,
                'pegawai' => $pegawai,
                'periode_penilaian' => $request->periode ?? date('Y-m'),
                'nilai_akhir' => null,
                'predikat' => null,
                'penilaianKPI' => null,
                'penilaianKompetensi' => null,
                'penilaianCoreValues' => null
            ];
        }
    }

    return response()->json(['data' => $result], 200);
}
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pegawai' => 'required|exists:tb_pegawai,id_pegawai',
            'periode_penilaian' => 'required|string',
            'id_penilaian_kpi' => 'required|exists:tb_penilaian_kpi,id_penilaian_kpi',
            'id_penilaian_kompetensi' => 'required|exists:tb_penilaian_kompetensi,id_penilaian_kompetensi',
            'id_penilaian_core_values' => 'required|exists:tb_penilaian_core_values,id_penilaian_core_values',
            'catatan' => 'nullable|string', // Tambahkan validasi untuk catatan
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        DB::beginTransaction();

        try {
            $penilaianKPI = PenilaianKPI::findOrFail($request->id_penilaian_kpi);
            $penilaianKompetensi = PenilaianKompetensi::findOrFail($request->id_penilaian_kompetensi);
            $penilaianCoreValues = PenilaianCoreValues::findOrFail($request->id_penilaian_core_values);

            $nilaiAkhir = ($penilaianKPI->nilai_rata_rata * 0.8) +
                          ($penilaianKompetensi->nilai_rata_rata * 0.1) +
                          ($penilaianCoreValues->nilai_rata_rata * 0.1);

            $predikat = $this->hitungPredikat($nilaiAkhir);

            $penilaianKinerja = PenilaianKinerja::create([
                'id_pegawai' => $request->id_pegawai,
                'periode_penilaian' => $request->periode_penilaian,
                'id_penilaian_kpi' => $request->id_penilaian_kpi,
                'id_penilaian_kompetensi' => $request->id_penilaian_kompetensi,
                'id_penilaian_core_values' => $request->id_penilaian_core_values,
                'nilai_akhir' => $nilaiAkhir,
                'predikat' => $predikat,
                'catatan' => $request->catatan // Tambahkan catatan ke dalam create
            ]);

            DB::commit();

            return response()->json([
                'data' => $penilaianKinerja->load(['pegawai', 'penilaianKPI', 'penilaianKompetensi', 'penilaianCoreValues']),
                'message' => 'Penilaian kinerja berhasil ditambahkan'
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
{
    $penilaianKinerja = PenilaianKinerja::with(['pegawai', 'penilaianKPI', 'penilaianKompetensi', 'penilaianCoreValues'])
        ->find($id); // Use find to fetch by primary key (id_penilaian_kinerja)

    if (!$penilaianKinerja) {
        return response()->json(['message' => 'Penilaian kinerja tidak ditemukan'], 404);
    }

    return response()->json(['data' => $penilaianKinerja], 200);
}
    // public function show($id)
    // {
    //     $penilaianKinerja = PenilaianKinerja::with(['pegawai', 'penilaianKPI', 'penilaianKompetensi', 'penilaianCoreValues'])->find($id);
    //     if (!$penilaianKinerja) {
    //         return response()->json(['message' => 'Penilaian kinerja tidak ditemukan'], 404);
    //     }
    //     return response()->json(['data' => $penilaianKinerja], 200);
    // }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_penilaian_kpi' => 'required|exists:tb_penilaian_kpi,id_penilaian_kpi',
            'id_penilaian_kompetensi' => 'required|exists:tb_penilaian_kompetensi,id_penilaian_kompetensi',
            'id_penilaian_core_values' => 'required|exists:tb_penilaian_core_values,id_penilaian_core_values',
            'catatan' => 'nullable|string', // Tambahkan validasi untuk catatan
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        DB::beginTransaction();

        try {
            $penilaianKinerja = PenilaianKinerja::findOrFail($id);
            $penilaianKPI = PenilaianKPI::findOrFail($request->id_penilaian_kpi);
            $penilaianKompetensi = PenilaianKompetensi::findOrFail($request->id_penilaian_kompetensi);
            $penilaianCoreValues = PenilaianCoreValues::findOrFail($request->id_penilaian_core_values);

            $nilaiAkhir = ($penilaianKPI->nilai_rata_rata * 0.8) +
                          ($penilaianKompetensi->nilai_rata_rata * 0.1) +
                          ($penilaianCoreValues->nilai_rata_rata * 0.1);

            $predikat = $this->hitungPredikat($nilaiAkhir);

            $penilaianKinerja->update([
                'id_penilaian_kpi' => $request->id_penilaian_kpi,
                'id_penilaian_kompetensi' => $request->id_penilaian_kompetensi,
                'id_penilaian_core_values' => $request->id_penilaian_core_values,
                'nilai_akhir' => $nilaiAkhir,
                'predikat' => $predikat,
                'catatan' => $request->catatan // Tambahkan catatan ke dalam update
            ]);

            DB::commit();

            return response()->json([
                'data' => $penilaianKinerja->load(['pegawai', 'penilaianKPI', 'penilaianKompetensi', 'penilaianCoreValues']),
                'message' => 'Penilaian kinerja berhasil diperbarui'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $penilaianKinerja = PenilaianKinerja::findOrFail($id);
            $penilaianKinerja->delete();

            DB::commit();

            return response()->json(['message' => 'Penilaian kinerja berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()], 500);
        }
    }

    private function hitungPredikat($nilaiAkhir)
    {
        if ($nilaiAkhir >= 4.51) {
            return 'Sangat Baik';
        } elseif ($nilaiAkhir >= 4.01) {
            return 'Baik';
        } elseif ($nilaiAkhir >= 3.51) {
            return 'Cukup';
        } elseif ($nilaiAkhir >= 3.00) {
            return 'Kurang';
        } else {
            return 'Sangat Kurang';
        }
    }

    public function getPenilaianByPegawaiAndPeriod($id, $tahun, $bulan)
    {
        // Validate year and month
        if (!preg_match('/^\d{4}$/', $tahun) || !preg_match('/^(0[1-9]|1[0-2])$/', $bulan)) {
            return response()->json(['message' => 'Tahun atau bulan tidak valid'], 400);
        }
    
        // Format the period for querying
        $periode = $tahun . '-' . $bulan;
    
        // Fetch performance evaluation for the specified employee and period
        $penilaianKinerja = PenilaianKinerja::with(['pegawai', 'penilaianKPI', 'penilaianKompetensi', 'penilaianCoreValues'])
            ->where('id_pegawai', $id)
            ->where('periode_penilaian', 'like', $periode . '%')
            ->first(); // Get the first matching record
    
        if (!$penilaianKinerja) {
            return response()->json(['message' => 'Penilaian kinerja tidak ditemukan'], 404);
        }
    
        return response()->json(['data' => $penilaianKinerja], 200);
    }

    public function getPenilaianKinerja(Request $request)
    {
        $query = PenilaianKinerja::with(['pegawai', 'penilaianKPI', 'penilaianKompetensi', 'penilaianCoreValues']);
    
        // Filter berdasarkan ID Pegawai jika disediakan
        if ($request->has('id_pegawai')) {
            $query->where('id_pegawai', $request->id_pegawai);
        }
    
        // Filter berdasarkan periode jika disediakan
        if ($request->has('periode')) {
            $query->where('periode_penilaian', 'like', $request->periode . '%');
        }
    
        $result = $query->get();
    
        if ($result->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Penilaian kinerja tidak ditemukan'], 404);
        }
    
        return response()->json(['status' => 'success', 'data' => $result]);
    }

}