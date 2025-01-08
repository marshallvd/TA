<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\HasilSeleksi;
use App\Models\Wawancara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import Log Facade

class HasilSeleksiController extends Controller
{
    public function index()
    {
        // Tampilkan halaman index hasil seleksi
        return view('rekrutmen.hasil_seleksi.index');
    }

    public function create(Request $request)
    {
        $wawancaraId = $request->query('wawancara_id');
        
        // Validasi keberadaan ID Wawancara
        if (!$wawancaraId) {
            return redirect()->route('rekrutmen.wawancara.index')
                ->with('error', 'ID Wawancara tidak valid');
        }
    
        // Cek apakah wawancara dengan ID tersebut ada
        $wawancara = Wawancara::findOrFail($wawancaraId);
    
        // Pastikan belum ada hasil seleksi untuk wawancara ini
        $existingHasilSeleksi = HasilSeleksi::where('id_wawancara', $wawancaraId)->first();
        if ($existingHasilSeleksi) {
            return redirect()->route('rekrutmen.wawancara.index')
                ->with('error', 'Hasil seleksi untuk wawancara ini sudah ada');
        }
    
        return view('rekrutmen.hasil_seleksi.create', [
            'wawancaraId' => $wawancaraId,
            'pelamarId' => $wawancara->id_pelamar,
            'lowonganId' => $wawancara->id_lowongan_pekerjaan
        ]);
    }

    // public function create(Request $request)
    // {
    //     $wawancaraId = $request->query('wawancara_id');
        
    //     // Validasi keberadaan ID Wawancara
    //     if (!$wawancaraId) {
    //         return redirect()->route('rekrutmen.wawancara.index')
    //             ->with('error', 'ID Wawancara tidak valid');
    //     }
    
    //     return view('rekrutmen.hasil_seleksi.create', compact('wawancaraId'));
    // }

    public function store(Request $request)
    {
        // Logika penyimpanan akan ditangani di API Controller
        return redirect()->route('rekrutmen.hasil_seleksi.index')
            ->with('success', 'Hasil seleksi berhasil ditambahkan');
    }
    public function edit($id)
    {
        // Mengambil hasil seleksi berdasarkan ID
        $hasilSeleksi = HasilSeleksi::with(['pelamar', 'lowonganPekerjaan'])->findOrFail($id);
        return view('rekrutmen.hasil_seleksi.edit', compact('hasilSeleksi'));
    }

    public function show($id)
    {
        $hasilSeleksi = HasilSeleksi::findOrFail($id);
        return view('rekrutmen.hasil_seleksi.view', compact('hasilSeleksi'));
    }

    public function view($id)
    {
        $hasilSeleksi = HasilSeleksi::with(['pelamar', 'lowonganPekerjaan', 'wawancara'])->findOrFail($id);
        return view('rekrutmen.hasil_seleksi.view', compact('hasilSeleksi'));
    }
    public function pribadi()
    {
        Log::info('Mengakses halaman pribadi hasil seleksi');


        return view('rekrutmen.hasil_seleksi.pribadi');
    }

    public function viewPelamar($id)
    {
        \Log::info('Accessing viewPelamar with ID: ' . $id);
        
        try {
            $hasilSeleksi = HasilSeleksi::with([
                'lamaran.lowonganPekerjaan', 
                'lamaran.pelamar', 
                'wawancara'
            ])->findOrFail($id);
            
            return view('rekrutmen.hasil_seleksi.view_pelamar', compact('hasilSeleksi'));
        } catch (\Exception $e) {
            \Log::error('Error in viewPelamar: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Detail hasil seleksi tidak ditemukan');
        }
    }
}