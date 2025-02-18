<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\JenisCuti;
use Illuminate\Http\Request;

class JenisCutiController extends Controller
{
    public function index()
    {
        return view('jenis_cuti.index'); // Pastikan Anda memiliki file views/jenis_cuti/index.blade.php
    }

    public function create()
    {
        return view('jenis_cuti.create'); // Buat view untuk create
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_cuti' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'jumlah_hari_diizinkan' => 'required|integer',
        ]);

        JenisCuti::create($request->all());

        return redirect()->route('jenis_cuti.index')->with('success', 'Jenis Cuti berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenisCuti = JenisCuti::findOrFail($id);
        return view('jenis_cuti.edit', compact('jenisCuti')); // Buat view untuk edit
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

        return redirect()->route('jenis_cuti.index')->with('success', 'Jenis Cuti berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenisCuti = JenisCuti::findOrFail($id);
        $jenisCuti->delete();

        return response()->json(['success' => 'Jenis Cuti berhasil dihapus.']);
    }
}