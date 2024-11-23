<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KomponenKPIController extends Controller
{
    public function index()
    {
        return view('komponen_penilaian_kinerja.komponen_kpi.index');
    }

    public function create()
    {
        return view('komponen_penilaian_kinerja.komponen_kpi.create');
    }

    public function edit($id)
    {
        return view('komponen_penilaian_kinerja.komponen_kpi.edit', compact('id'));
    }
}