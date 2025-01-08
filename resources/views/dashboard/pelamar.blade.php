@extends('layouts.pelamar_master')

@section('title', 'Dashboard Pelamar')

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <!-- Welcome Card with Background -->
            <div class="card mb-4 overflow-hidden" style="background: linear-gradient(to right, #ffffff 0%, #ffffff 100%);">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2 class="fw-bold mb-3">Selamat datang di HRMS SEB</h2>
                            <p class="text-muted" style="color: rgba(0,0,0,0.7);">
                                HRMS SEB adalah sistem manajemen sumber daya manusia yang dirancang untuk membantu 
                                organisasi dalam mengelola data karyawan, proses rekrutmen, penilaian kinerja, 
                                pengelolaan cuti, dan penggajian. 
                            </p>
                        </div>
                        <div class="col-md-6 text-end">
                            <img src="{{ asset('assets/images/icon.png') }}" 
                                alt="Logo HRMS SEB" 
                                class="img-fluid" 
                                style="max-width: 100%; height: auto; max-height: 800px; object-fit: contain;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Widgets -->
            <div class="row g-4" id="dashboard-widgets">

                <!-- Cuti Widget -->
                <div class="col-md-4">
                    <div class="card widget-card border-0 shadow-lg overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items- center mb-3">
                                <div class="widget-icon bg-primary-gradient text-white rounded-circle">
                                    <i class="bi bi-calendar2-check-fill"></i>
                                </div>
                                <a href="{{ route('rekrutmen.lamaran.pribadi') }}" class="btn btn-sm btn-outline-primary stretched-link">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted text-uppercase small mb-2">Lamaran</h6>
                                    <h2 class="mb-0 fw-bold" id="cuti-count">0</h2>
                                </div>
                                <div class="widget-trend text-success">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Penilaian Kinerja Widget -->
                <div class="col-md-4">
                    <div class="card widget-card border-0 shadow-lg overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="widget-icon bg-success-gradient text-white rounded-circle">
                                    <i class="bi bi-calendar2-check-fill"></i>
                                </div>
                                <a href="{{ route('rekrutmen.wawancara.pribadi') }}" class="btn btn-sm btn-outline-success stretched-link">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted text-uppercase small mb-2">Wawancara</h6>
                                    <h2 class="mb-0 fw-bold" id="penilaian-count">0</h2>
                                </div>
                                <div class="widget-trend text-success">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gaji Widget -->
                <div class="col-md-4">
                    <div class="card widget-card border-0 shadow-lg overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="widget-icon bg-info-gradient text-white rounded-circle">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                                
                                <a href="{{ route('rekrutmen.hasil_seleksi.pribadi') }}" class="btn btn-sm btn-outline-info stretched-link">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted text-uppercase small mb-2">Hasil Seleksi</h6>
                                    <h2 class="mb-0 fw-bold" id="gaji-count">0</h2>
                                </div>
                                <div class="widget-trend text-info">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
    const token = localStorage.getItem('pelamar_token');
    
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Sesi Habis',
            text: 'Silakan login kembali',
            confirmButtonText: 'Login'
        }).then(() => {
            window.location.href = '/landing/login';
        });
        return;
    }

    try {
        // Ambil data pelamar untuk mendapatkan ID
        const pelamarResponse = await fetch('http://127.0.0.1:8000/api/pelamar/auth/me', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        if (!pelamarResponse.ok) {
            throw new Error('Gagal mengambil data pelamar');
        }

        const pelamarData = await pelamarResponse.json();
        const pelamarId = pelamarData.data.id_pelamar;

        // Fetch data lamaran
        const lamaranResponse = await fetch('http://127.0.0.1:8000/api/admin/lamaran', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        const lamaranData = await lamaranResponse.json();
        const lamaranCount = lamaranData.data.data.filter(
            lamaran => lamaran.id_pelamar === pelamarId
        ).length;
        document.getElementById('cuti-count').textContent = lamaranCount;

        // Fetch data wawancara
        const wawancaraResponse = await fetch('http://localhost:8000/api/public/wawancara', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        const wawancaraData = await wawancaraResponse.json();
        const wawancaraCount = wawancaraData.data.filter(
            wawancara => wawancara.id_pelamar === pelamarId
        ).length;
        document.getElementById('penilaian-count').textContent = wawancaraCount;

        // Fetch data hasil seleksi
        const hasilSeleksiResponse = await fetch('http://127.0.0.1:8000/api/public/hasil-seleksi', {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        const hasilSeleksiData = await hasilSeleksiResponse.json();
        const hasilSeleksiCount = hasilSeleksiData.data.filter(
            hasil => hasil.id_pelamar === pelamarId
        ).length;
        document.getElementById('gaji-count').textContent = hasilSeleksiCount;

    } catch (error) {
        console.error('Error fetching dashboard data:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Gagal memuat data dashboard. Silakan coba lagi.',
            confirmButtonText: 'OK'
        });

        // Set default values
        document.getElementById('cuti-count').textContent = '0';
        document.getElementById('penilaian-count').textContent = '0';
        document.getElementById('gaji-count').textContent = '0';
    }
});
    </script>
@endpush
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
@endpush