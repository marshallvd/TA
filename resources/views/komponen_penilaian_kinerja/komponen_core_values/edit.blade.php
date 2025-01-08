@extends('layouts.master')

@section('title')
    Edit Komponen Core Values
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Komponen Core Values</h2></b>
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
                        <h4 class="card-title">Edit Komponen Core Values</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="editCoreValuesForm" class="needs-validation" novalidate>
                            <div class="row g-4">
                                <!-- Nama Core Values dan Bobot dalam satu baris -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="nama_core_values">
                                            <i class="bi bi-bookmark me-1"></i>Nama Core Values
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="nama_core_values" 
                                               name="nama_core_values" 
                                               required 
                                               maxlength="100"
                                               placeholder="Masukkan nama core values">
                                        <div class="invalid-feedback">
                                            Nama core values tidak boleh kosong
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
                                                  maxlength="500"
                                                  placeholder="Masukkan perilaku utama"></textarea>
                                        <div class="invalid-feedback">
                                            Perilaku utama tidak boleh kosong
                                        </div>
                                        <div class="text-end mt-1">
                                            <small class="text-muted">
                                                <span id="charCount">0</span>/500 karakter
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="{{ route('komponen-core-values.index') }}" class="btn btn-danger me-2">
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
    const editForm = document.getElementById('editCoreValuesForm');
    const resetButton = document.getElementById('resetButton');
    const coreValuesId = window.location.pathname.split('/').pop();
    const charCountSpan = document.getElementById('charCount');
    const perilakuTextarea = document.getElementById('perilaku_utama');

    // Check token
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Authentication Error',
            text: 'Token tidak ditemukan. Silakan login kembali.',
            allowOutsideClick: false
        }).then(() => {
            window.location.href = '{{ route('login') }}';
        });
        return;
    }

    // Character counter for perilaku_utama
    perilakuTextarea.addEventListener('input', function() {
        const length = this.value.length;
        charCountSpan.textContent = length;

        if (length > 500) {
            this.value = this.value.substring(0, 500);
            charCountSpan.textContent = 500;
        }

        // Visual feedback
        if (length > 450) {
            charCountSpan.classList.add('text-warning');
            charCountSpan.classList.remove('text-danger');
        } else if (length > 490) {
            charCountSpan.classList.remove('text-warning');
            charCountSpan.classList.add('text-danger');
        } else {
            charCountSpan.classList.remove('text-warning', 'text-danger');
        }
    });

    // Variabel untuk menyimpan data awal
    let originalData = {};

    // Fetch existing data
    fetch(`{{ url('api/komponen-core-values') }}/${coreValuesId}`, {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            if (response.status === 401) {
                throw new Error('Unauthorized');
            } else if (response.status === 404) {
                throw new Error('Data tidak ditemukan');
            }
            throw new Error('Terjadi kesalahan saat mengambil data');
        }
        return response.json();
    })
    .then(result => {
        // Simpan data awal
        originalData = {
            nama_core_values: result.data.nama_core_values || '',
            bobot: result.data.bobot || '',
            perilaku_utama: result.data.perilaku_utama || ''
        };

        // Populate form with existing data
        document.getElementById('nama_core_values').value = originalData.nama_core_values;
        document.getElementById('bobot').value = originalData.bobot;
        document.getElementById('perilaku_utama').value = originalData.perilaku_utama;
        charCountSpan.textContent = (originalData.perilaku_utama || '').length;
    })
    .catch(error => {
        console.error('Error:', error);
        let errorMessage = error.message || 'Terjadi kesalahan saat mengambil data';
        
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage,
            allowOutsideClick: false
        }).then(() => {
            if (error.message === 'Unauthorized') {
                window.location.href = '{{ route('login') }}';
            } else {
                window.location.href = '{{ route('komponen-core-values.index') }}';
            }
        });
    });

    // Handle form submission
    editForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Basic validation
        if (!document.getElementById('nama_core_values').value.trim()) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Nama Core Values tidak boleh kosong'
            });
            return;
        }

        const bobot = parseFloat(document.getElementById('bobot').value);
        if (isNaN(bobot) || bobot < 0 || bobot > 100) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Bobot harus berupa angka antara 0 dan 100'
            });
            return;
        }

        const formData = new FormData(this);
        const data = {
            nama_core_values: formData.get('nama_core_values').trim(),
            bobot: parseFloat(formData.get('bobot')),
            perilaku_utama: formData.get('perilaku_utama')?.trim() || null
        };

        try {
            // Show loading state
            const loadingAlert = Swal.fire({
                title: 'Mohon Tunggu',
                text: 'Sedang memperbarui data...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Send update request
            const response = await fetch(`{{ url('api/komponen-core-values') }}/${coreValuesId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                if (response.status === 401) {
                    throw new Error('Unauthorized');
                }
                const errorData = await response.json();
                throw errorData;
            }

            const result = await response.json();

            // Close loading alert
            await loadingAlert.close();

            // Show success message
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Komponen core values berhasil diperbarui',
                allowOutsideClick: false
            });

            // Redirect back to index
            window.location.href = '{{ route('komponen-core-values.index') }}';

        } catch (error) {
            console.error('Error:', error);
            
            // Close loading alert if it's still open
            if (Swal.isVisible()) {
                await Swal.close();
            }

            if (error.message === 'Unauthorized') {
                await Swal.fire({
                    icon: 'error',
                    title: 'Session Expired',
                    text: 'Sesi anda telah berakhir. Silakan login kembali.',
                    allowOutsideClick: false
                });
                window.location.href = '{{ route('login') }}';
                return;
            }

            let errorMessage = 'Terjadi kesalahan saat memperbarui data';
            if (error.errors) {
                errorMessage = Object.values(error.errors).flat().join('\n');
            } else if (error.message) {
                errorMessage = error.message;
            }

            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessage,
                allowOutsideClick: false
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
            // Kembalikan ke data awal
            document.getElementById('nama_core_values').value = originalData.nama_core_values;
            document.getElementById('bobot').value = originalData.bobot;
            document.getElementById('perilaku_utama').value = originalData.perilaku_utama;
            charCountSpan.textContent = (originalData.perilaku_utama || '').length;

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