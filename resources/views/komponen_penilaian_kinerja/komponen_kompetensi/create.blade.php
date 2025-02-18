@extends('layouts.master')

@section('title')
    Tambah Komponen Kompetensi
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Komponen Kompetensi</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-person-gear text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tambah Komponen Kompetensi Baru</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="createKompetensiForm" class="needs-validation" novalidate>
                            <div class="row g-4">
                                <!-- Nama Kompetensi dan Bobot dalam satu baris -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="nama_kompetensi">
                                            <i class="bi bi-bookmark me-1"></i>Nama Kompetensi
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="nama_kompetensi" 
                                               name="nama_kompetensi" 
                                               required 
                                               maxlength="100"
                                               placeholder="Masukkan nama kompetensi">
                                        <div class="invalid-feedback">
                                            Nama kompetensi tidak boleh kosong
                                        </div>
                                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Maksimal 100 karakter</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="bobot">
                                            <i class="bi bi-percent me-1"></i>Bobot
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="number" 
                                                   class="form-control form-control-lg shadow-none border-2" 
                                                   id="bobot" 
                                                   name="bobot" 
                                                   required 
                                                   min="0" 
                                                   max="100"
                                                   step="0.01"
                                                   placeholder="Masukkan bobot">
                                            <span class="input-group-text bg-light">%</span>
                                        </div>
                                        <div class="invalid-feedback">
                                            Bobot harus di antara 0 dan 100
                                        </div>
                                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Bobot harus di antara 0 dan 100</small>
                                    </div>
                                </div>

                                <!-- Perilaku Utama tetap full width -->
                                <div class="col-12">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="perilaku_utama">
                                            <i class="bi bi-list-check me-1"></i>Perilaku Utama
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control form-control-lg shadow-none border-2" 
                                                  id="perilaku_utama" 
                                                  name="perilaku_utama" 
                                                  required 
                                                  rows="4"
                                                  placeholder="Masukkan perilaku utama"></textarea>
                                        <div class="invalid-feedback">
                                            Perilaku utama tidak boleh kosong
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="{{ route('komponen-kompetensi.index') }}" class="btn btn-danger me-2">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali
                                    </a>
                                    <button type="button" id="resetButton" class="btn btn-warning me-2">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-save me-2"></i>Simpan
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
    const createForm = document.getElementById('createKompetensiForm');
    const resetButton = document.getElementById('resetButton');

    // Check token
    const token = localStorage.getItem('token');
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

    // Reset button functionality
    resetButton.addEventListener('click', function() {
        Swal.fire({
            title: 'Reset Form?',
            text: 'Semua data yang telah diisi akan dihapus',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                createForm.reset();
                createForm.classList.remove('was-validated');
                // Remove all is-invalid classes
                createForm.querySelectorAll('.is-invalid').forEach(element => {
                    element.classList.remove('is-invalid');
                });
                Swal.fire({
                    icon: 'success',
                    title: 'Form Direset',
                    text: 'Form telah dikosongkan',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    });

    // Form validation and submission
    createForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Basic validation
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        const formData = new FormData(this);
        const data = {
            nama_kompetensi: formData.get('nama_kompetensi').trim(),
            perilaku_utama: formData.get('perilaku_utama').trim(),
            bobot: formData.get('bobot').trim()
        };

        try {
            // Show loading state
            const loadingAlert = Swal.fire({
                title: 'Mohon Tunggu',
                text: 'Sedang menyimpan data...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Send data to API
            const response = await fetch('/api/komponen-kompetensi', {                
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            // Close loading alert
            await loadingAlert.close();

            const responseData = await response.json();

            if (!response.ok) {
                if (response.status === 401) {
                    throw new Error('Unauthorized');
                }
                
                // Handle validation errors
                if (responseData.errors) {
                    Object.keys(responseData.errors).forEach(key => {
                        const inputElement = document.getElementById(key);
                        if (inputElement) {
                            inputElement.classList.add('is-invalid');
                            const feedbackElement = inputElement.nextElementSibling;
                            if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                                feedbackElement.textContent = responseData.errors[key][0];
                            }
                        }
                    });
                    throw new Error('Validation failed');
                }

                throw new Error(responseData.message || 'Terjadi kesalahan saat menyimpan data');
            }

            // Show success message
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Komponen kompetensi berhasil disimpan',
                showConfirmButton: true
            }).then(() => {
                window.location.href = '{{ route("komponen-kompetensi.index") }}';
            });

        } catch (error) {
            console.error('Error:', error);
            
            let errorMessage = 'Terjadi kesalahan saat menyimpan data';
            if (error.message === 'Unauthorized') {
                window.location.href = '{{ route('login') }}';
                return;
            }

            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessage,
                showConfirmButton: true
            });
        }
    });

    // Add global fetch error handler
    window.addEventListener('unhandledrejection', function(event) {
        if (event.reason && event.reason.name === 'TypeError') {
            console.error('Network error occurred:', event.reason);
            Swal.fire({
                icon: 'error',
                title: 'Network Error',
                text: 'Terjadi kesalahan jaringan. Silakan coba lagi.'
            });
        }
    });
});
</script>
@endpush