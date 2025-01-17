@extends('layouts.landing_pelamar')

@section('title', 'Karir')

@section('content')
<div class="landing-page">
    <!-- Hero Section -->
    <div class="career-hero py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-3">Temukan Karier Impianmu</h1>
                    <p class="lead mb-4">Bergabunglah dengan tim kami dan kembangkan potensimu bersama BPR Saraswati Eka Bumi</p>
                    <div class="search-box bg-white p-3 rounded-3 shadow-sm">
                        <div class="row g-2">
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-0">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" class="form-control border-0" id="searchInput" placeholder="Cari posisi...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100" id="searchButton">Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    {{-- <img src="{{ asset('assets/images/logo seb.png') }}" alt="Career" class="img-fluid"> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4">
            <!-- Filter Sidebar -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm sticky-top" style="top: 2rem;">
                    <div class="card-body">
                        <h5 class="card-title d-flex align-items-center mb-4">
                            <i class="bi bi-funnel me-2"></i>
                            Filter Pencarian
                        </h5>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Divisi</label>
                            <select class="form-select form-select-sm border-0 bg-light" id="divisiFilter">
                                <option value ="">Semua Divisi</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Jenis Pekerjaan</label>
                            <select class="form-select form-select-sm border-0 bg-light" id="jenisFilter">
                                <option value="">Semua Jenis</option>
                                <option value="full time">Full Time</option>
                                <option value="part time">Part Time</option>
                                <option value="kontrak">Kontrak</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Rentang Gaji</label>
                            <div class="input-group input-group-sm mb-2">
                                <span class="input-group-text bg-light border-0">Rp</span>
                                <input type="number" class="form-control border-0 bg-light" id="gajiMinFilter" placeholder="Minimal">
                            </div>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-light border-0">Rp</span>
                                <input type="number" class="form-control border-0 bg-light" id="gajiMaxFilter" placeholder="Maksimal">
                            </div>
                        </div>

                        <button class="btn btn-primary w-100 mb-2" id="filterButton">
                            <i class="bi bi-funnel-fill me-2"></i>Terapkan Filter
                        </button>
                        <button class="btn btn-light w-100" id="resetFilterButton">
                            <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                        </button>
                    </div>
                </div>
            </div>

            <!-- Job Listings -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Lowongan Tersedia</h4>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="sortButton" data-bs-toggle="dropdown">
                            <i class="bi bi-sort-down me-2"></i>Urutkan
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item sort-option" data-sort="newest" href="#">Terbaru</a></li>
                            <li><a class="dropdown-item sort-option" data-sort="salary-high" href="#">Gaji Tertinggi</a></li>
                            <li><a class="dropdown-item sort-option" data-sort="salary-low" href="#">Gaji Terendah</a></li>
                            <li><a class="dropdown-item sort-option" data-sort="title" href="#">Nama (A-Z)</a></li>
                        </ul>
                    </div>
                </div>

                <div id="lowonganContainer">
                    <!-- Job cards will be loaded here -->
                </div>

                <div id="paginationContainer" class="d-flex justify-content-center mt-4">
                    <!-- Pagination will be loaded here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
<footer class="footer py-5 bg-dark text-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="mb-4">Tentang Kami</h5>
                <p>PT Bank Perekonomian Rakyat Saraswati Eka Bumi berizin dan diawasi oleh Otoritas Jasa
                    Keuangan (OJK) serta merupakan peserta penjaminan LPS</p>
                <div class="social-links mt-4">
                    <h6 class="mb-3">Media Sosial</h6>
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="mb-4">Kantor Pusat</h5>
                <p><i class="fas fa-map-marker-alt me-2"></i>Jalan By Pass Ngurah Rai No 233 Kuta Badung Bali</p>
                <p><i class="fas fa-phone me-2"></i>(0361) 756206, 763295</p>
                <p><i class="fas fa-clock me-2"></i>Jam buka:</p>
                <p class="ms-4">Senin - Jumat: 08.00 – 16.00 wita<br>
                Sabtu dan Minggu: TUTUP</p>
            </div>
            <div class="col-lg-4">
                <h5 class="mb-4">Kantor Kas</h5>
                <div class="branch-office">
                    <h6 class="mb-3">Kas Sempidi:</h6>
                    <p><i class="fas fa-map-marker-alt me-2"></i>Jalan Raya Sempidi No.12a Badung Bali</p>
                    <p><i class="fas fa-phone me-2"></i>(0361) 9561143, 9561144</p>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
@endsection

@push('styles')
<style>
.career-hero {
    background: linear-gradient(135deg, #2a4ec5 0%, #ffffff 100%);
    position: relative;
    overflow: hidden;
}
.footer {
    background: linear-gradient(135deg, #1a237e, #283593);
}
.career-hero::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='rgba(255,255,255,0.1)' fill-rule='evenodd'/%3E%3C/svg%3E");
}

.search-box {
    backdrop-filter: blur(10px);
}

.search-box .form-control:focus {
    box-shadow: none;
}

.job-card {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 8px;
}

.job-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    border-color: var(--elektrik-blue);
}

.avatar {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-soft-primary {
    background-color: rgba(0,119,190,0.1);
}

.badge {
    padding: 0.5rem 1rem;
    font-weight: 500;
}

.sticky-top {
    z-index: 1020;
}

@media (max-width: 991.98px) {
    .career-hero {
        text-align: center;
    }
    
    .search-box {
        margin: 0 auto;
        max-width: 500px;
    }
}
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- CSS untuk AOS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush



@push('scripts')

<!-- Script untuk AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const lowonganContainer = document.getElementById('lowonganContainer');
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const divisiFilter = document.getElementById('divisiFilter');
    const jenisFilter = document.getElementById('jenisFilter');
    const gajiMinFilter = document.getElementById('gajiMinFilter');
    const gajiMaxFilter = document.getElementById('gajiMaxFilter');
    const filterButton = document.getElementById('filterButton');
    const resetFilterButton = document.getElementById('resetFilterButton');
    const sortOptions = document.querySelectorAll('.sort-option');

    let currentSort = 'newest';
    let currentJobs = [];
    const token = localStorage.getItem('pelamar_token');

    // Helper Functions
    function formatRupiah(angka) {
        if (!angka) return 'Tidak ditentukan';
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(angka);
    }

    function formatDate(dateString) {
        if (!dateString) return 'Tidak ditentukan';
        return new Date(dateString).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }

    async function loadDivisiOptions() {
        console.log('🔄 Loading division options...');
        try {
            const response = await fetch('http://127.0.0.1:8000/api/public/divisi', {
                headers: {
                    'Accept': 'application/json',
                    ...(token && { 'Authorization': `Bearer ${token}` })
                }
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            console.log('📋 Division Data:', result);
            
            const divisions = result.data || result;
            if (Array.isArray(divisions) && divisions.length > 0) {
                divisiFilter.innerHTML = '<option value="">Semua Divisi</option>';
                
                const sortedDivisions = [...divisions].sort((a, b) => 
                    a.nama_divisi.localeCompare(b.nama_divisi)
                );

                sortedDivisions.forEach(divisi => {
                    if (divisi && divisi.id_divisi && divisi.nama_divisi) {
                        const option = new Option(divisi.nama_divisi, divisi.id_divisi);
                        divisiFilter.add(option);
                    }
                });
                
                console.log('✅ Divisions loaded successfully:', divisions.length);
            } else {
                throw new Error('No divisions found in the response');
            }
        } catch (error) {
            console.error('❌ Error loading divisions:', error);
            divisiFilter.innerHTML = '<option value="">Semua Divisi</option>';
        }
    }

    async function fetchJobs() {
        console.log('🔄 Starting job fetch process...');
        showLoadingState();
        
        try {
            let url = 'http://127.0.0.1:8000/api/lowongan';
            const queryParams = new URLSearchParams();

            // Add status filter to only show active jobs
            queryParams.append('status', 'aktif');

            if (searchInput.value.trim()) {
                queryParams.append('search', searchInput.value.trim());
            }

            if (divisiFilter.value) {
                queryParams.append('divisi_id', divisiFilter.value);
            }

            if (jenisFilter.value) {
                queryParams.append('jenis_pekerjaan', jenisFilter.value.toLowerCase());
            }

            if (gajiMinFilter.value) {
                queryParams.append('gaji_min', gajiMinFilter.value);
            }
            if (gajiMaxFilter.value) {
                queryParams.append('gaji_max', gajiMaxFilter.value);
            }

            if (queryParams.toString()) {
                url += '?' + queryParams.toString();
            }

            console.log('🔗 Fetching from URL:', url);

            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    ...(token && { 'Authorization': `Bearer ${token}` })
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            console.log('📋 Raw API Result:', result);

            if (!result.data) {
                throw new Error('No data found in response');
            }

            // Filter for active jobs only
            currentJobs = result.data.filter(job => {
                if (!job) return false;

                // Check for active status
                const isActive = job.status?.toLowerCase() === 'aktif';
                if (!isActive) return false;

                // Continue with existing filters
                const searchTerm = searchInput.value.toLowerCase().trim();
                const jobTitle = (job.judul_pekerjaan || '').toLowerCase();
                const matchesSearch = !searchTerm || jobTitle.includes(searchTerm);
                
                const jobDivisiId = job.divisi_id || job.id_divisi;
                const matchesDivisi = !divisiFilter.value || 
                    (jobDivisiId && jobDivisiId.toString() === divisiFilter.value);
                
                const jobType = (job.jenis_pekerjaan || '').toLowerCase();
                const matchesJobType = !jenisFilter.value || 
                    jobType === jenisFilter.value.toLowerCase();
                
                const jobMinSalary = parseInt(job.gaji_minimal || 0);
                const jobMaxSalary = parseInt(job.gaji_maksimal || 0);
                const filterMinSalary = parseInt(gajiMinFilter.value || 0);
                const filterMaxSalary = parseInt(gajiMaxFilter.value || Infinity);
                
                const matchesSalary = 
                    (!filterMinSalary || jobMinSalary >= filterMinSalary) && 
                    (!filterMaxSalary || jobMaxSalary <= filterMaxSalary);

                return matchesSearch && matchesDivisi && matchesJobType && matchesSalary;
            });

            console.log('✅ Filtered active jobs:', currentJobs);
            
            if (currentJobs.length === 0) {
                showNoResults();
            } else {
                sortAndRenderJobs();
            }

        } catch (error) {
            console.error('❌ Error fetching jobs:', error);
            showError('Terjadi kesalahan saat memuat data lowongan. Silakan coba lagi.');
        }
    }

// Update renderJobs for safer property access
function sortAndRenderJobs() {
    console.log('🔄 Sorting jobs with method:', currentSort);

    if (!currentJobs || currentJobs.length === 0) {
        showNoResults();
        return;
    }

    const sortedJobs = [...currentJobs].sort((a, b) => {
        switch (currentSort) {
            case 'newest':
                return new Date(b.tanggal_dibuat || 0) - new Date(a.tanggal_dibuat || 0);
            case 'salary-high':
                return (parseInt(b.gaji_maksimal || 0) || 0) - (parseInt(a.gaji_maksimal || 0) || 0);
            case 'salary-low':
                return (parseInt(a.gaji_minimal || 0) || 0) - (parseInt(b.gaji_minimal || 0) || 0);
            case 'title':
                return (a.judul_pekerjaan || '').localeCompare(b.judul_pekerjaan || '');
            default:
                return 0;
        }
    });

    lowonganContainer.innerHTML = sortedJobs.map(job => `
        <div class="job-card mb-3 bg-white p-4">
            <div class="d-flex">
                <div class="avatar bg-soft-primary rounded-circle me-3">
                    <i class="bi bi-briefcase fs-4 text-primary"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="mb-1">${job.judul_pekerjaan || 'Untitled Position'}</h5>
                            <p class="text-muted mb-0">
                                <i class="bi bi-building me-2"></i>${job.divisi?.nama_divisi || 'Divisi tidak tersedia'}
                            </p>
                        </div>
                        <a href="/landing/login" 
                           class="btn btn-primary btn-sm">
                            Lihat Detail
                        </a>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge bg-soft-primary text-primary">
                            <i class="bi bi-clock me-1"></i>${job.jenis_pekerjaan || 'Tidak ditentukan'}
                        </span>
                        <span class="badge bg-soft-success text-success">
                            <i class="bi bi-cash me-1"></i>${formatRupiah(job.gaji_minimal)} - ${formatRupiah(job.gaji_maksimal)}
                        </span>
                        <span class="badge bg-soft-info text-info">
                            <i class="bi bi-geo-alt me-1"></i>${job.lokasi_pekerjaan || 'Lokasi tidak ditentukan'}
                        </span>
                    </div>
                    <div class="text-muted small">
                        <i class="bi bi-calendar-check me-2"></i>
                        Periode: ${formatDate(job.tanggal_mulai)} - ${formatDate(job.tanggal_selesai)}
                    </div>
                </div>
            </div>
        </div>
    `).join('');
}

    // UI State Functions
    function showLoadingState() {
        lowonganContainer.innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Memuat lowongan pekerjaan...</p>
            </div>
        `;
    }

    function showError(message) {
        lowonganContainer.innerHTML = `
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle me-2"></i>${message}
            </div>
        `;
    }

    function showNoResults() {
        lowonganContainer.innerHTML = `
            <div class="text-center py-5">
                <i class="bi bi-search text-muted" style="font-size: 3rem;"></i>
                <h5 class="mt-3">Tidak Ada Lowongan Ditemukan</h5>
                <p class="text-muted">Coba ubah filter pencarian Anda untuk menemukan lebih banyak lowongan.</p>
            </div>
        `;
    }

// Event Listeners
searchButton.addEventListener('click', fetchJobs);
searchInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') fetchJobs();
});

filterButton.addEventListener('click', fetchJobs);

resetFilterButton.addEventListener('click', () => {
    searchInput.value = '';
    divisiFilter.value = '';
    jenisFilter.value = '';
    gajiMinFilter.value = '';
    gajiMaxFilter.value = '';
    currentSort = 'newest';
    fetchJobs();
});

// Tambahkan event listener untuk sorting di sini
sortOptions.forEach(option => {
    option.addEventListener('click', (e) => {
        e.preventDefault();
        currentSort = option.dataset.sort;
        
        // Update button text
        document.getElementById('sortButton').innerHTML = `
            <i class="bi bi-sort-down me-2"></i>${option.textContent}
        `;
        
        // Gunakan fungsi sortAndRenderJobs yang sudah ada
        sortAndRenderJobs();
    });
});

// Initialize
loadDivisiOptions();
fetchJobs();
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush