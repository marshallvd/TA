<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LamaranPekerjaan;
use App\Models\LowonganPekerjaan;

class AdminLamaranController extends Controller
{
    public function index()
    {
        // Cukup kembalikan view, data akan dimuat via API di frontend
        return view('rekrutmen.lamaran.index');
    }

    public function create()
    {
        // Ambil data lowongan untuk form tambah lamaran
        $lowonganPekerjaan = LowonganPekerjaan::all();
        return view('rekrutmen.lamaran.create', compact('lowonganPekerjaan'));
    }

    public function show($id)
    {
        try {
            $lamaran = LamaranPekerjaan::with(['lowonganPekerjaan', 'pelamar'])
                ->findOrFail($id);
            
            return view('rekrutmen.lamaran.show', compact('lamaran'));
        } catch (\Exception $e) {
            return redirect()->route('rekrutmen.lamaran.index')
                ->with('error', 'Lamaran tidak ditemukan');
        }
    }

    public function showView($id)
    {
        try {
            // Tambahkan logging
            \Log::info('Accessing lamaran view', ['id' => $id]);
    
            $lamaran = LamaranPekerjaan::with(['lowonganPekerjaan', 'pelamar'])
                ->findOrFail($id);
            
            return view('rekrutmen.lamaran.view', compact('lamaran'));
        } catch (\Exception $e) {
            // Log error
            \Log::error('Error in showView', [
                'message' => $e->getMessage(),
                'id' => $id
            ]);
    
            return redirect()->route('rekrutmen.lamaran.index')
                ->with('error', 'Lamaran tidak ditemukan: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $lamaran = LamaranPekerjaan::findOrFail($id);
            
            $validatedData = $request->validate([
                'status_lamaran' => 'required|in:diterima,ditolak,dalam_proses,menunggu',
                'catatan' => 'nullable|string'
            ]);

            $lamaran->update([
                'status_lamaran' => $validatedData['status_lamaran'],
                'catatan_admin' => $validatedData['catatan'] ?? null,
                'tanggal_diperbarui' => now()
            ]);

            return redirect()->route('rekrutmen.lamaran.view', $id)
                ->with('success', 'Status lamaran berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('rekrutmen.lamaran.index')
                ->with('error', 'Gagal memperbarui status lamaran: ' . $e->getMessage());
        }
    }

    public function pribadi()
    {
        return view('rekrutmen.lamaran.pribadi');
    }

    public function showViewPelamar($id)
    {
        try {
            \Log::info('Accessing lamaran view for pelamar', ['id' => $id]);
    
            // Gunakan metode find atau findOrFail
            $lamaran = LamaranPekerjaan::findOrFail($id);
            
            return view('rekrutmen.lamaran.view_pelamar', compact('lamaran'));
        } catch (\Exception $e) {
            \Log::error('Error in showViewPelamar', [
                'message' => $e->getMessage(),
                'id' => $id
            ]);
    
            return redirect()->route('pelamar.lamaran.index')
                ->with('error', 'Lamaran tidak ditemukan: ' . $e->getMessage());
        }
    }
}