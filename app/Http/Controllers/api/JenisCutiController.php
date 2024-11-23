<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisCuti;
use Illuminate\Http\Request;

class JenisCutiController extends Controller
{
    public function index()
    {
        $jenisCuti = JenisCuti::all();
        return response()->json($jenisCuti);
    }

    public function show($id)
    {
        $jenisCuti = JenisCuti::findOrFail($id);
        return response()->json($jenisCuti);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_cuti' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'jumlah_hari_diizinkan' => 'required|integer',
        ]);

        $jenisCuti = JenisCuti::create($request->all());
        return response()->json($jenisCuti, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis_cuti' => 'sometimes|required|string|max:255',
            'kategori' => 'sometimes|required|string|max:255',
            'jumlah_hari_diizinkan' => 'sometimes|required|integer',
        ]);

        $jenisCuti = JenisCuti::findOrFail($id);
        $jenisCuti->update($request->all());
        return response()->json($jenisCuti);
    }

    public function destroy($id)
    {
        $jenisCuti = JenisCuti::findOrFail($id);
        $jenisCuti->delete();
        return response()->json(null, 204); // Mengembalikan 204 No Content
    }
}