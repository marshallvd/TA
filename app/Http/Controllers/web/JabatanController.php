<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        return view('master_data.jabatan.index');
    }

    public function create()
    {
        return view('master_data.jabatan.create');
    }

    public function edit($id)
    {
        return view('master_data.jabatan.edit', compact('id'));
    }
}