<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index()
    {
        return view('cuti.index');
    }

    public function create()
    {
        return view('cuti.create');
    }

    public function store(Request $request)
    {
        // Validasi dan simpan data pengajuan cuti
        $validatedData = $request->validate([
            'id_pegawai' => 'required|exists:pegawai,id_pegawai',
            'id_jenis_cuti' => 'required|exists:jenis_cuti,id_jenis_cuti',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'nullable|string',
        ]);

        Cuti::create($validatedData);

        return redirect()->route('cuti.index')->with('success', 'Pengajuan cuti berhasil dibuat.');
    }

    public function show($id)
    {
        $cuti = Cuti::with('jenisCuti')->findOrFail($id);
        return response()->json($cuti);
    }

    public function edit($id)
    {
        $cuti = Cuti::findOrFail($id);
        return view('cuti.edit', compact('cuti'));
    }

    public function update(Request $request, $id)
    {
        // Validasi dan update data pengajuan cuti
        $validatedData = $request->validate([
            'id_pegawai' => 'required|exists:pegawai,id_pegawai',
            'id_jenis_cuti' => 'required|exists:jenis_cuti,id_jenis_cuti',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'nullable|string',
        ]);

        $cuti = Cuti::findOrFail($id);
        $cuti->update($validatedData);

        return redirect()->route('cuti.index')->with ('success', 'Pengajuan cuti berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->delete();

        return redirect()->route('cuti.index')->with('success', 'Pengajuan cuti berhasil dihapus.');
    }

    public function view($id)
    {
        try {
            // Ambil data cuti berdasarkan ID
            $cuti = Cuti::with('jenisCuti', 'pegawai')->findOrFail($id);
    
            // Kembalikan tampilan dengan data cuti
            return view('cuti.view', compact('cuti'));
        } catch (\Exception $e) {
            return abort(404);
        }
    }
    
    public function kalender()
{
    return view('cuti.kalender');
}
}