<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LamaranPekerjaan;

class LamaranController extends Controller
{
    // public function index()
    // {
    //     // Ambil semua lamaran untuk admin
    //     $lamarans = LamaranPekerjaan::with(['lowonganPekerjaan', 'pelamar'])
    //         ->orderBy('tanggal_dibuat', 'desc')
    //         ->get();

    //     return view('rekrutmen.lamaran.index', compact('lamarans'));
    // }

    // public function show($id)
    // {
    //     $lamaran = LamaranPekerjaan::with(['lowonganPekerjaan', 'pelamar'])->findOrFail($id);
    //     return view('rekrutmen.lamaran.show', compact('lamaran'));
    // }

    // public function accept($id)
    // {
    //     // Logika untuk menerima lamaran
    //     $lamaran = LamaranPekerjaan::findOrFail($id);
    //     $lamaran->update(['status_lamaran' => 'diterima']);
    //     return redirect()->route('rekrutmen.lamaran.index')->with('success', 'Lamaran diterima.');
    // }

    // public function reject($id)
    // {
    //     // Logika untuk menolak lamaran
    //     $lamaran = LamaranPekerjaan::findOrFail($id);
    //     $lamaran->update(['status_lamaran' => 'ditolak']);
    //     return redirect()->route('rekrutmen.lamaran.index')->with('error', 'Lamaran ditolak.');
    // }
}
