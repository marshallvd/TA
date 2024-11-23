<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index()
    {
        return view('gaji.index');
    }

    public function create()
    {
        return view('gaji.create');
    }

    public function edit()
    {
        return view('gaji.edit');
    }

    public function view()
    {
        return view('gaji.view');
    }
}
