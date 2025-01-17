@extends('layouts.master')

@section('title')
    Edit Pelamar
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen User Pelamar</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-person-vcard text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Informasi Pelamar</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="editPelamarForm" class="needs-validation" novalidate>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" id="pelamarId" name="id" value="{{ $pelamar->id_pelamar }}">
                            
                            <div class="row g-4">
                                <!-- Nama Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="nama">
                                            <i class="bi bi-person-fill me-1"></i>Nama Lengkap
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="nama" 
                                               name="nama"
                                               value="{{ $pelamar->nama }}"
                                               required 
                                               maxlength="100"
                                               placeholder="Masukkan nama lengkap">
                                        <div class="invalid-feedback">
                                            Nama lengkap tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Email Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="email">
                                            <i class="bi bi-envelope me-1"></i>Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="email" 
                                               name="email"
                                               value="{{ $pelamar->email }}"
                                               required
                                               placeholder="Masukkan alamat email">
                                        <div class="invalid-feedback">
                                            Email tidak valid
                                        </div>
                                    </div>
                                </div>

                                <!-- Password Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="password">
                                            <i class="bi bi-key me-1"></i>Password
                                        </label>
                                        <input type="password" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="password" 
                                               name="password"
                                               placeholder="Masukkan password baru">
                                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                                    </div>
                                </div>

                                <!-- Password Confirmation Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="password_confirmation">
                                            <i class="bi bi-key-fill me-1"></i>Konfirmasi Password
                                        </label>
                                        <input type="password" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="password_confirmation" 
                                               name="password_confirmation"
                                               placeholder="Konfirmasi password baru">
                                    </div>
                                </div>

                                <!-- No HP Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="no_hp">
                                            <i class="bi bi-phone me-1"></i>Nomor Handphone
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="tel" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="no_hp" 
                                               name="no_hp"
                                               value="{{ $pelamar->no_hp }}"
                                               required
                                               placeholder="Masukkan nomor handphone">
                                        <div class="invalid-feedback">
                                            Nomor handphone tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Pendidikan Terakhir Select -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="pendidikan_terakhir">
                                            <i class="bi bi-mortarboard me-1"></i>Pendidikan Terakhir
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control form-control-lg shadow-none border-2" 
                                                id="pendidikan_terakhir" 
                                                name="pendidikan_terakhir" 
                                                required>
                                            <option value="">Pilih Pendidikan</option>
                                            <option value="SMA" {{ $pelamar->pendidikan_terakhir == 'SMA' ? 'selected' : '' }}>SMA</option>
                                            <option value="D3" {{ $pelamar->pendidikan_terakhir == 'D3' ? 'selected' : '' }}>D3</option>
                                            <option value="S1" {{ $pelamar->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>S1</option>
                                            <option value="S2" {{ $pelamar->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>S2</option>
                                            <option value="S3" {{ $pelamar->pendidikan_terakhir == 'S3' ? 'selected' : '' }}>S3</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Pendidikan terakhir harus dipilih
                                        </div>
                                    </div>
                                </div>

                                <!-- Alamat Textarea -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="alamat">
                                            <i class="bi bi-geo-alt me-1"></i>Alamat
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control form-control-lg shadow-none border-2" 
                                                  id="alamat" 
                                                  name="alamat" 
                                                  required
                                                  rows="3"
                                                  placeholder="Masukkan alamat lengkap">{{ $pelamar->alamat }}</textarea>
                                        <div class="invalid-feedback">
                                            Alamat tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Pengalaman Kerja Textarea -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="pengalaman_kerja">
                                            <i class="bi bi-briefcase me-1"></i>Pengalaman Kerja
                                        </label>
                                        <textarea class="form-control form-control-lg shadow-none border-2" 
                                                  id="pengalaman_kerja" 
                                                  name="pengalaman_kerja" 
                                                  rows="3"
                                                  placeholder="Masukkan pengalaman kerja">{{ $pelamar->pengalaman_kerja }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="{{ route('pelamar.index') }}" class="btn btn-danger me-2">
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
    const pelamarForm = document.getElementById('editPelamarForm');
    const resetButton = document.getElementById('resetButton');
    const pelamarId = document.getElementById('pelamarId').value;
    
    // Store original data for reset functionality
    let originalData = null;
    
    // Initialize form
    initializeForm();

    async function initializeForm() {
        try {
            await fetchAndPopulatePelamarData();
        } catch (error) {
            console.error('Error initializing form:', error);
            showErrorAlert(error.message);
            redirectToIndex();
        }
    }

    async function fetchAndPopulatePelamarData() {
        try {
            showLoadingAlert('Sedang mengambil data pelamar...');
            
            const response = await fetch(`/api/pelamar/${pelamarId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            
            const result = await response.json();
            
            if (!response.ok) {
                throw new Error(result.message || 'Gagal mengambil data pelamar');
            }
            
            // Store original data and populate form
            originalData = result.data;
            populateFormFields(originalData);
            
            Swal.close();
            
        } catch (error) {
            Swal.close();
            throw error;
        }
    }

    function populateFormFields(data) {
        Object.keys(data).forEach(key => {
            const element = document.querySelector(`[name="${key}"]`);
            if (element && key !== 'password' && key !== 'password_confirmation') {
                element.value = data[key] || '';
            }
        });
    }

    // Event Listeners
    resetButton.addEventListener('click', async function() {
        const result = await Swal.fire({
            title: 'Konfirmasi Reset',
            text: 'Apakah Anda yakin ingin mengembalikan data ke kondisi awal?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset',
            cancelButtonText: 'Batal'
        });

        if (result.isConfirmed && originalData) {
            populateFormFields(originalData);
            document.getElementById('password').value = '';
            document.getElementById('password_confirmation').value = '';
            showSuccessAlert('Data berhasil direset', true);
        }
    });

    pelamarForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        // Password validation
        const password = document.getElementById('password').value;
        const passwordConfirm = document.getElementById('password_confirmation').value;
        
        if (password && password !== passwordConfirm) {
            showErrorAlert('Password dan konfirmasi password tidak cocok');
            return;
        }

        try {
            showLoadingAlert('Sedang menyimpan perubahan...');

            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            // Only include password if it's not empty
            if (!data.password) {
                delete data.password;
                delete data.password_confirmation;
            }

            const response = await fetch(`/api/pelamar/${pelamarId}`, {
                method: 'PUT',
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
                throw new Error(result.message || 'Gagal menyimpan perubahan');
            }

            await showSuccessAlert('Data pelamar berhasil diperbarui');
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
        window.location.href = '/pelamar';
    }

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
    }
});
</script>
@endpush