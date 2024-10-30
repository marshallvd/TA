<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\KomponenKpi;
use Illuminate\Http\Request;

class KomponenKpiController extends Controller
{
    public function index()
    {
        $komponenKpi = KomponenKpi::with('divisi')->get();
        return response()->json($komponenKpi);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_divisi' => 'required|exists:tb_divisi,id_divisi',
            'nama_indikator' => 'required|string|max:100',
            'bobot' => 'required|numeric|min:0|max:100',
        ]);

        $komponenKpi = KomponenKpi::create($validatedData);
        return response()->json($komponenKpi, 201);
    }

    public function show($id)
    {
        $komponenKpi = KomponenKpi::with('divisi')->findOrFail($id);
        return response()->json($komponenKpi);
    }

    public function update(Request $request, $id)
    {
        $komponenKpi = KomponenKpi::findOrFail($id);
        
        $validatedData = $request->validate([
            'id_divisi' => 'exists:tb_divisi,id_divisi',
            'nama_indikator' => 'string|max:100',
            'bobot' => 'numeric|min:0|max:100',
        ]);

        $komponenKpi->update($validatedData);
        return response()->json($komponenKpi);
    }

    public function destroy($id)
    {
        $komponenKpi = KomponenKpi::findOrFail($id);
        $komponenKpi->delete();
        return response()->json(null, 204);
    }
}