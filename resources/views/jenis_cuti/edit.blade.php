@extends('layouts.master')

@section('title')
    Edit Jenis Cuti
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Jenis Cuti</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="jenisCutiForm" class="needs-validation" novalidate method="POST" action="{{ url('api/jenis-cuti/' . $jenisCuti->id_jenis_cuti) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="jenisCutiId" name="jenisCutiId" value="{{ $jenisCuti->id_jenis_cuti }}">

                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label" for="nama_jenis_cuti">Nama Jenis Cuti <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="nama_jenis_cuti" 
                                           name="nama_jenis_cuti" 
                                           required 
                                           maxlength="100"
                                           placeholder="Masukkan nama jenis cuti"
                                           value="{{ $jenisCuti->nama_jenis_cuti }}">
                                    <div class="invalid-feedback">
                                        Nama jenis cuti tidak boleh kosong
                                    </div>
                                    <small class="text-muted">Maksimal 100 karakter</small>
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label class="form-label" for="kategori">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select" id="kategori" name="kategori" required>
                                        <option value="" disabled>Pilih kategori</option>
                                        <option value="Umum" {{ $jenisCuti->kategori == 'Umum' ? 'selected' : '' }}>Umum</option>
                                        <option value="Khusus" {{ $jenisCuti->kategori == 'Khusus' ? 'selected' : '' }}>Khusus</option>
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
                                           placeholder="Masukkan jumlah hari"
                                           value="{{ $jenisCuti->jumlah_hari_diizinkan }}">
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
    const jenisCutiId = document.getElementById('jenisCutiId').value;

    // Fetch the existing data
    async function fetchJenisCuti() {
        const response = await fetch(`{{ url('api/jenis-cuti') }}/${jenisCutiId}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`,
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error('Terjadi kesalahan saat mengambil data');
        }

        const data = await response.json();
        document.getElementById('nama_jenis_cuti').value = data.nama_jenis_cuti;
        document.getElementById('kategori').value = data.kategori;
        document.getElementById('jumlah_hari_diizinkan').value = data.jumlah_hari_diizinkan;
    }

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
            const response = await fetch(`{{ url('api/jenis-cuti') }}/${jenisCutiId}`, {
            method: 'PUT',
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
                text: 'Jenis Cuti berhasil diperbarui',
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

    // Fetch existing data on load
    fetchJenisCuti().catch(error => {
        console.error('Error fetching data:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal mengambil data jenis cuti',
            allowOutsideClick: false
        });
    });
});
</script>
@endpush