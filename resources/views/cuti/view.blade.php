@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Detail Pengajuan Cuti
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Pengajuan Cuti</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-calendar-week text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Employee Information Card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Informasi Pegawai</h4>
                    <button type="button" class="btn btn-danger btn-sm" id="btnBack">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </button>
                </div>
                <div class="card-body">
                    <div class="row small" id="pegawaiDetails">
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Nama:</strong></p>
                            <p class="text-muted" id="pegawaiName">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>NIK:</strong></p>
                            <p class="text-muted" id="pegawaiNIK">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Divisi:</strong></p>
                            <p class="text-muted" id="pegawaiDivision">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Jabatan:</strong></p>
                            <p class="text-muted" id="pegawaiPosition">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Row --}}
    <div class="row">
        {{-- Leave Details Card --}}
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Detail Pengajuan Cuti</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="leave-detail-item mb-4">
                                <label class="text-muted small mb-1">Jenis Cuti</label>
                                <h6 class="mb-0" id="jenisCuti">-</h6>
                            </div>
                            <div class="leave-detail-item mb-4">
                                <label class="text-muted small mb-1">Tanggal Mulai</label>
                                <h6 class="mb-0" id="tanggalMulai">-</h6>
                            </div>
                            <div class="leave-detail-item mb-4">
                                <label class="text-muted small mb-1">Tanggal Selesai</label>
                                <h6 class="mb-0" id="tanggalSelesai">-</h6>
                            </div>
                            <div class="leave-detail-item">
                                <label class="text-muted small mb-1">Jumlah Hari</label>
                                <h6 class="mb-0" id="jumlahHari">-</h6>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="leave-detail-item mb-4">
                                <label class="text-muted small mb-1">Alasan Cuti</label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-0" id="alasan">-</p>
                                </div>
                            </div>
                            <div class="leave-detail-item">
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
                        <label class="text-muted small mb-2">Status Pengajuan</label>
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

                    {{-- Divider --}}
                    {{-- <hr class="my-4"> --}}

                    {{-- Action Buttons Section --}}
                    <div class="action-section">
                        <label class="text-muted small mb-3">Tindakan yang Tersedia</label>
                        <div class="d-grid gap-3">
                            <button class="btn btn-success" id="approveBtn">
                                <i class="bi bi-check2-square me-2"></i>

                                Setujui Pengajuan
                            </button>
                            <button class="btn btn-outline-danger" id="rejectBtn">
                                <i class="bi bi-x-square me-2"></i>
                                Tolak Pengajuan
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
                        <h4 class="alert-heading mb-0">Panduan Persetujuan Cuti</h4>
                        <p class="text-muted mb-0">Mohon perhatikan hal-hal berikut sebelum memberikan persetujuan:</p>
                    </div>
                </div>
                
                <div class="row g-4 mt-2">
                    <div class="col-md-6 col-lg-3">
                        <div class="guidance-item">
                            <div class="d-flex align-items-center mb-2">
                                <div class="guidance-icon bg-primary-subtle rounded-circle me-2">
                                    <i class="fas fa-check-double text-primary"></i>
                                </div>
                                <h6 class="mb-0">Verifikasi Kesesuaian</h6>
                            </div>
                            <p class="small text-muted mb-0">Pastikan jenis cuti sesuai dengan alasan yang diajukan</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="guidance-item">
                            <div class="d-flex align-items-center mb-2">
                                <div class="guidance-icon bg-warning-subtle rounded-circle me-2">
                                    <i class="fas fa-calendar-check text-warning"></i>
                                </div>
                                <h6 class="mb-0">Cek Agenda Divisi</h6>
                            </div>
                            <p class="small text-muted mb-0">Periksa kalender divisi untuk menghindari konflik</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="guidance-item">
                            <div class="d-flex align-items-center mb-2">
                                <div class="guidance-icon bg-success-subtle rounded-circle me-2">
                                    <i class="fas fa-user-clock text-success"></i>
                                </div>
                                <h6 class="mb-0">Sisa Jatah Cuti</h6>
                            </div>
                            <p class="small text-muted mb-0">Verifikasi ketersediaan jatah cuti pegawai</p>
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
    .leave-detail-item {
        background: #fff;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .leave-detail-item:hover {
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
    const cutiId = pathSegments[pathSegments.indexOf('cuti') + 1];

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

    // Function to calculate days between two dates
    function calculateDays(startDate, endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);
        const diffTime = Math.abs(end - start);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        return diffDays;
    }

    // Function to redirect to index page
    function redirectToIndex() {
        window.location.href = '/cuti';
    }

    async function fetchCutiDetail() {
        try {
            if (!cutiId) {
                throw new Error('ID Cuti tidak valid');
            }

            const response = await fetch(`${API_BASE_URL}/cuti/${cutiId}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            const responseData = await response.json();

            if (!response.ok) {
                throw new Error(responseData.message || 'Gagal mengambil detail cuti');
            }

            const cuti = responseData.data;
            
            // Fetch employee data with error handling
            const pegawaiResponse = await fetch(`${API_BASE_URL}/pegawai/${cuti.id_pegawai}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            
            if (!pegawaiResponse.ok) {
                throw new Error('Gagal mengambil data pegawai');
            }
            
            const pegawaiData = await pegawaiResponse.json();
            const pegawai = pegawaiData.data;

            // Update UI with employee data
            document.getElementById('pegawaiName').innerText = pegawai.nama_lengkap || '-';
            document.getElementById('pegawaiNIK').innerText = pegawai.nik || '-';

            // Fetch division data with error handling
            if (pegawai.id_divisi) {
                const divisiResponse = await fetch(`${API_BASE_URL}/divisi/${pegawai.id_divisi}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
                if (!divisiResponse.ok) {
                    throw new Error('Gagal mengambil data divisi');
                }
                const divisiData = await divisiResponse.json();
                document.getElementById('pegawaiDivision').innerText = divisiData.nama_divisi;
            }

            // Fetch position data with error handling
            if (pegawai.id_jabatan) {
                const jabatanResponse = await fetch(`${API_BASE_URL}/jabatan/${pegawai.id_jabatan}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
                if (!jabatanResponse.ok) {
                    throw new Error('Gagal mengambil data jabatan');
                }
                const jabatanData = await jabatanResponse.json();
                document.getElementById('pegawaiPosition').innerText = jabatanData.nama_jabatan;
            }

            // Fetch leave type data with error handling
            if (cuti.id_jenis_cuti) {
                const jenisCutiResponse = await fetch(`${API_BASE_URL}/jenis-cuti/${cuti.id_jenis_cuti}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
                if (!jenisCutiResponse.ok) {
                    throw new Error('Gagal mengambil data jenis cuti');
                }
                const jenisCutiData = await jenisCutiResponse.json();
                document.getElementById('jenisCuti').innerText = jenisCutiData.nama_jenis_cuti;
            }

            // Update leave request details
            document.getElementById('tanggalMulai').innerText = cuti.tanggal_mulai ? new Date(cuti.tanggal_mulai).toLocaleDateString('id-ID') : '-';
            document.getElementById('tanggalSelesai').innerText = cuti.tanggal_selesai ? new Date(cuti.tanggal_selesai).toLocaleDateString('id-ID') : '-';
            
            if (cuti.tanggal_mulai && cuti.tanggal_selesai) {
                const days = calculateDays(cuti.tanggal_mulai, cuti.tanggal_selesai);
                document.getElementById('jumlahHari').innerText = `${days} hari`;
            }

            document.getElementById('alasan').innerText = cuti.alasan || '-';
            document.getElementById('keterangan').innerText = cuti.keterangan || '-';

            // Update status badge
            const statusBadge = document.getElementById('statusBadge');
            statusBadge.innerText = cuti.status || '-';
            
            switch (cuti.status?.toLowerCase()) {
                case 'menunggu':
                    statusBadge.className = 'badge rounded-pill bg-warning';
                    break;
                case 'disetujui':
                    statusBadge.className = 'badge rounded-pill bg-success';
                    break;
                case 'ditolak':
                    statusBadge.className = 'badge rounded-pill bg-danger';
                    break;
                default:
                    statusBadge.className = 'badge rounded-pill bg-secondary';
            }

            // Show/hide action buttons
            const actionButtons = document.getElementById('approveBtn').parentElement;
            actionButtons.style.display = cuti.status?.toLowerCase() === 'menunggu' ? 'flex' : 'none';

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

    // Back button handler
    document.getElementById('btnBack').addEventListener('click', () => {
        window.location.href = '/cuti';
    });

    // Reject button handler
    document.getElementById('rejectBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Masukkan Alasan Penolakan',
            input: 'textarea',
            inputPlaceholder: 'Tuliskan alasan penolakan di sini...',
            inputAttributes: {
                'aria-label': 'Alasan penolakan'
            },
            showCancelButton: true,
            confirmButtonText: 'Tolak',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true,
            preConfirm: async (keterangan) => {
                if (!keterangan.trim()) {
                    Swal.showValidationMessage('Alasan penolakan harus diisi');
                    return false;
                }

                try {
                    const response = await fetch(`${API_BASE_URL}/cuti/${cutiId}/ditolak`, {
                        method: 'PUT',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ keterangan })
                    });

                    const data = await response.json();
                    
                    if (!response.ok) {
                        throw new Error(data.message || 'Gagal menolak pengajuan cuti');
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
                    text: result.value.message || 'Pengajuan cuti berhasil ditolak',
                    confirmButtonText: 'OK'
                }).then(() => {
                    redirectToIndex();
                });
            }
        });
    });

    // Approve button handler
    document.getElementById('approveBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Konfirmasi Persetujuan',
            text: 'Apakah Anda yakin ingin menyetujui pengajuan cuti ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Setujui',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                try {
                    const response = await fetch(`${API_BASE_URL}/cuti/${cutiId}/diterima`, {
                        method: 'PUT',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    });

                    const data = await response.json();
                    
                    if (!response.ok) {
                        throw new Error(data.message || 'Gagal menyetujui pengajuan cuti');
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
                    text: result.value.message || 'Pengajuan cuti berhasil disetujui',
                    confirmButtonText: 'OK'
                }).then(() => {
                    redirectToIndex();
                });
            }
        });
    });

    // Initialize page
    fetchCutiDetail();
});
</script>
@endpush

@endsection