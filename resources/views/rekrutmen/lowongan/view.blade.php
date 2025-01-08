@extends('layouts.pelamar_master')

@section('title')
Detail Lowongan Pekerjaan
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    {{-- Header Lowongan --}}
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-4">
                            <div class="avatar avatar-xl bg-soft-primary text-primary rounded-circle">
                                <i class="bi bi-briefcase fs-2"></i>
                            </div>
                        </div>
                        <div>
                            <h2 class="mb-1" id="jobTitle"></h2>
                            <div class="text-muted">
                                <i class="bi bi-building me-2"></i>
                                <span id="companyName"></span>
                                <span class="mx-2">•</span>
                                <span id="jobLocation"></span>
                            </div>
                        </div>
                    </div>
                    {{-- Tombol Kembali --}}
                    <div class="position-absolute top-0 end-0 m-3">
                        <a href="{{ route('rekrutmen.lowongan.pelamar_index') }}" class="btn btn-danger btn-sm">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                    {{-- Job Quick Info --}}
                    <div class="row mb-4 text-center">
                        <div class="col-4">
                            <div class="badge bg-soft-primary text-primary p-2 w-100">
                                <i class="bi bi-clock me-2"></i>
                                <span id="jobType"></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="badge bg-soft-success text-success p-2 w-100">
                                <i class="bi bi-cash me-2"></i>
                                <span id="salaryRange"></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="badge bg-soft-warning text-warning p-2 w-100">
                                <i class="bi bi-calendar-check me-2"></i>
                                <span id="applicationDeadline"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Job Description --}}
                    <div class="mb-4">
                        <h4 class="mb-3">Detail Pekerjaan</h4>
                        <div id="jobDescription"></div>
                    </div>

                    {{-- Company Info --}}
                    <div class="mb-4">
                        <h4 class="mb-3">Tentang Perusahaan</h4>
                        <div class="card border-0 bg-soft-primary p-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <div class="avatar avatar-lg bg-white text-white rounded-circle">
                                        <img src="{{ asset('assets/images/logo seb.png') }}" alt="Logo HRMS SEB" class="icon-30">
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1">PT BPR Saraswati Eka Bumi</h5>
                                    <p class="text-muted mb-0">Perusahaan Perbankan Swasta</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-secondary">
                            <i class="bi bi-share me-2"></i>Bagikan
                        </button>
                        <button class="btn btn-primary" id="lamarSekarang">
                            <i class="bi bi-send me-2"></i>Lamar Sekarang
                        </button>
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
    const jobId = "{{ $id }}";
    const lamarSekarangButton = document.getElementById('lamarSekarang');

    if (lamarSekarangButton) {
    lamarSekarangButton.addEventListener('click', function() {
        const token = localStorage.getItem('pelamar_token');
        if (!token) {
            window.location.href = '/landing/login';
            return;
        }

        // Gunakan SweetAlert untuk konfirmasi
        Swal.fire({
            title: 'Konfirmasi Lamaran',
            html: `Apakah Anda yakin ingin melamar pada posisi <strong>${document.getElementById('jobTitle').textContent}</strong>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lamar Sekarang!',
            cancelButtonText: 'Batal'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    // Tampilkan loading
                    Swal.fire({
                        title: 'Sedang Memproses...',
                        text: 'Mohon tunggu sebentar',
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Kirim lamaran ke API
                    const response = await fetch('http://localhost:8000/api/pelamar/lamaran', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            id_lowongan_pekerjaan: jobId
                        })
                    });

                    const responseData = await response.json();

                    // Cek respon dari API
                    if (response.ok) {
                        // Lamaran berhasil
                        Swal.fire({
                            icon: 'success',
                            title: 'Lamaran Berhasil!',
                            text: responseData.message || 'Anda berhasil mengirimkan lamaran.',
                            confirmButtonText: 'Lihat Status Lamaran',
                            cancelButtonText: 'Tutup',
                            showCancelButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect ke halaman status lamaran
                                window.location.href = '/rekrutmen/lamaran/rekrutmen/lamaran/pribadi';
                            }
                        });
                    } else {
                        // Lamaran gagal
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Melamar',
                            text: responseData.message || 'Terjadi kesalahan saat mengirim lamaran. Silakan coba lagi.'
                        });
                    }

                } catch (error) {
                    // Error jaringan atau parsing
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Terjadi kesalahan. Silakan periksa koneksi internet Anda.'
                    });
                    console.error('Error:', error);
                }
            }
        });
    });
}

    async function fetchLowonganDetail() {
        try {
            const token = localStorage.getItem('pelamar_token');
            if (!token) {
                throw new Error('Token tidak tersedia');
            }

            const response = await fetch(`http://127.0.0.1:8000/api/lowongan/${jobId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data lowongan');
            }

            const responseData = await response.json();
            const data = responseData.data;

            document.getElementById('jobTitle').textContent = data.judul_pekerjaan || '-';
            document.getElementById('companyName').textContent = data.divisi?.nama_divisi || '-';
            document.getElementById('jobLocation').textContent = data.lokasi_pekerjaan || '-';
            document.getElementById('jobType').textContent = data.jenis_pekerjaan || '-';
            
            const gajiMinimal = parseFloat(data.gaji_minimal || 0);
            const gajiMaksimal = parseFloat(data.gaji_maksimal || 0);
            document.getElementById('salaryRange').textContent = 
                `Rp ${gajiMinimal.toLocaleString()} - Rp ${gajiMaksimal.toLocaleString()}`;
            
            document.getElementById('applicationDeadline').textContent = 
                `Tutup: ${new Date(data.tanggal_selesai).toLocaleDateString('id-ID')}`;
            
                const deskripsiLengkap = `
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card border-0 bg-soft-primary p-3">
                <h5 class="mb-3">
                    <i class="bi bi-info-circle me-2 text-primary"></i>
                    Detail Pekerjaan
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-tag me-2 text-primary"></i>
                                <strong>Jabatan:</strong> ${data.jabatan?.nama_jabatan || '-'}
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-building me-2 text-primary"></i>
                                <strong>Divisi:</strong> ${data.divisi?.nama_divisi || '-'}
                            </li>
                            <li>
                                <i class="bi bi-clock me-2 text-primary"></i>
                                <strong>Jenis Pekerjaan:</strong> ${data.jenis_pekerjaan || '-'}
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-people me-2 text-primary"></i>
                                <strong>Jumlah Lowongan:</strong> ${data.jumlah_lowongan || '-'}
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-briefcase me-2 text-primary"></i>
                                <strong>Pengalaman Minimal:</strong> ${data.pengalaman_minimal || 0} tahun
                            </li>
                            <li>
                                <i class="bi bi-calendar-range me-2 text-primary"></i>
                                <strong>Rentang Usia:</strong> ${data.usia_minimal || '-'} - ${data.usia_maksimal || '-'} tahun
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-4">
            <div class="card border-0 bg-soft-success p-3">
                <h5 class="mb-3">
                    <i class="bi bi-file-text me-2 text-success"></i>
                    Deskripsi Pekerjaan
                </h5>
                <p class="text-muted">${data.deskripsi || 'Tidak ada deskripsi tersedia.'}</p>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card border-0 bg-soft-warning p-3">
                <h5 class="mb-3">
                    <i class="bi bi-list-check me-2 text-warning"></i>
                    Persyaratan
                </h5>
                <p class="text-muted">${data.persyaratan || 'Tidak ada persyaratan khusus.'}</p>
            </div>
        </div>
    </div>
`;
            document.getElementById('jobDescription').innerHTML = deskripsiLengkap;

        } catch (error) {
            console.error('Error fetching lowongan detail:', error);
            document.getElementById('jobDescription').innerHTML = `
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Gagal memuat detail lowongan. ${error.message}
                </div>
            `;
        }
    }

    fetchLowonganDetail();
});
</script>
@endpush

