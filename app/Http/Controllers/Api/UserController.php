<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Pegawai; // Pastikan untuk mengimpor model Pegawai
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
{
    DB::enableQueryLog(); // Aktifkan query log

    // Tambahkan logging yang lebih komprehensif
    \Log::channel('daily')->info('Login Attempt', [
        'email' => $request->email,
        'ip' => $request->ip(),
        'timestamp' => now()
    ]);

    $startTime = microtime(true);

    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        \Log::error('Login Validation Failed', [
            'errors' => $validator->errors(),
            'input' => $request->except('password')
        ]);
        return response()->json($validator->errors(), 422);
    }

    try {
        // Tambahkan query logging
        \DB::enableQueryLog();

        // Cek user terlebih dahulu
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            \Log::warning('Login Failed: User Not Found', [
                'email' => $request->email
            ]);
            return response()->json(['error' => 'User not found'], 404);
        }

        // Verify password manually
        if (!Hash::check($request->password, $user->password)) {
            \Log::warning('Login Failed: Invalid Password', [
                'email' => $request->email
            ]);
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Attempt token generation
        if (!$token = auth()->login($user)) {
            \Log::error('Token Generation Failed', [
                'email' => $request->email
            ]);
            return response()->json(['error' => 'Could not create token'], 500);
        }

        // Log query performance
        $queries = \DB::getQueryLog();
        \Log::info('Login Queries', [
            'queries' => $queries,
            'total_time' => array_sum(array_column($queries, 'time'))
        ]);

        $endTime = microtime(true);
        \Log::info('Login Performance', [
            'total_time' => $endTime - $startTime
        ]);

        return $this->createNewToken($token);

    } catch (\Exception $e) {
        \Log::error('Login Exception', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'error' => 'An unexpected error occurred',
            'details' => $e->getMessage()
        ], 500);
    }
}

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pegawai' => 'required|exists:tb_pegawai,id_pegawai',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'id_role' => 'required|exists:tb_role,id_role',
        ]);
    
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
    
        $user = User::create([
            'id_pegawai' => $request->id_pegawai,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_role' => $request->id_role,
            'status' => 'aktif',
        ]);
    
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh()
    {
        return $this->createNewToken(auth()->refresh());
    }

    public function userProfile()
    {
        $user = auth()->user();
    
        // Ambil data pegawai berdasarkan id_pegawai
        $pegawai = Pegawai:: find($user->id_pegawai);
    
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'pegawai' => $pegawai,
        ]);
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'user' => auth()->user(),
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60 // Menambahkan expires_in
            ]
        ]);

    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pegawai' => 'required|exists:tb_pegawai,id_pegawai',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'id_role' => 'required|exists:tb_role,id_role',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = User::create([
                'id_pegawai' => $request->id_pegawai,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_role' => $request->id_role,
                'status' => $request->status
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User berhasil ditambahkan',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_pegawai' => 'sometimes|exists:tb_pegawai,id_pegawai',
            'email' => 'sometimes|string|email|max:255|unique:users,email,'.$id,
            'password' => 'sometimes|string|min:8',
            'id_role' => 'sometimes|exists:tb_role,id_role',
            'status' => 'sometimes|in:aktif,nonaktif',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();
        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($validatedData);

        return response()->json([
            'message' => 'User successfully updated',
            'user' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User successfully deleted']);
    }
}