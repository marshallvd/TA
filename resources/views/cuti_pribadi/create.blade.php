@extends('layouts.master')

@section('title')
    Pengajuan Cuti
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <h2 class="card-title mb-1 fw-bold">Pengajuan Cuti</h2>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-calendar-plus text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Employee Information Card --}}
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person-badge me-2"></i>Informasi Pegawai
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-3">
                            <div class="info-item">
                                <label class="text-muted mb-2">Nama Lengkap</label>
                                <p class="mb-0 fw-medium" id="pegawaiName">-</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="info-item">
                                <label class="text-muted mb-2">NIK</label>
                                <p class="mb-0 fw-medium" id="pegawaiNIK">-</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="info-item">
                                <label class="text-muted mb-2">Divisi</label>
                                <p class="mb-0 fw-medium" id="pegawaiDivision">-</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="info-item">
                                <label class="text-muted mb-2">Jabatan</label>
                                <p class="mb-0 fw-medium" id="pegawaiPosition">-</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Leave Balance Card --}}
        <div class="col-12 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-calendar-check me-2"></i>Sisa Jatah Cuti
                    </h5>
                </div>
                <div class="card-body">
                    <div class="leave-balance-item mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Cuti Tahunan</span>
                            <span class="badge bg-primary" id="sisaCutiTahunan">12 hari</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" role="progressbar" id="progressCutiTahunan" style="width: 100%"></div>
                        </div>
                    </div>
                    <div class="leave-balance-item mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Cuti Khusus</span>
                            <span class="badge bg-info" id="sisaCutiKhusus">3 hari</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" role="progressbar" id="progressCutiKhusus" style="width: 100%"></div>
                        </div>
                    </div>
                    <div class="leave-balance-item">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Cuti Melahirkan</span>
                            <span class="badge bg-success" id="sisaCutiMelahirkan">90 hari</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar" id="progressCutiMelahirkan" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Leave Application Form --}}
        <div class="col-12 col-lg-8 mb-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-file-earmark-text me-2"></i>Form Pengajuan Cuti
                    </h5>
                </div>
                <div class="card-body">
                    <form id="pengajuanCutiForm" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Jenis Cuti <span class="text-danger">*</span></label>
                                <select class="form-select" name="jenis_cuti" id="jenis_cuti" required>
                                    <option value="" selected disabled>Pilih jenis cuti</option>
                                    <option value="tahunan">Cuti Tahunan</option>
                                    <option value="khusus">Cuti Khusus</option>
                                    <option value="melahirkan">Cuti Melahirkan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Pilih jenis cuti
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kategori Cuti <span class="text-danger">*</span></label>
                                <select class="form-select" name="kategori_cuti" id="kategori_cuti" required disabled>
                                    <option value="" selected disabled>Pilih kategori cuti</option>
                                </select>
                                <div class="invalid-feedback">
                                    Pilih kategori cuti
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" required>
                                <div class="invalid-feedback">
                                    Pilih tanggal mulai cuti
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai" required>
                                <div class="invalid-feedback">
                                    Pilih tanggal selesai cuti
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Keterangan <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" required></textarea>
                                <div class="invalid-feedback">
                                    Masukkan keterangan cuti
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Dokumen Pendukung</label>
                                <input type="file" class="form-control" name="dokumen" id="dokumen">
                                <div class="form-text">Format: PDF, JPG, PNG (Max. 2MB)</div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <div class="d-flex">
                                        <i class="bi bi-info-circle me-2"></i>
                                        <div>
                                            <p class="mb-0">Total hari cuti yang diajukan: <strong id="totalHariCuti">0 hari</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-end">
                                <a href="{{ route('cuti.index') }}" class="btn btn-light me-2">
                                    <i class="bi bi-x-circle me-2"></i>Batal
                                </a>
                                <button type="button" id="resetButton" class="btn btn-warning me-2">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>Ajukan Cuti
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Leave Guidelines --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-book me-2"></i>Panduan Pengajuan Cuti
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Ketentuan Umum</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Pengajuan cuti minimal 3 hari sebelum tanggal mulai
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Pastikan sisa cuti mencukupi sebelum mengajukan
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Lengkapi dokumen pendukung jika diperlukan
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Jenis-jenis Cuti</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="bi bi-calendar-check text-primary me-2"></i>
                                    <strong>Cuti Tahunan:</strong> Max. 12 hari per tahun
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-calendar-heart text-info me-2"></i>
                                    <strong>Cuti Khusus:</strong> Sesuai ketentuan yang berlaku
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-calendar-plus text-success me-2"></i>
                                    <strong>Cuti Melahirkan:</strong> Max. 90 hari kerja
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: none;
        margin-bottom: 1.5rem;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        padding: 1rem;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .progress {
        background-color: #e9ecef;
        border-radius: 0.5rem;
    }

    .progress-bar {
        border-radius: 0.5rem;
    }

    .badge {
        font-weight: 500;
        padding: 0.5em 0.75em;
    }

    .info-item label {
        font-size: 0.875rem;
    }

    .info-item p {
        font-size: 1rem;
    }

    .alert-info {
        background-color: #f8f9fa;
        border-left: 4px solid #0dcaf0;
    }

    .list-unstyled li {
        display: flex;
        align-items: start;
    }

    .btn {
        padding: 0.5rem 1rem;
        font-weight: 500;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .invalid-feedback {
        font-size: 0.875em;
    }
</style>
@endpush


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const baseUrl = 'http://127.0.0.1:8000/api';
    let cutiPribadiTable;
    
    // Fungsi untuk menangani error dengan SweetAlert
    function handleError(title, message) {
        Swal.fire({
            icon: 'error',
            title: title,
            text: message,
            confirmButtonText: 'OK'
        });
    }

    // Cek token keberadaan
    if (!token) {
        handleError('Akses Ditolak', 'Anda harus login untuk mengakses halaman ini.');
        window.location.href = '/login';
        return;
    }

    // Fetch user data terlebih dahulu
    fetch(`${baseUrl}/auth/me`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Gagal mengambil data pengguna');
        }
        return response.json();
    })
    .then(userData => {
        // DEBUGGING: Tambahkan log detail
        console.log('======= DEBUG USER DATA =======');
        console.log('Data Pengguna Lengkap (Stringified):', JSON.stringify(userData, null, 2));
        console.log('Struktur userData:', Object.keys(userData));
        console.log('Struktur pegawai:', Object.keys(userData.pegawai || {}));
        
        // PENTING: Pastikan pengambilan ID Pegawai benar
        const idPegawai = userData.pegawai ? userData.pegawai.id_pegawai : null;
        const idUser = userData.user ? userData.user.id_user : null;
        
        console.log('ID Pegawai yang Sedang Login:', idPegawai);
        console.log('ID User:', idUser);
        console.log('Tipe ID Pegawai:', typeof idPegawai);
        
        if (!idPegawai) {
            throw new Error('Tidak dapat menemukan ID Pegawai');
        }

        // Initialize DataTable dengan ID pengguna
        cutiPribadiTable = $('#cuti-pribadi-table').DataTable({
            processing: true,
            serverSide: false,
            pageLength: 10,
            ajax: {
                url: `${baseUrl}/cuti`,
                type: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                dataSrc: function(response) {
                    console.log('======= DEBUG CUTI DATA =======');
                    console.log('Respon API Cuti Mentah (Stringified):', JSON.stringify(response, null, 2));
                    console.log('Total Data Cuti:', response.data.length);
                    
                    // Debugging: Tampilkan detail setiap item cuti
                    response.data.forEach((item, index) => {
                        console.log(`Item Cuti ke-${index + 1}:`, JSON.stringify(item, null, 2));
                    });
                    
                    // Filter data berdasarkan id_pegawai 
                    const filteredData = response.data.filter(item => {
                        console.log('Filtering Cuti - Item Full:', JSON.stringify(item, null, 2));
                        console.log('Comparing ID Pegawai:', item.id_pegawai, 'dengan ID Login:', idPegawai);
                        
                        // Pastikan perbandingan ID dilakukan dengan benar
                        return item.id_pegawai === idPegawai;
                    });

                    console.log('Data Cuti Terfilter:', filteredData);
                    console.log('Jumlah Data Cuti Terfilter:', filteredData.length);
                    
                    // Tambahkan pesan khusus jika tidak ada data
                    if (filteredData.length === 0) {
                        console.warn('Tidak ada data cuti ditemukan untuk pegawai ini');
                    }
                    
                    return filteredData;
                },
                error: function(xhr, error, thrown) {
                    console.error('Error mengambil data:', error);
                    console.error('Response Error:', xhr.responseText);
                    handleError('Error', 'Gagal memuat data: ' + (xhr.responseJSON?.message || 'Error tidak dikenal'));
                }
            },
            columns: [
                { 
                    data: null, 
                    render: (data, type, row, meta) => meta.row + 1 
                },
                { 
                    data: 'jenis_cuti.nama_jenis_cuti',
                    render: function(data, type, row) {
                        return data || 'Tidak ada data';
                    }
                },
                { 
                    data: 'tanggal_mulai',
                    render: function(data) {
                        return data ? new Date(data).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        }) : '-';
                    }
                },
                { 
                    data: 'tanggal_selesai',
                    render: function(data) {
                        return data ? new Date(data).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        }) : '-';
                    }
                },
                { 
                    data: 'status',
                    render: function(data) {
                        const statusClasses = {
                            'menunggu': 'badge bg-warning',
                            'disetujui': 'badge bg-success',
                            'ditolak': 'badge bg-danger'
                        };
                        const statusText = {
                            'menunggu': 'Menunggu',
                            'disetujui': 'Disetujui',
                            'ditolak': 'Ditolak'
                        };
                        return `<span class="${statusClasses[data] || 'badge bg-secondary'}">${statusText[data] || data}</span>`;
                    }
                },
                { 
                    data: null,
                    render: function(data) {
                        if (data.status === 'menunggu') {
                            return `
                                <div class="flex align-items-center list-user-action">
                                    <a href="/cuti-pribadi/${data.id_cuti}/edit" 
                                       class="btn btn-sm btn-icon btn-warning" 
                                       data-bs-toggle="tooltip" 
                                       data-bs-placement="top" 
                                       title="Edit">
                                        <span class="btn-inner">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </a>
                                    <a href="javascript:void(0)"
                                       class="btn btn-sm btn-icon btn-danger"
                                       data-bs-toggle="tooltip"
                                       data-bs-placement="top"
                                       title="Delete"
                                       onclick="deleteCuti(${data.id_cuti})">
                                        <span class="btn-inner">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            `;
                        }
                        return '-';
                    }
                }
            ],
            language: {
                processing: "Memuat...",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data yang tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
                search: "Cari:"
            },
            order: [[2, 'desc']]
        });

        // Inisialisasi tooltip setelah tabel digambar
        cutiPribadiTable.on('draw', function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    })
    .catch(error => {
        console.error('Error Utama:', error);
        handleError('Error', 'Gagal memuat data: ' + error.message);
    });

    // Event listener untuk tombol "Tambah Pengajuan Cuti"
    document.getElementById('tambahCutiBtn').addEventListener('click', function() {
        window.location.href = '/cuti/create';
    });
});

// Definisikan fungsi deleteCuti dalam lingkup global
window.deleteCuti = function(idCuti) {
    const token = localStorage.getItem('token');
    const baseUrl = 'http://127.0.0.1:8000/api';

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`${baseUrl}/cuti/${idCuti}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal menghapus data');
                }
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Pengajuan cuti telah dihapus.',
                    showConfirmButton: false,
                    timer: 1500
                });
                // Muat ulang DataTable untuk mencerminkan perubahan
                $('#cuti-pribadi-table').DataTable().ajax.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal menghapus data: ' + error.message
                });
            });
        }
    });
};
</script>

@endpush