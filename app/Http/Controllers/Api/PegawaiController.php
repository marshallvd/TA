<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::with(['user', 'divisi', 'jabatan'])->get();
        return response()->json(['data' => $pegawai], 200);
    }

    public function store(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'nama_lengkap' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|string',
        'alamat' => 'required|string',
        'telepon' => 'required|string',
        'email' => 'required|email|unique:tb_pegawai,email',
        'nik' => 'required|string|unique:tb_pegawai,nik',
        'id_jabatan' => 'required|integer',
        'id_divisi' => 'required|integer',
        'status_kepegawaian' => 'required|string',
        'foto' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Buat pegawai baru
    // $pegawai = Pegawai::create($request->all());
    $pegawai = new Pegawai();
    $pegawai->fill($request->all());
    $pegawai->save();
    // Kembalikan respons
    return response()->json(['data' => $pegawai, 'message' => 'Pegawai berhasil dibuat'], 201);
}

    public function show($id)
    {
        try {
            $pegawai = Pegawai::with(['user', 'divisi', 'jabatan'])->findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $pegawai
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pegawai tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);
        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'string|max:255',
            'tanggal_lahir' => 'date',
            'jenis_kelamin' => 'in:L,P',
            'alamat' => 'string',
            'telepon' => 'string|max:20',
            'email' => 'email|unique:tb_pegawai,email,'.$pegawai->id_pegawai.',id_pegawai',
            'nik' => 'string|unique:tb_pegawai,nik,'.$pegawai->id_pegawai.',id_pegawai',
            ' id_jabatan' => 'exists:tb_jabatan,id_jabatan',
            'id_divisi' => 'exists:tb_divisi,id_divisi',
            'tanggal_masuk' => 'nullable|date',
            'tanggal_keluar' => 'nullable|date',
            'agama' => 'nullable|in:Hindu,Islam,Budha,Konghucu,Kristen,Katolik',
            'status_kepegawaian' => 'in:aktif,tidak',
            'foto' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pegawai->update($request->all());
        return response()->json(['data' => $pegawai, 'message' => 'Pegawai berhasil diperbarui'], 200);
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai tidak ditemukan'], 404);
        }
        $pegawai->delete();
        return response()->json(['message' => 'Pegawai berhasil dihapus'], 200);
    }
}