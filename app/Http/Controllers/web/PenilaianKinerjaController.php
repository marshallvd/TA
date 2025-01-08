<?php

namespace App\Http\Controllers\Web;
use App\Models\PenilaianKinerja; // Pastikan ini ada

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
    public function pribadi()
    {
        return view('penilaian_kinerja.pribadi');
    }
        // Metode untuk menampilkan halaman view penilaian kinerja
        public function view($id)
        {
            // Ambil data penilaian kinerja berdasarkan ID
            $penilaian = PenilaianKinerja::with(['pegawai', 'penilaianKPI', 'penilaianKompetensi', 'penilaianCoreValues'])
                ->findOrFail($id); // Menggunakan findOrFail untuk menangani jika ID tidak ditemukan
        
            // Kirim data ke tampilan
            return view('penilaian_kinerja.view', compact('penilaian'));
        }
}