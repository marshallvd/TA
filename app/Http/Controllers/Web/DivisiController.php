<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {
        return view('master_data.divisi.index');
    }

    public function create()
    {
        return view('master_data.divisi.create');
    }

    public function edit($id)
    {
        return view('master_data.divisi.edit', compact('id'));
    }
}