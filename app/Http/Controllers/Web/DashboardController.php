<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index'); // Halaman default
    }

    public function admin()
    {
        return view('dashboard.admin'); // Halaman dashboard admin
    }

    public function hrd()
    {
        return view('dashboard.hrd'); // Halaman dashboard HRD
    }

    public function pegawai()
    {
        return view('dashboard.pegawai'); // Halaman dashboard pegawai
    }
    public function pelamar()
    {
        return view('dashboard.pelamar'); // Halaman dashboard pegawai
    }
}