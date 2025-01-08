<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function indexPegawai()
    {
        return view('laporan.pegawai.index');
    }

    public function indexPenggajian()
    {
        return view('laporan.penggajian.index');
    }

    public function indexPenilaianKinerja()
    {
        return view('laporan.penilaian_kinerja.index');
    }

    public function indexRekrutmen()
    {
        return view('laporan.rekrutmen.index');
    }

    public function indexCuti()
    {
        return view('laporan.cuti.index');
    }
}