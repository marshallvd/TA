@extends('layouts.master')

@section('title')
    Tambah Komponen KPI
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Komponen KPI</h2></b>
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
                        <h4 class="card-title">Tambah Komponen KPI Baru</h4>
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
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const komponenKPIForm = document.getElementById('komponenKPIForm');
    const resetButton = document.getElementById('resetButton');
    const divisiSelect = document.getElementById('divisiSelect');

    // Use the API_BASE_URL from master layout
    const fetchDivisi = async () => {
        try {
            const response = await fetch(`${API_BASE_URL}/divisi`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json'
                }
            });
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            const data = await response.json();
            data.forEach(divisi => {
                const option = document.createElement('option');
                option.value = divisi.id_divisi;
                option.textContent = divisi.nama_divisi;
                divisiSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error fetching divisi:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data divisi. ' + error.message
            });
        }
    };

    // Reset button functionality
    resetButton.addEventListener('click', function() {
        komponenKPIForm.reset();
        komponenKPIForm.classList.remove('was-validated');
    });

    // Form validation and submission
    komponenKPIForm.addEventListener('submit', async function(e) {
        e.preventDefault();

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

            const response = await fetch(`${API_BASE_URL}/komponen-kpi`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            await loadingAlert.close();
            const responseData = await response.json();

            if (!response.ok) {
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

            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Komponen KPI berhasil ditambahkan',
                showConfirmButton: true
            }).then(() => {
                window.location.href = `${BASE_URL}/komponen-kpi`;
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

    // Initialize
    fetchDivisi();
});
</script>
@endpush