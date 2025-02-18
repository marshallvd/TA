<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\PenilaianKompetensi;
use App\Models\DetailPenilaianKompetensi;
use App\Models\KomponenKompetensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class PenilaianKompetensiController extends Controller
{
    public function index()
    {
        $penilaianKompetensi = PenilaianKompetensi::with('detailPenilaianKompetensi.komponenKompetensi')->get();
        return response()->json($penilaianKompetensi);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'details' => 'required|array',
            'details.*.id_komponen_kompetensi' => 'required|exists:tb_komponen_kompetensi,id_komponen_kompetensi',
            'details.*.nilai' => 'required|numeric|min:0|max:100',
        ]);

        DB::beginTransaction();

        try {
            $penilaianKompetensi = new PenilaianKompetensi();
            $penilaianKompetensi->save();

            $totalNilai = 0;
            $totalBobot = 0;

            foreach ($validatedData['details'] as $detail) {
                $komponenKompetensi = KomponenKompetensi::findOrFail($detail['id_komponen_kompetensi']);
                
                DetailPenilaianKompetensi::create([
                    'id_penilaian_kompetensi' => $penilaianKompetensi->id_penilaian_kompetensi,
                    'id_komponen_kompetensi' => $detail['id_komponen_kompetensi'],
                    'nilai' => $detail['nilai'],
                ]);

                $totalNilai += $detail['nilai'] * $komponenKompetensi->bobot;
                $totalBobot += $komponenKompetensi->bobot;
            }

            $nilaiRataRata = $totalBobot > 0 ? $totalNilai / $totalBobot : 0;
            $penilaianKompetensi->nilai_rata_rata = $nilaiRataRata;
            $penilaianKompetensi->save();

            DB::commit();

            return response()->json($penilaianKompetensi->load('detailPenilaianKompetensi.komponenKompetensi'), 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.'], 500);
        }
    }

    public function show($id)
    {
        $penilaianKompetensi = PenilaianKompetensi::with('detailPenilaianKompetensi.komponenKompetensi')->findOrFail($id);
        return response()->json($penilaianKompetensi);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'details' => 'required|array',
            'details.*.id_detail_penilaian_kompetensi' => 'required|exists:tb_detail_penilaian_kompetensi,id_detail_penilaian_kompetensi',
            'details.*.nilai' => 'required|numeric|min:0|max:100',
        ]);

        DB::beginTransaction();

        try {
            $penilaianKompetensi = PenilaianKompetensi::findOrFail($id);

            $totalNilai = 0;
            $totalBobot = 0;

            foreach ($validatedData['details'] as $detail) {
                $detailPenilaian = DetailPenilaianKompetensi::findOrFail($detail['id_detail_penilaian_kompetensi']);
                $detailPenilaian->nilai = $detail['nilai'];
                $detailPenilaian->save();

                $komponenKompetensi = $detailPenilaian->komponenKompetensi;
                $totalNilai += $detail['nilai'] * $komponenKompetensi->bobot;
                $totalBobot += $komponenKompetensi->bobot;
            }

            $nilaiRataRata = $totalBobot > 0 ? $totalNilai / $totalBobot : 0;
            $penilaianKompetensi->nilai_rata_rata = $nilaiRataRata;
            $penilaianKompetensi->save();

            DB::commit();

            return response()->json($penilaianKompetensi->load('detailPenilaianKompetensi.komponenKompetensi'));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Terjadi kesalahan saat memperbarui data.'], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $penilaianKompetensi = PenilaianKompetensi::findOrFail($id);
            
            // Hapus detail terlebih dahulu
            $penilaianKompetensi->detailPenilaianKompetensi()->delete();
            
            // Kemudian hapus penilaian kompetensi
            $penilaianKompetensi->delete();

            DB::commit();

            return response()->json(['message' => 'Data berhasil dihapus'], 200);
        } catch (QueryException $e) {
            DB::rollback();
            Log::error('Database error: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan database saat menghapus data.', 'error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data.', 'error' => $e->getMessage()], 500);
        }
    }
}