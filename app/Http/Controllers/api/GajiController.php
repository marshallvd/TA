<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Pegawai;
use App\Models\Gaji;
use App\Models\DetailGaji;
use App\Models\Pajak;
use App\Models\KomponenGaji;
use App\Models\PenilaianKinerja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GajiController extends Controller
{
    public function index()
    {
        $gaji = Gaji::with('pegawai')->paginate(10);
        return response()->json($gaji);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_pegawai' => 'required|exists:tb_pegawai,id_pegawai',
                'periode' => 'required|date_format:Y-m',
                'jumlah_kehadiran' => 'required|integer|min:0',
                'jumlah_hari_lembur' => 'required|integer|min:0',
            ]);
    
            $gaji = $this->hitungGaji($request);
    
            return response()->json([
                'message' => 'Gaji berhasil dihitung dan disimpan',
                'data' => $gaji
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Error in GajiController@store: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghitung dan menyimpan gaji',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $gaji = Gaji::with(['pegawai', 'detailGaji.komponenGaji'])->findOrFail($id);
        return response()->json($gaji);
    }

    public function update(Request $request, $id)
    {
        $gaji = Gaji::findOrFail($id);
        
        $request->validate([
            'jumlah_kehadiran' => 'required|integer|min:0',
            'jumlah_hari_lembur' => 'required|integer|min:0',
        ]);

        // Hitung ulang gaji
        $updatedGaji = $this->hitungGaji($request, $gaji);

        return response()->json([
            'message' => 'Gaji berhasil diperbarui',
            'data' => $updatedGaji
        ]);
    }

    public function destroy($id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();

        return response()->json([
            'message' => 'Gaji berhasil dihapus'
        ]);
    }

    private function hitungGaji(Request $request, Gaji $existingGaji = null)
    {
        $pegawai = Pegawai::with('jabatan')->findOrFail($request->id_pegawai);
        $periodeDate = Carbon::parse($request->periode);

        // Hitung komponen gaji
        $gajiPokok = $pegawai->jabatan->gaji_pokok;
        $insentif = $this->hitungInsentif($pegawai, $periodeDate);
        $bonusKehadiran = $this->hitungBonusKehadiran($request->jumlah_kehadiran);
        $tunjanganLembur = $this->hitungTunjanganLembur($request->jumlah_hari_lembur, $pegawai->jabatan->tarif_lembur_per_hari);
        
        $totalPemasukan = $gajiPokok + $insentif + $bonusKehadiran + $tunjanganLembur;
        $potonganPajak = $this->hitungPotonganPajak($totalPemasukan);
        $potonganBPJS = 200000; // Potongan BPJS tetap 200 ribu
        $totalPotongan = $potonganPajak + $potonganBPJS;
        $gajiBersih = $totalPemasukan - $totalPotongan;

        // Simpan atau update data gaji
        $gaji = $existingGaji ?? new Gaji();
        $gaji->id_pegawai = $request->id_pegawai;
        $gaji->periode_bulan = $periodeDate->format('m');
        $gaji->periode_tahun = $periodeDate->format('Y');
        $gaji->jumlah_kehadiran = $request->jumlah_kehadiran;
        $gaji->jumlah_hari_lembur = $request->jumlah_hari_lembur;
        $gaji->total_pendapatan = $totalPemasukan;
        $gaji->total_potongan = $totalPotongan;
        $gaji->gaji_bersih = $gajiBersih;
        $gaji->tanggal_pembayaran = Carbon::now();
        $gaji->status = 'draft';
        $gaji->save();

        // Hapus detail gaji lama jika ini adalah update
        if ($existingGaji) {
            $gaji->detailGaji()->delete();
        }

        // Simpan detail gaji
        $this->simpanDetailGaji($gaji->id_gaji, 'Gaji Pokok', 'pendapatan', $gajiPokok);
        $this->simpanDetailGaji($gaji->id_gaji, 'Insentif', 'pendapatan', $insentif);
        $this->simpanDetailGaji($gaji->id_gaji, 'Bonus Kehadiran', 'pendapatan', $bonusKehadiran);
        $this->simpanDetailGaji($gaji->id_gaji, 'Tunjangan Lembur', 'pendapatan', $tunjanganLembur);
        $this->simpanDetailGaji($gaji->id_gaji, 'Potongan Pajak', 'potongan', $potonganPajak);
        $this->simpanDetailGaji($gaji->id_gaji, 'Potongan BPJS', 'potongan', $potonganBPJS);

        return $gaji->load('detailGaji');
    }

    private function hitungInsentif($pegawai, $periode)
    {
        $penilaianKinerja = PenilaianKinerja::where('id_pegawai', $pegawai->id_pegawai)
            ->where('periode_penilaian', 'like', $periode->format('Y') . '%')
            ->orderBy('tanggal_dibuat', 'desc')
            ->first();

        if (!$penilaianKinerja) {
            return 0;
        }

        $persentaseInsentif = 0;
        switch ($penilaianKinerja->predikat) {
            case 'Sangat Baik':
                $persentaseInsentif = 0.10;
                break;
            case 'Baik':
                $persentaseInsentif = 0.05;
                break;
            case 'Cukup':
                $persentaseInsentif = 0.02;
                break;
            case 'Kurang':
                $persentaseInsentif = 0;
                break;
            // Tambahkan case lain sesuai kebutuhan
        }

        return $pegawai->jabatan->gaji_pokok * $persentaseInsentif;
    }

    private function hitungBonusKehadiran($jumlahKehadiran)
    {
        return $jumlahKehadiran * 25000;
    }

    private function hitungTunjanganLembur($jumlahHariLembur, $tarifLemburPerHari)
    {
        return $jumlahHariLembur * $tarifLemburPerHari;
    }

    private function hitungPotonganPajak($totalPemasukan)
    {
        $pajak = Pajak::where('persentase', '>', 0)
            ->where('persentase', '<=', 100)
            ->orderBy('persentase', 'desc')
            ->first();

        if (!$pajak) {
            return 0;
        }

        return $totalPemasukan * ($pajak->persentase / 100);
    }

    private function simpanDetailGaji($gajiId, $namaKomponen, $jenisKomponen, $jumlah)
    {
        $komponenGaji = KomponenGaji::firstOrCreate(
            ['nama_komponen' => $namaKomponen],
            ['jenis' => $jenisKomponen]
        );

        $detailGaji = new DetailGaji();
        $detailGaji->id_gaji = $gajiId;
        $detailGaji->id_komponen = $komponenGaji->id_komponen;
        $detailGaji->jumlah = $jumlah;
        $detailGaji->save();
    }

    public function searchByPegawai($id_pegawai)
    {
        $gaji = Gaji::with(['pegawai', 'detailGaji.komponenGaji'])
                    ->where('id_pegawai', $id_pegawai)
                    ->orderBy('periode_tahun', 'desc')
                    ->orderBy('periode_bulan', 'desc')
                    ->get();

        if ($gaji->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada data gaji untuk pegawai ini'
            ], 404);
        }

        return response()->json($gaji);
    }
}