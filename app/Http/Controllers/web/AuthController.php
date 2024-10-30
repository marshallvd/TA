<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $response = Http::timeout(60)->post('http://127.0.0.1:8000/api/auth/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                session(['api_token' => $data['authorization']['token']]);
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login berhasil!',
                    'redirect' => route('dashboard')
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Email atau password salah!'
            ], 401);
        } catch (\Exception $e) {
            \Log::error('Login error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat login. Silakan coba lagi.'
            ], 500);
        }
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $response = Http::post(url('/api/auth/register'), [
            'id_pegawai' => $request->id_pegawai,
            'email' => $request->email,
            'password' => $request->password,
            'id_role' => $request->id_role,
        ]);

        if ($response->successful()) {
            // Login user setelah registrasi
            return $this->login($request);
        }

        return response()->json([
            'status' => 'error',
            'message' => $response->json()['message'] ?? 'Registrasi gagal!'
        ], $response->status());
    }

    public function logout(Request $request)
    {
        $response = Http::withToken(session('api_token'))->post(url('/api/logout'));

        session()->forget('api_token');
        
        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil!',
            'redirect' => '/login'
        ]);
    }
}