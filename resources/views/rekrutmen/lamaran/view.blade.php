@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Detail Lamaran Pekerjaan
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Lamaran Pekerjaan</h2></b>
                    <p class="card-text text-muted">Recruitment Management System</p>
                </div>
                <div>
                    <i class="bi bi-briefcase text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

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
                    <div class="row small" id="pelamarDetails">
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Nama:</strong></p>
                            <p class="text-muted" id="pelamarName">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Email:</strong></p>
                            <p class="text-muted" id="pelamarEmail">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>No. HP:</strong></p>
                            <p class="text-muted" id="pelamarPhone">-</p>
                        </div>
                                            <!-- Tambahkan informasi baru -->
                    <div class="col-md-3">
                        <p class="mb-1"><strong>Alamat:</strong></p>
                        <p class="text-muted" id="alamatPelamar">-</p>
                    </div>
                    <div class="col-md-4 ">
                        <p class="mb-1"><strong>Pendidikan Terakhir:</strong></p>
                        <p class="text-muted" id="pendidikanTerakhir">-</p>
                    </div>
                    <div class="col-md-4">
                        <p class="mb-1"><strong>Pengalaman Kerja:</strong></p>
                        <p class="text-muted" id="pengalamanKerja">-</p>
                    </div>
                    
                    <!-- Optional: Tambahkan link CV -->
                    <div class="col-md-4 ">
                        <p class="mb-1"><strong>CV:</strong></p>
                        <a href="#" id="cvLink" class="text-primary" target="_blank" style="display: none;">
                            Lihat CV
                        </a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Row --}}
    <div class="row">
        {{-- Lamaran Details Card --}}
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Detail Lamaran</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="lamaran-detail-item mb-4">
                                <label class="text-muted small mb-1">Posisi yang Dilamar</label>
                                <h6 class="mb-0" id="judulPekerjaan">-</h6>
                            </div>
                            <div class="lamaran-detail-item mb-4">
                                <label class="text-muted small mb-1">Gaji Minimal</label>
                                <h6 class="mb-0" id="gajiMinimal">-</h6>
                            </div>
                            <div class="lamaran-detail-item mb-4">
                                <label class="text-muted small mb-1">Gaji Maksimal</label>
                                <h6 class="mb-0" id="gajiMaksimal">-</h6>
                            </div>
                            <div class="lamaran-detail-item">
                                <label class="text-muted small mb-1">Tanggal Lamaran</label>
                                <h6 class="mb-0" id="tanggalLamaran">-</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="lamaran-detail-item mb-4">
                                <label class="text-muted small mb-1">Pengalaman Kerja</label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-0" id="pengalamanKerja">-</p>
                                </div>
                            </div>
                            <div class="lamaran-detail-item">
                                <label class="text-muted small mb-1">Keterangan Tambahan</label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-0" id="keterangan">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Approval Status & Actions Card --}}
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Status & Tindakan</h4>
                </div>
                <div class="card-body">
                    {{-- Current Status Section with Larger Display --}}
                    <div class="status-section mb-4">
                        <label class="text-muted small mb-2">Status Lamaran</label>
                        <div class="status-display p-4 rounded">
                            <div class="text-center mb-3">
                                <div class="status-icon-large mx-auto mb-3">
                                    <i class="fas fa-clock fa-2x"></i>
                                </div>
                                <h3 class="status-text mb-2">
                                    <span class="badge rounded-pill fs-6" id="statusBadge">-</span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons Section --}}
                    <div class="action-section">
                        <label class="text-muted small mb-3">Tindakan yang Tersedia</label>
                        <div class="d-grid gap-3">
                            <button class="btn btn-success" id="approveBtn">
                                <i class="bi bi-check2-square me-2"></i>
                                Terima Lamaran
                            </button>
                            <button class="btn btn-outline-danger" id="rejectBtn">
                                <i class="bi bi-x-square me-2"></i>
                                Tolak Lamaran
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Guidance Information Alert --}}
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center mb-3">
                    <div class="alert-icon me-3">
                        <i class="fas fa-info-circle fs-4 text-primary"></i>
                    </div>
                    <div>
                        <h4 class="alert-heading mb-0">Panduan Evaluasi Lamaran</h4>
                        <p class="text-muted mb-0">Pert imbangkan hal-hal berikut sebelum memberikan keputusan:</p>
                    </div>
                </div>
                
                <div class="row g-4 mt-2">
                    <div class="col-md-6 col-lg-3">
                        <div class="guidance-item">
                            <div class="d-flex align-items-center mb-2">
                                <div class="guidance-icon bg-primary-subtle rounded-circle me-2">
                                    <i class="fas fa-check-double text-primary"></i>
                                </div>
                                <h6 class="mb-0">Verifikasi Kualifikasi</h6>
                            </div>
                            <p class="small text-muted mb-0">Pastikan kualifikasi pelamar sesuai dengan posisi yang dilamar</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="guidance-item">
                            <div class="d-flex align-items-center mb-2">
                                <div class="guidance-icon bg-warning-subtle rounded-circle me-2">
                                    <i class="fas fa-calendar-check text-warning"></i>
                                </div>
                                <h6 class="mb-0">Cek Ketersediaan</h6>
                            </div>
                            <p class="small text-muted mb-0">Periksa ketersediaan posisi yang dilamar</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="guidance-item">
                            <div class="d-flex align-items-center mb-2">
                                <div class="guidance-icon bg-success-subtle rounded-circle me-2">
                                    <i class="fas fa-user-clock text-success"></i>
                                </div>
                                <h6 class="mb-0">Pengalaman Kerja</h6>
                            </div>
                            <p class="small text-muted mb-0">Tinjau pengalaman kerja pelamar</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="guidance-item">
                            <div class="d-flex align-items-center mb-2">
                                <div class="guidance-icon bg-danger-subtle rounded-circle me-2">
                                    <i class="fas fa-comment-dots text-danger"></i>
                                </div>
                                <h6 class="mb-0">Alasan Penolakan</h6>
                            </div>
                            <p class="small text-muted mb-0">Berikan alasan yang jelas jika menolak</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
