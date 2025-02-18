<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::all();
        return response()->json($jabatan);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'required|string|max:100',
            'id_divisi' => 'required|exists:tb_divisi,id_divisi',
            'gaji_pokok' => 'required|numeric|min:0',
            'tarif_lembur_per_hari' => 'required|numeric|min:0'
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        $jabatan = Jabatan::create($request->all());
        return response()->json($jabatan, 201);
    }
    
    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::find($id);
        if (!$jabatan) {
            return response()->json(['message' => 'Jabatan not found'], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'required|string|max:100',
            'id_divisi' => 'required|exists:tb_divisi,id_divisi',
            'gaji_pokok' => 'required|numeric|min:0',
            'tarif_lembur_per_hari' => 'required|numeric|min:0'
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        $jabatan->update($request->all());
        return response()->json($jabatan);
    }

    public function show($id)
    {
        $jabatan = Jabatan::find($id);
        if (!$jabatan) {
            return response()->json(['message' => 'Jabatan not found'], 404);
        }
        return response()->json($jabatan);
    }

    // public function update(Request $request, $id)
    // {
    //     $jabatan = Jabatan::find($id);
    //     if (!$jabatan) {
    //         return response()->json(['message' => 'Jabatan not found'], 404);
    //     }

    //     $validator = Validator::make($request->all(), [
    //         'nama_jabatan' => 'required|string|max:100',
    //         'id_divisi' => 'required|exists:tb_divisi,id_divisi',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }

    //     $jabatan->update($request->all());
    //     return response()->json($jabatan);
    // }

    public function destroy($id)
    {
        $jabatan = Jabatan::find($id);
        if (!$jabatan) {
            return response()->json(['message' => 'Jabatan not found'], 404);
        }

        $jabatan->delete();
        return response()->json(['message' => 'Jabatan deleted successfully']);
    }


// JabatanController
public function getByDivisi($id_divisi)
{
    $jabatan = Jabatan::where('id_divisi', $id_divisi)->get();
    return response()->json($jabatan);
}
}