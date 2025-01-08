@extends('layouts.master')

@section('title')
    Edit Hasil Seleksi
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Hasil Seleksi</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-briefcase text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Informasi Hasil Seleksi</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="editHasilSeleksiForm" class="needs-validation" novalidate>
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
                                        <label class="form-label fw-bold" for="lowonganPekerjaan">
                                            <i class="bi bi-briefcase me-1"></i>Lowongan Pekerjaan
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="lowonganPekerjaan" 
                                               readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="statusHasil">
                                            <i class="bi bi-check-circle me-1"></i>Status Seleksi
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-control-lg shadow-none border-2" 
                                                id="statusHasil" 
                                                required>
                                            <option value="">Pilih Status</option>
                                            <option value="lulus">Lulus</option>
                                            <option value="gagal">Gagal</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Status seleksi harus dipilih
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="catatanHasil">
                                            <i class="bi bi-journal-text me-1"></i>Catatan Hasil Seleksi
                                        </label>
                                        <textarea class="form-control form-control-lg shadow-none border-2" 
                                                  id="catatanHasil" 
                                                  rows="4" 
                                                  placeholder="Masukkan catatan hasil seleksi"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="{{ route('rekrutmen.hasil_seleksi.index') }}" class="btn btn-danger me-2">
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
<style>
    /* Sama seperti di halaman edit wawancara */
    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }

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

    .btn {
        padding: 0.6rem 1.5rem;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.2s;
    }

    .btn:hover {
        transform: translateY(-1px);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const editForm = document.getElementById('editHasilSeleksiForm');
    const resetButton = document.getElementById('resetButton');
    
    // Elemen-elemen form
    const pelamarName = document.getElementById('pelamarName');
    const pelamarEmail = document.getElementById('pelamarEmail');
    const lowonganPekerjaan = document.getElementById('lowonganPekerjaan');
    const statusHasil = document.getElementById('statusHasil');
    const catatanHasil = document.getElementById('catatanHasil');
    

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

    // Ambil ID hasil seleksi dari URL
    const pathSegments = window.location.pathname.split('/');
    const hasilSeleksiId = pathSegments[pathSegments.indexOf('edit') - 1];

    // Fetch existing data
    async function fetchHasilSeleksiDetail() {
        try {
            const response = await fetch(`/api/hasil-seleksi/${hasilSeleksiId}`, {
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
            const hasilSeleksi = responseData.data || {};

            // Update UI
            pelamarName.value = hasilSeleksi.pelamar?.nama || 'Nama Tidak Tersedia';
            pelamarEmail.value = hasilSeleksi.pelamar?.email || 'Email Tidak Tersedia';
            lowonganPekerjaan.value = hasilSeleksi.lowongan_pekerjaan?.judul_pekerjaan || 'Tidak Diketahui';
            statusHasil.value = hasilSeleksi.status || '';
            catatanHasil.value = hasilSeleksi.catatan || '';

        } catch (error) {
            console.error('Error Detail Hasil Seleksi:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Terjadi kesalahan saat memuat data',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '/rekrutmen/hasil_seleksi';
            });
        }
    }

    // Panggil fungsi fetch
    fetchHasilSeleksiDetail();

    // Handle form submission
    editForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = {
            status: statusHasil.value,
            catatan: catatanHasil.value
        };

        // Validasi form
        if (!formData.status) {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Error',
                text: 'Harap pilih status hasil seleksi',
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
            const response = await fetch(`/api/hasil-seleksi/${hasilSeleksiId}`, {
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
                throw new Error(result.message || 'Gagal memperbarui data hasil seleksi');
            }

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data hasil seleksi berhasil diperbarui',
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/rekrutmen/hasil_seleksi';
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
                fetchHasilSeleksiDetail(); // Reset to original data
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
});
</script>
@endpush