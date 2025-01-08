@extends('layouts.app')
@extends('layouts.pelamar_master')

@section('title')
    Detail Wawancara
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0" id="wawancara-detail-container" style="display: none;">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Detail Wawancara</h2></b>
                    <p class="card-text text-muted">Informasi lengkap jadwal wawancara Anda</p>
                </div>
                <div>
                    <i class="bi bi-calendar2-check text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Loading Spinner --}}
    <div id="loading-spinner" class="text-center">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p>Memuat data wawancara...</p>
    </div>

    {{-- Error Container --}}
    <div id="error-container" class="alert alert-danger" style="display: none;"></div>
{{-- Applicant Information Card --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Informasi Pelamar</h4>
                <button type="button" class="btn btn-danger btn-sm" id="btnBack">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="text-muted small mb-1">Nama</label>
                            <h6 id="pelamar-nama"></h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="text-muted small mb-1">Email</label>
                            <h6 id="pelamar-email"></h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="text-muted small mb-1">No. HP</label>
                            <h6 id="pelamar-telepon"></h6>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="text-muted small mb-1">Alamat</label>
                            <h6 id="pelamar-alamat"></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    {{-- Interview Information Card --}}
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Informasi Wawancara</h4>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Tanggal Wawancara</label>
                                <h6 id="wawancara-tanggal"></h6>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Lokasi</label>
                                <h6 id="wawancara-lokasi"></h6>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Status Wawancara</label>
                                <h6 id="wawancara-hasil"></h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Catatan</label>
                                <h6 id="wawancara-catatan"></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Position Details Card --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Detail Posisi</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small mb-1">Posisi yang Dilamar</label>
                        <h6 id="posisi-judul"></h6>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small mb-1">Lokasi Pekerjaan</label>
                        <h6 id="posisi-lokasi"></h6>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small mb-1">Jenis Pekerjaan</label>
                        <h6 id="posisi-jenis"></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get interview ID from URL
    const pathParts = window.location.pathname.split('/');
    const wawancaraId = pathParts[pathParts.length - 2];

    // Elements that will be updated
    const containerEl = document.getElementById('wawancara-detail-container');
    const loadingSpinner = document.getElementById('loading-spinner');
    const errorContainer = document.getElementById('error-container');

    // Function to display error
    function showError(message) {
        console.error('Fetch Error:', message);
        loadingSpinner.style.display = 'none';
        errorContainer.textContent = message;
        errorContainer.style.display = 'block';
    }

    // Fetch interview data
    async function fetchWawancaraDetail() {
        if (!wawancaraId) {
            showError('ID Wawancara tidak valid');
            return;
        }

        try {
            const response = await fetch(`http://localhost:8000/api/wawancara/${wawancaraId}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Gagal mengambil data wawancara');
            }

            const wawancaraData = await response.json();
            updateWawancaraDetail(wawancaraData.data);
        } catch (error) {
            console.error('Fetch error:', error);
            showError(error.message);
        }
    }

    // Function to update interview details in UI
    function updateWawancaraDetail(data) {
        loadingSpinner.style.display = 'none';
        containerEl.style.display = 'block';

        // Interview Information
        document.getElementById('wawancara-tanggal').textContent = formatDateTime(data.tanggal_wawancara);
        document.getElementById('wawancara-lokasi').textContent = data.lokasi;
        document.getElementById('wawancara-hasil').innerHTML = `
            <span class="badge ${getHasilClass(data.hasil)}">
                ${capitalizeFirstLetter(data.hasil || 'Belum ada hasil')}
            </span>
        `;
        document.getElementById('wawancara-catatan').textContent = data.catatan || 'Tidak ada catatan';

        // Position Details
        const lowongan = data.lamaran_pekerjaan?.lowongan_pekerjaan;
        if (lowongan) {
            document.getElementById('posisi-judul').textContent = lowongan.judul_pekerjaan;
            document.getElementById('posisi-lokasi').textContent = lowongan.lokasi_pekerjaan;
            document.getElementById('posisi-jenis').textContent = capitalizeFirstLetter(lowongan.jenis_pekerjaan);
        }

        // Applicant Information
        const pelamar = data.pelamar;
        if (pelamar) {
            document.getElementById('pelamar-nama').textContent = pelamar.nama;
            document.getElementById('pelamar-email').textContent = pelamar.email;
            document.getElementById('pelamar-telepon').textContent = pelamar.no_hp;
            document.getElementById('pelamar-alamat').textContent = pelamar.alamat;
        }
    }

    // Utility functions
    function getHasilClass(hasil) {
        switch (hasil?.toLowerCase()) {
            case 'lulus': return 'bg-success';
            case 'tidak_lulus': return 'bg-danger';
            default: return 'bg-secondary';
        }
    }

    function capitalizeFirstLetter(string) {
        if (!string) return '';
        return string.split('_').map(word => 
            word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()
        ).join(' ');
    }

    function formatDateTime(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    // Add back button functionality
    document.getElementById('btnBack').addEventListener('click', function() {
        window.history.back();
    });

    // Fetch data when page loads
    fetchWawancaraDetail();
});
</script>
@endpush