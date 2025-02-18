<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserPelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthPelamarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pelamar', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
    
            $credentials = $request->only('email', 'password');
    
            if (!$token = Auth::guard('pelamar')->attempt($credentials)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized'
                ], 401);
            }
    
            $user = Auth::guard('pelamar')->user();
    
            return response()->json([
                'status' => 'success',
                'message' => 'Login berhasil',
                'data' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                    'expires_in' => auth('pelamar')->factory()->getTTL() * 60 // Menambahkan expires_in
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Login gagal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|unique:tb_user_pelamar,email',
                'password' => 'required|string|min:8|confirmed',
                'no_hp' => 'nullable|string|max:15',
                'alamat' => 'nullable|string',
                'pendidikan_terakhir' => 'nullable|string|max:50',
                'pengalaman_kerja' => 'nullable|string'
            ]);

            $user = UserPelamar::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'pengalaman_kerja' => $request->pengalaman_kerja
            ]);
    
            $token = Auth::guard('pelamar')->login($user);
    
            return response()->json([
                'status' => 'sukses',
                'message' => 'Registrasi berhasil',
                'data' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                    'expires_in' => auth('pelamar')->factory()->getTTL() * 60 // Menambahkan expires_in
                ]
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Registrasi gagal',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    public function logout()
    {
        try {
            if (!Auth::guard('pelamar')->check()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized'
                ], 401);
            }
    
            Auth::guard('pelamar')->logout();
            return response()->json([
                'status' => 'sukses',
                'message' => 'Berhasil logout'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Logout gagal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function me()
    {
        try {
            if (!Auth::guard('pelamar')->check()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized'
                ], 401);
            }
    
            $user = Auth::guard('pelamar')->user();
            return response()->json([
                'status' => 'sukses',
                'data' => $user
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function refresh()
    {
        try {
            if (!Auth::guard('pelamar')->check()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized'
                ], 401);
            }
    
            return response()->json([
                'status' => 'sukses',
                'user' => Auth::guard('pelamar')->user(),
                'authorization' => [
                    'token' => Auth::guard('pelamar')->refresh(),
                    'type' => 'bearer',
                    'expires_in' => auth('pelamar')->factory()->getTTL() * 60
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal refresh token',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}