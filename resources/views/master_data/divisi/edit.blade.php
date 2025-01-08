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
                    <form id="editDivisiForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="nama_divisi">Nama Divisi</label>
                                    <input type="text" class="form-control" id="nama_divisi" name="nama_divisi" required>
                                    <div class="invalid-feedback" id="nama_divisi_error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 position-absolute bottom-0 end-0 m-4">
                            <div class="col-12">
                                <a href="{{ route('master_data.divisi.index') }}" class="btn btn-danger me-2">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
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

    // Get divisi ID from URL
    const pathArray = window.location.pathname.split('/');
    const divisiId = pathArray[pathArray.indexOf('edit') - 1];

    // Fetch existing divisi data
    fetch(`/api/divisi/${divisiId}`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json',
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Divisi tidak ditemukan');
        }
        return response.json();
    })
    .then(data => {
        // Populate form with existing data
        document.getElementById('nama_divisi').value = data.nama_divisi;
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal mengambil data divisi',
            confirmButtonText: 'Kembali'
        }).then(() => {
            window.location.href = '{{ route("master_data.divisi.index") }}';
        });
    });

    // Handle form submission
    const form = document.getElementById('editDivisiForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Reset error messages
        document.getElementById('nama_divisi_error').textContent = '';
        document.getElementById('nama_divisi').classList.remove('is-invalid');
        
        // Get form data
        const formData = {
            nama_divisi: document.getElementById('nama_divisi').value
        };

        // Send PUT request
        fetch(`/api/divisi/${divisiId}`, {
            method: 'PUT',
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
                text: 'Data divisi berhasil diperbarui',
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route("master_data.divisi.index") }}';
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
            
            if (error.nama_divisi) {
                document.getElementById('nama_divisi_error').textContent = error.nama_divisi[0];
                document.getElementById('nama_divisi').classList.add('is-invalid');
            }

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat memperbarui data',
                footer: error.message || 'Silakan coba lagi nanti'
            });
        });
    });

    // Handle reset button
    form.addEventListener('reset', function(e) {
        // Fetch original data again to reset to initial values
        fetch(`/api/divisi/${divisiId}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('nama_divisi').value = data.nama_divisi;
        })
        .catch(error => {
            console.error('Error resetting form:', error);
        });

        // Clear error messages
        document.getElementById('nama_divisi_error').textContent = '';
        document.getElementById('nama_divisi').classList.remove('is-invalid');
    });
});
</script>
@endpush