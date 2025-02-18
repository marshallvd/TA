<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\PenilaianCoreValues;
use App\Models\DetailPenilaianCoreValues;
use App\Models\KomponenCoreValues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PenilaianCoreValuesController extends Controller
{
    public function index()
    {
        $penilaianCoreValues = PenilaianCoreValues::with('detailPenilaianCoreValues.komponenCoreValues')->get();
        return response()->json(['data' => $penilaianCoreValues], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'details' => 'required|array',
            'details.*.id_komponen_core_values' => 'required|exists:tb_komponen_core_values,id_komponen_core_values',
            'details.*.nilai' => 'required|numeric|min:0|max:100',
            'details.*.perilaku_utama' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        DB::beginTransaction();

        try {
            $penilaianCoreValues = new PenilaianCoreValues();
            $penilaianCoreValues->save();

            $totalNilai = 0;
            $totalBobot = 0;

            foreach ($request->details as $detail) {
                $komponenCoreValues = KomponenCoreValues::findOrFail($detail['id_komponen_core_values']);
                
                DetailPenilaianCoreValues::create([
                    'id_penilaian_core_values' => $penilaianCoreValues->id_penilaian_core_values,
                    'id_komponen_core_values' => $detail['id_komponen_core_values'],
                    'nilai' => $detail['nilai'],
                    'perilaku_utama' => $detail['perilaku_utama'] ?? null,
                ]);

                $totalNilai += $detail['nilai'] * $komponenCoreValues->bobot;
                $totalBobot += $komponenCoreValues->bobot;
            }

            $nilaiRataRata = $totalBobot > 0 ? $totalNilai / $totalBobot : 0;
            $penilaianCoreValues->nilai_rata_rata = $nilaiRataRata;
            $penilaianCoreValues->save();

            DB::commit();

            return response()->json([
                'data' => $penilaianCoreValues->load('detailPenilaianCoreValues.komponenCoreValues'),
                'message' => 'Penilaian core values berhasil ditambahkan'
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        Log::info('Update request received', ['request' => $request->all()]);
    
        $validator = Validator::make($request->all(), [
            'details' => 'required|array',
            'details.*.id_komponen_core_values' => 'required|exists:tb_komponen_core_values,id_komponen_core_values',
            'details.*.nilai' => 'required|numeric|min:0|max:100',
            'details.*.perilaku_utama' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        DB::beginTransaction();
    
        try {
            $penilaianCoreValues = PenilaianCoreValues::findOrFail($id);
            $totalNilai = 0;
            $totalBobot = 0;
    
            // Delete existing details
            $penilaianCoreValues->detailPenilaianCoreValues()->delete();
    
            // Create new details
            foreach ($request->details as $detail) {
                $komponenCoreValues = KomponenCoreValues::findOrFail($detail['id_komponen_core_values']);
                
                DetailPenilaianCoreValues::create([
                    'id_penilaian_core_values' => $penilaianCoreValues->id_penilaian_core_values,
                    'id_komponen_core_values' => $detail['id_komponen_core_values'],
                    'nilai' => $detail['nilai'],
                    'perilaku_utama' => $detail['perilaku_utama'] ?? null,
                ]);
    
                $totalNilai += $detail['nilai'] * $komponenCoreValues->bobot;
                $totalBobot += $komponenCoreValues->bobot;
            }
    
            $nilaiRataRata = $totalBobot > 0 ? $totalNilai / $totalBobot : 0;
            $penilaianCoreValues->nilai_rata_rata = $nilaiRataRata;
            $penilaianCoreValues->save();
    
            DB::commit();
            
            return response()->json([
                'data' => $penilaianCoreValues->load('detailPenilaianCoreValues.komponenCoreValues'),
                'message' => 'Penilaian core values berhasil diperbarui'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating penilaian core values', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()], 500);
        }
    }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'details' => 'required|array',
    //         'details.*.id_detail_penilaian_core' => 'required|exists:tb_detail_penilaian_core_values,id_detail_penilaian_core',
    //         'details.*.nilai' => 'required|numeric|min:0|max:100',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 400);
    //     }

    //     DB::beginTransaction();

    //     try {
    //         $penilaianCoreValues = new PenilaianCoreValues();
    //         $penilaianCoreValues->save();

    //         $totalNilai = 0;
    //         $totalBobot = 0;

    //         foreach ($request->details as $detail) {
    //             $komponenCoreValues = KomponenCoreValues::findOrFail($detail['id_komponen_core_values']);
                
    //             DetailPenilaianCoreValues::create([
    //                 'id_penilaian_core_values' => $penilaianCoreValues->id_penilaian_core_values,
    //                 'id_komponen_core_values' => $detail['id_komponen_core_values'],
    //                 'nilai' => $detail['nilai'],
    //                 'perilaku_utama' => $detail['perilaku_utama'] ?? null,
    //             ]);

    //             $totalNilai += $detail['nilai'] * $komponenCoreValues->bobot;
    //             $totalBobot += $komponenCoreValues->bobot;
    //         }

    //         $nilaiRataRata = $totalBobot > 0 ? $totalNilai / $totalBobot : 0;
    //         $penilaianCoreValues->nilai_rata_rata = $nilaiRataRata;
    //         $penilaianCoreValues->save();

    //         DB::commit();

    //         return response()->json([
    //             'data' => $penilaianCoreValues->load('detailPenilaianCoreValues.komponenCoreValues'),
    //             'message' => 'Penilaian core values berhasil ditambahkan'
    //         ], 201);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()], 500);
    //     }
    // }

    public function show($id)
    {
        $penilaianCoreValues = PenilaianCoreValues::with('detailPenilaianCoreValues.komponenCoreValues')->find($id);
        if (!$penilaianCoreValues) {
            return response()->json(['message' => 'Penilaian core values tidak ditemukan'], 404);
        }
        return response()->json(['data' => $penilaianCoreValues], 200);
    }



    // public function update(Request $request, $id)
    // {
    //     Log::info('Update request received', ['request' => $request->all()]);
    
    //     $validator = Validator::make($request->all(), [
    //         'details' => 'required|array',
    //         'details.*.id_detail_penilaian_core' => 'required|exists:tb_detail_penilaian_core_values,id_detail_penilaian_core',
    //         'details.*.nilai' => 'required|numeric|min:0|max:100',
    //         'details.*.perilaku_utama' => 'nullable|string',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 400);
    //     }
    
    //     DB::beginTransaction();
    
    //     try {
    //         $penilaianCoreValues = PenilaianCoreValues::findOrFail($id);
    //         $totalNilai = 0;
    //         $totalBobot = 0;
    
    //         foreach ($request->details as $detail) {
    //             $detailPenilaian = DetailPenilaianCoreValues::findOrFail($detail['id_detail_penilaian_core']);
    //             $detailPenilaian->nilai = $detail['nilai'];
    //             $detailPenilaian->perilaku_utama = $detail['perilaku_utama'] ?? null;
    //             $detailPenilaian->save();
    
    //             $komponenCoreValues = $detailPenilaian->komponenCoreValues;
    //             $totalNilai += $detail['nilai'] * $komponenCoreValues->bobot;
    //             $totalBobot += $komponenCoreValues->bobot;
    //         }
    
    //         $nilaiRataRata = $totalBobot > 0 ? $totalNilai / $totalBobot : 0;
    //         $penilaianCoreValues->nilai_akhir = $nilaiRataRata;
    //         $penilaianCoreValues->save();
    
    //         DB::commit();
    //         return response()->json(['message' => 'Penilaian core values updated successfully.'], 200);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Error updating penilaian core values', ['error' => $e->getMessage()]);
    //         return response()->json(['message' => 'Failed to update penilaian core values.'], 500);
    //     }
    // }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $penilaianCoreValues = PenilaianCoreValues::findOrFail($id);
            $penilaianCoreValues->detailPenilaianCoreValues()->delete();
            $penilaianCoreValues->delete();

            DB::commit();

            return response()->json(['message' => 'Penilaian core values berhasil dihapus'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()], 500);
        }
    }
}