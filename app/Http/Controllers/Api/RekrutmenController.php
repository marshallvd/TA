<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\UserPelamar;
use App\Models\LamaranPekerjaan;
use App\Models\LowonganPekerjaan;
use App\Models\Wawancara;
use App\Models\HasilSeleksi;

class RekrutmenController extends Controller
{
    public function registerPelamar(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:tb_user_pelamar',
            'password' => 'required|string|min:8',
        ]);

        $pelamar = UserPelamar::create($validasi);

        return response()->json([
            'pesan' => 'Pendaftaran pelamar berhasil',
            'data' => $pelamar
        ], 201);
    }

    public function loginPelamar(Request $request)
    {
        $validasi = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $pelamar = UserPelamar::where('email', $validasi['email'])->first();

        if ($pelamar && password_verify($validasi['password'], $pelamar->password)) {
            $token = $pelamar->createToken('token-pelamar')->plainTextToken;
            return response()->json([
                'pesan' => 'Login berhasil',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'pesan' => 'Email atau password tidak valid'
            ], 401);
        }
    }

    public function daftarLowongan(Request $request)
    {
        $lowongan = LowonganPekerjaan::all();
        return response()->json([
            'pesan' => 'Daftar lowongan pekerjaan',
            'data' => $lowongan
        ], 200);
    }

    public function lamarPekerjaan(Request $request, $id)
    {
        $pelamar = $request->user('tb_user_pelamar');

        $validasi = $request->validate([
            'id_lowongan_pekerjaan' => 'required|exists:tb_lowongan_pekerjaan,id_lowongan_pekerjaan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'pendidikan_terakhir' => 'required|in:D3,D4,S1,S2,S3',
            'pengalaman_kerja' => 'nullable|string',
        ]);

        $lamaran = LamaranPekerjaan::create([
            'id_pelamar' => $pelamar->id_pelamar,
            'id_lowongan_pekerjaan' => $validasi['id_lowongan_pekerjaan'],
            'tanggal_lahir' => $validasi['tanggal_lahir'],
            'alamat' => $validasi['alamat'],
            'pendidikan_terakhir' => $validasi['pendidikan_terakhir'],
            'pengalaman_kerja' => $validasi['pengalaman_kerja'],
            'status_lamaran' => 'dikirim',
            'status_seleksi' => 'dikirim',
        ]);

        return response()->json([
            'pesan' => 'Lamaran pekerjaan berhasil dikirim',
            'data' => $lamaran
        ], 201);
    }

    public function lihatStatusLamaran(Request $request)
    {
        $pelamar = $request->user('tb_user_pelamar');
        $lamaran = LamaranPekerjaan::where('id_pelamar', $pelamar->id_pelamar)
            ->with('lowonganPekerjaan')
            ->get();

        return response()->json([
            'pesan' => 'Status lamaran pelamar',
            'data' => $lamaran
        ], 200);
    }

    public function lihatJadwalWawancara(Request $request)
    {
        $pelamar = $request->user('tb_user_pelamar');
        $wawancara = Wawancara::where('id_pelamar', $pelamar->id_pelamar)
            ->with('lamaranPekerjaan.lowonganPekerjaan')
            ->get();

        return response()->json([
            'pesan' => 'Jadwal wawancara pelamar',
            'data' => $wawancara
        ], 200);
    }

    public function lihatHasilSeleksi(Request $request)
    {
        $pelamar = $request->user('tb_user_pelamar');
        $hasilSeleksi = HasilSeleksi::where('id_pelamar', $pelamar->id_pelamar)
            ->with('lamaranPekerjaan.lowonganPekerjaan')
            ->get();

        return response()->json([
            'pesan' => 'Hasil seleksi pelamar',
            'data' => $hasilSeleksi
        ], 200);
    }
}
