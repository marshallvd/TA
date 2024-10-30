<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Gaji;
use App\Models\Cuti;
use App\Models\UserPelamar;
use App\Models\Divisi;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getStats()
    {
        try {
            $stats = [
                'total_pegawai' => Pegawai::count(),
                'total_gaji' => Gaji::count(),
                'total_cuti' => Cuti::count(),
                'total_pelamar' => UserPelamar::count(),
                'pegawai_aktif' => Pegawai::where('status', 'aktif')->count(),
                'cuti_pending' => Cuti::where('status', 'pending')->count(),
                'pelamar_baru' => UserPelamar::where('created_at', '>=', now()->subDays(7))->count(),
                'total_divisi' => Divisi::count()
            ];

            return response()->json($stats);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengambil data statistik',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getChartData()
    {
        try {
            // Data pegawai per divisi
            $pegawaiPerDivisi = Pegawai::select('tb_divisi.nama_divisi', DB::raw('count(*) as total'))
                ->join('tb_divisi', 'tb_pegawai.id_divisi', '=', 'tb_divisi.id_divisi')
                ->groupBy('tb_divisi.id_divisi', 'tb_divisi.nama_divisi')
                ->get();

            // Data status cuti
            $statusCuti = Cuti::select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get();

            // Data pelamar per bulan
            $pelamarPerBulan = UserPelamar::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('count(*) as total')
            )
                ->whereYear('created_at', date('Y'))
                ->groupBy('bulan')
                ->get();

            $chartData = [
                'pegawaiPerDivisi' => [
                    'labels' => $pegawaiPerDivisi->pluck('nama_divisi'),
                    'datasets' => [[
                        'label' => 'Jumlah Pegawai per Divisi',
                        'data' => $pegawaiPerDivisi->pluck('total'),
                        'backgroundColor' => [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        'borderColor' => [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        'borderWidth' => 1
                    ]]
                ],
                'statusCuti' => [
                    'labels' => $statusCuti->pluck('status'),
                    'datasets' => [[
                        'label' => 'Status Cuti',
                        'data' => $statusCuti->pluck('total'),
                        'backgroundColor' => [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        'borderColor' => [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                        ],
                        'borderWidth' => 1
                    ]]
                ],
                'pelamarPerBulan' => [
                    'labels' => $pelamarPerBulan->pluck('bulan')->map(function($bulan) {
                        return date ('F', mktime(0, 0, 0, $bulan, 1));
                    }),
                    'datasets' => [[
                        'label' => 'Pelamar per Bulan',
                        'data' => $pelamarPerBulan->pluck('total'),
                        'backgroundColor' => [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                        ],
                        'borderColor' => [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                        ],
                        'borderWidth' => 1
                    ]]
                ]
            ];

            return response()->json($chartData);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengambil data chart',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}