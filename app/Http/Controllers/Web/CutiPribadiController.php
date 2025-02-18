<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutiPribadiController extends Controller
{
    public function index()
    {
        return view('cuti_pribadi.index'); // Menampilkan halaman index cuti pribadi
    }

    public function create()
    {
        return view('cuti_pribadi.create'); // Menampilkan form untuk membuat cuti pribadi
    }

    public function store(Request $request)
    {
        // Validasi dan simpan data pengajuan cuti pribadi
        $validatedData = $request->validate([
            'id_jenis_cuti' => 'required|exists:jenis_cuti,id_jenis_cuti',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);

        Cuti::create([
            'id_pegawai' => Auth::id(), // Mengambil ID pegawai yang sedang login
            'status' => 'menunggu', // Status awal
            ...$validatedData
        ]);

        return redirect()->route('cuti_pribadi.index')->with('success', 'Pengajuan cuti pribadi berhasil dibuat.');
    }

    public function edit($id)
    {
        $cuti = Cuti::findOrFail($id);
        $pegawai = Auth::user(); // Ambil data pegawai yang sedang login
        return view('cuti_pribadi.edit', compact('cuti', 'pegawai'));
    }

    public function update(Request $request, $id)
    {
        // Validasi dan update data pengajuan cuti pribadi
        $validatedData = $request->validate([
            'id_jenis_cuti' => 'required|exists:jenis_cuti,id_jenis_cuti',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);

        $cuti = Cuti::findOrFail($id);
        $cuti->update($validatedData);

        return redirect()->route('cuti_pribadi.index')->with('success', 'Pengajuan cuti pribadi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->delete();

        return redirect()->route('cuti_pribadi.index')->with('success', 'Pengajuan cuti pribadi berhasil dihapus.');
    }

    public function show($id)
    {
        // Ambil data cuti beserta relasi yang dibutuhkan
        $cuti = Cuti::with(['jenisCuti', 'pegawai'])->findOrFail($id);
        
        return view('cuti_pribadi.view', compact('cuti'));
    }

}