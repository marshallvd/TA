<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LamaranPekerjaan;
use App\Models\Wawancara;

class WawancaraController extends Controller
{
    public function index()
    {
        // Cukup kembalikan view, data akan dimuat via API di frontend
        return view('rekrutmen.wawancara.index');
    }

    public function create(Request $request)
{
    $lamaranId = $request->query('lamaran_id');

    if (!$lamaranId) {
        return redirect()->route('rekrutmen.wawancara.index')
            ->with('error', 'ID Lamaran tidak diberikan');
    }

    try {
        $lamaran = LamaranPekerjaan::with(['pelamar', 'lowonganPekerjaan'])
            ->findOrFail($lamaranId);

        // Pastikan lamaran belum memiliki wawancara
        $existingWawancara = Wawancara::where('id_lamaran_pekerjaan', $lamaranId)->first();
        
        if ($existingWawancara) {
            return redirect()->route('rekrutmen.wawancara.index')
                ->with('error', 'Lamaran sudah memiliki jadwal wawancara');
        }

        if ($lamaran->status_lamaran !== 'diterima') {
            return redirect()->route('rekrutmen.wawancara.index')
                ->with('error', 'Hanya lamaran dengan status "diterima" yang dapat dijadwalkan wawancara');
        }

        return view('rekrutmen.wawancara.create', compact('lamaran'));

    } catch (\Exception $e) {
        return redirect()->route('rekrutmen.wawancara.index')
            ->with('error', 'Lamaran tidak ditemukan');
    }
}

    public function show($id)
    {
        try {
            $wawancara = Wawancara::with(['lamaranPekerjaan', 'pelamar'])
                ->findOrFail($id);
            
            return view('rekrutmen.wawancara.show', compact('wawancara'));
        } catch (\Exception $e) {
            return redirect()->route('rekrutmen.wawancara.index')
                ->with('error', 'Wawancara tidak ditemukan');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $wawancara = Wawancara::findOrFail($id);
            
            $validatedData = $request->validate([
                'hasil' => 'required|in:lulus,gagal,tertunda',
                'catatan' => 'nullable|string'
            ]);

            $wawancara->update([
                'hasil' => $validatedData['hasil'],
                'catatan' => $validatedData['catatan'] ?? null
            ]);

            return redirect()->route('rekrutmen.wawancara.index')
                ->with('success', 'Status wawancara berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('rekrutmen.wawancara.index')
                ->with('error', 'Gagal memperbarui status wawancara: ' . $e->getMessage());
        }
    }

    public function view($id)
{
    $wawancara = Wawancara::findOrFail($id);
    return view('rekrutmen.wawancara.view', compact('wawancara'));
}

    // WawancaraController
    public function edit($id)
    {
        $wawancara = Wawancara::findOrFail($id);
        return view('rekrutmen.wawancara.edit', compact('wawancara'));
    }

    public function pribadi()
    {
        return view('rekrutmen.wawancara.pribadi');
    }

    public function viewPelamar($id)
{
    try {
        $wawancara = Wawancara::with([
            'lamaranPekerjaan.lowonganPekerjaan', 
            'lamaranPekerjaan.pelamar'
        ])->findOrFail($id);
        
        return view('rekrutmen.wawancara.view_pelamar', compact('wawancara'));
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Detail wawancara tidak ditemukan');
    }
}
}