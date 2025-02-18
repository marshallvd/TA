@extends('layouts.master')

@section('title')
    Tambah Jenis Cuti
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Jenis Cuti</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-calendar-range text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tambah Jenis Cuti Baru</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="jenisCutiForm" class="needs-validation" novalidate>
                            <div class="row g-4">
                                <!-- Nama Jenis Cuti Input -->
                                <div class="col-md-12">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="nama_jenis_cuti">
                                            <i class="bi bi-calendar-check me-1"></i>Nama Jenis Cuti
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="nama_jenis_cuti" 
                                               name="nama_jenis_cuti" 
                                               required 
                                               maxlength="100"
                                               placeholder="Masukkan nama jenis cuti">
                                        <div class="invalid-feedback">
                                            Nama jenis cuti tidak boleh kosong
                                        </div>
                                        <small class="text-muted">Maksimal 100 karakter</small>
                                    </div>
                                </div>

                                <!-- Kategori Select -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="kategori">
                                            <i class="bi bi-tags me-1"></i>Kategori
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control form-control-lg shadow-none border-2" 
                                                id="kategori" 
                                                name="kategori" 
                                                required>
                                            <option value="">Pilih Kategori</option>
                                            <option value="Umum">Umum</option>
                                            <option value="Khusus">Khusus</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Kategori harus dipilih
                                        </div>
                                    </div>
                                </div>

                                <!-- Jumlah Hari Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="jumlah_hari_diizinkan">
                                            <i class="bi bi-calendar-day me-1"></i>Jumlah Hari Diizinkan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="jumlah_hari_diizinkan" 
                                               name="jumlah_hari_diizinkan" 
                                               required 
                                               min="1"
                                               placeholder="Masukkan jumlah hari">
                                        <div class="invalid-feedback">
                                            Jumlah hari harus minimal 1
                                        </div>
                                        <small class="text-muted">Masukkan nilai minimal 1</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="{{ route('jenis_cuti.index') }}" class="btn btn-danger me-2">
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
    // Get necessary DOM elements
    const token = localStorage.getItem('token');
    const jenisCutiForm = document.getElementById('jenisCutiForm');
    const resetButton = document.getElementById('resetButton');

    // Token validation on page load
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Anda harus login untuk mengakses halaman ini.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/login';
        });
        return;
    }

    // Reset button functionality
    resetButton.addEventListener('click', async function() {
        const result = await Swal.fire({
            title: 'Konfirmasi Reset',
            text: 'Apakah Anda yakin ingin mengosongkan semua field?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset',
            cancelButtonText: 'Batal'
        });

        if (result.isConfirmed) {
            jenisCutiForm.reset();
            jenisCutiForm.classList.remove('was-validated');
            showSuccessAlert('Form berhasil direset', true);
        }
    });

    // Form submission
    jenisCutiForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        try {
            showLoadingAlert('Sedang menyimpan data...');

            const formData = new FormData(this);
            const data = {
                nama_jenis_cuti: formData.get('nama_jenis_cuti').trim(),
                kategori: formData.get('kategori'),
                jumlah_hari_diizinkan: parseInt(formData.get('jumlah_hari_diizinkan'))
            };

            const response = await fetch('/api/jenis-cuti', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (!response.ok) {
                if (result.errors) {
                    handleValidationErrors(result.errors);
                    throw new Error('Terjadi kesalahan validasi');
                }
                throw new Error(result.message || 'Gagal menyimpan data');
            }

            await showSuccessAlert('Jenis cuti berhasil ditambahkan');
            redirectToIndex();

        } catch (error) {
            console.error('Error:', error);
            showErrorAlert(error.message);
        }
    });

    // Utility Functions
    function showLoadingAlert(message) {
        return Swal.fire({
            title: 'Mohon Tunggu',
            text: message,
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }

    function showSuccessAlert(message, autoClose = false) {
        return Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: message,
            showConfirmButton: !autoClose,
            timer: autoClose ? 1500 : undefined
        });
    }

    function showErrorAlert(message) {
        return Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            confirmButtonText: 'OK'
        });
    }

    function handleValidationErrors(errors) {
        Object.keys(errors).forEach(key => {
            const inputElement = document.querySelector(`[name="${key}"]`);
            if (inputElement) {
                inputElement.classList.add('is-invalid');
                const feedbackElement = inputElement.nextElementSibling;
                if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                    feedbackElement.textContent = errors[key][0];
                }
            }
        });
    }

    function redirectToIndex() {
        window.location.href = '/jenis_cuti';
    }
});
</script>
@endpush