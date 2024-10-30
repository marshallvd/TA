<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DivisiController extends Controller
{
    public function index()
    {
        $divisi = Divisi::all();
        return response()->json($divisi);
    }

    public function store(Request $request)
    {
        \Log::info('Data permintaan yang diterima:', $request->all());
        
        $validator = Validator::make($request->all(), [
            'nama_divisi' => 'required|string|max:100|unique:tb_divisi',
        ]);
    
        if ($validator->fails()) {
            \Log::error('Validasi gagal:', $validator->errors()->toArray());
            return response()->json($validator->errors(), 400);
        }
    
        try {
            $divisi = Divisi::create($request->all());
            \Log::info('Divisi berhasil dibuat:', $divisi->toArray());
            return response()->json($divisi, 201);
        } catch (\Exception $e) {
            \Log::error('Error saat membuat divisi:', ['pesan' => $e->getMessage()]);
            return response()->json(['pesan' => 'Error saat membuat divisi', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $divisi = Divisi::find($id);
        if (!$divisi) {
            return response()->json(['message' => 'Divisi not found'], 404);
        }
        return response()->json($divisi);
    }

    public function update(Request $request, $id)
    {
        $divisi = Divisi::find($id);
        if (!$divisi) {
            return response()->json(['message' => 'Divisi not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_divisi' => 'required|string|max:100|unique:tb_divisi,nama_divisi,'.$id.',id_divisi',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $divisi->update($request->all());
        return response()->json($divisi);
    }

    public function destroy($id)
    {
        $divisi = Divisi::find($id);
        if (!$divisi) {
            return response()->json(['message' => 'Divisi not found'], 404);
        }

        $divisi->delete();
        return response()->json(['message' => 'Divisi deleted successfully']);
    }
}