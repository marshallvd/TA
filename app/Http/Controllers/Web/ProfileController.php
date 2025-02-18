<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function pegawai()
    {
        return view('profile.pegawai');
    }

    public function pelamar()
    {
        return view('profile.pelamar');
    }
    public function editpegawai()
    {
        return view('profile.edit_pegawai'); // Pastikan Anda memiliki view ini
    }

    public function editpelamar()
    {
        return view('profile.edit_pelamar'); // Pastikan Anda memiliki view ini
    }

    public function edituserpegawai()
    {
        return view('profile.edit_user_pegawai'); // Pastikan Anda memiliki view ini
    }
    public function editpasswordpelamar()
    {
        return view('profile.edit_user_pelamar');
    }
}


