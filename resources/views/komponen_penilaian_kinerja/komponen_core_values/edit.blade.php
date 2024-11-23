@extends('layouts.master')

@section('title')
    Edit Komponen Core Values
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Komponen Core Values</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="editCoreValuesForm" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label" for="nama_core_values">Nama Core Values <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="nama_core_values" 
                                           name="nama_core_values" 
                                           required 
                                           maxlength="100"
                                           placeholder="Masukkan nama core values">
                                    <div class="invalid-feedback">
                                        Nama core values tidak boleh kosong
                                    </div>
                                    <small class="text-muted">Maksimal 100 karakter</small>
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label class="form-label" for="bobot">Bobot (%) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" 
                                               class="form-control" 
                                               id="bobot" 
                                               name="bobot" 
                                               required 
                                               min="0" 
                                               max="100" 
                                               step="0.01"
                                               placeholder="Masukkan bobot">
                                        <span class="input-group-text">%</span>
                                        <div class="invalid-feedback">
                                            Bobot harus diisi antara 0-100
                                        </div>
                                    </div>
                                    <small class="text-muted">Masukkan nilai antara 0-100</small>
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label" for="perilaku_utama">Perilaku Utama</label>
                                    <textarea class="form-control" 
                                              id="perilaku_utama" 
                                              name="perilaku_utama" 
                                              rows="4"
                                              maxlength="500"
                                              placeholder="Masukkan perilaku utama"></textarea>
                                    <small class="text-muted">Maksimal 500 karakter</small>
                                    <div class="text-end">
                                        <small class="text-muted">
                                            <span id="charCount">0</span>/500 karakter
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>
                                    Update Core Values
                                </button>
                                <a href="{{ route('komponen-core-values.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Kembali
                                </a>
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
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const editForm = document.getElementById('editCoreValuesForm');
    const bobotInput = document.getElementById('bobot');
    const namaInput = document.getElementById('nama_core_values');
    const perilakuTextarea = document.getElementById('perilaku_utama');
    const charCountSpan = document.getElementById('charCount');
    const coreValuesId = window.location.pathname.split('/').pop();

    // Check token
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Authentication Error',
            text: 'Token tidak ditemukan. Silakan login kembali.',
            allowOutsideClick: false
        }).then(() => {
            window.location.href = '{{ route('login') }}';
        });
        return;
    }

    // Character counter for perilaku_utama
    perilakuTextarea.addEventListener('input', function() {
        const length = this.value.length;
        charCountSpan.textContent = length;
        
        if (length > 500) {
            this.value = this.value.substring(0, 500);
            charCountSpan.textContent = 500;
        }
        
        // Visual feedback
        if (length > 450) {
            charCountSpan.classList.add('text-warning');
            charCountSpan.classList.remove('text-danger');
        } else if (length > 490) {
            charCountSpan.classList.remove('text-warning');
            charCountSpan.classList.add('text-danger');
        } else {
            charCountSpan.classList.remove('text-warning', 'text-danger');
        }
    });

    // Validate and format bobot input
    bobotInput.addEventListener('input', function(e) {
        let value = this.value;
        
        // Remove non-numeric characters except decimal point
        value = value.replace(/[^\d.]/g, '');
        
        // Ensure only one decimal point
        const parts = value.split('.');
        if (parts.length > 2) {
            value = parts[0] + '.' + parts.slice(1).join('');
        }
        
        // Limit to 2 decimal places
        if (parts[1] && parts[1].length > 2) {
            value = parseFloat(value).toFixed(2);
        }
        
        // Ensure value is between 0 and 100
        if (value > 100) value = 100;
        if (value < 0) value = 0;
        
        this.value = value;
    });

    // Validate nama input
    namaInput.addEventListener('input', function(e) {
        // Remove leading/trailing spaces as they type
        this.value = this.value.trim();
        
        // Convert multiple spaces to single space
        this.value = this.value.replace(/\s+/g, ' ');
    });

    // Fetch existing data
    fetch(`{{ url('api/komponen-core-values') }}/${coreValuesId}`, {
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
        // Populate form with existing data
        document.getElementById('nama_core_values').value = result.data.nama_core_values;
        document.getElementById('bobot').value = result.data.bobot;
        document.getElementById('perilaku_utama').value = result.data.perilaku_utama || '';
        // Update character count
        charCountSpan.textContent = (result.data.perilaku_utama || '').length;
    })
    .catch(error => {
        console.error('Error:', error);
        let errorMessage = error.message || 'Terjadi kesalahan saat mengambil data';
        
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage,
            allowOutsideClick: false
        }).then(() => {
            if (error.message === 'Unauthorized') {
                window.location.href = '{{ route('login') }}';
            } else {
                window.location.href = '{{ route('komponen-core-values.index') }}';
            }
        });
    });

    // Handle form submission
    editForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Basic validation
        if (!namaInput.value.trim()) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Nama Core Values tidak boleh kosong'
            });
            namaInput.focus();
            return;
        }

        const bobot = parseFloat(bobotInput.value);
        if (isNaN(bobot) || bobot < 0 || bobot > 100) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Bobot harus berupa angka antara 0 dan 100'
            });
            bobotInput.focus();
            return;
        }

        const formData = new FormData(this);
        const data = {
            nama_core_values: formData.get('nama_core_values').trim(),
            bobot: parseFloat(formData.get('bobot')),
            perilaku_utama: formData.get('perilaku_utama')?.trim() || null
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

            // Send update request
            const response = await fetch(`{{ url('api/komponen-core-values') }}/${coreValuesId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                if (response.status === 401) {
                    throw new Error('Unauthorized');
                }
                const errorData = await response.json();
                throw errorData;
            }

            const result = await response.json();

            // Close loading alert
            await loadingAlert.close();

            // Show success message
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Komponen core values berhasil diperbarui',
                allowOutsideClick: false
            });

            // Redirect back to index
            window.location.href = '{{ route('komponen-core-values.index') }}';

        } catch (error) {
            console.error('Error:', error);
            
            // Close loading alert if it's still open
            if (Swal.isVisible()) {
                await Swal.close();
            }

            if (error.message === 'Unauthorized') {
                await Swal.fire({
                    icon: 'error',
                    title: 'Session Expired',
                    text: 'Sesi anda telah berakhir. Silakan login kembali.',
                    allowOutsideClick: false
                });
                window.location.href = '{{ route('login') }}';
                return;
            }

            let errorMessage = 'Terjadi kesalahan saat memperbarui data';
            if (error.errors) {
                errorMessage = Object.values(error.errors).flat().join('\n');
            } else if (error.message) {
                errorMessage = error.message;
            }

            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessage,
                allowOutsideClick: false
            });
        }
    });
});
</script>
@endpush