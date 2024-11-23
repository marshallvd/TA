@extends('layouts.master')

@section('title')
    Edit Komponen Kompetensi
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Komponen Kompetensi</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="editKompetensiForm">
                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label" for="nama_kompetensi">Nama Kompetensi:</label>
                                    <input type="text" class="form-control" id="nama_kompetensi" name="nama_kompetensi" required maxlength="100">
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label" for="perilaku_utama">Perilaku Utama:</label>
                                    <textarea class="form-control" id="perilaku_utama" name="perilaku_utama" required rows="4"></textarea>
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label" for="bobot">Bobot (%):</label>
                                    <input type="number" class="form-control" id="bobot" name="bobot" required min="0" max="100" step="0.01">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update Kompetensi</button>
                            <a href="{{ route('komponen-kompetensi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const editForm = document.getElementById('editKompetensiForm');
    const kompetensiId = window.location.pathname.split('/').pop();

    // Check token
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Authentication Error',
            text: 'Token tidak ditemukan. Silakan login kembali.'
        }).then(() => {
            window.location.href = '{{ route('login') }}';
        });
        return;
    }

    // Fetch existing data
    fetch(`{{ url('api/komponen-kompetensi') }}/${kompetensiId}`, {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            if (response.status === 401) {
                throw new Error('Unauthorized');
            } else if (response.status === 404) {
                throw new Error('Data tidak ditemukan');
            }
            throw new Error('Terjadi kesalahan saat mengambil data');
        }
        return response.json();
    })
    .then(result => {
        console.log('Data from API:', result); // Debug data yang diterima
        
        // Populate form with existing data
        const data = result.data;
        document.getElementById('nama_kompetensi').value = data.nama_kompetensi || '';
        document.getElementById('perilaku_utama').value = data.perilaku_utama || '';
        document.getElementById('bobot').value = data.bobot || '';
    })
    .catch(error => {
        console.error('Error:', error);
        let errorMessage = error.message || 'Terjadi kesalahan saat mengambil data';
        
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage
        }).then(() => {
            if (error.message === 'Unauthorized') {
                window.location.href = '{{ route('login') }}';
            } else {
                window.location.href = '{{ route('komponen-kompetensi.index') }}';
            }
        });
    });

    // Handle form submission
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        // Debug data yang akan dikirim
        console.log('Data yang akan dikirim:', data);

        // Validate bobot
        const bobot = parseFloat(data.bobot);
        if (isNaN(bobot) || bobot < 0 || bobot > 100) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Bobot harus berupa angka antara 0 dan 100'
            });
            return;
        }

        // Show loading state
        Swal.fire({
            title: 'Mohon Tunggu',
            text: 'Sedang memperbarui data...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Send update request
        fetch(`{{ url('api/komponen-kompetensi') }}/${kompetensiId}`, {
            method: 'PUT',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                if (response.status === 401) {
                    throw new Error('Unauthorized');
                }
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(result => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Komponen kompetensi berhasil diperbarui',
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('komponen-kompetensi.index') }}';
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
            
            let errorMessage = 'Terjadi kesalahan saat memperbarui data';
            if (error.message === 'Unauthorized') {
                window.location.href = '{{ route('login') }}';
                return;
            }

            if (error.errors) {
                errorMessage = Object.values(error.errors).flat().join('\n');
            } else if (error.message) {
                errorMessage = error.message;
            }

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessage,
                showConfirmButton: true
            });
        });
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

    // Token refresh handler
    async function refreshToken() {
        try {
            const response = await fetch('{{ url('api/auth/refresh') }}', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });

            if (!response.ok) {
                throw new Error('Token refresh failed');
            }

            const data = await response.json();
            localStorage.setItem('token', data.access_token);
        } catch (error) {
            window.location.href = '{{ route('login') }}';
        }
    }
});
</script>
@endpush