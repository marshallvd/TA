@extends('layouts.master')

@section('title')
    Edit Wawancara
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Wawancara</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-person-interview text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Informasi Wawancara</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="editWawancaraForm" class="needs-validation" novalidate>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="pelamarName">
                                            <i class="bi bi-person me-1"></i>Nama Pelamar
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="pelamarName" 
                                               readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="pelamarEmail">
                                            <i class="bi bi-envelope me-1"></i>Email Pelamar
                                        </label>
                                        <input type="email" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="pelamarEmail" 
                                               readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="tanggalWawancara">
                                            <i class="bi bi-calendar me-1"></i>Tanggal Wawancara
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="datetime-local" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="tanggalWawancara" 
                                               required>
                                        <div class="invalid-feedback">
                                            Tanggal wawancara tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="lokasiWawancara">
                                            <i class="bi bi-geo-alt me-1"></i>Lokasi Wawancara
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="lokasiWawancara" 
                                               required 
                                               placeholder="Masukkan lokasi wawancara">
                                        <div class="invalid-feedback">
                                            Lokasi wawancara tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="catatanWawancara">
                                            <i class="bi bi-journal-text me-1"></i>Catatan Wawancara
                                        </label>
                                        <textarea class="form-control form-control-lg shadow-none border-2" 
                                                  id="catatanWawancara" 
                                                  rows="4" 
                                                  placeholder="Masukkan catatan wawancara"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="statusWawancara">
                                            <i class="bi bi-check-circle me-1"></i>Status Wawancara
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-control-lg shadow-none border-2" 
                                                id="statusWawancara" 
                                                required>
                                            <option value="">Pilih Status</option>
                                            <option value="tertunda">Tertunda</option>
                                            <option value="lulus">Lulus</option>
                                            <option value="gagal">Gagal</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Status wawancara harus dipilih
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="{{ route('wawancara.index') }}" class="btn btn-danger me-2">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali
                                    </a>
                                    <button type="button" id="resetButton" class="btn btn-warning me-2">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-save me-2"></i>Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<!-- CSS sama seperti di halaman create -->
