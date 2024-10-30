<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KomponenKompetensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KomponenKompetensiController extends Controller
{
    public function index()
    {
        $komponenKompetensi = KomponenKompetensi::all();
        return response()->json(['data' => $komponenKompetensi], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kompetensi' => 'required|string|max:100',
            'bobot' => 'required|numeric|between:0,100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $komponenKompetensi = KomponenKompetensi::create($request->all());
        return response()->json(['data' => $komponenKompetensi, 'message' => 'Komponen kompetensi berhasil ditambahkan'], 201);
    }

    public function show($id)
    {
        $komponenKompetensi = KomponenKompetensi::find($id);
        if (!$komponenKompetensi) {
            return response()->json(['message' => 'Komponen kompetensi tidak ditemukan'], 404);
        }
        return response()->json(['data' => $komponenKompetensi], 200);
    }

    public function update(Request $request, $id)
    {
        $komponenKompetensi = KomponenKompetensi::find($id);
        if (!$komponenKompetensi) {
            return response()->json(['message' => 'Komponen kompetensi tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_kompetensi' => 'required|string|max:100',
            'bobot' => 'required|numeric|between:0,100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $komponenKompetensi->update($request->all());
        return response()->json(['data' => $komponenKompetensi, 'message' => 'Komponen kompetensi berhasil diperbarui'], 200);
    }

    public function destroy($id)
    {
        $komponenKompetensi = KomponenKompetensi::find($id);
        if (!$komponenKompetensi) {
            return response()->json(['message' => 'Komponen kompetensi tidak ditemukan'], 404);
        }

        $komponenKompetensi->delete();
        return response()->json(['message' => 'Komponen kompetensi berhasil dihapus'], 200);
    }
}