<style>
    .lamaran-detail-item {
        background: #fff;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .lamaran-detail-item:hover {
        background: #f8f9fa;
    }
    
    .status-indicator {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 193, 7, 0.1);
    }
    
    .btn {
        padding: 12px 24px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .badge {
        padding: 8px 16px;
        font-weight: 500;
    }
    
    .card {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .card:hover {
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.08);
    }
    
    .guidance-item {
        padding: 15px;
        border-radius: 10px;
        background: white;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .guidance-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
 @media (max-width: 991.98px) {
        .action-section {
            position: sticky;
            bottom: 0;
            background: white;
            padding: 1rem;
            margin: -1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const pathSegments = window.location.pathname.split('/');
    const lamaranId = pathSegments[pathSegments.indexOf('view') - 1];

    // Token validation
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Anda harus login untuk mengakses halaman ini.',
            confirmButtonText: 'OK',
            allowOutsideClick: false
        }).then(() => {
            window.location.href = '/login';
        });
        return;
    }

    // Helper function to format currency
    function formatRupiah(angka) {
        if (!angka) return '-';
        return 'Rp ' + parseFloat(angka).toLocaleString('id-ID');
    }

    // Helper function to get badge class based on status
    function getStatusBadgeClass(status) {
        const statusClasses = {
            'diterima': 'badge rounded-pill bg-success',
            'ditolak': 'badge rounded-pill bg-danger',
            'dalam_proses': 'badge rounded-pill bg-warning',
            'menunggu': 'badge rounded-pill bg-secondary',
            'default': 'badge rounded-pill bg-info'
        };
        return statusClasses[status?.toLowerCase()] || statusClasses['default'];
    }

    // Function to set button status based on application status
    function setButtonStatus(status) {
        const approveBtn = document.getElementById('approveBtn');
        const rejectBtn = document.getElementById('rejectBtn');

        // Reset all button states
        approveBtn.disabled = false;
        rejectBtn.disabled = false;
        approveBtn.classList.remove('btn-secondary', 'btn-success');
        rejectBtn.classList.remove('btn-secondary', 'btn-danger');

        switch(status?.toLowerCase()) {
            case 'diterima':
                approveBtn.disabled = true;
                approveBtn.classList.add('btn-secondary');
                rejectBtn.classList.add('btn-danger');
                break;
            case 'ditolak':
                approveBtn.classList.add('btn-success');
                rejectBtn.disabled = true;
                rejectBtn.classList.add('btn-secondary');
                break;
            case 'menunggu':
            default:
                approveBtn.classList.add('btn-success');
                rejectBtn.classList.add('btn-danger');
                break;
        }
    }

    // Fetch detailed information about the job application
    async function fetchLamaranDetail() {
    try {
        const response = await fetch(`/api/admin/lamaran/${lamaranId}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        const responseData = await response.json();

        if (!response.ok) {
            throw new Error(responseData.message || 'Gagal mengambil detail lamaran');
        }

        const lamaran = responseData.data;

        // Update informasi pelamar
        document.getElementById('pelamarName').innerText = lamaran.nama || '-';
        document.getElementById('pelamarEmail').innerText = lamaran.email || '-';
        document.getElementById('pelamarPhone').innerText = lamaran.no_hp || '-';
        
        // Informasi tambahan
        document.getElementById('alamatPelamar').innerText = lamaran.alamat || '-';
        document.getElementById('pendidikanTerakhir').innerText = lamaran.pendidikan_terakhir || '-';
        document.getElementById('pengalamanKerja').innerText = lamaran.pengalaman_kerja || '-';

        // Optional: Tambahkan informasi CV
        const cvLink = document.getElementById('cvLink');
        if (lamaran.cv_path) {
            cvLink.href = lamaran.cv_path;
            cvLink.style.display = 'inline-block';
        } else {
            cvLink.style.display = 'none';
        }

        // Detail lowongan pekerjaan
        document.getElementById('judulPekerjaan').innerText = lamaran.lowongan_pekerjaan.judul_pekerjaan || '-';
        document.getElementById('gajiMinimal').innerText = formatRupiah(lamaran.lowongan_pekerjaan.gaji_minimal);
        document.getElementById('gajiMaksimal').innerText = formatRupiah(lamaran.lowongan_pekerjaan.gaji_maksimal);
        
        document.getElementById('tanggalLamaran').innerText = new Date(lamaran.tanggal_dibuat).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });
        
        document.getElementById('keterangan').innerText = lamaran.catatan_admin || 'Tidak ada keterangan';

        // Update status badge
        const statusBadge = document.getElementById('statusBadge');
        statusBadge.innerText = lamaran.status_lamaran || '-';
        statusBadge.className = getStatusBadgeClass(lamaran.status_lamaran);

        // Set button status
        setButtonStatus(lamaran.status_lamaran);

    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message || 'Terjadi kesalahan saat memuat data',
            confirmButtonText: 'OK'
        });
    }
}

    // Back button event listener
    document.getElementById('btnBack').addEventListener('click', () => {
        window.location.href = '/rekrutmen/lamaran';
    });

    // Approve button event listener
    document.getElementById('approveBtn').addEventListener('click', async function() {
        if (this.disabled) return;

        Swal.fire({
            title: 'Konfirmasi Persetujuan Lamaran',
            text: 'Apakah Anda yakin ingin menyetujui lamaran ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Terima Lamaran',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                try {
                    const response = await fetch(`/api/admin/lamaran/${lamaranId}/status`, {
                        method: 'PUT',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ 
                            status_lamaran: 'diterima',
                            catatan: 'Lamaran diterima oleh admin'
                        })
                    });

                    const data = await response.json();
                    
                    if (!response.ok) {
                        throw new Error(data.message || 'Gagal menyetujui lamaran');
                    }

                    return data;
                } catch (error) {
                    Swal.showValidationMessage(error.message);
                    return false;
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: result.value.message || 'Lamaran berhasil diterima',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '/rekrutmen/lamaran';
                });
            }
        });
    });

    // Reject button event listener
    document.getElementById('rejectBtn').addEventListener('click', function() {
        if (this.disabled) return;

         Swal.fire({
            title: 'Masukkan Alasan Penolakan',
            input: 'textarea',
            inputPlaceholder: 'Tuliskan alasan penolakan lamaran di sini...',
            inputAttributes: {
                'aria-label': 'Alasan penolakan'
            },
            showCancelButton: true,
            confirmButtonText: 'Tolak Lamaran',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true,
            preConfirm: async (catatan) => {
                if (!catatan.trim()) {
                    Swal.showValidationMessage('Alasan penolakan harus diisi');
                    return false;
                }

                try {
                    const response = await fetch(`/api/admin/lamaran/${lamaranId}/status`, {
                        method: 'PUT',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ 
                            status_lamaran: 'ditolak', 
                            catatan: catatan 
                        })
                    });

                    const data = await response.json();
                    
                    if (!response.ok) {
                        throw new Error(data.message || 'Gagal menolak lamaran');
                    }

                    return data;
                } catch (error) {
                    Swal.showValidationMessage(error.message);
                    return false;
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: result.value.message || 'Lamaran berhasil ditolak',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '/rekrutmen/lamaran';
                });
            }
        });
    });

    // Fetch the application details on page load
    fetchLamaranDetail();
});
</script>
@endpush

@endsection