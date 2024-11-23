<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;

class PenilaianKinerjaController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all(); // Ambil semua data pegawai
        return view('penilaian_kinerja.index', compact('pegawai'));
    }

    public function create(Request $request)
    {
        $idPegawai = $request->query('id_pegawai');
        $periode = $request->query('periode'); // Ambil periode dari query parameter jika ada
        return view('penilaian_kinerja.create', compact('idPegawai', 'periode'));
    }

    public function edit($id)
    {
        return view('penilaian_kinerja.edit', compact('id'));
    }
}