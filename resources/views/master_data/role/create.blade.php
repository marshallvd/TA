@extends('layouts.master')

@section('title')
Tambah Role
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tambah Role</h4>
                    </div>
                    <div>
                        <a href="{{ route('master_data.role.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form id="createRoleForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="nama_role">Nama Role</label>
                                    <input type="text" class="form-control" id="nama_role" name="nama_role" required 
                                           placeholder="Masukkan nama role">
                                    <small class="form-text text-muted">
                                        Contoh role yang umum: Admin, HRD, Pegawai, Manager, Supervisor, dll.
                                    </small>
                                    <div class="invalid-feedback" id="nama_role_error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get token from localStorage
    const token = localStorage.getItem('token');

    // Check if token exists, if not redirect to login
    if (!token) {
        window.location.href = '/login';
        return;
    }

    // Handle form submission
    const form = document.getElementById('createRoleForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Reset error messages
        document.getElementById('nama_role_error').textContent = '';
        
        // Get form data
        const formData = {
            nama_role: document.getElementById('nama_role').value.trim()
        };

        // Send POST request
        fetch('/api/role', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        })
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data role berhasil ditambahkan',
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route("master_data.role.index") }}';
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
            
            if (error.nama_role) {
                document.getElementById('nama_role_error').textContent = error.nama_role[0];
                document.getElementById('nama_role').classList.add('is-invalid');
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat menyimpan data',
                footer: error.message || 'Silakan coba lagi nanti'
            });
        });
    });

    // Handle reset button
    form.addEventListener('reset', function(e) {
        // Clear error messages
        document.getElementById('nama_role_error').textContent = '';
        document.getElementById('nama_role').classList.remove('is-invalid');
    });
});
</script>
@endpush