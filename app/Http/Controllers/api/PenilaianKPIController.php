<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\PenilaianKPI;
use App\Models\DetailPenilaianKPI;
use App\Models\KomponenKpi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class PenilaianKPIController extends Controller
{
    public function index()
    {
        $penilaianKPI = PenilaianKPI::with('detailPenilaianKPI.komponenKPI')->get();
        return response()->json($penilaianKPI);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'details' => 'required|array',
            'details.*.id_komponen_kpi' => 'required|exists:tb_komponen_kpi,id_komponen_kpi',
            'details.*.nilai' => 'required|numeric|min:0|max:100',
        ]);

        DB::beginTransaction();

        try {
            $penilaianKPI = new PenilaianKPI();
            $penilaianKPI->save();

            $totalNilai = 0;
            $totalBobot = 0;

            foreach ($validatedData['details'] as $detail) {
                $komponenKPI = KomponenKpi::findOrFail($detail['id_komponen_kpi']);
                
                DetailPenilaianKPI::create([
                    'id_penilaian_kpi' => $penilaianKPI->id_penilaian_kpi,
                    'id_komponen_kpi' => $detail['id_komponen_kpi'],
                    'nilai' => $detail['nilai'],
                ]);

                $totalNilai += $detail['nilai'] * $komponenKPI->bobot;
                $totalBobot += $komponenKPI->bobot;
            }

            $nilaiRataRata = $totalBobot > 0 ? $totalNilai / $totalBobot : 0;
            $penilaianKPI->nilai_rata_rata = $nilaiRataRata;
            $penilaianKPI->save();

            DB::commit();

            return response()->json($penilaianKPI->load('detailPenilaianKPI.komponenKPI'), 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.'], 500);
        }
    }

    public function show($id)
    {
        $penilaianKPI = PenilaianKPI::with('detailPenilaianKPI.komponenKPI')->findOrFail($id);
        return response()->json($penilaianKPI);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'details' => 'required|array',
            'details.*.id_detail_penilaian_kpi' => 'required|exists:tb_detail_penilaian_kpi,id_detail_penilaian_kpi',
            'details.*.nilai' => 'required|numeric|min:0|max:100',
        ]);

        DB::beginTransaction();

        try {
            $penilaianKPI = PenilaianKPI::findOrFail($id);

            $totalNilai = 0;
            $totalBobot = 0;

            foreach ($validatedData['details'] as $detail) {
                $detailPenilaian = DetailPenilaianKPI::findOrFail($detail['id_detail_penilaian_kpi']);
                $detailPenilaian->nilai = $detail['nilai'];
                $detailPenilaian->save();

                $komponenKPI = $detailPenilaian->komponenKPI;
                $totalNilai += $detail['nilai'] * $komponenKPI->bobot;
                $totalBobot += $komponenKPI->bobot;
            }

            $nilaiRataRata = $totalBobot > 0 ? $totalNilai / $totalBobot : 0;
            $penilaianKPI->nilai_rata_rata = $nilaiRataRata;
            $penilaianKPI->save();

            DB::commit();

            return response()->json($penilaianKPI->load('detailPenilaianKPI.komponenKPI'));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Terjadi kesalahan saat memperbarui data.'], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $penilaianKPI = PenilaianKPI::findOrFail($id);
            
            // Hapus detail terlebih dahulu
            $penilaianKPI->detailPenilaianKPI()->delete();
            
            // Kemudian hapus penilaian KPI
            $penilaianKPI->delete();

            DB::commit();

            return response()->json(['message' => 'Data penilaian KPI berhasil dihapus'], 200);
        } catch (QueryException $e) {
            DB::rollback();
            Log::error('Database error saat menghapus penilaian KPI: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan database saat menghapus data penilaian KPI.',
                'error' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings()
            ], 500);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error saat menghapus penilaian KPI: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data penilaian KPI.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}