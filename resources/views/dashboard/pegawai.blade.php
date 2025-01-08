@extends('layouts.master')

@section('title', 'Dashboard Pegawai')

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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex flex-column text-center align-items-center justify-content-between ">
                                    <div class="fs-italic">
                                        <h5> Regina Miles</h5>
                                        <div class="text-muted-50 mb-1">
                                            <small>Trainer Expert</small>
                                        </div>
                                    </div>	
                                    <div class="text-black-50 text-warning">
                                        <svg class="icon-20"  xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="orange">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="orange">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="orange">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="gary">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="gary">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                    <div class="card-profile-progress">
                                        <div id="circle-progress-1" class="circle-progress  circle-progress-basic circle-progress-primary" data-min-value="0" data-max-value="100" data-value="80" data-type="percent"></div>
                                        <img src="../../assets/images/avatars/01.png" alt="User-Profile" class="theme-color-default-img img-fluid rounded-circle card-img">
                                        <img src="../../assets/images/avatars/avtar_1.png" alt="User-Profile" class="theme-color-purple-img img-fluid rounded-circle card-img">
                                        <img src="../../assets/images/avatars/avtar_2.png" alt="User-Profile" class="theme-color-blue-img img-fluid rounded-circle card-img">
                                        <img src="../../assets/images/avatars/avtar_4.png" alt="User-Profile" class="theme-color-green-img img-fluid rounded-circle card-img">
                                        <img src="../../assets/images/avatars/avtar_5.png" alt="User-Profile" class="theme-color-yellow-img img-fluid rounded-circle card-img">
                                        <img src="../../assets/images/avatars/avtar_3.png" alt="User-Profile" class="theme-color-pink-img img-fluid rounded-circle card-img">  
                                    </div>
                                    <div class="mt-3 text-center text-muted-50">
                                        <p>Slate helps you see how many more days you need</p>
                                    </div>
                                    <div class="d-flex icon-pill">
                                        <a href="#" class="btn btn-sm rounded-pill px-2 py-2 ms-2">
                                            <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="#" class="btn btn-sm rounded-pill px-2 py-2  ms-2">
                                            <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="20" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                            </svg>
                                        </a>
                                        <a href="#" class="btn btn-sm rounded-pill px-2 py-2 ms-2">
                                            <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" class="text-success" width="20" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
                <!-- Right Column -->
    <div class="col-md-6">
        <!-- First Row - Cuti and Penilaian -->
        <div class="row g-4">
            <!-- Cuti Widget -->
            <div class="col-md-6">
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
            <div class="col-md-6">
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
            <div class="col-12">
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
        </div>

            <!-- Dashboard Widgets -->
            {{-- <div class="row g-4">
                <!-- Pegawai Widget -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <i class="bi bi-people-fill text-primary fs-3 me-2"></i>
                                    <span class="text-muted text-uppercase small">Pegawai</span>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    Go <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="mb-1">0</h2>
                                    <small class="text-success">
                                        <i class="bi bi-graph-up-arrow"></i> +0 bulan ini
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pelamar Widget -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <i class="bi bi-person-plus-fill text-success fs-3 me-2"></i>
                                    <span class="text-muted text-uppercase small">Pelamar</span>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-success">
                                    Go <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="mb-1">0</h2>
                                    <small class="text-success">
                                        <i class="bi bi-graph-up-arrow"></i> +0 bulan ini
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Divisi Widget -->
                {{-- <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <i class="bi bi-building-fill text-info fs-3 me-2"></i>
                                    <span class="text-muted text-uppercase small">Divisi</span>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-info">
                                    Go <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="mb-1">0</h2>
                                    <small class="text-success">
                                        <i class="bi bi-graph-up-arrow"></i> +0 bulan ini
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Jabatan Widget -->
                {{-- <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <i class="bi bi-briefcase-fill text-warning fs-3 me-2"></i>
                                    <span class="text-muted text-uppercase small">Jabatan</span>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-warning">
                                    Go <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="mb-1">0</h2>
                                    <small class="text-success">
                                        <i class="bi bi-graph-up-arrow"></i> +0 bulan ini
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Cuti Widget -->
                {{-- <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <i class="bi bi-calendar2-check-fill text-primary fs-3 me-2"></i>
                                    <span class="text-muted text-uppercase small">Cuti</span>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    Go <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="mb-1">0</h2>
                                    <small class="text-success">
                                        <i class="bi bi-graph-up-arrow"></i> +0 bulan ini
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Penilaian Kinerja Widget -->
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <i class="bi bi-calendar2-check-fill text-primary fs-3 me-2"></i>
                                    <span class="text-muted text-uppercase small">Penilaian Kinerja</span>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-success">
                                    Go <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="mb-1">0</h2>
                                    <small class="text-success">
                                        <i class="bi bi-graph-up-arrow"></i> +0 bulan ini
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gaji Widget -->
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <i class="bi bi-cash-coin text-info fs-3 me-2"></i>
                                    <span class="text-muted text-uppercase small">Gaji</span>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-info">
                                    Go <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="mb-1">0</h2>
                                    <small class="text-success">
                                        <i class="bi bi-graph-up-arrow"></i> +0 bulan ini
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rekrutmen Widget -->
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <i class="bi bi-person-lines-fill text-warning fs-3 me-2"></i>
                                    <span class="text-muted text-uppercase small">Rekrutmen</span>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-warning">
                                    Go <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="mb-1">0</h2>
                                    <small class="text-success">
                                        <i class="bi bi-graph-up-arrow"></i> +0 bulan ini
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">


@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const baseUrl = 'http://127.0.0.1:8000/api';
    let pegawaiId = null;

    // Fungsi render bintang
    function renderStars(score) {
        const maxStars = 5;
        const fullStars = Math.floor(score);
        const halfStar = score % 1 >= 0.5 ? 1 : 0;
        const emptyStars = maxStars - fullStars - halfStar;

        let starsHTML = '';

        // Render full stars
        for (let i = 0; i < fullStars; i++) {
            starsHTML += `
                <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="orange">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
            `;
        }

        // Render half star if needed
        if (halfStar) {
            starsHTML += `
                <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="orange">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" 
                          clip-path="polygon(0 0, 50% 0, 50% 100%, 0 100%)"/>
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" 
                          clip-path="polygon(50% 0, 100% 0, 100% 100%, 50% 100%)" fill="gray"/>
                </svg>
            `;
        }

        // Render empty stars
        for (let i = 0; i < emptyStars; i++) {
            starsHTML += `
                <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 20 20" fill="gray">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
            `;
        }

        return starsHTML;
    }

    // Fungsi untuk fetch data user dan inisialisasi widget
    async function initializeDashboard() {
        try {
            const response = await fetch(`${baseUrl}/auth/me`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const userData = await response.json();
            
            // Validate user data structure
            if (!userData || !userData.pegawai || !userData.pegawai.id_pegawai) {
                throw new Error('Invalid user data structure received from server');
            }

            pegawaiId = userData.pegawai.id_pegawai;

            // Store user data with timestamp
            const userDataWithTimestamp = {
                data: userData,
                timestamp: new Date().getTime(),
                version: '1.0' // Add version for future compatibility
            };

            localStorage.setItem('user_data', JSON.stringify(userDataWithTimestamp));

            // Initialize widgets only after confirming valid data
            await initializeWidgets(pegawaiId);
            await fetchUserPerformance();

        } catch (error) {
            console.error('Initialization Error:', error);
            handleError(error);
        }
    }

    // Fungsi untuk inisialisasi widget
    function initializeWidgets(pegawaiId) {
        // Widget Cuti
        fetchWidgetData(`${baseUrl}/cuti`, 'cuti-count', pegawaiId);
        
        // Widget Penilaian Kinerja
        fetchWidgetData(`${baseUrl}/penilaian-kinerja`, 'penilaian-count', pegawaiId);
        
        // Widget Gaji
        fetchWidgetData(`${baseUrl}/gaji`, 'gaji-count', pegawaiId);
    }

    // Fungsi umum untuk fetch data widget
    async function fetchWidgetData(url, elementId, pegawaiId) {
        try {
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) { throw new Error(`Gagal mengambil data ${elementId}`);
            }

            const data = await response.json();
            
            // Filter data berdasarkan ID Pegawai
            let count = 0;
            if (data.data && Array.isArray(data.data)) {
                count = data.data.filter(item => 
                    item.id_pegawai === pegawaiId
                ).length;
            }

            // Update widget
            const element = document.getElementById(elementId);
            if (element) {
                element.textContent = count;
            }

        } catch (error) {
            console.error(`Error fetching ${elementId}:`, error);
            const element = document.getElementById(elementId);
            if (element) {
                element.textContent = '0';
            }
        }
    }

    // Fungsi untuk menampilkan performance card
    async function fetchUserPerformance() {
    try {
        const storedUserData = localStorage.getItem('user_data');
        if (!storedUserData) {
            throw new Error('No stored user data found');
        }

        const parsedData = JSON.parse(storedUserData);
        const pegawaiData = parsedData.data.pegawai;
        
        console.log('Pegawai ID:', pegawaiData.id_pegawai);

        // Fetch performance data
        const performanceResponse = await fetch(`${baseUrl}/penilaian-kinerja`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        if (!performanceResponse.ok) {
            throw new Error('Failed to fetch performance data');
        }

        const performanceData = await performanceResponse.json();
        console.log('All Performance Data:', performanceData.data);

        // Filter performance data for current employee
        const employeePerformances = performanceData.data.filter(p => p.id_pegawai === pegawaiData.id_pegawai);
        console.log('Employee Performances:', employeePerformances);

        // Sort performances by period in descending order to get the latest
        const sortedPerformances = employeePerformances.sort((a, b) => {
            // Convert period to Date for proper comparison
            const dateA = new Date(a.periode_penilaian + '-01');
            const dateB = new Date(b.periode_penilaian + '-01');
            return dateB - dateA;
        });

        // Select the most recent performance entry
        const latestPerformance = sortedPerformances[0];
        console.log('Latest Performance:', latestPerformance);

        // Fetch jabatan data
        const jabatanResponse = await fetch(`${baseUrl}/jabatan`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        if (!jabatanResponse.ok) {
            throw new Error('Failed to fetch jabatan data');
        }

        const jabatanData = await jabatanResponse.json();
        const userJabatan = jabatanData.find(j => j.id_jabatan === pegawaiData.id_jabatan);
        
        console.log('User  Jabatan:', userJabatan);

        // Update UI with latest performance data
        updatePerformanceCard({
            nama: pegawaiData.nama_lengkap,
            jabatan: userJabatan ? userJabatan.nama_jabatan : 'Posisi belum ditentukan'
        }, latestPerformance);

    } catch (error) {
        console.error('Performance fetch error:', error);
        updatePerformanceCard({
            nama: 'Memuat data...',
            jabatan: 'Memuat data...'
        }, null);
        
        setTimeout(initializeDashboard, 3000);
    }
}

// Remove the duplicate updatePerformanceCard function and keep only this version
function updatePerformanceCard(userData, performance) {
    console.log('Updating Performance Card:', { userData, performance });
    
    // Update name and position
    const nameElement = document.querySelector('.fs-italic h5');
    const positionElement = document.querySelector('.fs-italic .text-muted-50 small');
    if (nameElement) {
        nameElement.textContent = userData.nama;
    }
    if (positionElement) {
        positionElement.textContent = userData.jabatan;
    }

    // Calculate and update stars
    const score = performance?.nilai_akhir ? parseFloat(performance.nilai_akhir) : 0;
    console.log('Performance Score:', score);
    const starsContainer = document.querySelector('.text-black-50.text-warning');
    if (starsContainer) {
        starsContainer.innerHTML = renderStars(score);
    }

    // Update circle progress
    const circleProgress = document.getElementById('circle-progress-1');
    if (circleProgress) {
        circleProgress.setAttribute('data-value', Math.round(score * 20)); // Convert 5-point scale to percentage
    }

    // Update predicate text with period information
    const predicateElement = document.querySelector('.mt-3.text-center.text-muted-50 p');
    if (predicateElement) {
        if (performance && performance.periode_penilaian) {
            try {
                // Parse the period string (format: "YYYY-MM")
                const [year, month] = performance.periode_penilaian.split('-').map(num => parseInt(num));
                const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                                  'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                
                // Ensure month index is valid (0-11)
                const monthIndex = month - 1;
                if (monthIndex >= 0 && monthIndex < 12) {
                    const displayText = `${performance.predikat} - Periode ${monthNames[monthIndex]} ${year}`;
                    console.log('Setting predicate text:', displayText);
                    predicateElement.textContent = displayText;
                } else {
                    throw new Error('Invalid month index');
                }
            } catch (error) {
                console.error('Error parsing period:', error);
                predicateElement.textContent = 'Format periode tidak valid';
            }
        } else {
            console.log('No performance data available');
            predicateElement.textContent = 'Belum ada penilaian untuk periode ini';
        }
    }

    // Log the actual values for debugging
    console.log('Period:', performance?.periode_penilaian);
    console.log('Predicate:', performance?.predikat);
}

    // Fungsi untuk menangani error
    function handleError(error) {
        let errorMessage = 'Terjadi kesalahan yang tidak diketahui';
        
        if (error.message.includes('Unauthorized')) {
            errorMessage = 'Sesi Anda telah berakhir. Silakan login kembali.';
            localStorage.clear(); // Clear all stored data
            setTimeout(() => window.location.href = '/login', 2000);
        } else if (error.message.includes('Invalid user data')) {
            errorMessage = 'Data pengguna tidak valid. Sistem akan mencoba memuat ulang.';
            localStorage.removeItem('user_data'); // Clear only user data
            setTimeout(initializeDashboard, 2000);
        } else if (error.message.includes('Failed to fetch')) {
            errorMessage = 'Gagal terhubung ke server. Periksa koneksi internet Anda.';
        }

        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: errorMessage,
            confirmButtonText: 'OK'
        });
    }

    // Validasi token
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Anda harus login untuk mengakses halaman ini.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/login';
        });
        return;
    }

    // Mulai inisialisasi dashboard
    initializeDashboard();
    fetchUserPerformance();
});
</script>
@endpush