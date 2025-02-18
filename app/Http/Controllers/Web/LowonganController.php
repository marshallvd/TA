<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
    {
        return view('rekrutmen.lowongan.index');
    }

    public function create()
    {
        return view('rekrutmen.lowongan.create');
    }

    public function edit($id)
    {
        return view('rekrutmen.lowongan.edit', compact('id'));
    }
    public function pelamarIndex()
    {
        return view('rekrutmen.lowongan.pelamar_index');
    }

    public function viewPelamar($id)
    {
        // Anda bisa menambahkan logika untuk mengambil detail lowongan jika diperlukan
        return view('rekrutmen.lowongan.view', compact('id'));
    }
}
