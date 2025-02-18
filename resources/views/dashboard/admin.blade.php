@extends('layouts.master')

@section('title', 'Dashboard Admin')

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
                            <a href="{{ route('laporan.pegawai.index') }}" class="btn btn-light text-primary">
                                <i class="bi bi-file-earmark-text me-2"></i>Laporan Pegawai
                            </a>
                        </div>
                        <div class="col-md-6 text-end">
                            <img src="{{ asset('assets/images/dashboard/d1.png') }}" 
                                alt="Logo HRMS SEB" 
                                class="img-fluid" 
                                style="max-width: 100%; height: auto; max-height: 800px; object-fit: contain;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Widgets -->
            <div class="row g-4" id="dashboard-widgets">
                <!-- Pegawai Widget -->
                <div class="col-md-3">
                    <div class="card widget-card border-0 shadow-lg overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="widget-icon bg-primary-gradient text-white rounded-circle">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <a href="{{ route('pegawai.index') }}" class="btn btn-sm btn-outline-primary stretched-link">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted text-uppercase small mb-2">Total Pegawai</h6>
                                    <h2 class="mb-0 fw-bold" id="pegawai-count">0</h2>
                                </div>
                                <div class="widget-trend text-success">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pelamar Widget -->
                <div class="col-md-3">
                    <div class="card widget-card border-0 shadow-lg overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="widget-icon bg-success-gradient text-white rounded-circle">
                                    <i class="bi bi-person-plus-fill"></i>
                                </div>
                                <a href="{{ route('pelamar.index') }}" class="btn btn-sm btn-outline-success stretched-link">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted text-uppercase small mb-2">Total Pelamar</h6>
                                    <h2 class="mb-0 fw-bold" id="pelamar-count">0</h2>
                                </div>
                                <div class="widget-trend text-success">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divisi Widget -->
                <div class="col-md-3">
                    <div class="card widget-card border-0 shadow-lg overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="widget-icon bg-info-gradient text-white rounded-circle">
                                    <i class="bi bi-building-fill"></i>
                                </div>
                                <a href="{{ route('master_data.divisi.index') }}" class="btn btn-sm btn-outline-info stretched-link">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted text-uppercase small mb-2">Total Divisi</h6>
                                    <h2 class="mb-0 fw-bold" id="divisi-count">0</h2>
                                </div>
                                <div class="widget-trend text-info">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jabatan Widget -->
                <div class="col-md-3">
                    <div class="card widget-card border-0 shadow-lg overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="widget-icon bg-warning-gradient text-white rounded-circle">
                                    <i class="bi bi-briefcase-fill"></i>
                                </div>
                                <a href="{{ route('master_data.jabatan.index') }}" class="btn btn-sm btn-outline-warning stretched-link">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted text-uppercase small mb-2">Total Jabatan</h6>
                                    <h2 class="mb-0 fw-bold" id="jabatan-count">0</h2>
                                </div>
                                <div class="widget-trend text-warning">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cuti Widget -->
                <div class="col-md-3">
                    <div class="card widget-card border-0 shadow-lg overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items- center mb-3">
                                <div class="widget-icon bg-primary-gradient text-white rounded-circle">
                                    <i class="bi bi-calendar2-check-fill"></i>
                                </div>
                                <a href="{{ route('cuti.index') }}" class="btn btn-sm btn-outline-primary stretched-link">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted text-uppercase small mb-2">Total Cuti</h6>
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
                <div class="col-md-3">
                    <div class="card widget-card border-0 shadow-lg overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="widget-icon bg-success-gradient text-white rounded-circle">
                                    <i class="bi bi-calendar2-check-fill"></i>
                                </div>
                                <a href="{{ route('penilaian_kinerja.index') }}" class="btn btn-sm btn-outline-success stretched-link">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted text-uppercase small mb-2">Total Penilaian</h6>
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
                <div class="col-md-3">
                    <div class="card widget-card border-0 shadow-lg overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="widget-icon bg-info-gradient text-white rounded-circle">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                                <a href="{{ route('gaji.index') }}" class="btn btn-sm btn-outline-info stretched-link">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted text-uppercase small mb-2">Total Gaji</h6>
                                    <h2 class="mb-0 fw-bold" id="gaji-count">0</h2>
                                </div>
                                <div class="widget-trend text-info">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rekrutmen Widget -->
                <div class="col-md-3">
                    <div class="card widget-card border-0 shadow-lg overflow-hidden">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="widget-icon bg-warning-gradient text-white rounded-circle">
                                    <i class="bi bi-person-lines-fill"></i>
                                </div>
                                <a href="{{ route('rekrutmen.lamaran.index') }}" class="btn btn-sm btn-outline-warning stretched-link">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted text-uppercase small mb-2">Total Lamaran</h6>
                                    <h2 class="mb-0 fw-bold" id="lamaran-count">0</h2>
                                </div>
                                <div class="widget-trend text-warning">
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

@push('scripts')
<script>
async function fetchData(url, elementId) {
    try {
        const token = localStorage.getItem('token');
        
        if (! token) {
            console.error('No token found');
            document.getElementById(elementId).innerText = '0';
            return;
        }

        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        console.log(`Response for ${elementId}:`, response);

        if (!response.ok) {
            const errorText = await response.text();
            console.error(`HTTP error for ${elementId}! status: ${response.status}`, errorText);
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        
        console.log(`Data for ${elementId}:`, data);

        // Logika khusus untuk setiap endpoint
        let count = 0;
        if (elementId === 'lamaran-count') {
            count = data.data?.data?.length || 0;
        } else if (elementId === 'pelamar-count') {
            count = data.data?.data?.length || 0;
        } else if (Array.isArray(data)) {
            count = data.length;
        } else if (data.data && Array.isArray(data.data)) {
            count = data.data.length;
        } else if (data.data && data.data.data && Array.isArray(data.data.data)) {
            count = data.data.data.length;
        }

        console.log(`Count for ${elementId}:`, count);
        
        document.getElementById(elementId).innerText = count;
    } catch (error) {
        console.error(`Error fetching data for ${elementId}:`, error);
        document.getElementById(elementId).innerText = '0';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const token = localStorage.getItem('token');
    
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Sesi Habis',
            text: 'Silakan login kembali',
            confirmButtonText: 'Login'
        }).then(() => {
            window.location.href = '/login';
        });
        return;
    }

    fetchData('/api/pegawai', 'pegawai-count');
    fetchData('/api/pelamar', 'pelamar-count');
    fetchData('/api/divisi', 'divisi-count');
    fetchData('/api/jabatan', 'jabatan-count');
    fetchData('/api/cuti', 'cuti-count');
    fetchData('/api/penilaian-kinerja', 'penilaian-count');
    fetchData('/api/gaji', 'gaji-count');
    fetchData('/api/admin/lamaran', 'lamaran-count');
});
</script>
@endpush

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .widget-card {
        transition: all 0.3s ease;
        transform: translateY(0);
    }

    .widget-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }

    .widget-icon {
        position: absolute;
        top: -20px;
        right: -20px;
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        opacity: 0.7;
        z-index: 1;
    }

    .bg-primary-gradient {
        background: linear-gradient(45deg, #007bff, #00c6ff);
    }

    .bg-success-gradient {
        background: linear-gradient(45deg, #28a745, #00ff87);
    }

    .bg-info-gradient {
        background: linear-gradient(45deg, #17a2b8, #00f2ff);
    }

    .bg-warning-gradient {
        background: linear-gradient(45deg, #ffc107, #ffeb3b);
    }

    .widget-trend {
        font-size: 1.2rem;
    }
</style>
@endpush

@endsection