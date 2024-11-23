<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $apiUrl = 'http://localhost:8000/api'; // Ganti dengan URL API Anda

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        try {
            Log::info('Attempting to log in with email: ' . $request->email);
            $response = Http::timeout(10)->post($this->apiUrl . '/auth/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);
            Log::info('Response received: ', $response->json());

            $responseData = $response->json();

            if ($response->successful() && isset($responseData['authorization']['token'])) {
                session(['token' => $responseData['authorization']['token']]);
                session(['user' => $responseData['user']]); // Simpan data user jika ada
                return redirect()->route('dashboard.index');
            } else {
                throw new \Exception($responseData['error'] ?? 'Login failed. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return back()->withErrors(['email' => $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('token');
        $request->session()->forget('user');
        return redirect()->route('login')->with('status', 'You have been logged out.');
    }
}