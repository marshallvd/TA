<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KomponenGajiController extends Controller
{
    public function index()
    {
        return view('komponen_gaji.index');
    }

    public function create()
    {
        return view('komponen_gaji.create');
    }

    public function edit($id)
    {
        return view('komponen_gaji.edit', compact('id'));
    }
}