<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('pegawai.index');
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function edit()
    {
        return view('pegawai.edit');
    }
}
