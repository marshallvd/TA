<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\KomponenCoreValues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KomponenCoreValuesController extends Controller
{
    public function index()
    {
        $komponenCoreValues = KomponenCoreValues::all();
        return response()->json(['data' => $komponenCoreValues], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_core_values' => 'required|string|max:100',
            'bobot' => 'required|numeric|between:0,100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $komponenCoreValues = KomponenCoreValues::create($request->all());
        return response()->json(['data' => $komponenCoreValues, 'message' => 'Komponen core values berhasil ditambahkan'], 201);
    }

    public function show($id)
    {
        $komponenCoreValues = KomponenCoreValues::find($id);
        if (!$komponenCoreValues) {
            return response()->json(['message' => 'Komponen core values tidak ditemukan'], 404);
        }
        return response()->json(['data' => $komponenCoreValues], 200);
    }

    public function update(Request $request, $id)
    {
        $komponenCoreValues = KomponenCoreValues::find($id);
        if (!$komponenCoreValues) {
            return response()->json(['message' => 'Komponen core values tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_core_values' => 'required|string|max:100',
            'bobot' => 'required|numeric|between:0,100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $komponenCoreValues->update($request->all());
        return response()->json(['data' => $komponenCoreValues, 'message' => 'Komponen core values berhasil diperbarui'], 200);
    }

    public function destroy($id)
    {
        $komponenCoreValues = KomponenCoreValues::find($id);
        if (!$komponenCoreValues) {
            return response()->json(['message' => 'Komponen core values tidak ditemukan'], 404);
        }

        $komponenCoreValues->delete();
        return response()->json(['message' => 'Komponen core values berhasil dihapus'], 200);
    }
}