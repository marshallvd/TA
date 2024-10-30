<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Exception;

class AuthController extends Controller
{
    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = env('API_BASE_URL', 'http://localhost:8000/api');
    }

    public function showLogin()
    {
        if (session('api_token')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            Log::info('Login attempt', [
                'email' => $request->email,
                'api_url' => $this->apiBaseUrl . '/auth/login'
            ]);

            $client = new Client(['verify' => false]); // Disable SSL verify for local development
            $response = $client->post($this->apiBaseUrl . '/auth/login', [
                'json' => [
                    'email' => $request->email,
                    'password' => $request->password,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'timeout' => 30
            ]);

            $data = json_decode($response->getBody(), true);

            // Simpan data di session
            session([
                'api_token' => $data['authorization']['token'],
                'user' => $data['user']
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil!',
                'redirect' => route('dashboard')
            ]);

        } catch (Exception $e) {
            Log::error('Login error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal login: ' . $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            if (session('api_token')) {
                $client = new Client(['verify' => false]);
                $response = $client->post($this->apiBaseUrl . '/auth/logout', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . session('api_token'),
                        'Accept' => 'application/json'
                    ]
                ]);
            }
        } catch (Exception $e) {
            Log::error('Logout error', ['message' => $e->getMessage()]);
        }

        // Hapus session
        session()->forget(['api_token', 'user']);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil!',
            'redirect' => route('login')
        ]);
    }
}