@extends('layouts.master')

@section('title')
Tambah Jabatan
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Jabatan</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-bank2 text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Tambah Jabatan Baru</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="createJabatanForm" class="needs-validation" novalidate>
                            <div class="row g-4">
                                <!-- Nama Jabatan Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="nama_jabatan">
                                            <i class="bi bi-person-badge me-1"></i>Nama Jabatan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="nama_jabatan" 
                                               name="nama_jabatan" 
                                               required 
                                               maxlength="100"
                                               placeholder="Masukkan nama jabatan">
                                        <div class="invalid-feedback">
                                            Nama jabatan tidak boleh kosong
                                        </div>
                                        <small class="text-muted">
                                            <i class="bi bi-info-circle me-1"></i>Maksimal 100 karakter
                                        </small>
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

                                <!-- Gaji Pokok Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="gaji_pokok">
                                            <i class="bi bi-cash me-1"></i>Gaji Pokok
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="gaji_pokok" 
                                               name="gaji_pokok" 
                                               required
                                               placeholder="Masukkan gaji pokok">
                                        <div class="invalid-feedback">
                                            Gaji pokok tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <!-- Tarif Lembur Input -->
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="tarif_lembur_per_hari">
                                            <i class="bi bi-clock-history me-1"></i>Tarif Lembur per Hari
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="tarif_lembur_per_hari" 
                                               name="tarif_lembur_per_hari" 
                                               required
                                               placeholder="Masukkan tarif lembur">
                                        <div class="invalid-feedback">
                                            Tarif lembur tidak boleh kosong
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="{{ route('master_data.jabatan.index') }}" class="btn btn-danger me-2">
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
    const jabatanForm = document.getElementById('createJabatanForm');
    const resetButton = document.getElementById('resetButton');
    const gajiPokokInput = document.getElementById('gaji_pokok');
    const tarifLemburInput = document.getElementById('tarif_lembur_per_hari');
    
    // Store original data for reset functionality
    let originalData = {
        nama_jabatan: '',
        id_divisi: '',
        gaji_pokok: '0',
        tarif_lembur_per_hari: '0'
    };

    // Function to format currency
    function formatCurrency(input) {
        input.setAttribute('type', 'text');
        
        input.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            if (value.length > 15) {
                value = value.slice(0, 15);
            }
            if (value) {
                value = new Intl.NumberFormat('id-ID').format(value);
            }
            this.value = value;
        });

        input.addEventListener('blur', function(e) {
            if (this.value === '') {
                this.value = '0';
            }
        });
    }

    // Function to populate form with data
    function populateForm(data) {
        document.getElementById('nama_jabatan').value = data.nama_jabatan;
        document.getElementById('id_divisi').value = data.id_divisi;
        document.getElementById('gaji_pokok').value = data.gaji_pokok;
        document.getElementById('tarif_lembur_per_hari').value = data.tarif_lembur_per_hari;
    }

    // Initialize currency formatting
    formatCurrency(gajiPokokInput);
    formatCurrency(tarifLemburInput);

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
            jabatanForm.classList.remove('was-validated');
            
            const invalidInputs = jabatanForm.querySelectorAll('.is-invalid');
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
        const selectElement = document.getElementById('id_divisi');
        divisions.forEach(division => {
            const option = document.createElement('option');
            option.value = division.id_divisi;
            option.textContent = division.nama_divisi;
            selectElement.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error fetching divisions:', error);
        Swal.fire('Error', 'Gagal mengambil data divisi', 'error');
    });

    // Form submission
    jabatanForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        const formData = {
            nama_jabatan: document.getElementById('nama_jabatan').value.trim(),
            id_divisi: document.getElementById('id_divisi').value,
            gaji_pokok: document.getElementById('gaji_pokok').value.replace(/\D/g, ''),
            tarif_lembur_per_hari: document.getElementById('tarif_lembur_per_hari').value.replace(/\D/g, '')
        };

        try {
            // const loadingAlert = await Swal.fire({
            //     title: 'Mohon Tunggu',
            //     text: 'Sedang menyimpan data...',
            //     allowOutsideClick: false,
            //     allowEscapeKey: false,
            //     showConfirmButton: false,
            //     didOpen: () => {
            //         Swal.showLoading();
            //     }
            // });

            const response = await fetch('/api/jabatan', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            // await loadingAlert.close();

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
                text: 'Data jabatan berhasil ditambahkan',
                showConfirmButton: true
            }).then(() => {
                window.location.href = '{{ route("master_data.jabatan.index") }}';
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