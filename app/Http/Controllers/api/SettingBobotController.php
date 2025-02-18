<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SettingBobot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingBobotController extends Controller
{
    public function index()
    {
        $setting = SettingBobot::latest()->first();
        return response()->json(['data' => $setting]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bobot_kpi' => 'required|numeric|min:0|max:100',
            'bobot_kompetensi' => 'required|numeric|min:0|max:100',
            'bobot_core_values' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $total = $request->bobot_kpi + $request->bobot_kompetensi + $request->bobot_core_values;
            
            if ($total !== 100) {
                return response()->json([
                    'message' => 'Total bobot harus 100%'
                ], 400);
            }

            $setting = SettingBobot::create($request->all());
            
            return response()->json([
                'message' => 'Setting bobot berhasil disimpan',
                'data' => $setting
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'bobot_kpi' => 'required|numeric|min:0|max:100',
            'bobot_kompetensi' => 'required|numeric|min:0|max:100',
            'bobot_core_values' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $setting = SettingBobot::findOrFail($id);
            
            $total = $request->bobot_kpi + $request->bobot_kompetensi + $request->bobot_core_values;
            
            if ($total !== 100) {
                return response()->json([
                    'message' => 'Total bobot harus 100%'
                ], 400);
            }

            $setting->update($request->all());
            
            return response()->json([
                'message' => 'Setting bobot berhasil diperbarui',
                'data' => $setting
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}