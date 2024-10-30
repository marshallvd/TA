<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\UserPelamar;
use App\Exports\PelamarExport;
use Maatwebsite\Excel\Facades\Excel;

class PelamarController extends Controller
{
    public function index(Request $request)
    {
        $query = UserPelamar::query();

        // Filter berdasarkan status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Search berdasarkan nama atau email
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Sorting - Ubah created_at menjadi tanggal_dibuat
        $sortField = $request->get('sort', 'tanggal_dibuat'); // Ubah default sort field
        $sortOrder = $request->get('order', 'desc');
        
        // Pastikan field sorting ada di tabel
        $allowedSortFields = ['tanggal_dibuat', 'tanggal_diperbarui', 'nama', 'email']; // tambahkan field yang diizinkan
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'tanggal_dibuat'; // default ke tanggal_dibuat jika field tidak valid
        }
        
        $query->orderBy($sortField, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 10);
        
        return response()->json([
            'status' => 'success',
            'data' => $query->paginate($perPage)
        ]);
    }

    public function show($id)
    {
        $pelamar = UserPelamar::with(['lamaran.lowongan', 'lamaran.wawancara'])
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $pelamar
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
            'keterangan' => 'nullable|string'
        ]);

        $pelamar = Pelamar::findOrFail($id);
        $pelamar->status = $request->status;
        $pelamar->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status pelamar berhasil diupdate',
            'data' => $pelamar
        ]);
    }

    public function statistics()
    {
        $totalPelamar = UserPelamar::count();
        $pelamarAktif = UserPelamar::where('status', 'active')->count();
        
        $pelamarPerPosisi = UserPelamar::join('lamaran', 'pelamar.id', '=', 'lamaran.pelamar_id')
            ->join('lowongan', 'lamaran.lowongan_id', '=', 'lowongan.id')
            ->selectRaw('lowongan.posisi, count(*) as total')
            ->groupBy('lowongan.posisi')
            ->get();

        $pelamarPerStatus = UserPelamar::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->get()
            ->pluck('total', 'status');

        return response()->json([
            'status' => 'success',
            'data' => [
                'total_pelamar' => $totalPelamar,
                'pelamar_aktif' => $pelamarAktif,
                'pelamar_per_posisi' => $pelamarPerPosisi,
                'pelamar_per_status' => $pelamarPerStatus
            ]
        ]);
    }

    public function export(Request $request)
    {
        $format = $request->get('format', 'excel');
        
        return Excel::download(new PelamarExport, 'pelamar.' . ($format == 'excel' ? 'xlsx' : 'csv'));
    }

    public function update(Request $request, $id)
    {
        $pelamar = UserPelamar::findOrFail($id);
        
        $dataTervalidasi = $request->validate([
            'nama' => 'string|max:255',
            'email' => 'email|unique:tb_user_pelamar,email,'.$id.',id_pelamar|max:255',
            'status_lamaran' => 'in:dikirim,dijadwalkan,diterima,ditolak'
        ]);

        if ($request->has('password')) {
            $dataTervalidasi['password'] = bcrypt($request->password);
        }

        $pelamar->update($dataTervalidasi);
        
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Data pelamar berhasil diperbarui',
            'data' => $pelamar
        ]);
    }

    public function destroy($id)
    {
        $pelamar = UserPelamar::findOrFail($id);
        $pelamar->delete();
        
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Data pelamar berhasil dihapus'
        ]);
    }
}
