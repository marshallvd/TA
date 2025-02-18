<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SettingGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingGajiController extends Controller
{
    public function index()
    {
        $setting = SettingGaji::latest()->first();
        
        return response()->json([
            'status' => 'success',
            'data' => $setting
        ]);
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'insentif_sangat_baik' => 'required|numeric|min:0|max:100',
                'insentif_baik' => 'required|numeric|min:0|max:100',
                'insentif_cukup' => 'required|numeric|min:0|max:100',
                'insentif_kurang' => 'required|numeric|min:0|max:100',
                'insentif_sangat_kurang' => 'required|numeric|min:0|max:100',
                'bonus_per_kehadiran' => 'required|numeric|min:0',
                'potongan_bpjs' => 'required|numeric|min:0',
                'persentase_pajak' => 'required|numeric|min:0|max:100',
                'hitung_gaji_pokok' => 'required|boolean',
                'hitung_insentif' => 'required|boolean',
                'hitung_bonus_kehadiran' => 'required|boolean',
                'hitung_tunjangan_lembur' => 'required|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Get existing setting or create new if doesn't exist
            $setting = SettingGaji::latest()->first();
            
            if ($setting) {
                // Update existing record
                $setting->update($request->all());
            } else {
                // Create new record if no setting exists
                $setting = SettingGaji::create($request->all());
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Setting gaji berhasil diperbarui',
                'data' => $setting
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui setting gaji',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}