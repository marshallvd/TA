@extends('layouts.master')

@section('title')
    Edit Pegawai
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Data Pegawai</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-person-lines-fill text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Informasi Pegawai</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="pegawaiForm" class="needs-validation" novalidate>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" id="pegawaiId" name="id_pegawai">
                            <div class="row g-4">
                                <!-- Nama Lengkap Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="nama_lengkap">
                                            <i class="bi bi-person-fill me-1"></i>Nama Lengkap
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="nama_lengkap" 
                                               name="nama_lengkap" 
                                               required 
                                               maxlength="100"
                                               placeholder="Masukkan nama lengkap">
                                        <div class="invalid-feedback">
                                            Nama lengkap tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- NIK Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="nik">
                                            <i class="bi bi-credit-card-2-front me-1"></i>NIK
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="nik" 
                                               name="nik" 
                                               required
                                               maxlength="16"
                                               placeholder="Masukkan NIK">
                                        <div class="invalid-feedback">
                                            NIK tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Tanggal Lahir Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="tanggal_lahir">
                                            <i class="bi bi-calendar-date me-1"></i>Tanggal Lahir
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="tanggal_lahir" 
                                               name="tanggal_lahir" 
                                               required>
                                        <div class="invalid-feedback">
                                            Tanggal lahir tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Jenis Kelamin Select -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="jenis_kelamin">
                                            <i class="bi bi-gender-ambiguous me-1"></i>Jenis Kelamin
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control form-control-lg shadow-none border-2" 
                                                id="jenis_kelamin" 
                                                name="jenis_kelamin" 
                                                required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Jenis kelamin harus dipilih
                                        </div>
                                    </div>
                                </div>

                                <!-- Alamat Textarea -->
                                <div class="col-md-12">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="alamat">
                                            <i class="bi bi-geo-alt me-1"></i>Alamat
                                            <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control form-control-lg shadow-none border-2" 
                                                  id="alamat" 
                                                  name="alamat" 
                                                  required
                                                  rows="3"
                                                  placeholder="Masukkan alamat lengkap"></textarea>
                                        <div class="invalid-feedback">
                                            Alamat tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Telepon Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="telepon">
                                            <i class="bi bi-telephone me-1"></i>Telepon
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="tel" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="telepon" 
                                               name="telepon" 
                                               required
                                               placeholder="Masukkan nomor telepon">
                                        <div class="invalid-feedback">
                                            Nomor telepon tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Email Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="email">
                                            <i class="bi bi-envelope me-1"></i>Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="email" 
                                               name="email" 
                                               required
                                               placeholder="Masukkan alamat email">
                                        <div class="invalid-feedback">
                                            Email tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Divisi Select -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="id_divisi">
                                            <i class="bi bi-building me-1"></i>Divisi
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control form-control-lg shadow-none border-2" 
                                                id="id_divisi" 
                                                name="id_divisi" 
                                                required>
                                            <option value="">Pilih Divisi</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Divisi harus dipilih
                                        </div>
                                    </div>
                                </div>

                                <!-- Jabatan Select -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="id_jabatan">
                                            <i class="bi bi-person-badge me-1"></i>Jabatan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control form-control-lg shadow-none border-2" 
                                                id="id_jabatan" 
                                                name="id_jabatan" 
                                                required
                                                disabled>
                                            <option value="">Pilih Jabatan</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Jabatan harus dipilih
                                        </div>
                                    </div>
                                </div>

                                <!-- Tanggal Masuk Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="tanggal_masuk">
                                            <i class="bi bi-calendar-check me-1"></i>Tanggal Masuk
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="tanggal_masuk" 
                                               name="tanggal_masuk" 
                                               required>
                                        <div class="invalid-feedback">
                                            Tanggal masuk tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Agama Select -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="agama">
                                            <i class="bi bi-book me-1"></i>Agama
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control form-control-lg shadow-none border-2" 
                                                id="agama" 
                                                name="agama" 
                                                required>
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Agama harus dipilih
                                        </div>
                                    </div>
                                </div>

                                <!-- Pendidikan Terakhir Select -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="pendidikan_terakhir">
                                            <i class="bi bi-mortarboard me-1"></i>Pendidikan Terakhir
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control form-control-lg shadow-none border-2" 
                                                id="pendidikan_terakhir" 
                                                name="pendidikan_terakhir" 
                                                required>
                                            <option value="">Pilih Pendidikan</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                            <option value="D3">D3</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Pendidikan terakhir harus dipilih
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Kepegawaian Select -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="status_kepegawaian">
                                            <i class="bi bi-person-check me-1"></i>Status Kepegawaian
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control form-control-lg shadow-none border-2" 
                                                id="status_kepegawaian" 
                                                name="status_kepegawaian" 
                                                required>
                                            <option value="">Pilih Status</option>
                                            <option value="aktif">Aktif</option>
                                            <option value="tidak aktif">Tidak Aktif</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Status kepegawaian harus dipilih
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="{{ route('pegawai.index') }}" class="btn btn-danger me-2">
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

