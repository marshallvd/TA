@extends('layouts.master')

@section('title')
    Edit Komponen KPI
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Komponen KPI</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="komponenKPIForm" class="needs-validation" novalidate>
                            <input type="hidden" id="kpiId" name="id_komponen_kpi" value="{{ request('id') }}">
                            
                            <div class="row g-4">
                                <!-- Divisi Selection -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="divisiSelect">
                                            <i class="bi bi-building me-1"></i>Divisi
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-select-lg shadow-none border-2" 
                                                id="divisiSelect" 
                                                name="id_divisi" 
                                                required>
                                            <option value="" disabled selected>Pilih Divisi</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Divisi tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Bobot Input -->
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
                                                   placeholder="Contoh: 25">
                                            <span class="input-group-text bg-light">%</span>
                                        </div>
                                        <div class="invalid-feedback">
                                            Bobot harus di antara 0 dan 100
                                        </div>
                                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Bobot harus di antara 0 dan 100</small>
                                    </div>
                                </div>

                                <!-- Nama Indikator Input -->
                                <div class="col-12">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="nama_indikator">
                                            <i class="bi bi-tag me-1"></i>Nama Indikator
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="nama_indikator" 
                                               name="nama_indikator" 
                                               required 
                                               maxlength="100"
                                               placeholder="Masukkan nama indikator">
                                        <div class="invalid-feedback">
                                            Nama indikator tidak boleh kosong
                                        </div>
                                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Maksimal 100 karakter</small>
                                    </div>
                                </div>

                                <!-- Target Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="target">
                                            <i class="bi bi-bullseye me-1"></i>Target
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="target" 
                                               name="target" 
                                               required
                                               placeholder="Masukkan target">
                                        <div class="invalid-feedback">
                                            Target tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Ukuran Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="ukuran">
                                            <i class="bi bi-rulers me-1"></i>Ukuran
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="ukuran" 
                                               name="ukuran" 
                                               required
                                               placeholder="Masukkan ukuran">
                                        <div class="invalid-feedback">
                                            Ukuran tidak boleh kosong
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="{{ route('komponen-kpi.index') }}" class="btn btn-danger me-2">
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
    .custom-card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }

    .card-header {
        background: #fff;
        border-bottom: 1px solid #eee;
        padding: 1.25rem 1.5rem;
    }

    .card-header h5 {
        color: #344767;
        font-weight: 600;
    }

    /* Form Controls */
    .form-label {
        color: #344767;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .form-control,
    .form-select {
        border: 1px solid #e0e0e0;
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
        border-color: #e0e0e0;
        color: #6c757d;
    }

    /* Validation Styling */
    .was-validated .form-control:invalid,
    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        font-size: 0.875em;
        color: #dc3545;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 1rem;
        }
        
        .card-body {
            padding: 1.25rem;
        }
        
        .btn {
            padding: 0.5rem 1.25rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const komponenKPIForm = document.getElementById('komponenKPIForm');
    const resetButton = document.getElementById('resetButton');
    const divisiSelect = document.getElementById('divisiSelect');
    const kpiId = document.getElementById('kpiId').value;
    
    // Add variable to store initial data
    let initialKPIData = null;

    // Token check
    const token = localStorage.getItem('token');
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Authentication Error',
            text: 'Token tidak ditemukan. Silakan login kembali.'
        }).then(() => {
            window.location.href = `${BASE_URL}/login`;
        });
        return;
    }

    // Fetch divisi options
    fetch(`${API_BASE_URL}/divisi`, {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        data.forEach(divisi => {
            const option = document.createElement('option');
            option.value = divisi.id_divisi;
            option.textContent = divisi.nama_divisi;
            divisiSelect.appendChild(option);
        });
        
        // Fetch existing KPI data after populating divisi
        fetchKPIData();
    })
    .catch(error => {
        console.error('Error fetching divisi:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal mengambil data divisi. ' + error.message
        });
    });

    // Fetch existing KPI data
    function fetchKPIData() {
        fetch(`${API_BASE_URL}/komponen-kpi/${kpiId}`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Store initial data
            initialKPIData = data;
            
            // Populate form with existing data
            populateFormData(data);
        })
        .catch(error => {
            console.error('Error fetching KPI data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data KPI: ' + error.message
            }).then(() => {
                window.location.href = `${BASE_URL}/komponen-kpi`;
            });
        });
    }

    // Function to populate form data
    function populateFormData(data) {
        divisiSelect.value = data.id_divisi;
        document.getElementById('bobot').value = data.bobot;
        document.getElementById('nama_indikator').value = data.nama_indikator;
        document.getElementById('target').value = data.target || '';
        document.getElementById('ukuran').value = data.ukuran || '';
        
        // Remove validation styling
        komponenKPIForm.classList.remove('was-validated');
        const invalidInputs = komponenKPIForm.querySelectorAll('.is-invalid');
        invalidInputs.forEach(input => input.classList.remove('is-invalid'));
    }

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
                // Pastikan initialKPIData sudah ada sebelum direset
                if (initialKPIData) {
                    populateFormData(initialKPIData);

                    Swal.fire({
                        icon: 'success',
                        title: 'Form Direset',
                        text: 'Form telah dikembalikan ke data awal',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            }
        });
    });

    // Form submission
    komponenKPIForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Basic validation
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        const formData = new FormData(this);
        const data = {
            id_divisi: formData.get('id_divisi').trim(),
            bobot: formData.get('bobot').trim(),
            nama_indikator: formData.get('nama_indikator').trim(),
            target: formData.get('target').trim(),
            ukuran: formData.get('ukuran').trim()
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

            // Send data to API
            const response = await fetch(`${API_BASE_URL}/komponen-kpi/${kpiId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            // Close loading alert
            await loadingAlert.close();

            // Handle response
            const responseData = await response.json();

            if (!response.ok) {
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

                throw new Error(responseData.message || 'Terjadi kesalahan saat memperbarui data');
            }

            // Show success message
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data KPI berhasil diperbarui',
                showConfirmButton: true
            }).then(() => {
                window.location.href = `${BASE_URL}/komponen-kpi`;
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