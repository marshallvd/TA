@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Detail Pengajuan Cuti
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Informasi Pegawai</h4>
                    <button type="button" class="btn btn-danger btn-sm" id="btnBack">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
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

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Pengajuan Cuti</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h6 class="card-subtitle text-muted mb-1">Jenis Cuti</h6>
                                <p class="card-text" id="jenisCuti">-</p>
                            </div>
                            <div class="mb-4">
                                <h6 class="card-subtitle text-muted mb-1">Tanggal Mulai</h6>
                                <p class="card-text" id="tanggalMulai">-</p>
                            </div>
                            <div class="mb-4">
                                <h6 class="card-subtitle text-muted mb-1">Tanggal Selesai</h6>
                                <p class="card-text" id="tanggalSelesai">-</p>
                            </div>
                            <div class="mb-4">
                                <h6 class="card-subtitle text-muted mb-1">Jumlah Hari</h6>
                                <p class="card-text" id="jumlahHari">-</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h6 class="card-subtitle text-muted mb-1">Status</h6>
                                <span class="badge rounded-pill" id="statusBadge">-</span>
                            </div>
                            <div class="mb-4">
                                <h6 class="card-subtitle text-muted mb-1">Alasan</h6>
                                <p class="card-text" id="alasan">-</p>
                            </div>
                            <div class="mb-4">
                                <h6 class="card-subtitle text-muted mb-1">Keterangan</h6>
                                <p class="card-text" id="keterangan">-</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button class="btn btn-primary" id="approveBtn">
                            <i class="fas fa-check me-1"></i> Terima
                        </button>
                        <button class="btn btn-danger" id="rejectBtn">
                            <i class="fas fa-times me-1"></i> Tolak
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Panduan Persetujuan</h5>
                </div>
                <div class="card-body">
                    <ul class="small mb-0">
                        <li>Periksa kesesuaian jenis cuti dengan alasan yang diajukan</li>
                        <li>Pastikan tanggal cuti tidak berbenturan dengan agenda penting</li>
                        <li>Jika menolak, berikan alasan penolakan yang jelas</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk menolak pengajuan -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Alasan Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" id="rejectReason" rows="3" placeholder="Masukkan alasan penolakan"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmRejectBtn">Tolak Pengajuan</button>
            </div>
        </div>
    </div>
</div>

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

            const response = await fetch(`http://127.0.0.1:8000/api/cuti/${cutiId}`, {
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
            const pegawaiResponse = await fetch(`http://127.0.0.1:8000/api/pegawai/${cuti.id_pegawai}`, {
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
                const divisiResponse = await fetch(`http://127.0.0.1:8000/api/divisi/${pegawai.id_divisi}`, {
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
                const jabatanResponse = await fetch(`http://127.0.0.1:8000/api/jabatan/${pegawai.id_jabatan}`, {
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
                const jenisCutiResponse = await fetch(`http://127.0.0.1:8000/api/jenis-cuti/${cuti.id_jenis_cuti}`, {
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
                case 'diterima':
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
                    const response = await fetch(`http://127.0.0.1:8000/api/cuti/${cutiId}/ditolak`, {
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
                    const response = await fetch(`http://127.0.0.1:8000/api/cuti/${cutiId}/diterima`, {
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