<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KomponenKpi;
use Illuminate\Http\Request;

class KomponenKpiController extends Controller
{
    // Di KomponenKPIController
    public function index(Request $request)
    {
        try {
            // Validate id_divisi if provided
            if ($request->has('id_divisi')) {
                $request->validate([
                    'id_divisi' => 'required|exists:tb_divisi,id_divisi'
                ]);
                
                $komponenKPI = KomponenKpi::where('id_divisi', $request->id_divisi)
                                         ->with('divisi')
                                         ->get();
            } else {
                $komponenKPI = KomponenKpi::with('divisi')->get();
            }
            
            \Log::info('Fetching KPI components for divisi: ' . $request->id_divisi);
            \Log::info('Retrieved components:', $komponenKPI->toArray());
            
            return response()->json($komponenKPI);
            
        } catch (\Exception $e) {
            \Log::error('Error in KomponenKpiController@index: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to fetch KPI components',
                'message' => $e->getMessage()
            ], 500);
        }
    }


//     public function index(Request $request)
// {
//     $komponenKPI = KomponenKPI::all(); // Mengambil semua data
//     return response()->json($komponenKPI);
// }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_divisi' => 'required|exists:tb_divisi,id_divisi',
            'nama_indikator' => 'required|string|max:100',
            'bobot' => 'required|numeric|min:0|max:100',
            'target' => 'required|string|max:50',
            'ukuran' => 'required|string|max:255'
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
            'target' => 'string|max:50',
            'ukuran' => 'string|max:255'
        ]);

        $komponenKpi->update($validatedData);
        return response()->json($komponenKpi);
    }

    
    public function destroy($id)
    {
        try {
            $komponenKpi = KomponenKpi::findOrFail($id);
            $komponenKpi->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Data KPI berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
}
}