@extends('layouts.master')

@section('title')
    Tambah Hasil Seleksi
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Hasil Seleksi</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-clipboard-check text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Form Hasil Seleksi</h4>
                    </div>
                    <a href="{{ route('rekrutmen.wawancara.index') }}" class="btn btn-danger btn-sm">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form id="hasilSeleksiForm" class="needs-validation" novalidate>
                        <div class="row g-4">
                            <!-- Informasi Pelamar -->
                            <div class="col-md-4">
                                <div class="form-group position-relative">
                                    <label class="form-label fw-bold" for="namaPelamar">
                                        <i class="bi bi-person me-1"></i>Nama Pelamar
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg shadow-none border-2" 
                                           id="namaPelamar" 
                                           readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group position-relative">
                                    <label class="form-label fw-bold" for="emailPelamar">
                                        <i class="bi bi-envelope me-1"></i>Email
                                    </label>
                                    <input type="email" 
                                           class="form-control form-control-lg shadow-none border-2" 
                                           id="emailPelamar" 
                                           readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group position-relative">
                                    <label class="form-label fw-bold" for="judulPekerjaan">
                                        <i class="bi bi-briefcase me-1"></i>Lowongan Pekerjaan
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg shadow-none border-2" 
                                           id="judulPekerjaan" 
                                           readonly>
                                </div>
                            </div>

                            <!-- Hidden Inputs -->
                            <input type="hidden" id="idPelamar" name="id_pelamar">
                            <input type="hidden" id="idLowongan" name="id_lowongan_pekerjaan">
                            <input type="hidden" id="idWawancara" name="id_wawancara" value="{{ request()->get('wawancara_id') }}">

                            <!-- Status Seleksi -->
                            <div class="col-md-6">
                                <div class="form-group position-relative">
                                    <label class="form-label fw-bold" for="statusSeleksi">
                                        <i class="bi bi-check-circle me-1"></i>Status Seleksi
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select form-control-lg shadow-none border-2" 
                                            id="statusSeleksi" 
                                            name="status" 
                                            required>
                                        <option value="">Pilih Status</option>
                                        <option value="lulus">Lulus</option>
                                        <option value="gagal">Gagal</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Harap pilih status seleksi
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tanggal Keputusan -->
                            <div class="col-md-6">
                                <div class="form-group position-relative">
                                    <label class="form-label fw-bold" for="tanggalKeputusan">
                                        <i class="bi bi-calendar me-1"></i>Tanggal Keputusan
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" 
                                           class="form-control form-control-lg shadow-none border-2" 
                                           id="tanggalKeputusan"
                                           name="tanggal_keputusan" 
                                           value="{{ date('Y-m-d') }}" 
                                           max="{{ date('Y-m-d') }}" 
                                           required>
                                    <div class="invalid-feedback">
                                        Tanggal keputusan harus diisi
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Catatan -->
                            <div class="col-12">
                                <div class="form-group position-relative">
                                    <label class="form-label fw-bold" for="catatan">
                                        <i class="bi bi-journal-text me-1"></i>Catatan
                                    </label>
                                    <textarea class="form-control form-control-lg shadow-none border-2" 
                                              id="catatan"
                                              name="catatan" 
                                              rows="4" 
                                              placeholder="Tambahkan catatan atau keterangan"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="row mt-5">
                            <div class="col-12 d-flex justify-content-end gap-2">
                                <a href="{{ route('rekrutmen.wawancara.index') }}" class="btn btn-danger me-2">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save me-2"></i>Simpan Hasil Seleksi
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

