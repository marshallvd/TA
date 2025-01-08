@extends('layouts.app')
@extends('layouts.pelamar_master')

@section('title')
    Detail Lamaran Saya
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0" id="lamaran-detail-container" style="display: none;">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Detail Lamaran</h2></b>
                    <p class="card-text text-muted">Informasi lengkap lamaran Anda</p>
                </div>
                <div>
                    <i class="bi bi-1-circle-fill text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Loading Spinner --}}
    <div id="loading-spinner" class="text-center">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p>Memuat data lamaran...</p>
    </div>

    {{-- Error Container --}}
    <div id="error-container" class="alert alert-danger" style="display: none;"></div>

    {{-- Pelamar Information Card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Informasi Pelamar</h4>
                    <button type="button" class="btn btn-danger btn-sm" id="btnBack">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </button>
                </div>
                <div class="card-body">
                    <div class="row small">
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Nama:</strong></p>
                            <p class="text-muted" id="pelamar-nama"></p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Email:</strong></p>
                            <p class="text-muted" id="pelamar-email"></p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>No. HP:</strong></p>
                            <p class="text-muted" id="pelamar-telepon"></p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Alamat:</strong></p>
                            <p class="text-muted" id="pelamar-alamat"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Lamaran Details --}}
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Detail Lamaran</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Posisi yang Dilamar</label>
                                <h6 id="lowongan-judul"></h6>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Gaji Minimal</label>
                                <h6 id="lowongan-gaji-min"></h6>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Gaji Maksimal</label>
                                <h6 id="lowongan-gaji-max"></h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Status Lamaran</label>
                                <h6 id="lamaran-status"></h6>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Tanggal Lamaran</label>
                                <h6 id="lamaran-tanggal"></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CV Section --}}
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Dokumen Pendukung</h4>
                </div>
                <div class="card-body text-center" id="cv-section">
                    <p class="text-muted">Tidak ada CV tersedia</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ambil ID dari URL
    const pathParts = window.location.pathname.split('/');
    const lamaranId = pathParts[pathParts.length - 2];

    // Elemen-elemen yang akan diupdate
    const containerEl = document.getElementById('lamaran-detail-container');
    const loadingSpinner = document.getElementById('loading-spinner');
    const errorContainer = document.getElementById('error-container');

    // Fungsi untuk menampilkan error
    function showError(message) {
        console.error('Fetch Error:', message);
        loadingSpinner.style.display = 'none';
        errorContainer.textContent = message;
        errorContainer.style.display = 'block';
    }

    // Ambil token dari localStorage
    const pelamarToken = localStorage.getItem('pelamar_token');

    // Fetch data pelamar
    async function fetchPelamarDetail() {
        try {
            const response = await fetch('http://localhost:8000/api/pelamar/auth/me', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${pelamarToken}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data pelamar');
            }

            const pelamarData = await response.json();
            return pelamarData.data;
        } catch (error) {
            console.error('Error fetching pelamar data:', error);
            return null;
        }
    }

    // Fetch data lamaran
    async function fetchLamaranDetail() {
        if (!lamaranId) {
            showError('ID Lamaran tidak valid');
            return;
        }

        try {
            // Fetch data lamaran
            const lamaranResponse = await fetch(`http://localhost:8000/api/lamaran/${lamaranId}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            console.log('Response status:', lamaranResponse.status);

            if (!lamaranResponse.ok) {
                const errorData = await lamaranResponse.json();
                console.error('Error response:', errorData);
                throw new Error(errorData.message || 'Gagal mengambil data lamaran');
            }

            const lamaranData = await lamaranResponse.json();
            console.log('Lamaran data:', lamaranData);

            // Fetch data pelamar
            const pelamarData = await fetchPelamarDetail();

            // Update UI dengan data lamaran dan pelamar
            updateLamaranDetail(lamaranData.data, pelamarData);
        } catch (error) {
            console.error('Fetch error:', error);
            showError(error.message);
        }
    }

    // Fungsi untuk memperbarui detail lamaran di UI
    function updateLamaranDetail(lamaranData, pelamarData) {
        console.log('Updating lamaran detail:', lamaranData);
        console.log('Updating pelamar detail:', pelamarData);

        loadingSpinner.style.display = 'none';
        containerEl.style.display = 'block';

        // Informasi Pelamar
        if (pelamarData) {
            document.getElementById('pelamar-nama').textContent = pelamarData.nama;
            document.getElementById('pelamar-email').textContent = pelamarData.email;
            document.getElementById('pelamar-telepon').textContent = pelamarData.no_hp;
            document.getElementById('pelamar-alamat').textContent = pelamarData.alamat;
        }
        
        // Informasi Lowongan
        document.getElementById('lowongan-judul').textContent = lamaranData.lowongan_pekerjaan?.judul_pekerjaan || 'Tidak ada informasi';
        document.getElementById('lowongan-gaji-min').textContent = lamaranData.lowongan_pekerjaan 
            ? 'Rp ' + parseFloat(lamaranData.lowongan_pekerjaan.gaji_minimal).toLocaleString('id-ID') 
            : 'Tidak ada informasi';
        document.getElementById('lowongan-gaji-max').textContent = lamaranData.lowongan_pekerjaan 
            ? 'Rp ' + parseFloat(lamaranData.lowongan_pekerjaan.gaji_maksimal).toLocaleString('id-ID') 
            : 'Tidak ada informasi';

        // Status Lamaran
        document.getElementById('lamaran-status').innerHTML = `
            <span class="badge ${getStatusClass(lamaranData.status_lamaran)}">
                ${capitalizeFirstLetter(lamaranData.status_lamaran || 'Tidak diketahui')}
            </span>
        `;

        // Tanggal Lamaran
        document.getElementById('lamaran-tanggal').textContent = formatDate(lamaranData.tanggal_dibuat);

        // CV Section
        const cvSection = document.getElementById('cv-section');
        if (pelamarData && pelamarData.cv_path) {
            cvSection.innerHTML = `
                <div class="mb-3">
                    <i class="bi bi-file-pdf text-danger" style="font-size: 3rem;"></i>
                </div>
                <a href="${pelamarData.cv_path}" class="btn btn-primary" target="_blank">
                    <i class="bi bi-download me-2"></i>Unduh CV
                </a>
            `;
        } else {
            cvSection.innerHTML = '<p class="text-muted">Tidak ada CV tersedia</p>';
        }
    }

    // Fungsi utilitas
    function getStatusClass(status) {
        switch (status) {
            case 'diterima': return 'bg-success';
            case 'ditolak': return 'bg-danger';
            case 'dalam_proses': return 'bg-warning';
            default: return 'bg-secondary';
        }
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }
    document.getElementById('btnBack').addEventListener('click', function() {
        window.history.back();
    });

    // Panggil fungsi fetch
    fetchLamaranDetail();
});
</script>
@endpush