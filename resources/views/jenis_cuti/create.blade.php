@extends('layouts.master')

@section('title')
    Tambah Jenis Cuti
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tambah Jenis Cuti Baru</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="jenisCutiForm" class="needs-validation" novalidate method="POST" action="{{ route('jenis_cuti.store') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label" for="nama_jenis_cuti">Nama Jenis Cuti <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="nama_jenis_cuti" 
                                           name="nama_jenis_cuti" 
                                           required 
                                           maxlength="100"
                                           placeholder="Masukkan nama jenis cuti">
                                    <div class="invalid-feedback">
                                        Nama jenis cuti tidak boleh kosong
                                    </div>
                                    <small class="text-muted">Maksimal 100 karakter</small>
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label" for="kategori">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select" id="kategori" name="kategori" required>
                                        <option value="" disabled selected>Pilih kategori</option>
                                        <option value="Umum">Umum</option>
                                        <option value="Khusus">Khusus</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Kategori tidak boleh kosong
                                    </div>
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label class="form-label" for="jumlah_hari_diizinkan">Jumlah Hari Diizinkan <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="jumlah_hari_diizinkan" 
                                           name="jumlah_hari_diizinkan" 
                                           required 
                                           min="1" 
                                           placeholder="Masukkan jumlah hari">
                                    <div class="invalid-feedback">
                                        Jumlah hari tidak boleh kosong
                                    </div>
                                    <small class="text-muted">Masukkan nilai minimal 1</small>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>
                                    Simpan Jenis Cuti
                                </button>
                                <a href="{{ route('jenis_cuti.index') }}" class="btn btn-secondary">
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
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisCutiForm = document.getElementById('jenisCutiForm');

    // Form validation and submission
    jenisCutiForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Basic validation
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        const formData = new FormData(this);
        const data = {
            nama_jenis_cuti: formData.get('nama_jenis_cuti').trim(),
            kategori: formData.get('kategori').trim(),
            jumlah_hari_diizinkan: parseInt(formData.get('jumlah_hari_diizinkan'))
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
            const response = await fetch('{{ url('api/jenis-cuti') }}', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error('Terjadi kesalahan saat menyimpan data');
            }

            // Close loading alert
            await loadingAlert.close();

            // Show success message
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Jenis Cuti berhasil ditambahkan',
                allowOutsideClick: false
            });

            // Redirect back to index
            window.location.href = '{{ route('jenis_cuti.index') }}';

        } catch (error) {
            console.error('Error:', error);
            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Terjadi kesalahan saat menyimpan data',
                allowOutsideClick: false
            });
        }
    });
});
</script>
@endpush