@push('css')
<!-- CSS sama seperti di halaman create -->
<style>
    /* Card Styling */
    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }

    /* Form Controls */
    .form-label {
        color: #344767;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .form-control,
    .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 6px;
        padding: 0.6rem 1rem;
        font-size: 0.95rem;
        transition: all 0.2s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #5e72e4;
        box-shadow: 0 0 0 3px rgba(94, 114, 228, 0.1);
    }

    .input-group-text {
        background: #f8f9fa;
        border: 2px solid #e0e0e0;
        border-left: none;
        color: #6c757d;
    }

    /* Validation Styling */
    .was-validated .form-control:invalid,
    .form-control.is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    .invalid-feedback {
        font-size: 0.875em;
        color: #dc3545;
    }

    /* Buttons */
    .btn {
        padding: 0.6rem 1.5rem;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.2s;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .btn-success {
        background-color: #2dce89;
        border-color: #2dce89;
    }

    .btn-success:hover {
        background-color: #28b97b;
        border-color: #28b97b;
    }

    .btn-warning {
        background-color: #fb6340;
        border-color: #fb6340;
        color: white;
    }

    .btn-warning:hover {
        background-color: #fa3a0e;
        border-color: #fa3a0e;
        color: white;
    }

    .btn-danger {
        background-color: #f5365c;
        border-color: #f5365c;
    }

    .btn-danger:hover {
        background-color: #f40b38;
        border-color: #f40b38;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ambil token dari localStorage
    const token = localStorage.getItem('token');
    
    // Ambil ID wawancara dari URL
    const urlParams = new URLSearchParams(window.location.search);
    const wawancaraId = urlParams.get('wawancara_id');

    // Elemen-elemen form
    const namaPelamarInput = document.getElementById('namaPelamar');
    const emailPelamarInput = document.getElementById('emailPelamar');
    const judulPekerjaanInput = document.getElementById('judulPekerjaan');
    const idPelamarInput = document.getElementById('idPelamar');
    const idLowonganInput = document.getElementById('idLowongan');
    const form = document.getElementById('hasilSeleksiForm');

    // Validasi keberadaan ID Wawancara
    if (!wawancaraId) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'ID Wawancara tidak ditemukan',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/rekrutmen/wawancara';
        });
        return;
    }

    // Fungsi untuk memuat data wawancara
    async function fetchWawancaraData() {
        try {
            const response = await fetch(`/api/wawancara/${wawancaraId}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            
            // Validasi struktur data respons
            if (!result.data) {
                throw new Error('Data wawancara tidak ditemukan');
            }

            const { pelamar, lamaran_pekerjaan } = result.data;

            // Validasi detail data yang diperlukan
            if (!pelamar?.id_pelamar || !pelamar?.nama || !pelamar?.email) {
                throw new Error('Data pelamar tidak lengkap atau tidak valid');
            }

            const lowongan = lamaran_pekerjaan?.lowongan_pekerjaan;
            if (!lowongan?.id_lowongan_pekerjaan || !lowongan?.judul_pekerjaan) {
                throw new Error('Data lowongan pekerjaan tidak lengkap atau tidak valid');
            }

            // Isi field informasi pelamar
            namaPelamarInput.value = pelamar.nama;
            emailPelamarInput.value = pelamar.email;
            judulPekerjaanInput.value = lowongan.judul_pekerjaan;

            // Set hidden input values
            idPelamarInput.value = pelamar.id_pelamar;
            idLowonganInput.value = lowongan.id_lowongan_pekerjaan;

        } catch (error) {
            console.error('Kesalahan saat memuat data:', error);
            
            // Tampilkan pesan error yang lebih spesifik
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: `Gagal memuat data wawancara: ${error.message}`,
                confirmButtonText: 'OK'
            }).then(() => {
                // Redirect ke halaman index jika data tidak dapat dimuat
                window.location.href = '/rekrutmen/wawancara';
            });
        }
    }

    // Handler submit form
    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        // Validasi form
        if (!form.checkValidity()) {
            event.stopPropagation();
            form.classList.add('was-validated');
            return;
        }

        const statusSeleksi = document.getElementById('statusSeleksi').value;
        if (!statusSeleksi) {
            Swal.fire({
                icon: 'warning',
                title: 'Validasi',
                text: 'Harap pilih status seleksi',
                confirmButtonText: 'OK'
            });
            return;
        }

        try {
            // Siapkan data untuk dikirim
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            const response = await fetch('/api/hasil-seleksi', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.pesan || 'Gagal menyimpan hasil seleksi');
            }

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: result.pesan || 'Hasil seleksi berhasil disimpan'
            }).then(() => {
                window.location.href = '/rekrutmen/wawancara';
            });

        } catch (error) {
            console.error('Error submitting form:', error);
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: error.message || 'Terjadi kesalahan saat menyimpan hasil seleksi'
            });
        }
    });

    // Panggil fungsi untuk memuat data wawancara
    fetchWawancaraData();
});
</script>
@endpush