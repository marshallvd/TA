@extends('layouts.master')

@section('title')
Edit Divisi
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
                    <i class="bi bi-pencil-square text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Divisi</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="editDivisiForm" class="needs-validation" novalidate>
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
    const divisiForm = document.getElementById('editDivisiForm');
    const resetButton = document.getElementById('resetButton');
    const token = localStorage.getItem('token');
    let originalData = null;

    // Check token and redirect if not present
    if (!token) {
        window.location.href = '/login';
        return;
    }

    // Get divisi ID from URL
    const pathArray = window.location.pathname.split('/');
    const divisiId = pathArray[pathArray.indexOf('edit') - 1];

    // Function to fetch and populate divisi data
    // Function to fetch and populate divisi data
    async function fetchDivisiData() {
        try {
            // Start loading indicator in form instead of full-screen alert
            const formContainer = document.querySelector('.card-body');
            formContainer.style.opacity = '0.6';
            
            const response = await fetch(`/api/divisi/${divisiId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                }
            });

            // Restore form visibility
            formContainer.style.opacity = '1';

            if (!response.ok) {
                throw new Error('Divisi tidak ditemukan');
            }

            const data = await response.json();
            originalData = data; // Store original data for reset
            populateForm(data);
            
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data divisi',
                confirmButtonText: 'Kembali'
            }).then(() => {
                window.location.href = '{{ route("master_data.divisi.index") }}';
            });
        }
    }

    // Function to populate form with data
    function populateForm(data) {
        document.getElementById('nama_divisi').value = data.nama_divisi;
    }

    // Fetch initial data
    fetchDivisiData();

    // Reset button handler - restores to original data
    // Reset button handler - now with confirmation dialog
    resetButton.addEventListener('click', async function() {
        if (originalData) {
            // Show confirmation dialog
            const result = await Swal.fire({
                title: 'Konfirmasi Reset',
                text: 'Apakah Anda yakin ingin mengembalikan data ke kondisi awal? Perubahan yang belum disimpan akan hilang.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Reset',
                cancelButtonText: 'Batal',
                // Adding custom class for better styling
                customClass: {
                    confirmButton: 'btn btn-warning me-2',
                    cancelButton: 'btn btn-secondary'
                }
            });

            // Only proceed with reset if user confirms
            if (result.isConfirmed) {
                // Reset form to original data
                populateForm(originalData);
                divisiForm.classList.remove('was-validated');
                
                // Remove any custom error states
                const invalidInputs = divisiForm.querySelectorAll('.is-invalid');
                invalidInputs.forEach(input => {
                    input.classList.remove('is-invalid');
                });

                // Show reset success message
                await Swal.fire({
                    icon: 'success',
                    title: 'Data Direset',
                    text: 'Form telah dikembalikan ke data awal',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }
    });

    // Form submission handler
    divisiForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Basic validation
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        const formData = {
            nama_divisi: document.getElementById('nama_divisi').value.trim()
        };

        try {
            // Show loading state
            const loadingAlert = await Swal.fire({
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
            const response = await fetch(`/api/divisi/${divisiId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            await loadingAlert.close();

            const responseData = await response.json();

            if (!response.ok) {
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
                    throw new Error(responseData.message || 'Terjadi kesalahan validasi');
                }
                throw new Error(responseData.message || 'Terjadi kesalahan saat memperbarui data');
            }

            // Show success message and redirect
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data divisi berhasil diperbarui',
                showConfirmButton: true
            }).then(() => {
                window.location.href = '{{ route("master_data.divisi.index") }}';
            });

        } catch (error) {
            console.error('Error:', error);
            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Terjadi kesalahan saat memperbarui data',
                confirmButtonText: 'OK'
            });
        }
    });
});
</script>
@endpush