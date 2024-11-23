<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KomponenKompetensiController extends Controller
{
    public function index()
    {
        return view('komponen_penilaian_kinerja.komponen_kompetensi.index');
    }

    public function create()
    {
        return view('komponen_penilaian_kinerja.komponen_kompetensi.create');
    }

    public function edit($id)
    {
        return view('komponen_penilaian_kinerja.komponen_kompetensi.edit', compact('id'));
    }
}