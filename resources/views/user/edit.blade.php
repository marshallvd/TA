@extends('layouts.master')

@section('title')
    Edit User
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen User</h2></b>
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
                        <h4 class="card-title">Edit Informasi User</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="userForm" class="needs-validation" novalidate>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" id="userId" name="id_user">
                            <div class="row g-4">
                                <!-- Pegawai Select -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="pegawaiSelect">
                                            <i class="bi bi-person-badge me-1"></i>Pegawai
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control form-control-lg shadow-none border-2" 
                                                id="pegawaiSelect" 
                                                name="id_pegawai" 
                                                required>
                                            <option value="">Pilih Pegawai</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Pegawai harus dipilih
                                        </div>
                                    </div>
                                </div>

                                <!-- Role Select -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="roleSelect">
                                            <i class="bi bi-shield-lock me-1"></i>Role
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control form-control-lg shadow-none border-2" 
                                                id="roleSelect" 
                                                name="id_role" 
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
                                               id="email" 
                                               name="email" 
                                               required
                                               placeholder="Masukkan alamat email">
                                        <div class="invalid-feedback">
                                            Email tidak boleh kosong dan harus valid
                                        </div>
                                    </div>
                                </div>

                                <!-- Password Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="password">
                                            <i class="bi bi-key me-1"></i>Password Baru
                                        </label>
                                        <input type="password" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="password" 
                                               name="password" 
                                               minlength="8"
                                               placeholder="Kosongkan jika tidak ingin mengubah password">
                                        <div class="invalid-feedback">
                                            Password minimal 8 karakter
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Select -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="status">
                                            <i class="bi bi-toggle-on me-1"></i>Status
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control form-control-lg shadow-none border-2" 
                                                id="status" 
                                                name="status" 
                                                required>
                                            <option value="">Pilih Status</option>
                                            <option value="aktif">Aktif</option>
                                            <option value="non-aktif">Non-aktif</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Status harus dipilih
                                        </div>
                                    </div>
                                </div>

                            <!-- Action Buttons -->
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="/user" class="btn btn-danger me-2">
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
    // Get necessary DOM elements and setup variables
    const token = localStorage.getItem('token');
    const userId = window.location.pathname.split('/').pop();
    const userForm = document.getElementById('userForm');
    const resetButton = document.getElementById('resetButton');
    const pegawaiSelect = document.getElementById('pegawaiSelect');
    const roleSelect = document.getElementById('roleSelect');
    const API_URL = 'http://127.0.0.1:8000/api';
    
    // Store original data for reset functionality
    let originalData = null;

    // Initialize form
    initializeForm();

    async function initializeForm() {
        try {
            await Promise.all([
                fetchAndPopulateUserData(),
                fetchPegawai(),
                fetchRole()
            ]);
        } catch (error) {
            console.error('Error initializing form:', error);
            showErrorAlert(error.message);
            redirectToIndex();
        }
    }

    async function fetchAndPopulateUserData() {
    try {
        showLoadingAlert('Sedang mengambil data user...');
        
        const response = await fetch(`${API_URL}/users/${userId}`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        const result = await response.json();
        console.log('GET User Response:', result); // Debug log untuk melihat format data dari server
        
        if (!response.ok) {
            throw new Error(result.message || 'Gagal mengambil data user');
        }

        originalData = result.data ? result.data : result;
        
        if (!originalData || typeof originalData !== 'object') {
            throw new Error('Invalid data structure received from API');
        }

        // Debug log untuk melihat nilai status yang diterima
        console.log('Original status value:', originalData.status);
        console.log('Original status type:', typeof originalData.status);

        populateFormFields(originalData);
        Swal.close();

    } catch (error) {
        console.error('Fetch user data error:', error);
        Swal.close();
        throw error;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('status');
    if (statusSelect) {
        statusSelect.innerHTML = `
            <option value="">Pilih Status</option>
            <option value="aktif">Aktif</option>
            <option value="non-aktif">Non-Aktif</option>
        `;
    }
});
function populateFormFields(data) {
        try {
            console.log('Populating form with data:', data);
            
            const userData = data.data || data;
            
            document.getElementById('userId').value = userData.id_user || '';
            document.querySelector('input[name="email"]').value = userData.email || '';
            
            // Updated status handling for correct enum values
            const statusSelect = document.querySelector('select[name="status"]');
            if (statusSelect) {
                // Convert any 'non-aktif' to 'nonaktif' for compatibility
                const status = userData.status === 'non-aktif' ? 'nonaktif' : userData.status;
                if (status === 'aktif' || status === 'nonaktif') {
                    statusSelect.value = status;
                }
            }
            
            if (userData.id_pegawai && pegawaiSelect) {
                pegawaiSelect.value = userData.id_pegawai;
            }

            if (userData.id_role && roleSelect) {
                roleSelect.value = userData.id_role;
            }

            console.log('Form populated successfully');
        } catch (error) {
            console.error('Error in populateFormFields:', error);
            throw new Error('Failed to populate form fields: ' + error.message);
        }
    }


    async function fetchPegawai() {
        try {
            const response = await fetch(`${API_URL}/pegawai`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Gagal mengambil data pegawai');

            const result = await response.json();
            populatePegawaiSelect(result.data || result);

        } catch (error) {
            throw new Error('Gagal memuat data pegawai: ' + error.message);
        }
    }

    function populatePegawaiSelect(pegawaiData) {
        pegawaiSelect.innerHTML = '<option value="">Pilih Pegawai</option>';
        pegawaiData.forEach(pegawai => {
            const option = document.createElement('option');
            option.value = pegawai.id_pegawai;
            option.textContent = pegawai.nama_lengkap;
            if (originalData && pegawai.id_pegawai == originalData.id_pegawai) {
                option.selected = true;
            }
            pegawaiSelect.appendChild(option);
        });
    }

    async function fetchRole() {
        try {
            const response = await fetch(`${API_URL}/role`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Gagal mengambil data role');

            const result = await response.json();
            populateRoleSelect(result.data || result);

        } catch (error) {
            throw new Error('Gagal memuat data role: ' + error.message);
        }
    }

    function populateRoleSelect(roleData) {
        roleSelect.innerHTML = '<option value="">Pilih Role</option>';
        roleData.forEach(role => {
            const option = document.createElement('option');
            option.value = role.id_role;
            option.textContent = role.nama_role;
            if (originalData && role.id_role == originalData.id_role) {
                option.selected = true;
            }
            roleSelect.appendChild(option);
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
            await Promise.all([fetchPegawai(), fetchRole()]);
            showSuccessAlert('Data berhasil direset', true);
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
            showLoadingAlert('Sedang menyimpan perubahan...');

            const formData = new FormData(this);
            
            // Create request data with correct status value format
            const requestData = {
                id_pegawai: formData.get('id_pegawai'),
                id_role: formData.get('id_role'),
                email: formData.get('email'),
                status: formData.get('status') // Status value is already correct from select
            };
            
            // Add password if provided
            const password = formData.get('password');
            if (password && password.trim()) {
                requestData.password = password;
            }

            console.log('Request data being sent:', requestData);

            const response = await fetch(`${API_URL}/users/${userId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestData)
            });

            const result = await response.json();
            console.log('API Response:', result);

            if (!response.ok) {
                if (result.errors) {
                    console.error('Validation errors:', result.errors);
                    handleValidationErrors(result.errors);
                    throw new Error('Terjadi kesalahan validasi');
                }
                if (result.status) {
                    const errorMessage = Array.isArray(result.status) ? result.status[0] : result.status;
                    throw new Error(errorMessage);
                }
                throw new Error(result.message || 'Gagal menyimpan perubahan');
            }

            await showSuccessAlert('Data user berhasil diperbarui');
            redirectToIndex();

        } catch (error) {
            console.error('Full error details:', error);
            showErrorAlert(error.message);
        }
    });

    // Update the error handling function
    function handleValidationErrors(errors) {
        console.log('Handling validation errors:', errors);
        Object.keys(errors).forEach(key => {
            const inputElement = document.querySelector(`[name="${key}"]`);
            if (inputElement) {
                inputElement.classList.add('is-invalid');
                const feedbackElement = inputElement.nextElementSibling;
                if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                    feedbackElement.textContent = Array.isArray(errors[key]) ? errors[key][0] : errors[key];
                }
                console.log(`Added error feedback for ${key}:`, errors[key]);
            } else {
                console.warn(`No input element found for ${key}`);
            }
        });
    }

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

    function handleFetchError(error) {
        console.error('Error caught by handler:', error);

        // Check if token is expired or invalid
        if (error.message.includes('Unauthenticated') || error.message.includes('token')) {
            Swal.fire({
                icon: 'error',
                title: 'Session Expired',
                text: 'Sesi anda telah berakhir. Silakan login kembali.',
                confirmButtonText: 'Login'
            }).then(() => {
                localStorage.removeItem('token');
                window.location.href = '/login';
            });
            return;
        }

        // Tampilkan error dengan opsi retry
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message || 'Terjadi kesalahan. Silakan coba lagi.',
            showCancelButton: true,
            confirmButtonText: 'Coba Lagi',
            cancelButtonText: 'Tutup'
        }).then((result) => {
            if (result.isConfirmed) {
                // Reload halaman untuk mencoba lagi
                window.location.reload();
            }
        });
    }

    function redirectToIndex() {
        window.location.href = '/user';
    }

    // Token validation check on page load
    function checkToken() {
        if (!token) {
            Swal.fire({
                icon: 'error',
                title: 'Authentication Error',
                text: 'Token tidak ditemukan. Silakan login kembali.'
            }).then(() => {
                window.location.href = '/login';
            });
            return false;
        }
        return true;
    }

    // Check token when page loads
    if (!checkToken()) {
        return;
    }
});
</script>
@endpush