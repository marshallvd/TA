<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KomponenGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KomponenGajiController extends Controller
{
    public function index()
    {
        try {
            $komponenGaji = KomponenGaji::all();
            
            return response()->json([
                'status' => 'success',
                'data' => $komponenGaji
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data komponen gaji',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_komponen' => 'required|string|max:100|unique:tb_komponen_gaji,nama_komponen',
            'jenis' => 'required|in:pendapatan,potongan',
            'keterangan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $komponenGaji = new KomponenGaji();
            $komponenGaji->nama_komponen = $request->nama_komponen;
            $komponenGaji->jenis = $request->jenis;
            $komponenGaji->keterangan = $request->keterangan ?? null;
            $komponenGaji->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Komponen gaji berhasil ditambahkan',
                'data' => $komponenGaji
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan komponen gaji',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $komponenGaji = KomponenGaji::findOrFail($id);
            
            return response()->json([
                'status' => 'success',
                'data' => $komponenGaji
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Komponen gaji tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data komponen gaji',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_komponen' => 'required|string|max:100|unique:tb_komponen_gaji,nama_komponen,' . $id . ',id_komponen',
            'jenis' => 'required|in:pendapatan,potongan',
            'keterangan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $komponenGaji = KomponenGaji::findOrFail($id);
            $komponenGaji->nama_komponen = $request->nama_komponen;
            $komponenGaji->jenis = $request->jenis;
            $komponenGaji->keterangan = $request->keterangan ?? null;
            $komponenGaji->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Komponen gaji berhasil diperbarui',
                'data' => $komponenGaji
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Komponen gaji tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui komponen gaji',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $komponenGaji = KomponenGaji::findOrFail($id);
            $komponenGaji->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Komponen gaji berhasil dihapus'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Komponen gaji tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus komponen gaji',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Tambahan: Mendapatkan komponen gaji berdasarkan jenis
    public function getByJenis($jenis)
    {
        try {
            $komponenGaji = KomponenGaji::where('jenis', $jenis)->get();
            
            return response()->json([
                'status' => 'success',
                'data' => $komponenGaji
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data komponen gaji',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}