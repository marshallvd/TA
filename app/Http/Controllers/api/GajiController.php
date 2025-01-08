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
        \Log::info("Fetching gaji with ID: $id");
        try {
            $gaji = Gaji::with(['pegawai', 'detailGaji.komponenGaji'])->find($id);
            
            if (!$gaji) {
                \Log::warning("Gaji not found for ID: $id");
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data gaji tidak ditemukan'
                ], 404);
            }
            
            // Cast periode_bulan to string if needed
            $gaji->periode_bulan = (string)$gaji->periode_bulan;
            
            return response()->json([
                'status' => 'success',
                'data' => $gaji,
                'message' => 'Data gaji berhasil ditemukan'
            ]);
        } catch (\Exception $e) {
            \Log::error("Error in show gaji: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengambil data gaji'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'id_pegawai' => 'required|exists:tb_pegawai,id_pegawai',
                'id_divisi' => 'required|exists:tb_divisi,id_divisi',
                'periode_tahun' => 'required|digits:4',
                'periode_bulan' => 'required|digits_between:1,2|min:1|max:12',
                'jumlah_kehadiran' => 'required|integer|min:0',
                'jumlah_hari_lembur' => 'required|integer|min:0',
                'gaji_pokok' => 'required|numeric|min:0',
                'insentif' => 'required|numeric|min:0',
                'bonus_kehadiran' => 'required|numeric|min:0',
                'tunjangan_lembur' => 'required|numeric|min:0',
                'total_pendapatan' => 'required|numeric|min:0',
                'potongan_pajak' => 'required|numeric|min:0',
                'potongan_bpjs' => 'required|numeric|min:0',
                'gaji_bersih' => 'required|numeric|min:0',
            ]);
    
            $gaji = Gaji::findOrFail($id);
            
            // Update data
            $gaji->update($request->all());
    
            return response()->json([
                'status' => 'success',
                'message' => 'Data gaji berhasil diupdate',
                'data' => $gaji
            ]);
    
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengupdate gaji',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
        {
            DB::beginTransaction();
            try {
                // Find the salary record
                $gaji = Gaji::findOrFail($id);

                // Delete related DetailGaji records first
                DetailGaji::where('id_gaji', $id)->delete();

                // Delete the main Gaji record
                $gaji->delete();

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Data gaji berhasil dihapus'
                ]);

            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                DB::rollBack();
                Log::error('Gaji not found: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data gaji tidak ditemukan'
                ], 404);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Error deleting gaji: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal menghapus data gaji: ' . $e->getMessage()
                ], 500);
            }
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
            $potonganBPJS = 200000; // Potongan BPJS tetap
            
            // Hitung total potongan
            $totalPotongan = $potonganPajak + $potonganBPJS;
        
            // Hitung gaji bersih
            $gajiBersih = $totalPemasukan - $totalPotongan;
        
            // Simpan atau update data gaji
            $gaji = $existingGaji ?? new Gaji();
            $gaji->id_pegawai = $request->id_pegawai;
            $gaji->periode_bulan = $periodeDate->format('m');
            $gaji->periode_tahun = $periodeDate->format('Y');
            $gaji->jumlah_kehadiran = $request->jumlah_kehadiran;
            $gaji->jumlah_hari_lembur = $request->jumlah_hari_lembur;
            $gaji->total_pendapatan = $totalPemasukan; // Simpan total pendapatan
            $gaji->total_potongan = $totalPotongan; // Simpan total potongan
            $gaji->gaji_bersih = $gajiBersih; // Simpan gaji bersih
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
            // Tambahkan log untuk debugging
            \Log::info('Mencari Penilaian Kinerja', [
                'id_pegawai' => $pegawai->id_pegawai,
                'periode' => $periode->format('Y')
            ]);
        
            $penilaianKinerja = PenilaianKinerja::where('id_pegawai', $pegawai->id_pegawai)
            ->where('periode_penilaian', $periode->format('Y-m')) // Cocokkan dengan format YYYY-MM
            ->first();
        
            // Tambahkan pengecekan null
            if (!$penilaianKinerja) {
                \Log::warning('Tidak ada penilaian kinerja ditemukan', [
                    'id_pegawai' => $pegawai->id_pegawai,
                    'periode' => $periode->format('Y')
                ]);
                return 0;
            }
        
            // Tambahkan pengecekan predikat
            if (!$penilaianKinerja->predikat) {
                \Log::warning('Predikat tidak ditemukan', [
                    'penilaian_kinerja' => $penilaianKinerja
                ]);
                return 0;
            }
        
            $persentaseInsentif = 0;
            switch (strtolower($penilaianKinerja->predikat)) {
                case 'sangat baik':
                    $persentaseInsentif = 0.15;
                    break;
                case 'baik':
                    $persentaseInsentif = 0.10;
                    break;
                case 'cukup':
                    $persentaseInsentif = 0.05;
                    break;
                case 'kurang':
                    $persentaseInsentif = 0.02;
                    break;
                case 'sangat kurang':
                    $persentaseInsentif = 0.00;
                    break;
                default:
                    \Log::warning('Predikat tidak dikenali', [
                        'predikat' => $penilaianKinerja->predikat
                    ]);
                    return 0;
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

    // private function hitungPotonganPajak($totalPemasukan)
    // {
    //     $pajak = Pajak::where('persentase', '>', 0)
    //         ->where('persentase', '<=', 100)
    //         ->orderBy('persentase', 'desc')
    //         ->first();

    //     if (!$pajak) {
    //         return 0;
    //     }

    //     return $totalPemasukan * ($pajak->persentase / 100);
    // }
    private function hitungPotonganPajak($totalPemasukan)
{
    return $totalPemasukan * 0.10; // Pajak tetap 10%
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

    public function getGajiStatus(Request $request)
    {
        try {
            $periode = $request->query('periode', Carbon::now()->format('Y-m'));
            
            list($tahun, $bulan) = explode('-', $periode);
            
            $pegawai = Pegawai::with(['jabatan', 'penilaianKinerja' => function($query) use ($periode) {
                $query->where('periode_penilaian', $periode)
                    ->orderBy('tanggal_dibuat', 'desc');
            }])
            ->get();
            
            $result = $pegawai->map(function ($p) use ($bulan, $tahun, $periode) {
                // Cari penilaian kinerja yang spesifik untuk periode ini
                $penilaian = $p->penilaianKinerja->first();
                
                $gaji = Gaji::where('id_pegawai', $p->id_pegawai)
                    ->where('periode_bulan', $bulan)
                    ->where('periode_tahun', $tahun)
                    ->first();
                
                return [
                    'id_pegawai' => $p->id_pegawai,
                    'nama_lengkap' => $p->nama_lengkap,
                    'periode_gaji' => $periode,
                    // Pastikan penilaian benar-benar ada untuk periode yang diminta
                    'status_penilaian' => $penilaian !== null && $penilaian->periode_penilaian === $periode,
                    'id_gaji' => $gaji ? $gaji->id_gaji : null,
                    'jumlah_kehadiran' => $gaji ? $gaji->jumlah_kehadiran : null,
                    'jumlah_hari_lembur' => $gaji ? $gaji->jumlah_hari_lembur : null,
                    'total_pendapatan' => $gaji ? $gaji->total_pendapatan : null,
                    'total_potongan' => $gaji ? $gaji->total_potongan : null,
                    'gaji_bersih' => $gaji ? $gaji->gaji_bersih : null
                ];
            });
    
            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Error in getGajiStatus: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data gaji: ' . $e->getMessage()
            ], 500);
        }
    }

    public function pribadi()
{
    // Dapatkan user yang sedang login
    $user = Auth::user();

    // Cari pegawai berdasarkan user_id
    $pegawai = Pegawai::where('user_id', $user->id)->first();

    if (!$pegawai) {
        return redirect()->back()->with('error', 'Data pegawai tidak ditemukan');
    }

    // Kirim ID pegawai ke view
    return view('penilaian_kinerja.pribadi', [
        'id_pegawai' => $pegawai->id_pegawai
    ]);
}

}