/* Form styling */
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

    /* Custom form control styling */
    .form-control-lg {
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }

    /* Icon styling */
    .bi {
        vertical-align: -0.125em;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get necessary DOM elements and setup variables
    const token = localStorage.getItem('token');
    const pegawaiId = window.location.pathname.split('/').pop();
    const pegawaiForm = document.getElementById('pegawaiForm');
    const resetButton = document.getElementById('resetButton');
    const divisiSelect = document.querySelector('[name="id_divisi"]');
    const jabatanSelect = document.querySelector('[name="id_jabatan"]');
    
    // Store original data for reset functionality
    let originalData = null;
    
    // Initialize form by fetching employee data
    initializeForm();

    async function initializeForm() {
        try {
            await Promise.all([
                fetchAndPopulatePegawaiData(),
                fetchDivisi()
            ]);

            // Enable jabatan select after divisi is loaded
            jabatanSelect.disabled = false;
            
        } catch (error) {
            console.error('Error initializing form:', error);
            showErrorAlert(error.message);
            redirectToIndex();
        }
    }

    async function fetchAndPopulatePegawaiData() {
        try {
            showLoadingAlert('Sedang mengambil data pegawai...');
            
            const response = await fetch(`/api/pegawai/${pegawaiId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            
            const result = await response.json();
            
            if (!response.ok) {
                throw new Error(result.message || 'Gagal mengambil data pegawai');
            }
            
            // Store original data and populate form
            originalData = result.data;
            populateFormFields(originalData);
            
            // Fetch related jabatan data if divisi is selected
            if (originalData.id_divisi) {
                await fetchJabatan(originalData.id_divisi, originalData.id_jabatan);
            }

            Swal.close();
            
        } catch (error) {
            Swal.close();
            throw error;
        }
    }

    function populateFormFields(data) {
        Object.keys(data).forEach(key => {
            const element = document.querySelector(`[name="${key}"]`);
            if (element) {
                element.value = data[key] || '';
            }
        });
    }

    async function fetchDivisi() {
        try {
            const response = await fetch('/api/divisi', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            
            if (!response.ok) throw new Error('Gagal mengambil data divisi');
            
            const divisions = await response.json();
            populateDivisiSelect(divisions);
            
        } catch (error) {
            throw new Error('Gagal memuat data divisi: ' + error.message);
        }
    }

    function populateDivisiSelect(divisions) {
        divisiSelect.innerHTML = '<option value="">Pilih Divisi</option>';
        divisions.forEach(division => {
            const option = document.createElement('option');
            option.value = division.id_divisi;
            option.textContent = division.nama_divisi;
            if (originalData && division.id_divisi == originalData.id_divisi) {
                option.selected = true;
            }
            divisiSelect.appendChild(option);
        });
    }

    async function fetchJabatan(divisiId, selectedJabatanId = null) {
        try {
            const response = await fetch('/api/jabatan', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            
            if (!response.ok) throw new Error('Gagal mengambil data jabatan');
            
            const positions = await response.json();
            const filteredPositions = positions.filter(pos => pos.id_divisi == divisiId);
            
            populateJabatanSelect(filteredPositions, selectedJabatanId);
            jabatanSelect.disabled = false;
            
        } catch (error) {
            showErrorAlert('Gagal memuat data jabatan');
            jabatanSelect.disabled = true;
        }
    }

    function populateJabatanSelect(positions, selectedId = null) {
        jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
        positions.forEach(position => {
            const option = document.createElement('option');
            option.value = position.id_jabatan;
            option.textContent = position.nama_jabatan;
            if (selectedId && position.id_jabatan == selectedId) {
                option.selected = true;
            }
            jabatanSelect.appendChild(option);
        });
    }

    // Event Listeners
    divisiSelect.addEventListener('change', async function() {
        const divisiId = this.value;
        jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
        jabatanSelect.disabled = true;
        
        if (divisiId) {
            await fetchJabatan(divisiId);
        }
    });

    resetButton.addEventListener('click', async function() {
        const result = await Swal.fire({
            title: 'Konfirmasi Reset',
            text: 'Apakah Anda yakin ingin mengembalikan data ke kondisi awal?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset',
            cancelButtonText: 'Batal'
        });

        if (result.isConfirmed && originalData) {
            populateFormFields(originalData);
            await fetchDivisi();
            
            if (originalData.id_divisi) {
                await fetchJabatan(originalData.id_divisi, originalData.id_jabatan);
            }

            showSuccessAlert('Data berhasil direset', true);
        }
    });

    pegawaiForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        try {
            showLoadingAlert('Sedang menyimpan perubahan...');

            const formData = new FormData(this);
            
            const response = await fetch(`/api/pegawai/${pegawaiId}`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const result = await response.json();

            if (!response.ok) {
                if (result.errors) {
                    handleValidationErrors(result.errors);
                    throw new Error('Terjadi kesalahan validasi');
                }
                throw new Error(result.message || 'Gagal menyimpan perubahan');
            }

            await showSuccessAlert('Data pegawai berhasil diperbarui');
            redirectToIndex();

        } catch (error) {
            console.error('Error:', error);
            showErrorAlert(error.message);
        }
    });

    // Utility Functions
    function showLoadingAlert(message) {
        return Swal.fire({
            title: 'Mohon Tunggu',
            text: message,
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }

    function showSuccessAlert(message, autoClose = false) {
        return Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: message,
            showConfirmButton: !autoClose,
            timer: autoClose ? 1500 : undefined
        });
    }

    function showErrorAlert(message) {
        return Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            confirmButtonText: 'OK'
        });
    }

    function handleValidationErrors(errors) {
        Object.keys(errors).forEach(key => {
            const inputElement = document.querySelector(`[name="${key}"]`);
            if (inputElement) {
                inputElement.classList.add('is-invalid');
                const feedbackElement = inputElement.nextElementSibling;
                if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                    feedbackElement.textContent = errors[key][0];
                }
            }
        });
    }

    function redirectToIndex() {
        window.location.href = '/pegawai';
    }
});
</script>
@endpush