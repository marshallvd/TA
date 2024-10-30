<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        Log::info('Percobaan pendaftaran', $request->all());

        try {
            $validator = Validator::make($request->all(), [
                'id_pegawai' => 'required|exists:tb_pegawai,id_pegawai',
                'email' => 'required|string|email|max:255|unique:tb_users',
                'password' => 'required|string|min:8',
                'id_role' => 'required|exists:tb_role,id_role',
            ], [
                'id_pegawai.required' => 'ID pegawai wajib diisi',
                'id_pegawai.exists' => 'ID pegawai tidak ditemukan',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 8 karakter',
                'id_role.required' => 'ID role wajib diisi',
                'id_role.exists' => 'ID role tidak ditemukan',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $pegawai = Pegawai::findOrFail($request->id_pegawai);

            $user = User::create([
                'id_pegawai' => $request->id_pegawai,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_role' => $request->id_role,
                'status' => 'aktif',
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            Log::info('Pengguna berhasil terdaftar', ['user_id' => $user->id_user]);

            return response()->json([
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'pesan' => 'Pendaftaran berhasil',
            ], 201);

        } catch (ValidationException $e) {
            Log::error('Validasi gagal saat pendaftaran', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            Log::error('Pegawai tidak ditemukan saat pendaftaran', ['id_pegawai' => $request->id_pegawai]);
            return response()->json(['pesan' => 'Pegawai tidak ditemukan'], 404);
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat pendaftaran', ['error' => $e->getMessage()]);
            return response()->json(['pesan' => 'Terjadi kesalahan saat pendaftaran'], 500);
        }
    }
    
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
    
            $credentials = $request->only('email', 'password');
    
            if (! $token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
    
            return $this->respondWithToken($token);
    
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat login', ['error' => $e->getMessage()]);
            return response()->json(['pesan' => 'Terjadi kesalahan saat login: ' . $e->getMessage()], 500);
        }
    }
    
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    // public function login(Request $request)
    // {
    //     Log::info('Percobaan login', ['email' => $request->email]);
    
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'email' => 'required|string|email',
    //             'password' => 'required|string',
    //         ], [
    //             'email.required' => 'Email wajib diisi',
    //             'email.email' => 'Format email tidak valid',
    //             'password.required' => 'Password wajib diisi',
    //         ]);
    
    //         if ($validator->fails()) {
    //             return response()->json(['errors' => $validator->errors()], 422);
    //         }
    
    //         $credentials = $request->only('email', 'password');
    
    //         if (!$token = auth('api')->attempt($credentials)) {
    //             Log::warning('Percobaan login gagal', ['email' => $request->email]);
    //             return response()->json(['pesan' => 'Email atau password salah'], 401);
    //         }
    
    //         return $this->respondWithToken($token);
    
    //     } catch (\Exception $e) {
    //         Log::error('Terjadi kesalahan saat login', ['error' => $e->getMessage()]);
    //         return response()->json(['pesan' => 'Terjadi kesalahan saat login'], 500);
    //     }
    // }
    


    // protected function respondWithToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => JWTAuth::factory()->getTTL() * 60
    //     ]);
    // }

    // public function login(Request $request)
    // {
    //     Log::info('Percobaan login', ['email' => $request->email]);

    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'email' => 'required|string|email',
    //             'password' => 'required|string',
    //         ], [
    //             'email.required' => 'Email wajib diisi',
    //             'email.email' => 'Format email tidak valid',
    //             'password.required' => 'Password wajib diisi',
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json(['errors' => $validator->errors()], 422);
    //         }

    //         if (!Auth::attempt($request->only('email', 'password'))) {
    //             Log::warning('Percobaan login gagal', ['email' => $request->email]);
    //             return response()->json(['pesan' => 'Email atau password salah'], 401);
    //         }

    //         $user = User::where('email', $request->email)->firstOrFail();
    //         $token = $user->createToken('auth_token')->plainTextToken;

    //         Log::info('Pengguna berhasil login', ['user_id' => $user->id_user]);

    //         return response()->json([
    //             'pesan' => 'Login berhasil',
    //             'access_token' => $token,
    //             'token_type' => 'Bearer',
    //         ]);

    //     } catch (ModelNotFoundException $e) {
    //         Log::error('Pengguna tidak ditemukan saat login', ['email' => $request->email]);
    //         return response()->json(['pesan' => 'Pengguna tidak ditemukan'], 404);
    //     } catch (\Exception $e) {
    //         Log::error('Terjadi kesalahan saat login', ['error' => $e->getMessage()]);
    //         return response()->json(['pesan' => 'Terjadi kesalahan saat login'], 500);
    //     }
    // }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            Log::info('Pengguna berhasil logout', ['user_id' => $request->user()->id_user]);
            return response()->json(['pesan' => 'Logout berhasil']);
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat logout', ['error' => $e->getMessage()]);
            return response()->json(['pesan' => 'Terjadi kesalahan saat logout'], 500);
        }
    }
}