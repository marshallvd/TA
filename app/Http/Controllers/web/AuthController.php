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
            $response = Http::timeout(10)->post($this->apiUrl . '/auth/login', [
                'email' => $request->email,
                'password' => $request->password,
            ]);
    
            $responseData = $response->json();
    
            if ($response->successful() && isset($responseData['authorization']['token'])) {
                session(['token' => $responseData['authorization']['token']]);
                session(['user' => $responseData['user']]); 
    
                // Routing berdasarkan id_role
                switch ($responseData['user']['id_role']) {
                    case 1: // Admin
                        return redirect()->route('dashboard.admin');
                    case 2: // HRD
                        return redirect()->route('dashboard.hrd');
                    case 3: // Pegawai
                        return redirect()->route('dashboard.pegawai');
                    default:
                        return redirect()->route('dashboard.index');
                }
            } else {
                throw new \Exception($responseData['error'] ?? 'Login failed. Please try again.');
            }
        } catch (\Exception $e) {
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