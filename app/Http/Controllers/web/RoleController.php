<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('master_data.role.index');
    }

    public function create()
    {
        return view('master_data.role.create');
    }

    public function edit($id)
    {
        return view('master_data.role.edit', compact('id'));
    }
}
