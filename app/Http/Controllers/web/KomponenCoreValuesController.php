<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KomponenCoreValuesController extends Controller
{
    public function index()
    {
        return view('komponen_penilaian_kinerja.komponen_core_values.index');
    }

    public function create()
    {
        return view('komponen_penilaian_kinerja.komponen_core_values.create');
    }

    public function edit($id)
    {
        return view('komponen_penilaian_kinerja.komponen_core_values.edit', compact('id'));
    }
}