<style>
    /* Card Styling */
    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }

    /* Form Controls */
    .form-label {
        color: #344767;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .form-control,
    .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 6px;
        padding: 0.6rem 1rem;
        font-size: 0.95rem;
        transition: all 0.2s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #5e72e4;
        box-shadow: 0 0 0 3px rgba(94, 114, 228, 0.1);
    }

    .input-group-text {
        background: #f8f9fa;
        border: 2px solid #e0e0e0;
        border-left: none;
        color: #6c757d;
    }

    /* Validation Styling */
    .was-validated .form-control:invalid,
    .form-control.is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    .invalid-feedback {
        font-size: 0.875em;
        color: #dc3545;
    }

    /* Buttons */
    .btn {
        padding: 0.6rem 1.5rem;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.2s;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .btn-success {
        background-color: #2dce89;
        border-color: #2dce89;
    }

    .btn-success:hover {
        background-color: #28b97b;
        border-color: #28b97b;
    }

    .btn-warning {
        background-color: #fb6340;
        border-color: #fb6340;
        color: white;
    }

    .btn-warning:hover {
        background-color: #fa3a0e;
        border-color: #fa3a0e;
        color: white;
    }

    .btn-danger {
        background-color: #f5365c;
        border-color: #f5365c;
    }

    .btn-danger:hover {
        background-color: #f40b38;
        border-color: #f40b38;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const editForm = document.getElementById('editWawancaraForm');
    const resetButton = document.getElementById('resetButton');
    
    // Elemen-elemen form
    const pelamarName = document.getElementById('pelamarName');
    const pelamarEmail = document.getElementById('pelamarEmail');
    const tanggalWawancara = document.getElementById('tanggalWawancara');
    const lokasiWawancara = document.getElementById('lokasiWawancara');
    const catatanWawancara = document.getElementById('catatanWawancara');
    const statusWawancara = document.getElementById('statusWawancara');
    
    // Variabel untuk menyimpan data awal
    let originalData = {};

    // Check token
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Authentication Error',
            text: 'Token tidak ditemukan. Silakan login kembali.'
        }).then(() => {
            window.location.href = '{{ route('login') }}';
        });
        return;
    }

    // Ambil ID dengan cara lama
    const pathSegments = window.location.pathname.split('/');
    const wawancaraId = pathSegments[pathSegments.indexOf('edit') - 1];

    // Debugging
    console.log('Path Segments:', pathSegments);
    console.log('Wawancara ID:', wawancaraId);

    // Fungsi format tanggal untuk datetime-local
    function formatDateForInput(dateString) {
        if (!dateString) return '';
        const date = new Date(dateString);
        return date.toISOString().slice(0, 16);
    }

    // Fetch existing data
    async function fetchWawancaraDetail() {
        try {
            const response = await fetch(`/api/wawancara/${wawancaraId}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                const errorData = await response.text();
                throw new Error(errorData || `HTTP error! status: ${response.status}`);
            }

            const responseData = await response.json();
            console.log('Full Wawancara Response:', responseData);

            // Sesuaikan dengan struktur data yang diterima
            const wawancara = responseData.data.wawancara || {};
            const pelamarData = responseData.data.pelamar || wawancara.pelamar || {};

            // Simpan data awal
            originalData = {
                tanggal_wawancara: wawancara.tanggal_wawancara || '',
                lokasi: wawancara.lokasi || '',
                catatan: wawancara.catatan || '',
                hasil: wawancara.hasil || ''
            };

            // Update UI
            pelamarName.value = pelamarData.nama || 'Nama Tidak Tersedia';
            pelamarEmail.value = pelamarData.email || 'Email Tidak Tersedia';
            tanggalWawancara.value = formatDateForInput(wawancara.tanggal_wawancara);
            lokasiWawancara.value = wawancara.lokasi || '';
            catatanWawancara.value = wawancara.catatan || '';
            
            // Set status wawancara
            if (wawancara.hasil) {
                statusWawancara.value = wawancara.hasil.toLowerCase();
            }

        } catch (error) {
            console.error('Error Detail Wawancara:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Terjadi kesalahan saat memuat data',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '/rekrutmen/wawancara';
            });
        }
    }

    // Panggil fungsi fetch
    fetchWawancaraDetail();

    // Handle form submission
    editForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = {
            tanggal_wawancara: tanggalWawancara.value,
            lokasi: lokasiWawancara.value,
            catatan: catatanWawancara.value,
            hasil: statusWawancara.value
        };

        // Validasi form
        if (!formData.tanggal_wawancara || !formData.lokasi || !formData.hasil) {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Error',
                text: 'Harap lengkapi semua field yang wajib diisi',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Show loading state
        Swal.fire({
            title: 'Mohon Tunggu',
            text: 'Sedang memperbarui data...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        try {
            const response = await fetch(`/api/wawancara/${wawancaraId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Gagal memperbarui data wawancara');
            }

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data wawancara berhasil diperbarui',
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/rekrutmen/wawancara';
                }
            });

        } catch (error) {
            console.error('Error:', error);
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Terjadi kesalahan saat memperbarui data',
                showConfirmButton: true
            });
        }
    });

    // Reset button functionality
    resetButton.addEventListener('click', function() {
        Swal.fire({
            title: 'Reset Form?',
            text: 'Anda akan mengembalikan form ke data awal',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                tanggalWawancara.value = formatDateForInput(originalData.tanggal_wawancara);
                lokasiWawancara.value = originalData.lokasi;
                catatanWawancara.value = originalData.catatan;
                statusWawancara.value = originalData.hasil.toLowerCase();

                Swal.fire({
                    icon: 'success',
                    title: 'Form Direset',
                    text: 'Form telah dikembalikan ke data awal',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    });

    // Tambahkan global error handler
    window.addEventListener('unhandledrejection', function(event ) {
        console.error('Unhandled promise rejection:', event.reason);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan yang tidak terduga. Silakan coba lagi.',
            confirmButtonText: 'OK'
        });
    });
});
</script>
@endpush