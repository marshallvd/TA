<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingPageController extends Controller
{
    /**
     * Menampilkan halaman landing page utama
     */
    public function index()
    {
        return view('landing_page.index');
    }

    /**
     * Menampilkan halaman karir/lowongan
     */
    public function career()
    {
        // Anda bisa menambahkan logika untuk mengambil data lowongan kerja
        $careers = []; // Misalnya, ambil data lowongan dari database

        return view('landing_page.career', compact('careers'));
    }

    public function about()
    {
        return view('landing_page.tentang');
    }

    /**
     * Menampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('pelamar.login'); // Pastikan view nama benar
    }

    public function showRegistrationForm()
    {
        return view('pelamar.register'); // Pastikan view nama benar
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil
            return redirect()->route('dashboard');
        }

        // Autentikasi gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    /**
     * Proses logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('landing.index');
    }
}