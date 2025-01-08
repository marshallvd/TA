@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Tambah Lowongan Pekerjaan
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Lowongan Pekerjaan</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-briefcase text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tambah Lowongan Pekerjaan Baru</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="createLowonganForm" class="needs-validation" novalidate>
                            <div class="row g-4">
                                <!-- Divisi Selection -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="id_divisi">
                                            <i class="bi bi-building me-1"></i>Divisi
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-select-lg shadow-none border-2" 
                                                id="id_divisi" 
                                                name="id_divisi" 
                                                required>
                                            <option value="" disabled selected>Pilih Divisi</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Divisi tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Jabatan Selection -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="id_jabatan">
                                            <i class="bi bi-person-workspace me-1"></i>Jabatan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-select-lg shadow-none border-2" 
                                                id="id_jabatan" 
                                                name="id_jabatan" 
                                                required>
                                            <option value="" disabled selected>Pilih Jabatan</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Jabatan tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Judul Pekerjaan -->
                                <div class="col-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="judul_pekerjaan">
                                            <i class="bi bi-tag me-1"></i>Judul Pekerjaan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="judul_pekerjaan" 
                                               name="judul_pekerjaan" 
                                               required 
                                               placeholder="Masukkan judul pekerjaan">
                                        <div class="invalid-feedback">
                                            Judul pekerjaan tidak boleh kosong
                                        </div>
                                    </div>
                                </div>
                                <!-- Tambahkan di bagian yang sama dengan jumlah lowongan -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="pengalaman_minimal">
                                            <i class="bi bi-briefcase me-1"></i>Pengalaman Minimal (Tahun)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" 
                                            class="form-control form-control-lg shadow-none border-2" 
                                            id="pengalaman_minimal" 
                                            name="pengalaman_minimal" 
                                            min="0" 
                                            required 
                                            placeholder="Masukkan pengalaman minimal">
                                        <div class="invalid-feedback">
                                            Pengalaman minimal harus diisi
                                        </div>
                                    </div>
                                </div>

                                <!-- Lokasi Pekerjaan -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="lokasi_pekerjaan">
                                            <i class="bi bi-geo-alt me-1"></i>Lokasi Pekerjaan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="lokasi_pekerjaan" 
                                               name="lokasi_pekerjaan" 
                                               required 
                                               placeholder="Masukkan lokasi pekerjaan">
                                        <div class="invalid-feedback">
                                            Lokasi pekerjaan tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Jumlah Lowongan -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="jumlah_lowongan">
                                            <i class="bi bi-people me-1"></i>Jumlah Lowongan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="jumlah_lowongan" 
                                               name="jumlah_lowongan" 
                                               min="1" 
                                               required 
                                               placeholder="Masukkan jumlah lowongan">
                                        <div class="invalid-feedback">
                                            Jumlah lowongan harus lebih dari 0
                                        </div>
                                    </div>
                                </div>

                                <!-- Rentang Usia -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold">
                                            <i class="bi bi-calendar-date me-1"></i>Rentang Usia
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="number" 
                                                   class="form-control form-control-lg shadow-none border-2" 
                                                   id="usia_minimal" 
                                                   name="usia_minimal" 
                                                   min="17" 
                                                   required 
                                                   placeholder="Usia Min">
                                            <span class="input-group-text bg-light">-</span>
                                            <input type="number" 
                                                   class="form-control form-control-lg shadow-none border-2" 
                                                   id="usia_maksimal" 
                                                   name="usia_maksimal" 
                                                   required 
                                                   placeholder="Usia Maks">
                                            <div class="invalid-feedback">
                                                Rentang usia tidak valid
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rentang Gaji -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold">
                                            <i class="bi bi-cash me-1"></i>Rentang Gaji
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="number" 
                                                   class="form-control form-control-lg shadow-none border-2" 
                                                   id="gaji_minimal" 
                                                   name="gaji_minimal" 
                                                   min="0" 
                                                   required 
                                                   placeholder="Gaji Min">
                                            <span class="input-group-text bg-light">-</span>
                                            <input type="number" 
                                                   class="form-control form-control-lg shadow-none border-2" 
                                                   id="gaji_maksimal" 
                                                   name="gaji_maksimal" 
                                                   required 
                                                   placeholder="Gaji Maks">
                                            <div class="invalid-feedback">
                                                Rentang gaji tidak valid
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Jenis Pekerjaan -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="jenis_pekerjaan">
                                            <i class="bi bi-file-earmark-text me-1"></i>Jenis Pekerjaan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-select-lg shadow-none border-2" 
                                                id="jenis_pekerjaan" 
                                                name="jenis_pekerjaan" 
                                                required>
                                            <option value="" disabled selected>Pilih Jenis</option>
                                            <option value="full time">Full Time</option>
                                            <option value="part time">Part Time</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Jenis pekerjaan tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="status">
                                            <i class="bi bi-check-circle me-1"></i>Status
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select form-select-lg shadow-none border-2" 
                                                id="status" 
                                                name="status" 
                                                required>
                                            <option value="aktif">Aktif</option>
                                            <option value="tutup">Tutup</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Status tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Tanggal Mulai dan Selesai -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="tanggal_mulai">
                                            <i class="bi bi-calendar me-1"></i>Tanggal Mulai
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="tanggal_mulai" 
                                               name="tanggal_mulai" 
                                               required>
                                        <div class="invalid-feedback">
                                            Tanggal mulai tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="tanggal_selesai">
                                            <i class="bi bi-calendar-check me-1"></i>Tanggal Selesai
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="tanggal_selesai" 
                                               name="tanggal_selesai" 
                                               required>
                                        <div class="invalid-feedback">
                                            Tanggal selesai tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Deskripsi dan Persyaratan -->
                                <div class="col-12">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="deskripsi">
                                            <i class="bi bi-file-earmark-text me-1"></i>Deskripsi Pekerjaan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control form-control-lg shadow-none border-2" 
                                                  id="deskripsi" 
                                                  name="deskripsi" 
                                                  rows="4" 
                                                  required 
                                                  placeholder="Masukkan deskripsi pekerjaan"></textarea>
                                        <div class="invalid-feedback">
                                            Deskripsi pekerjaan tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="persyaratan">
                                            <i class="bi bi-file-earmark-text me-1"></i>Persyaratan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control form-control-lg shadow-none border-2" 
                                                  id="persyaratan" 
                                                  name="persyaratan" 
                                                  rows="4" 
                                                  required 
                                                  placeholder="Masukkan persyaratan pekerjaan"></textarea>
                                        <div class="invalid-feedback">
                                            Persyaratan tidak boleh kosong
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <button type="button" id="btnBack" class="btn btn-danger me-2">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali
                                    </button>
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const createLowonganForm = document.getElementById('createLowonganForm');
    const resetButton = document.querySelector('button[type="reset"]');
    const divisiSelect = document.getElementById('id_divisi');
    const jabatanSelect = document.getElementById('id_jabatan');
    const btnBack = document.getElementById('btnBack');

    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Anda harus login untuk mengakses halaman ini.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/login';
        });
        return;
    }

    // Back button functionality
    btnBack.addEventListener('click', function() {
        window.history.back();
    });

    // Fetch Divisi
    async function fetchDivisi() {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/divisi', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Gagal mengambil data divisi');

            const data = await response.json();
            
            // Reset divisi options
            divisiSelect.innerHTML = '<option value="">Pilih Divisi</option>';
            
            data.forEach(divisi => {
                const option = document.createElement('option');
                option.value = divisi.id_divisi;
                option.textContent = divisi.nama_divisi;
                divisiSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
    }

    // Fetch Jabatan berdasarkan Divisi
    async function fetchJabatanByDivisi(idDivisi) {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/jabatan/divisi/${idDivisi}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Gagal mengambil data jabatan');

            const data = await response.json();
            
            // Reset jabatan options
            jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
            
            data.forEach(jabatan => {
                const option = document.createElement('option');
                option.value = jabatan.id_jabatan;
                option.textContent = jabatan.nama_jabatan;
                jabatanSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
    }

    // Event listener untuk perubahan divisi
    divisiSelect.addEventListener('change', function() {
        const idDivisi = this.value;
        
        if (idDivisi) {
            fetchJabatanByDivisi(idDivisi);
        } else {
            // Reset jabatan options jika tidak ada divisi yang dipilih
            jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
        }
    });

    // Reset button functionality
    resetButton.addEventListener('click', function() {
        Swal.fire({
            title: 'Reset Form?',
            text: 'Semua data yang telah diisi akan dihapus',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Reset form
                createLowonganForm.reset();
                
                // Remove validation classes
                createLowonganForm.classList.remove('was-validated');
                
                // Reset jabatan select
                jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
                
                // Remove all is-invalid classes
                createLowonganForm.querySelectorAll('.is-invalid').forEach(element => {
                    element.classList.remove('is-invalid');
                });
                
                Swal.fire({
                    icon: 'success',
                    title: 'Form Direset',
                    text: 'Form telah dikosongkan',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    });

    // Form submission
    createLowonganForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Validasi form
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        // Validasi tambahan
        const usiaMaksimal = parseInt(document.getElementById('usia_maksimal').value);
        const usiaMinimal = parseInt(document.getElementById('usia_minimal').value);
        const gajiMaksimal = parseInt(document.getElementById('gaji_maksimal').value);
        const gajiMinimal = parseInt(document.getElementById('gaji_minimal').value);
        const tanggalMulai = document.getElementById('tanggal_mulai').value;
        const tanggalSelesai = document.getElementById('tanggal_selesai').value;

        // Validasi rentang usia
        if (usiaMaksimal <= usiaMinimal) {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                text: 'Usia maksimal harus lebih besar dari usia minimal'
            });
            return;
        }

        // Validasi rentang gaji
        if (gajiMaksimal <= gajiMinimal) {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                text: 'Gaji maksimal harus lebih besar dari gaji minimal'
            });
            return;
        }

        // Validasi tanggal
        if (new Date(tanggalSelesai) <= new Date(tanggalMulai)) {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                text: 'Tanggal selesai harus setelah tanggal mulai'
            });
            return;
        }

        // Siapkan data
        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        try {
            // Tampilkan loading
            const loadingAlert = Swal.fire({
                title: 'Mohon Tunggu',
                text: 'Sedang menyimpan data lowongan...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Kirim data ke API
            const response = await fetch('http://127.0.0.1:8000/api/lowongan', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            // Tutup loading
            Swal.close();

            const result = await response.json();

// Replace the error handling section in your form submission with this:
if (!response.ok) {
    const result = await response.json();
    
    if (response.status === 422) { // Validation error
        const errors = result.errors;
        Object.keys(errors).forEach(field => {
            const element = document.getElementById(field);
            if (element) {
                element.classList.add('is-invalid');
                const feedback = element.nextElementSibling;
                if (feedback?.classList.contains('invalid-feedback')) {
                    feedback.textContent = errors[field][0];
                }
            }
        });
        throw new Error('Please check all required fields');
    }
    
    throw new Error(result.message || 'Failed to save data');
}

            // Tampilkan pesan sukses
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Lowongan berhasil disimpan',
                showConfirmButton: true
            }).then(() => {
                window.location.href = '/rekrutmen/lowongan'; // Ganti dengan rute yang sesuai
            });

        } catch (error) {
            console.error('Error:', error);

            let errorMessage = 'Terjadi kesalahan saat menyimpan data';
            if (error.message === 'Unauthorized') {
                window.location.href = '/login';
                return;
            }

            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessage,
                showConfirmButton: true
            });
        }
    });

    // Ambil data divisi saat halaman dimuat
    fetchDivisi();
});
</script>
@endpush