@push('styles')
<style>
.list-unstyled {
    padding-left: 0;
    list-style: none;
}

.list-unstyled li {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
}

.list-unstyled i {
    margin-right: 10px;
    color: #3b82f6;
    font-size: 1.2rem;
    width: 25px;
    text-align: center;
}

.container-fluid {
    background-color: #f4f7f6;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    transform: translateY(-5px);
}

.avatar-xl {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.badge {
    font-weight: 500;
    padding: 0.5rem;
}
.bg-soft-success {
    background-color: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.bg-soft-warning {
    background-color: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.card-body .list-unstyled li {
    margin-bottom: 0.75rem;
}

.card-body .list-unstyled i {
    margin-right: 15px;
    opacity: 0.7;
}
.bg-soft-primary {
    background-color: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.bg-soft-success {
    background-color: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.bg-soft-warning {
    background-color: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.btn-outline-secondary {
    border-color: #6b7280;
    color: #6b7280;
}

.btn-primary {
    background-color: #3b82f6;
    border-color: #3b82f6;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #2563eb;
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

@media (max-width: 768px) {
    .card-body {
        padding: 1rem !important;
    }

    .d-flex {
        flex-direction: column;
        align-items: center !important;
        text-align: center;
    }

    .avatar {
        margin-bottom: 1rem;
    }
}

.alert-danger {
    background-color: rgba(239, 68, 68, 0.1);
    border-color: #ef4444;
    color: #7f1d1d;
}
</style>
@endpush