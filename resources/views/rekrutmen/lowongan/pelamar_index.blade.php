@extends('layouts.app')
@extends('layouts.pelamar_master')

@section('title')
Lowongan Pekerjaan
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
            {{-- Header Card --}}
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <b><h2 class="card-title mb-1">Temukan Karier Impianmu</h2></b>
                            <p class="card-text text-muted">Jelajahi peluang pekerjaan terbaru yang sesuai dengan minat dan keahlianmu</p>
                        </div>
                        <div>
                            <i class="bi bi-briefcase text-primary" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                </div>
            </div>

    <div class="row">
        <div class="col-12 col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Filter Lowongan</h5>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label">Divisi</label>
                        <select class="form-select" id="divisiFilter">
                            <option value="">Semua Divisi</option>
                            <!-- Akan diisi secara dinamis -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Pekerjaan</label>
                        <select class="form-select" id="jenisFilter">
                            <option value="">Semua Jenis</option>
                            <option value="full time">Full Time</option>
                            <option value="part time">Part Time</option>
                            <option value="kontrak">Kontrak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rentang Gaji</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="gajiMinFilter" placeholder="Min">
                            <span class="input-group-text">-</span>
                            <input type="number" class="form-control" id="gajiMaxFilter" placeholder="Max">
                        </div>
                    </div>
                    <button class="btn btn-primary w-100" id="filterButton">
                        <i class="bi bi-funnel me-2"></i>Terapkan Filter
                    </button>
                    <button class="btn btn-outline-secondary w-100 mt-2" id="resetFilterButton">
                        <i class="bi bi-arrow-clockwise me-2"></i>Reset Filter
                    </button>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-9">
            <div class="row" id="lowonganContainer">
                <!-- Lowongan akan dimuat di sini -->
            </div>
            <div id="paginationContainer" class="d-flex justify-content-center mt-4">
                <!-- Pagination akan dimuat di sini -->
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('pelamar_token');
    const lowonganContainer = document.getElementById('lowonganContainer');
    const divisiFilter = document.getElementById('divisiFilter');
    const jenisFilter = document.getElementById('jenisFilter');
    const gajiMinFilter = document.getElementById('gajiMinFilter');
    const gajiMaxFilter = document.getElementById('gajiMaxFilter');
    const filterButton = document.getElementById('filterButton');
    // Tambahkan setelah event listener filterButton
    const resetFilterButton = document.getElementById('resetFilterButton');

    resetFilterButton.addEventListener('click', function() {
        // Reset semua filter ke kondisi awal
        divisiFilter.selectedIndex = 0;
        jenisFilter.selectedIndex = 0;
        gajiMinFilter.value = '';
        gajiMaxFilter.value = '';

        // Panggil ulang fetchLowongan untuk menampilkan semua lowongan
        fetchLowongan();
    });
    
    // Token check
    if (!token) {
        window.location.href = '/landing/login';
        return;
    }

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(angka);
    }

    // Load Divisi Options
    async function loadDivisiOptions() {
    try {
        const response = await fetch(`${API_BASE_URL}/public/divisi`, {
            headers: {
                'Accept': 'application/json'
            }
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const responseData = await response.json();
        console.log('Divisi data:', responseData);

        // Gunakan langsung responseData jika tidak memiliki properti data
        const divisiList = Array.isArray(responseData) ? responseData : 
                           (responseData.data ? responseData.data : []);

        divisiFilter.innerHTML = '<option value="">Semua Divisi</option>';
        
        if (divisiList && divisiList.length > 0) {
            divisiList.forEach(divisi => {
                divisiFilter.innerHTML += `
                    <option value="${divisi.id_divisi}">
                        ${divisi.nama_divisi}
                    </option>
                `;
            });
            console.log('Berhasil memuat divisi:', divisiList.length);
        } else {
            console.warn('Tidak ada data divisi yang ditemukan');
            
            // Fallback divisi options
            divisiFilter.innerHTML = `
                <option value="">Semua Divisi</option>
                <option value="1">Komisaris</option>
                <option value="2">Direksi</option>
                <option value="5">Operasional</option>
                <option value="7">IT</option>
                <option value="11">Marketing</option>
            `;
        }
    } catch (error) {
        console.error('Error loading divisi:', error);
        
        // Fallback divisi options
        divisiFilter.innerHTML = `
            <option value="">Semua Divisi</option>
            <option value="1">Komisaris</option>
            <option value="2">Direksi</option>
            <option value="5">Operasional</option>
            <option value="7">IT</option>
            <option value="11">Marketing</option>
        `;
    }
}

    // Fetch Lowongan with Advanced Filtering
    // Fetch Lowongan with Advanced Filtering
async function fetchLowongan() {
    try {
        const token = localStorage.getItem('pelamar_token');
        
        // Prepare query parameters
        const params = new URLSearchParams();
        
        const divisiId = divisiFilter.value;
        const jenisPekerjaan = jenisFilter.value;
        const gajiMin = gajiMinFilter.value;
        const gajiMax = gajiMaxFilter.value;

        // Add parameters conditionally
        if (divisiId) params.append('divisi_id', divisiId);
        if (jenisPekerjaan) params.append('jenis_pekerjaan', jenisPekerjaan);
        if (gajiMin) params.append('gaji_minimal', gajiMin);
        if (gajiMax) params.append('gaji_maksimal', gajiMax);

        // Construct URL
        const url = `${API_BASE_URL}/lowongan?${params.toString()}`;
        console.log('Fetching URL:', url);

        // Fetch data
        const response = await fetch(url, {
            headers: {
                'Authorization': token ? `Bearer ${token}` : undefined,
                'Accept': 'application/json'
            }
        });

        const data = await response.json();
        console.log('Response data:', data);

        // Clear current content
        lowonganContainer.innerHTML = '';

        // Advanced Filtering
        let filteredData = data.data;
        
        // Jika token tersedia, filter lowongan yang belum dilamar
        if (token) {
            try {
                // Ambil ID Pelamar
                const pelamarResponse = await fetch(`${API_BASE_URL}/pelamar/auth/me`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
                const pelamarData = await pelamarResponse.json();
                const pelamarId = pelamarData.data.id_pelamar;

                // Ambil data lamaran
                const lamaranResponse = await fetch(`${API_BASE_URL}/admin/lamaran`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
                const lamaranData = await lamaranResponse.json();

                // Dapatkan ID lowongan yang sudah dilamar
                const lamaranPelamar = lamaranData.data.data.filter(
                    item => item.id_pelamar === pelamarId
                );
                const lowonganDilamar = lamaranPelamar.map(
                    lamaran => lamaran.lowongan_pekerjaan?.id_lowongan_pekerjaan
                );

                // Filter lowongan yang belum dilamar
                filteredData = filteredData.filter(
                    job => !lowonganDilamar.includes(job.id_lowongan_pekerjaan)
                );

                console.log('Lowongan belum dilamar:', filteredData);
            } catch (error) {
                console.error('Error filtering lamaran:', error);
                // Jika gagal memfilter, tampilkan semua lowongan
            }
        }
        
        // Filter tambahan berdasarkan input
        if (divisiId) {
            filteredData = filteredData.filter(job => 
                job.id_divisi === parseInt(divisiId)
            );
        }

        if (jenisPekerjaan) {
            filteredData = filteredData.filter(job => 
                job.jenis_pekerjaan.toLowerCase() === jenisPekerjaan.toLowerCase()
            );
        }

        if (gajiMin) {
            filteredData = filteredData.filter(job => 
                parseFloat(job.gaji_minimal) >= parseFloat(gajiMin)
            );
        }

        if (gajiMax) {
            filteredData = filteredData.filter(job => 
                parseFloat(job.gaji_maksimal) <= parseFloat(gajiMax)
            );
        }

        // Filter hanya lowongan aktif
        filteredData = filteredData.filter(job => job.status === 'aktif');

        // Handle empty results
        if (!filteredData || filteredData.length === 0) {
            lowonganContainer.innerHTML = `
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="bi bi-info-circle me-2"></i>
                        ${token 
                            ? 'Tidak ada lowongan baru yang tersedia atau Anda sudah melamar semua lowongan.' 
                            : 'Tidak ada lowongan yang sesuai dengan filter Anda.'}
                    </div>
                </div>`;
            return;
        }

        // Render filtered jobs
        filteredData.forEach(job => {
            const card = `
                <div class="col-12 mb-3">
                    <div class="card border-0 shadow-sm job-card">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-lg bg-soft-primary text-primary rounded-circle">
                                        <i class="bi bi-briefcase fs-4"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1">${job.judul_pekerjaan}</h5>
                                    <p class="text-muted mb-2">
                                        <i class="bi bi-building me-2"></i>${job.divisi?.nama_divisi || 'N/A'} | 
                                        <i class="bi bi-geo-alt me-2"></i>${job.lokasi_pekerjaan}
                                    </p>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge bg-soft-primary text-primary me-2">
                                            <i class="bi bi-clock me-1"></i>${job.jenis_pekerjaan}
                                        </span>
                                        <span class="badge bg-soft-success text-success">
                                            <i class="bi bi-cash me-1"></i>${formatRupiah(job.gaji_minimal)} - ${formatRupiah(job.gaji_maksimal)}
                                        </span>
                                    </div>
                                    <div class="text-muted small mb-2">
                                        <i class="bi bi-calendar-check me-2"></i>
                                        Dibuka: ${new Date(job.tanggal_mulai).toLocaleDateString('id-ID')} s/d ${new Date(job.tanggal_selesai).toLocaleDateString('id-ID')}
                                    </div>
                                    <a href="/rekrutmen/lowongan/pelamar/${job.id_lowongan_pekerjaan}" class="btn btn-primary">
                                        <i class="bi bi-eye me-2"></i>Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
            lowonganContainer.innerHTML += card;
        });

    } catch (error) {
        console.error('Error fetching jobs:', error);
        lowonganContainer.innerHTML = `
            <div class="col-12">
             <div class="alert alert-danger text-center">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    Terjadi kes alahan saat memuat lowongan. Silakan coba lagi nanti.
                </div>
            </div>`;
    }
}

    // Event listener for filter button
    filterButton.addEventListener('click', function() {
        fetchLowongan();
    });

    // Initialize page
    loadDivisiOptions();
    fetchLowongan();
});
</script>

<style>
.job-card {
    transition: transform 0.2s;
}
.job-card:hover {
    transform: scale(1.02);
}
</style>
@endsection