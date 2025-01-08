@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Tambah User
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
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
                <div class="card-body position-relative" style="min-height: 300px;">
                    <div class="new-user-info">
                        <form id="userForm">
                            <div class="row">
                                <input type="hidden" id="pegawaiId" name="id_pegawai" value="{{ request('id_pegawai') }}">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Role:</label>
                                    <select class="form-control" name="id_role" id="roleSelect" required>
                                        <option value="">Pilih Role</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="emailInput" name="email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Password:</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="passwordInput" name="password" required minlength="8">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="far fa-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Status:</label>
                                    <select class="form-control" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Non Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Updated button section -->
                            <div class="row mt-3 position-absolute bottom-0 end-0 m-4">
                                <div class="col-12">
                                    <a type="button" class="btn btn-danger me-2" href="/pegawai">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali
                                    </a>
                                    <button type="reset" class="btn btn-warning me-2">
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

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endpush

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const pegawaiId = document.getElementById('pegawaiId').value;
    const emailInput = document.getElementById('emailInput');
    const roleSelect = document.getElementById('roleSelect');
    const passwordInput = document.getElementById('passwordInput');
    const togglePassword = document.getElementById('togglePassword');
    const toggleIcon = document.getElementById('toggleIcon');

    console.log('ID Pegawai:', pegawaiId);

    // Toggle password visibility
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        toggleIcon.classList.toggle('fa-eye');
        toggleIcon.classList.toggle('fa-eye-slash');
    });

    // Check token
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Authentication Error',
            text: 'Token tidak ditemukan. Silakan login kembali.'
        }).then(() => {
            window.location.href = '/login';
        });
        return;
    }

    // Fetch roles
    fetch('http://127.0.0.1:8000/api/role', {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        data.forEach(role => {
            const option = document.createElement('option');
            option.value = role.id_role;
            option.textContent = role.nama_role;
            roleSelect.appendChild(option);
        });
    })
    .catch(error => console.error('Error fetching roles:', error));

    // Fetch pegawai data
    if (pegawaiId) {
        fetch(`http://127.0.0.1:8000/api/pegawai/${pegawaiId}`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            console.log('Response Status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Pegawai Data:', data);
            if (data && data.data) {
                emailInput.value = data.data.email;
            } else if (data && data.email) {
                emailInput.value = data.email;
            } else {
                console.error('Format data tidak sesuai:', data);
            }
        })
        .catch(error => {
            console.error('Error fetching pegawai:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data pegawai'
            });
        });
    }

    // Form submission
    document.getElementById('userForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        // Show loading
        Swal.fire({
            title: 'Mohon Tunggu',
            text: 'Sedang menyimpan data...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch('http://127.0.0.1:8000/api/users', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: result.message,
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/pegawai';
                    }
                });
            } else {
                throw new Error(result.message || 'Terjadi kesalahan saat menyimpan data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Terjadi kesalahan saat menyimpan data',
                showConfirmButton: true
            });
        });
    });
});
</script>
@endsection