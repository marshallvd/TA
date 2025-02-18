@extends('layouts.master')

@section('title')
Tambah Divisi
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Divisi</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-building-fill text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tambah Divisi Baru</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="createDivisiForm" class="needs-validation" novalidate>
                            <div class="row g-4">
                                <!-- Nama Divisi Input -->
                                <div class="col-12">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="nama_divisi">
                                            <i class="bi bi-building me-1"></i>Nama Divisi
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="nama_divisi" 
                                               name="nama_divisi" 
                                               required 
                                               maxlength="100"
                                               placeholder="Masukkan nama divisi">
                                        <div class="invalid-feedback">
                                            Nama divisi tidak boleh kosong
                                        </div>
                                        <small class="text-muted">
                                            <i class="bi bi-info-circle me-1"></i>Maksimal 100 karakter
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="{{ route('master_data.divisi.index') }}" class="btn btn-danger me-2">
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
    /* Form styling */
    .form-label {
        font-weight: 500;
    }

    .invalid-feedback {
        font-size: 0.875em;
    }

    .was-validated .form-control:invalid,
    .form-control.is-invalid {
        border-color: #dc3545;
    }

    /* Custom form control styling */
    .form-control-lg {
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }

    /* Icon styling */
    .bi {
        vertical-align: -0.125em;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const divisiForm = document.getElementById('createDivisiForm');
    const resetButton = document.getElementById('resetButton');

    // Reset button functionality
    resetButton.addEventListener('click', function() {
        divisiForm.reset();
        divisiForm.classList.remove('was-validated');
        
        // Remove any custom error states
        const invalidInputs = divisiForm.querySelectorAll('.is-invalid');
        invalidInputs.forEach(input => {
            input.classList.remove('is-invalid');
        });
    });

    // Form validation and submission
    divisiForm.addEventListener('submit', async function(e) {
    e.preventDefault();

    // Basic validation
    if (!this.checkValidity()) {
        e.stopPropagation();
        this.classList.add('was-validated');
        return;
    }

    const formData = new FormData(this);
    const data = {
        nama_divisi: formData.get('nama_divisi').trim()
    };

    console.log('Data yang dikirim:', JSON.stringify(data)); // Log data yang dikirim

    try {
        // Send data to API
        const response = await fetch('/api/divisi', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });

        // Handle response
        const responseData = await response.json(); // Hanya dibaca sekali

        if (!response.ok) {
            console.error('Respons dari server:', responseData); // Log respons dari server
            // Validation errors
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
                throw new Error(responseData.message || 'Terjadi kesalahan validasi');
            }
            throw new Error(responseData.message || 'Terjadi kesalahan saat menyimpan data');
        }

        // Show success message
        await Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data divisi berhasil ditambahkan',
            showConfirmButton: true
        }).then(() => {
            window.location.href = '{{ route("master_data.divisi.index") }}';
        });

    } catch (error) {
        console.error('Error:', error);
        await Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message || 'Terjadi kesalahan saat menyimpan data',
            confirmButtonText: 'OK'
        });
    }
});
});
</script>
@endpush