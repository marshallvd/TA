<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\JatahCuti;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class JatahCutiController extends Controller
{
    public function index()
    {
        $jatahCuti = JatahCuti::with(['pegawai' => function($query) {
            $query->select('id_pegawai', 'nama_lengkap')
                  ->with('jabatan:id_jabatan,nama_jabatan');
        }])->get();
        
        // Hitung sisa cuti untuk setiap record
        foreach($jatahCuti as $jatah) {
            $jatah->hitungSisaCuti();
        }
        
        return view('jatah_cuti.index', compact('jatahCuti'));
    }

    public function create(Request $request)
    {
        $id_pegawai = $request->query('id_pegawai');
        $pegawai = Pegawai::findOrFail($id_pegawai);
        return view('jatah_cuti.create', compact('pegawai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pegawai' => 'required|exists:tb_pegawai,id_pegawai',
            'tahun' => 'required|integer',
            'jatah_cuti_umum' => 'required|integer|min:0',
            'jatah_cuti_menikah' => 'required|integer|min:0',
            'jatah_cuti_melahirkan' => 'required|integer|min:0',
        ]);

        // Check if leave allocation already exists for this employee in the given year
        $existingJatahCuti = JatahCuti::where('id_pegawai', $request->id_pegawai)
            ->where('tahun', $request->tahun)
            ->first();

        if ($existingJatahCuti) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Jatah cuti untuk pegawai ini di tahun tersebut sudah ada');
        }

        $jatahCuti = JatahCuti::create($request->all());
        $jatahCuti->hitungSisaCuti(); // Hitung sisa cuti setelah create

        return redirect()->route('jatah_cuti.index')
            ->with('success', 'Jatah Cuti berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jatahCuti = JatahCuti::with('pegawai')->findOrFail($id);
        $jatahCuti->hitungSisaCuti(); // Hitung sisa cuti sebelum menampilkan form edit
        return view('jatah_cuti.edit', compact('jatahCuti'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jatah_cuti_umum' => 'required|integer|min:0',
            'jatah_cuti_menikah' => 'required|integer|min:0',
            'jatah_cuti_melahirkan' => 'required|integer|min:0',
        ]);

        $jatahCuti = JatahCuti::findOrFail($id);
        $jatahCuti->update($request->all());
        $jatahCuti->hitungSisaCuti(); // Hitung ulang sisa cuti setelah update

        return redirect()->route('jatah_cuti.index')
            ->with('success', 'Jatah Cuti berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jatahCuti = JatahCuti::findOrFail($id);
        $jatahCuti->delete();

        return redirect()->route('jatah_cuti.index')
            ->with('success', 'Jatah Cuti berhasil dihapus.');
    }
}