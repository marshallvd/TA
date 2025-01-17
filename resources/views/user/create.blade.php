@extends('layouts.master')

@section('title')
    Tambah User
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Data Pegawai</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-person-lines-fill text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tambah User Baru</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="userForm" class="needs-validation" novalidate>
                            <div class="row g-4">
                                <input type="hidden" id="pegawaiId" name="id_pegawai" value="{{ request('id_pegawai') }}">
                                
                                <!-- Role Select -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="id_role">
                                            <i class="bi bi-person-gear me-1"></i>Role
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control form-control-lg shadow-none border-2" 
                                                name="id_role" 
                                                id="roleSelect" 
                                                required>
                                            <option value="">Pilih Role</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Role harus dipilih
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
                                               id="emailInput" 
                                               name="email" 
                                               required
                                               placeholder="Masukkan alamat email">
                                        <div class="invalid-feedback">
                                            Email tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Password Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="password">
                                            <i class="bi bi-key me-1"></i>Password
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" 
                                                   class="form-control form-control-lg shadow-none border-2" 
                                                   id="passwordInput" 
                                                   name="password" 
                                                   required 
                                                   minlength="8"
                                                   placeholder="Masukkan password">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="bi bi-eye" id="toggleIcon"></i>
                                            </button>
                                        </div>
                                        <div class="invalid-feedback">
                                            Password minimal 8 karakter
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Select -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="status">
                                            <i class="bi bi-person-check me-1"></i>Status
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control form-control-lg shadow-none border-2" 
                                                name="status" 
                                                required>
                                            <option value="">Pilih Status</option>
                                            <option value="aktif">Aktif</option>
                                            <option value="nonaktif">Non Aktif</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Status harus dipilih
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="/pegawai" class="btn btn-danger me-2">
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
    const pegawaiId = document.getElementById('pegawaiId').value;
    const emailInput = document.getElementById('emailInput');
    const roleSelect = document.getElementById('roleSelect');
    const passwordInput = document.getElementById('passwordInput');
    const togglePassword = document.getElementById('togglePassword');
    const toggleIcon = document.getElementById('toggleIcon');
    const userForm = document.getElementById('userForm');
    const resetButton = document.getElementById('resetButton');

    // Store original form data for reset functionality
    let originalData = null;

    // Initialize form
    initializeForm();

    async function initializeForm() {
        try {
            await Promise.all([
                fetchPegawaiData(),
                fetchRoles()
            ]);
        } catch (error) {
            console.error('Error initializing form:', error);
            showErrorAlert(error.message);
            redirectToIndex();
        }
    }

    async function fetchPegawaiData() {
        if (!pegawaiId) return;

        try {
            showLoadingAlert('Sedang mengambil data pegawai...');
            
            const response = await fetch(`/api/pegawai/${pegawaiId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data pegawai');
            }

            const result = await response.json();
            
            // Store original data and set email
            originalData = {
                email: result.data?.email || result.email
            };
            emailInput.value = originalData.email;

            Swal.close();

        } catch (error) {
            Swal.close();
            throw error;
        }
    }

    async function fetchRoles() {
        try {
            const response = await fetch('/api/role', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data role');
            }

            const roles = await response.json();
            populateRoleSelect(roles);

        } catch (error) {
            throw new Error('Gagal memuat data role: ' + error.message);
        }
    }

    function populateRoleSelect(roles) {
        roleSelect.innerHTML = '<option value="">Pilih Role</option>';
        roles.forEach(role => {
            const option = document.createElement('option');
            option.value = role.id_role;
            option.textContent = role.nama_role;
            roleSelect.appendChild(option);
        });
    }

    // Event Listeners
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
    });

    resetButton.addEventListener('click', async function() {
        const result = await Swal.fire({
            title: 'Konfirmasi Reset',
            text: 'Apakah Anda yakin ingin mengembalikan form ke kondisi awal?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset',
            cancelButtonText: 'Batal'
        });

        if (result.isConfirmed) {
            userForm.reset();
            if (originalData) {
                emailInput.value = originalData.email;
            }
            await fetchRoles();
            userForm.classList.remove('was-validated');
            showSuccessAlert('Form berhasil direset', true);
        }
    });

    userForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        try {
            showLoadingAlert('Sedang menyimpan data...');

            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            const response = await fetch('/api/users', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
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

            await showSuccessAlert('User berhasil ditambahkan');
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
        window.location.href = '/pegawai';
    }
});
</script>
@endpush