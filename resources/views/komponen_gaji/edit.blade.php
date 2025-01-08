@extends('layouts.master')

@section('title')
    Edit Komponen Gaji
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
                        <h4 class="card-title">Edit Komponen Gaji</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="komponenGajiForm" class="needs-validation" novalidate>
                            <input type="hidden" id="komponen_gaji_id" name="id" value="{{ $id }}">
                            
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
                                        <i class="bi bi-save me-2"></i>Simpan Perubahan
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
    const token = localStorage.getItem('token');
    const komponenGajiId = document.getElementById('komponen_gaji_id').value;

    // Check if token exists
    if (!token) {
        window.location.href = '/login';
        return;
    }

    // Fetch existing data
    async function fetchKomponenGajiData() {
        try {
            const response = await fetch(`/api/komponen-gaji/${komponenGajiId}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data komponen gaji');
            }

            const result = await response.json();
            const data = result.data;
            
            document.getElementById('nama_komponen').value = data.nama_komponen;
            document.getElementById('jenis').value = data.jenis;
            document.getElementById('keterangan').value = data.keterangan || '';
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
    }

    // Fetch data when page loads
    fetchKomponenGajiData();

    // Reset button functionality
    resetButton.addEventListener('click', function() {
        fetchKomponenGajiData();
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
            id: komponenGajiId,
            nama_komponen: formData.get('nama_komponen').trim(),
            jenis: formData.get('jenis').trim(),
            keterangan: formData.get('keterangan') ? formData.get('keterangan').trim() : null
        };

        try {
            // Show loading state
            const loadingAlert = Swal.fire({
                title: 'Mohon Tunggu',
                text: 'Sedang menyimpan perubahan...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                     Swal.showLoading();
                }
            });

            // Send data to API
            const response = await fetch(`/api/komponen-gaji/${komponenGajiId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            // Close loading alert
            await loadingAlert.close();

            if (!response.ok) {
                const errorData = await response.json();
                // Handle validation errors
                if (errorData.errors) {
                    Object.keys(errorData.errors).forEach(key => {
                        const inputElement = document.getElementById(key);
                        if (inputElement) {
                            inputElement.classList.add('is-invalid');
                            const feedbackElement = inputElement.nextElementSibling;
                            if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                                feedbackElement.textContent = errorData.errors[key][0];
                            }
                        }
                    });
                    throw new Error('Terjadi kesalahan validasi');
                }
                throw new Error(errorData.message || 'Terjadi kesalahan saat menyimpan data');
            }

            // Show success message
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Komponen gaji berhasil diperbarui',
                showConfirmButton: true
            }).then(() => {
                window.location.href = '{{ route("komponen_gaji.index") }}';
            });

        } catch (error) {
            console.error('Error:', error);
            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Terjadi kesalahan saat memperbarui data',
                confirmButtonText: 'OK'
            });
        }
    });
});
</script>
@endpush