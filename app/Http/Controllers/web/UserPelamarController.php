<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Untuk melakukan HTTP request
use App\Models\UserPelamar;

class UserPelamarController extends Controller
{
    public function index()
    {
        return view('user.user_pelamar.index'); // Mengembalikan tampilan daftar pelamar
    }

    public function create()
    {
        return view('user.user_pelamar.create'); // Mengembalikan tampilan form tambah pelamar
    }
    public function edit($id)
    {
        try {
            // Retrieve the specific pelamar (job applicant) by ID
            $pelamar = UserPelamar::findOrFail($id);
            
            // Pass the pelamar data to the edit view
            return view('user.user_pelamar.edit', compact('pelamar'));
        } catch (\Exception $e) {
            // Handle case where pelamar is not found
            return redirect()->route('pelamar.index')
                ->with('error', 'Pelamar tidak ditemukan');
        }
    }

}