@extends('layouts.master')

@section('title')
Tambah Pegawai
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
                        <h4 class="card-title">Tambah Pegawai Baru</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="createPegawaiForm" class="needs-validation" novalidate>
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
    const pegawaiForm = document.getElementById('createPegawaiForm');
    const resetButton = document.getElementById('resetButton');
    const divisiSelect = document.getElementById('id_divisi');
    const jabatanSelect = document.getElementById('id_jabatan');
    
    // Store original data for reset functionality
    let originalData = {
        nama_lengkap: '',
        nik: '',
        tanggal_lahir: '',
        jenis_kelamin: '',
        alamat: '',
        telepon: '',
        email: '',
        id_divisi: '',
        id_jabatan: '',
        tanggal_masuk: '',
        agama: '',
        pendidikan_terakhir: '',
        status_kepegawaian: ''
    };

    // Function to populate form with data
    function populateForm(data) {
        Object.keys(data).forEach(key => {
            const element = document.getElementById(key);
            if (element) {
                element.value = data[key];
            }
        });
        // Disable jabatan select if no divisi is selected
        if (!data.id_divisi) {
            jabatanSelect.disabled = true;
            jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
        }
    }

    // Reset button functionality with confirmation
    resetButton.addEventListener('click', async function() {
        const result = await Swal.fire({
            title: 'Konfirmasi Reset',
            text: 'Apakah Anda yakin ingin mengembalikan data ke kondisi awal? Perubahan yang belum disimpan akan hilang.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-warning me-2',
                cancelButton: 'btn btn-secondary'
            }
        });

        if (result.isConfirmed) {
            populateForm(originalData);
            pegawaiForm.classList.remove('was-validated');
            
            const invalidInputs = pegawaiForm.querySelectorAll('.is-invalid');
            invalidInputs.forEach(input => {
                input.classList.remove('is-invalid');
            });

            await Swal.fire({
                icon: 'success',
                title: 'Data Direset',
                text: 'Form telah dikembalikan ke data awal',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });

    // Fetch divisions for select dropdown
    fetch('/api/divisi', {
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(divisions => {
        divisions.forEach(division => {
            const option = document.createElement('option');
            option.value = division.id_divisi;
            option.textContent = division.nama_divisi;
            divisiSelect.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error fetching divisions:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal mengambil data divisi',
            confirmButtonText: 'OK'
        });
    });

    // Handle divisi change
    divisiSelect.addEventListener('change', function() {
        const divisiId = this.value;
        jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
        jabatanSelect.disabled = !divisiId;

        if (divisiId) {
            fetch('/api/jabatan', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(positions => {
                const filteredPositions = positions.filter(position => position.id_divisi == divisiId);
                filteredPositions.forEach(position => {
                    const option = document.createElement('option');
                    option.value = position.id_jabatan;
                    option.textContent = position.nama_jabatan;
                    jabatanSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal mengambil data jabatan',
                    confirmButtonText: 'OK'
                });
            });
        }
    });

    // Form submission
    pegawaiForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        try {
            const loadingAlert = await Swal.fire({
                title: 'Mohon Tunggu',
                text: 'Sedang menyimpan data...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const formData = new FormData(this);

            const response = await fetch('/api/pegawai', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Accept': 'application/json'
                },
                body: formData
            });

            await loadingAlert.close();

            const responseData = await response.json();

            if (!response.ok) {
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

            await Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data pegawai berhasil ditambahkan',
                showConfirmButton: true
            }).then(() => {
                window.location.href = '{{ route("pegawai.index") }}';
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