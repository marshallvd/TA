@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Detail Wawancara
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Wawancara</h2></b>
                    <p class="card-text text-muted">Recruitment Management System</p>
                </div>
                <div>
                    <i class="bi bi-person-lines-fill text-primary" style="font-size: 3rem;"></i>
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
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Alamat:</strong></p>
                            <p class="text-muted" id="alamatPelamar">-</p>
                        </div>
                        <div class="col-md-4 mt-2">
                            <p class="mb-1"><strong>Pendidikan Terakhir:</strong></p>
                            <p class="text-muted" id="pendidikanTerakhir">-</p>
                        </div>
                        <div class="col-md-4 mt-2">
                            <p class="mb-1"><strong>Pengalaman Kerja:</strong></p>
                            <p class="text-muted" id="pengalamanKerja">-</p>
                        </div>
                        <div class="col-md-4 mt-2">
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
        {{-- Wawancara Details Card --}}
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Detail Wawancara</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="lamaran-detail-item mb-4">
                                <label class="text-muted small mb-1">Tanggal Wawancara</label>
                                <h6 class="mb-0" id="tanggalWawancara">-</h6>
                            </div>
                            <div class="lamaran-detail-item mb-4">
                                <label class="text-muted small mb-1">Lokasi Wawancara</label>
                                <h6 class="mb-0" id="lokasiWawancara">-</h6>
                            </div>
                            <div class="lamaran-detail-item">
                                <label class="text-muted small mb-1">Posisi yang Dilamar</label>
                                <h6 class="mb-0" id="judulPekerjaan">-</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="lamaran-detail-item mb-4">
                                <label class="text-muted small mb-1">Catatan Wawancara</label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-0" id="catatanWawancara">-</p>
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
                        <label class="text-muted small mb-2">Status Wawancara</label>
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
                                Lulus Wawancara
                            </button>
                            <button class="btn btn-outline-danger" id="rejectBtn">
                                <i class="bi bi-x-square me-2"></i>
                                Tidak Lulus
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
                <!-- Isi sama seperti di view lamaran -->
                <div class="d-flex align -items-center mb-3">
                    <div class="alert-icon me-3">
                        <i class="fas fa-info-circle fs-4 text-primary"></i>
                    </div>
                    <div>
                        <h4 class="alert-heading mb-0">Panduan Evaluasi Wawancara</h4>
                        <p class="text-muted mb-0">Pertimbangkan hal-hal berikut sebelum memberikan keputusan:</p>
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const pathSegments = window.location.pathname.split('/');
    const wawancaraId = pathSegments[pathSegments.indexOf('view') - 1];

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

    // Fetch detailed information about the interview
    async function fetchWawancaraDetail() {
    try {
        const response = await fetch(`/api/wawancara/${wawancaraId}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        const responseData = await response.json();

        if (!response.ok) {
            throw new Error(responseData.message || 'Gagal mengambil detail wawancara');
        }

        // Ambil data dari struktur yang benar
        const wawancara = responseData.data;
        const pelamarData = responseData.data.pelamar;
        const lowonganPekerjaan = responseData.data.lamaran_pekerjaan.lowongan_pekerjaan;
        const lamaranPekerjaan = responseData.data.lamaran_pekerjaan;

        // Update UI dengan data yang benar
        document.getElementById('pelamarName').innerText = pelamarData.nama || '-';
        document.getElementById('pelamarEmail').innerText = pelamarData.email || '-';
        document.getElementById('pelamarPhone').innerText = pelamarData.no_hp || '-';
        document.getElementById('alamatPelamar').innerText = pelamarData.alamat || '-';
        document.getElementById('pendidikanTerakhir').innerText = pelamarData.pendidikan_terakhir || '-';
        document.getElementById('pengalamanKerja').innerText = pelamarData.pengalaman_kerja || '-';
        
        // Posisi yang dilamar
        document.getElementById('judulPekerjaan').innerText = lowonganPekerjaan.judul_pekerjaan || '-';

        // Tanggal wawancara
        document.getElementById('tanggalWawancara').innerText = 
            wawancara.tanggal_wawancara ? 
            new Date(wawancara.tanggal_wawancara).toLocaleString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }) : '-';

        document.getElementById('lokasiWawancara').innerText = wawancara.lokasi || '-';
        document.getElementById('catatanWawancara').innerText = wawancara.catatan || '-';

        // Status badge
        const statusBadge = document.getElementById('statusBadge');
        const hasilWawancara = wawancara.hasil;
        statusBadge.innerText = hasilWawancara || '-';
        statusBadge.className = getStatusBadgeClass(hasilWawancara?.toLowerCase());

        // Set button status
        setButtonStatus(hasilWawancara?.toLowerCase());

        // CV Link
        const cvLink = document.getElementById('cvLink');
        const cvPath = pelamarData.cv_path;
        if (cvPath) {
            cvLink.href = cvPath;
            cvLink.style.display = 'inline-block';
        } else {
            cvLink.style.display = 'none';
        }

    } catch (error) {
        console.error('Error Detail Wawancara:', error);
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
        window.location.href = '/rekrutmen/wawancara';
    });

    // Approve button event listener
    document.getElementById('approveBtn').addEventListener('click', async function() {
        Swal.fire({
            title: 'Konfirmasi Kelulusan',
            text: 'Apakah Anda yakin ingin menyatakan pelamar LULUS?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Lulus',
            cancelButtonText: 'Batal'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(`/api/wawancara/${wawancaraId}/status`, {
                        method: 'PUT',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ hasil: 'lulus', catatan: 'Lolos tahap wawancara' })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'Gagal mengupdate status wawancara');
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Wawancara Lulus',
                        text: 'Status wawancara berhasil diperbarui',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '/rekrutmen/wawancara';
                    });
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Terjadi kesalahan saat memperbarui status',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });

    // Reject button event listener
    document.getElementById('rejectBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Alasan Wawancara Gagal',
            input: 'textarea',
            inputLabel: 'Berikan alasan mengapa wawancara dinyatakan gagal',
            inputPlaceholder: 'Tulis alasan penolakan di sini...',
            showCancelButton: true,
            confirmButtonText: 'Tandai Gagal',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
                if (!value) {
                    return 'Anda harus memberikan alasan wawancara gagal!';
                }
            }
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(`/api/wawancara/${wawancaraId}/status`, {
                        method: 'PUT',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ hasil: 'gagal', catatan: result.value })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.message || 'Gagal mengupdate status wawancara');
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Wawancara Gagal',
                        text: 'Status wawancara berhasil diperbarui',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '/rekrutmen/wawancara';
                    });
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Terjadi kesalahan saat memperbarui status',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });
// Fungsi untuk mendapatkan kelas badge berdasarkan status
function getStatusBadgeClass(status) {
    const statusClasses = {
        'lulus': 'badge rounded-pill bg-success',
        'gagal': 'badge rounded-pill bg-danger',
        'tertunda': 'badge rounded-pill bg-warning',
        'default': 'badge rounded-pill bg-secondary'
    };
    return statusClasses[status] || statusClasses['default'];
}

// Fungsi untuk mengatur status tombol
function setButtonStatus(status) {
    const approveBtn = document.getElementById('approveBtn');
    const rejectBtn = document.getElementById('rejectBtn');

    // Reset semua kondisi tombol
    approveBtn.classList.remove('btn-success', 'btn-secondary', 'btn-success');
    rejectBtn.classList.remove('btn-danger', 'btn-secondary', 'btn-primary');

    // Reset status disabled
    approveBtn.disabled = false;
    rejectBtn.disabled = false;

    switch(status) {
        case 'lulus':
            // Tombol lulus menjadi secondary dan tidak bisa diklik
            approveBtn.classList.add('btn-secondary');
            approveBtn.disabled = true;
            
            // Tombol gagal aktif dengan warna danger
            rejectBtn.classList.add('btn-danger');
            rejectBtn.disabled = false;
            break;
        
        case 'gagal':
            // Tombol lulus aktif dengan warna primary
            approveBtn.classList.add('btn-success');
            approveBtn.disabled = false;
            
            // Tombol gagal menjadi secondary dan tidak bisa diklik
            rejectBtn.classList.add('btn-secondary');
            rejectBtn.disabled = true;
            break;
        
        case 'tertunda':
            // Kedua tombol aktif
            approveBtn.classList.add('btn-success');
            rejectBtn.classList.add('btn-danger');
            break;
        
        default:
            // Fallback ke kondisi default
            approveBtn.classList.add('btn-success');
            rejectBtn.classList.add('btn-danger');
    }
}
    // Fetch the interview details on page load
    fetchWawancaraDetail();
});
</script>
@endpush