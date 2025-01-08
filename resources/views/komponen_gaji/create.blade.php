@extends('layouts.master')

@section('title')
    Tambah Komponen Gaji
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Komponen Gaji</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-cash-coin text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tambah Komponen Gaji Baru</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="komponenGajiForm" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label" for="nama_komponen">Nama Komponen <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="nama_komponen" 
                                           name="nama_komponen" 
                                           required 
                                           maxlength="100"
                                           placeholder="Masukkan nama komponen gaji">
                                    <div class="invalid-feedback">
                                        Nama komponen tidak boleh kosong
                                    </div>
                                    <small class="text-muted">Maksimal 100 karakter</small>
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label" for="jenis">Jenis Komponen <span class="text-danger">*</span></label>
                                    <select class="form-select" id="jenis" name="jenis" required>
                                        <option value="" disabled selected>Pilih jenis komponen</option>
                                        <option value="pendapatan">Pendapatan</option>
                                        <option value="potongan">Potongan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Jenis komponen tidak boleh kosong
                                    </div>
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label" for="keterangan">Keterangan</label>
                                    <textarea 
                                        class="form-control" 
                                        id="keterangan" 
                                        name="keterangan" 
                                        rows="3" 
                                        placeholder="Masukkan keterangan komponen gaji (opsional)"
                                        maxlength="255"></textarea>
                                    <small class="text-muted">Maksimal 255 karakter</small>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-end">
                                    <a href="{{ route('komponen_gaji.index') }}" class="btn btn-danger me-2">
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
    const komponenGajiForm = document.getElementById('komponenGajiForm');
    const resetButton = document.getElementById('resetButton');

    // Reset button functionality
    resetButton.addEventListener('click', function() {
        komponenGajiForm.reset();
        komponenGajiForm.classList.remove('was-validated');
    });

    // Form validation and submission
    komponenGajiForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Basic validation
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        const formData = new FormData(this);
        const data = {
            nama_komponen: formData.get('nama_komponen').trim(),
            jenis: formData.get('jenis').trim(),
            keterangan: formData.get('keterangan') ? formData.get('keterangan').trim() : null
        };

        try {
            // Show loading state
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

            // Send data to API
            const response = await fetch('{{ url('api/komponen-gaji') }}', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            // Close loading alert
            await loadingAlert.close();

            // Handle response
            const responseData = await response.json();

            if (!response.ok) {
                // Validation errors
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

            // Show success message
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Komponen gaji berhasil ditambahkan',
                showConfirmButton: true
            }).then(() => {
                window.location.href = '{{ route("komponen_gaji.index") }}';
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
});
</script>
@endpush