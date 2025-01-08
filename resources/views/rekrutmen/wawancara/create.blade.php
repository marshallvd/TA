@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Jadwalkan Wawancara
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Jadwalkan Wawancara Baru</h4>
                    <a href="{{ route('rekrutmen.wawancara.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form id="formWawancara" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" id="idLamaranPekerjaan" name="id_lamaran_pekerjaan" 
                               value="{{ request()->get('lamaran_id') }}">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Pelamar</label>
                                <input type="text" class="form-control" id="namaPelamar" readonly>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Pelamar</label>
                                <input type="email" class="form-control" id="emailPelamar" readonly>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lowongan Pekerjaan</label>
                                <input type="text" class="form-control" id="judulPekerjaan" readonly>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Wawancara *</label>
                                <input type="datetime-local" class="form-control" 
                                       id="tanggalWawancara" name="tanggal_wawancara" required>
                                <div class="invalid-feedback">
                                    Tanggal wawancara tidak boleh kosong
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lokasi Wawancara *</label>
                                <input type="text" class="form-control" 
                                       id="lokasiWawancara" name="lokasi" required>
                                <div class="invalid-feedback">
                                    Lokasi wawancara tidak boleh kosong
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Metode Wawancara</label>
                                <select class="form-control" id="metodeWawancara" name="metode">
                                    <option value="offline">Offline</option>
                                    <option value="online">Online</option>
                                    <option value="hybrid">Hybrid</option>
                                </select>
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Catatan Tambahan</label>
                                <textarea class="form-control" 
                                          id="catatanWawancara" 
                                          name="catatan" 
                                          rows="3" 
                                          placeholder="Tambahkan catatan atau instruksi khusus"></textarea>
                            </div>
                        </div>
                        
                        <div class="text-end">
                            <button type="button" id="resetButton" class="btn btn-warning me-2">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Simpan Jadwal Wawancara
                            </button>
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
    // Ambil token dari localStorage
    const token = localStorage.getItem('token');

    // Validasi token
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

    // Ambil parameter lamaran_id dari URL
    const urlParams = new URLSearchParams(window.location.search);
    const lamaranId = urlParams.get('lamaran_id');

    // Elemen-elemen form
    const formWawancara = document.getElementById('formWawancara');
    const namaPelamarInput = document.getElementById('namaPelamar');
    const emailPelamarInput = document.getElementById('emailPelamar');
    const judulPekerjaanInput = document.getElementById('judulPekerjaan');
    const hiddenLamaranIdInput = document.getElementById('idLamaranPekerjaan');

    // Validasi keberadaan lamaran ID
    if (!lamaranId) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'ID Lamaran tidak ditemukan',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/rekrutmen/wawancara'; // Sesuaikan dengan route Anda
        });
        return;
    }

    // Set hidden input lamaran ID
    hiddenLamaranIdInput.value = lamaranId;

    // Fungsi untuk mempersiapkan form wawancara
    async function initializeWawancaraForm() {
        try {
            // Fetch data persiapan wawancara
            const response = await fetch(`/api/wawancara/prepare-jadwal/${lamaranId}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            // Parse response
            const result = await response.json();

            // Cek response
            if (!response.ok) {
                throw new Error(result.message || 'Gagal memuat data lamaran');
            }

            // Destructuring data
            const { 
                pelamar, 
                lowongan 
            } = result.data;

            // Isi field form
            namaPelamarInput.value = pelamar.nama || '';
            emailPelamarInput.value = pelamar.email || '';
            judulPekerjaanInput.value = lowongan.judul_pekerjaan || '';

        } catch (error) {
            console.error('Kesalahan saat memuat data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: error.message,
                confirmButtonText: 'OK'
            });
        }
    }

    // Handler submit form wawancara
    formWawancara.addEventListener('submit', async function(event) {
        event.preventDefault();

        // Validasi form
        if (!this.checkValidity()) {
            event.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        // Siapkan data untuk dikirim
        const formData = new FormData(formWawancara);
        const data = Object.fromEntries(formData.entries());

        try {
            // Kirim data wawancara
            const response = await fetch('/api/wawancara/jadwalkan', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            // Parse response
            const result = await response.json();

            // Cek response
            if (!response.ok) {
                throw new Error(result.message || 'Gagal menjadwalkan wawancara');
            }

            // Tampilkan pesan sukses
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Jadwal wawancara berhasil dibuat',
                confirmButtonText: 'OK'
            }).then(() => {
                // Redirect ke halaman daftar wawancara
                window.location.href = '/rekrutmen/wawancara'; // Sesuaikan dengan route Anda
            });

        } catch (error) {
            console.error('Kesalahan saat submit:', error);
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: error.message,
                confirmButtonText: 'OK'
            });
        }
    });

    // Reset button functionality
    document.getElementById('resetButton').addEventListener('click', function() {
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
                formWawancara .reset();
                formWawancara.classList.remove('was-validated');
                // Remove all is-invalid classes
                formWawancara.querySelectorAll('.is-invalid').forEach(element => {
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

    // Panggil fungsi inisialisasi form
    initializeWawancaraForm();
});
</script>
@endpush