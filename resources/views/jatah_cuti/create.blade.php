@extends('layouts.master')

@section('title')
    Tambah Jatah Cuti
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Jatah Cuti</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-calendar-range text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Employee Information Card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title mb-0">Informasi Pegawai</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" id="pegawaiDetails">
                        <div class="col-md-3">
                            <p class="mb-1 fw-bold">Nama:</p>
                            <p class="text-muted" id="pegawaiName">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1 fw-bold">NIK:</p>
                            <p class="text-muted" id="pegawaiNIK">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1 fw-bold">Divisi:</p>
                            <p class="text-muted" id="pegawaiDivision">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1 fw-bold">Jabatan:</p>
                            <p class="text-muted" id="pegawaiPosition">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Form Card --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Form Pengajuan Jatah Cuti</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="jatahCutiForm" class="needs-validation" novalidate>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="id_pegawai">
                                            <i class="bi bi-person-badge me-1"></i>ID Pegawai
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="id_pegawai" 
                                               name="id_pegawai" 
                                               required 
                                               readonly>
                                        <div class="invalid-feedback">
                                            ID Pegawai tidak boleh kosong
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="tahun">
                                            <i class="bi bi-calendar-event me-1"></i>Tahun
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="tahun" 
                                               name="tahun" 
                                               required 
                                               min="2000" 
                                               max="2100"
                                               placeholder="Masukkan tahun">
                                        <div class="invalid-feedback">
                                            Tahun tidak valid
                                        </div>
                                        <small class="text-muted">Masukkan tahun antara 2000-2100</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="jatah_cuti_umum">
                                            <i class="bi bi-calendar-check me-1"></i>Jatah Cuti Umum
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="jatah_cuti_umum" 
                                               name="jatah_cuti_umum" 
                                               required 
                                               min="0" 
                                               value="12"
                                               placeholder="Masukkan jumlah hari">
                                        <div class="invalid-feedback">
                                            Jatah cuti umum tidak valid
                                        </div>
                                        <small class="text-muted">Minimal 0 hari</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="jatah_cuti_menikah">
                                            <i class="bi bi-calendar-heart me-1"></i>Jatah Cuti Menikah
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="jatah_cuti_menikah" 
                                               name="jatah_cuti_menikah" 
                                               required 
                                               min="0" 
                                               value="3"
                                               placeholder="Masukkan jumlah hari">
                                        <div class="invalid-feedback">
                                            Jatah cuti menikah tidak valid
                                        </div>
                                        <small class="text-muted">Minimal 0 hari</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="jatah_cuti_melahirkan">
                                            <i class="bi bi-calendar-plus me-1"></i>Jatah Cuti Melahirkan
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="jatah_cuti_melahirkan" 
                                               name="jatah_cuti_melahirkan" 
                                               required 
                                               min="0" 
                                               value="120"
                                               placeholder="Masukkan jumlah hari">
                                        <div class="invalid-feedback">
                                            Jatah cuti melahirkan tidak valid
                                        </div>
                                        <small class="text-muted">Minimal 0 hari</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <a href="/jatah_cuti" class="btn btn-danger me-2">
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

    {{-- Information Alert --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading"><i class="bi bi-info-circle me-2"></i>Informasi Jatah Cuti</h4>
                <p class="mb-0">Berikut adalah ketentuan jatah cuti yang berlaku:</p>
                <ul class="mt-2 mb-0">
                    <li>Cuti Umum: Diberikan kepada seluruh karyawan untuk keperluan pribadi</li>
                    <li>Cuti Menikah: Khusus diberikan saat karyawan melangsungkan pernikahan</li>
                    <li>Cuti Melahirkan: Diberikan kepada karyawati yang akan melahirkan</li>
                </ul>
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

/* Alert styling */
.alert-info {
    background-color: #f8f9fa;
    border-left: 4px solid #0dcaf0;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Constants and Configurations
    const token = localStorage.getItem('token');
    const urlParams = new URLSearchParams(window.location.search);
    const idPegawai = urlParams.get('id_pegawai');
    const baseUrl = 'http://127.0.0.1:8000/api';
    const jatahCutiForm = document.getElementById('jatahCutiForm');
    const resetButton = document.getElementById('resetButton');

    // Initial token check
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

    // ID Pegawai check
    if (!idPegawai) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'ID Pegawai tidak ditemukan.'
        }).then(() => {
            window.location.href = '/jatah-cuti';
        });
        return;
    }

    // Reset button functionality
    resetButton.addEventListener('click', async function() {
        const result = await Swal.fire({
            title: 'Konfirmasi Reset',
            text: 'Apakah Anda yakin ingin mengosongkan semua field?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset',
            cancelButtonText: 'Batal'
        });

        if (result.isConfirmed) {
            setDefaultValues();
            jatahCutiForm.classList.remove('was-validated');
            showSuccessAlert('Form berhasil direset', true);
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

    async function fetchPegawaiDetails() {
        try {
            showLoadingAlert('Mengambil data pegawai...');

            const pegawaiResponse = await fetch(`${baseUrl}/pegawai/${idPegawai}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!pegawaiResponse.ok) {
                throw new Error('Gagal mengambil data pegawai');
            }

            const pegawaiData = await pegawaiResponse.json();
            document.getElementById('pegawaiName').textContent = pegawaiData.data.nama_lengkap;
            document.getElementById('pegawaiNIK').textContent = pegawaiData.data.nik;

            if (pegawaiData.data.id_jabatan) {
                await fetchJabatan(pegawaiData.data.id_jabatan);
            }

            if (pegawaiData.data.id_divisi) {
                await fetchDivisi(pegawaiData.data.id_divisi);
            }

            await checkExistingJatahCuti();
            Swal.close();

        } catch (error) {
            console.error('Error in fetchPegawaiDetails:', error);
            showErrorAlert(error.message);
        }
    }



async function fetchJabatan(idJabatan) {
    try {
        const response = await fetch(`${baseUrl}/jabatan/${idJabatan}`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        if (!response.ok) throw new Error('Gagal mengambil data jabatan');

        const data = await response.json();
        document.getElementById('pegawaiPosition').textContent = data.nama_jabatan;
    } catch (error) {
        console.error('Error in fetchJabatan:', error);
        document.getElementById('pegawaiPosition').textContent = '-';
    }
}

async function fetchDivisi(idDivisi) {
    try {
        const response = await fetch(`${baseUrl}/divisi/${idDivisi}`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        if (!response.ok) throw new Error('Gagal mengambil data divisi');

        const data = await response.json();
        document.getElementById('pegawaiDivision').textContent = data.nama_divisi;
    } catch (error) {
        console.error('Error in fetchDivisi:', error);
        document.getElementById('pegawaiDivision').textContent = '-';
    }
}

async function checkExistingJatahCuti() {
    try {
        const response = await fetch(`${baseUrl}/check-jatah-cuti/${idPegawai}`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        if (!response.ok) throw new Error('Gagal memeriksa jatah cuti');

        const data = await response.json();

        if (data.data) {
            await Swal.fire({
                icon: 'info',
                title: 'Info',
                text: 'Jatah cuti untuk pegawai ini sudah ada. Mengalihkan ke halaman edit...',
                timer: 2000,
                showConfirmButton: false
            });
            window.location.href = `/jatah-cuti/edit/${data.data.id}`;
        }
    } catch (error) {
        console.error('Error in checkExistingJatahCuti:', error);
        showErrorAlert(error.message);
    }
}

function validateForm() {
    const jatahCutiUmum = parseInt(document.getElementById('jatah_cuti_umum').value);
    const jatahCutiMenikah = parseInt(document.getElementById('jatah_cuti_menikah').value);
    const jatahCutiMelahirkan = parseInt(document.getElementById('jatah_cuti_melahirkan').value);
    const tahun = parseInt(document.getElementById('tahun').value);

    if (isNaN(jatahCutiUmum) || isNaN(jatahCutiMenikah) || isNaN(jatahCutiMelahirkan)) {
        throw new Error('Semua jatah cuti harus berupa angka');
    }

    if (jatahCutiUmum < 0 || jatahCutiMenikah < 0 || jatahCutiMelahirkan < 0) {
        throw new Error('Jatah cuti tidak boleh negatif');
    }

    if (!tahun || tahun < 2000 || tahun > 2100) {
        throw new Error('Tahun tidak valid');
    }

    if (!document.getElementById('id_pegawai').value) {
        throw new Error('ID Pegawai tidak boleh kosong');
    }
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

async function handleSubmit(event) {
    event.preventDefault();
    
    if (!jatahCutiForm.checkValidity()) {
        event.stopPropagation();
        jatahCutiForm.classList.add('was-validated');
        return;
    }
    
    try {
        validateForm();
        showLoadingAlert('Sedang menyimpan data...');
        
        const formData = {
            id_pegawai: document.getElementById('id_pegawai').value,
            tahun: document.getElementById('tahun').value,
            jatah_cuti_umum: document.getElementById('jatah_cuti_umum').value,
            jatah_cuti_menikah: document.getElementById('jatah_cuti_menikah').value,
            jatah_cuti_melahirkan: document.getElementById('jatah_cuti_melahirkan').value
        };

        const response = await fetch(`${baseUrl}/jatah-cuti`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });

        const result = await response.json();

        if (!response.ok) {
            if (result.errors) {
                handleValidationErrors(result.errors);
                throw new Error('Terjadi kesalahan validasi');
            }
            throw new Error(result.message || 'Gagal menyimpan data');
        }

        await showSuccessAlert('Jatah cuti berhasil disimpan');
        window.location.href = '/jatah_cuti';

    } catch (error) {
        console.error('Error in handleSubmit:', error);
        showErrorAlert(error.message);
    }
}

function setDefaultValues() {
    document.getElementById('id_pegawai').value = idPegawai;
    document.getElementById('tahun').value = new Date().getFullYear();
    document.getElementById('jatah_cuti_umum').value = '12';
    document.getElementById('jatah_cuti_menikah').value = '3';
    document.getElementById('jatah_cuti_melahirkan').value = '120';
}

// Initialize form and event listeners
jatahCutiForm.addEventListener('submit', handleSubmit);
setDefaultValues();
fetchPegawaiDetails();
});
</script>
@endpush