@extends('layouts.app')
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
                            <p class="mb-1"><strong>Nama:</strong></p>
                            <p class="text-muted" id="pegawaiName">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>NIK:</strong></p>
                            <p class="text-muted" id="pegawaiNIK">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Divisi:</strong></p>
                            <p class="text-muted" id="pegawaiDivision">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Jabatan:</strong></p>
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
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label class="form-label" for="id_pegawai">ID Pegawai <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="id_pegawai" 
                                           name="id_pegawai" 
                                           required 
                                           readonly>
                                    <div class="invalid-feedback">
                                        ID Pegawai tidak boleh kosong
                                    </div>
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label class="form-label" for="tahun">Tahun <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="tahun" 
                                           name="tahun" 
                                           required 
                                           min="2000" 
                                           max="2100">
                                    <div class="invalid-feedback">
                                        Tahun tidak valid
                                    </div>
                                    <small class="text-muted">Masukkan tahun antara 2000-2100</small>
                                </div>

                                <div class="form-group col-md-4 mb-3">
                                    <label class="form-label" for="jatah_cuti_umum">Jatah Cuti Umum <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="jatah_cuti_umum" 
                                           name="jatah_cuti_umum" 
                                           required 
                                           min="0" 
                                           value="12">
                                    <div class="invalid-feedback">
                                        Jatah cuti umum tidak valid
                                    </div>
                                    <small class="text-muted">Minimal 0 hari</small>
                                </div>

                                <div class="form-group col-md-4 mb-3">
                                    <label class="form-label" for="jatah_cuti_menikah">Jatah Cuti Menikah <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="jatah_cuti_menikah" 
                                           name="jatah_cuti_menikah" 
                                           required 
                                           min="0" 
                                           value="3">
                                    <div class="invalid-feedback">
                                        Jatah cuti menikah tidak valid
                                    </div>
                                    <small class="text-muted">Minimal 0 hari</small>
                                </div>

                                <div class="form-group col-md-4 mb-3">
                                    <label class="form-label" for="jatah_cuti_melahirkan">Jatah Cuti Melahirkan <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="jatah_cuti_melahirkan" 
                                           name="jatah_cuti_melahirkan" 
                                           required 
                                           min="0" 
                                           value="120">
                                    <div class="invalid-feedback">
                                        Jatah cuti melahirkan tidak valid
                                    </div>
                                    <small class="text-muted">Minimal 0 hari</small>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-danger me-2" id="btnBack">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali
                                    </button>
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

    // Initial token check
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Token tidak ditemukan. Silakan login kembali.'
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

    // Utility Functions
    function showError(message) {
        console.error('Error occurred:', message);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message
        });
    }

    function showSuccess(message) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: message,
            timer: 2000,
            showConfirmButton: false
        });
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

    // API Functions
    async function fetchPegawaiDetails() {
        try {
            console.log('Fetching pegawai details for ID:', idPegawai);
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
            console.log('Pegawai data received:', pegawaiData);

            document.getElementById('pegawaiName').textContent = pegawaiData.data.nama_lengkap;
            document.getElementById('pegawaiNIK').textContent = pegawaiData.data.nik;

            if (pegawaiData.data.id_jabatan) {
                await fetchJabatan(pegawaiData.data.id_jabatan);
            }

            if (pegawaiData.data.id_divisi) {
                await fetchDivisi(pegawaiData.data.id_divisi);
            }

            await checkExistingJatahCuti();

        } catch (error) {
            console.error('Error in fetchPegawaiDetails:', error);
            showError(error.message);
        }
    }

    async function fetchJabatan(idJabatan) {
        try {
            console.log('Fetching jabatan for ID:', idJabatan);
            const response = await fetch(`${baseUrl}/jabatan/${idJabatan}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Gagal mengambil data jabatan');

            const data = await response.json();
            console.log('Jabatan data received:', data);
            document.getElementById('pegawaiPosition').textContent = data.nama_jabatan;
        } catch (error) {
            console.error('Error in fetchJabatan:', error);
            document.getElementById('pegawaiPosition').textContent = '-';
        }
    }

    async function fetchDivisi(idDivisi) {
        try {
            console.log('Fetching divisi for ID:', idDivisi);
            const response = await fetch(`${baseUrl}/divisi/${idDivisi}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Gagal mengambil data divisi');

            const data = await response.json();
            console.log('Divisi data received:', data);
            document.getElementById('pegawaiDivision').textContent = data.nama_divisi;
        } catch (error) {
            console.error('Error in fetchDivisi:', error);
            document.getElementById('pegawaiDivision').textContent = '-';
        }
    }

    async function checkExistingJatahCuti() {
        try {
            console.log('Checking existing jatah cuti for pegawai:', idPegawai);
            const response = await fetch(`${baseUrl}/check-jatah-cuti/${idPegawai}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Gagal memeriksa jatah cuti');

            const data = await response.json();
            console.log('Existing jatah cuti data:', data);

            if (data.data) {
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: 'Jatah cuti untuk pegawai ini sudah ada. Mengalihkan ke halaman edit...',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = `/jatah-cuti/edit/${data.data.id}`;
                });
            }
        } catch (error) {
            console.error('Error in checkExistingJatahCuti:', error);
            showError(error.message);
        }
    }

    async function handleSubmit(event) {
        event.preventDefault();
        
        try {
            validateForm();
            
            const formData = {
                id_pegawai: document.getElementById('id_pegawai').value,
                tahun: document.getElementById('tahun').value,
                jatah_cuti_umum: document.getElementById('jatah_cuti_umum').value,
                jatah_cuti_menikah: document.getElementById('jatah_cuti_menikah').value,
                jatah_cuti_melahirkan: document.getElementById('jatah_cuti_melahirkan').value
            };

            console.log('Submitting form data:', formData);
            console.log('API URL:', `${baseUrl}/jatah-cuti`);
            console.log('Token:', token);

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
            console.log('Submit response:', result);

            if (!response.ok) {
                throw new Error(result.message || result.error || 'Gagal menyimpan jatah cuti');
            }

            showSuccess(result.message || 'Jatah cuti berhasil disimpan');
            setTimeout(() => {
                window.location.href = '/jatah_cuti';
            }, 2000);

        } catch (error) {
            console.error('Error in handleSubmit:', {
                message: error.message,
                stack: error.stack
            });
            showError(error.message);
        }
    }

    // Initialize
    function setDefaultValues() {
        document.getElementById('id_pegawai').value = idPegawai;
        document.getElementById('tahun').value = new Date().getFullYear();
    }

    // Event Listeners
    document.getElementById('jatahCutiForm').addEventListener('submit', handleSubmit);
    
    document.getElementById('btnBack').addEventListener('click', function() {
        window.location.href = '/jatah_cuti';
    });

    // Initialize the form
    setDefaultValues();
    fetchPegawaiDetails();
});
</script>
@endpush
@endsection