@extends('layouts.master')

@section('title')
    Pengajuan Cuti
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Pengajuan Cuti Pribadi</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-calendar2-week text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Employee Information Card --}}
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Informasi Pegawai</h4>
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

        {{-- Leave Balance Card --}}
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Sisa Jatah Cuti</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Cuti Umum</span>
                                <span class="badge bg-primary" id="sisaCutiUmum">0 hari</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" id="progressCutiUmum" style="width: 0%"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Cuti Khusus</span>
                                <span class="badge bg-info" id="sisaCutiKhusus">0 hari</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-info" id="progressCutiKhusus" style="width: 0%"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Cuti Melahirkan</span>
                                <span class="badge bg-success" id="sisaCutiMelahirkan">0 hari</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" id="progressCutiMelahirkan" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Leave Application Form --}}
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Pengajuan Cuti</h4>
                </div>
                <div class="card-body">
                    <form id="pengajuanCutiForm" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label class="form-label">Jenis Cuti <span class="text-danger">*</span></label>
                                <select class="form-select" name="jenis_cuti" id="jenis_cuti" required>
                                    <option value="" selected disabled>Pilih jenis cuti</option>
                                    <option value="umum">Cuti Umum</option>
                                    <option value="menikah">Cuti Menikah</option>
                                    <option value="melahirkan">Cuti Melahirkan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Pilih jenis cuti
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar-check"></i></span>
                                        <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" required>
                                    </div>
                                    <div class="invalid-feedback">
                                        Pilih tanggal mulai cuti
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-6 mb-3">
                                    <label class="form-label">Tanggal Selesai <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar2-x"></i></span>
                                        <input type="date" class="form-control" name="tanggal_selesai" id="tanggal_selesai" required>
                                    </div>
                                    <div class="invalid-feedback">
                                        Pilih tanggal selesai cuti
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-12 mb-3">
                                <label class="form-label">Keterangan <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" required></textarea>
                                <div class="invalid-feedback">
                                    Masukkan keterangan cuti
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info mt-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-info-circle me-2"></i>
                                <span>Total hari cuti yang diajukan: <strong id="totalHariCuti">0 hari</strong></span>
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

        {{-- Leave Guidelines --}}
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ketentuan Pengajuan Cuti</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Ketentuan Umum:</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Pengajuan cuti minimal 3 hari sebelum tanggal mulai
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Pastikan sisa cuti mencukupi sebelum mengajukan
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Jenis-jenis Cuti:</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="bi bi-calendar2 text-primary me-2"></i>
                                    Cuti Umum: Digunakan untuk keperluan pribadi
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-calendar2 text-info me-2"></i>
                                    Cuti Khusus: Untuk acara/keperluan tertentu
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-calendar2 text-success me-2"></i>
                                    Cuti Melahirkan: Khusus untuk karyawati yang akan melahirkan
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        padding: 1rem;
    }

    .progress {
        background-color: #e9ecef;
        border-radius: 0.5rem;
    }

    .progress-bar {
        border-radius: 0.5rem;
    }

    .form-label {
        font-weight: 500;
    }

    .alert-info {
        background-color: #f8f9fa;
        border-left: 4px solid #0dcaf0;
    }
        /* Custom styling for date inputs */
        .input-group-text {
        background-color: #f8f9fa;
        border-color: #ced4da;
    }

    .form-control[type="date"] {
        appearance: none;
        -webkit-appearance: none;
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
    }

    /* Styling for date picker icon */
    .input-group-text i {
        color: #6c757d;
    }

    /* Hover and focus states */
    .input-group:focus-within .input-group-text {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>
@endpush
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
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

    // Tambahkan elemen tersembunyi untuk menyimpan ID Pegawai
    if (!document.getElementById('id_pegawai')) {
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.id = 'id_pegawai';
        hiddenInput.name = 'id_pegawai';
        document.getElementById('pengajuanCutiForm').appendChild(hiddenInput);
    }

    // Back button functionality
    const btnBack = document.getElementById('btnBack');
    if (btnBack) {
        btnBack.addEventListener('click', function() {
            window.history.back();
        });
    }

    // Validasi Tanggal
    function validateDates() {
        const tanggalMulai = document.getElementById('tanggal_mulai');
        const tanggalSelesai = document.getElementById('tanggal_selesai');

        if (!tanggalMulai || !tanggalSelesai) return false;

        const startDate = new Date(tanggalMulai.value);
        const endDate = new Date(tanggalSelesai.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (startDate < today) {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Tanggal',
                text: 'Tanggal mulai cuti tidak boleh kurang dari hari ini'
            });
            return false;
        }

        if (endDate < startDate) {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Tanggal',
                text: 'Tanggal selesai harus lebih besar dari tanggal mulai'
            });
            return false;
        }

        return true;
    }

    // Validasi Sisa Jatah Cuti
    function validateLeaveQuota(selectedLeaveType, requestedDays) {
        if (!window.leaveQuotaData) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data jatah cuti belum dimuat'
            });
            return false;
        }

        const jenisCuti = document.getElementById('jenis_cuti');
        const selectedOption = jenisCuti.options[jenisCuti.selectedIndex];
        const kategori = selectedOption.getAttribute('data-kategori');

        switch(kategori) {
            case 'Umum':
                if (requestedDays > window.leaveQuotaData.sisa_cuti_umum) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Jatah Cuti Tidak Mencukupi',
                        text: `Sisa cuti umum Anda hanya ${window.leaveQuotaData.sisa_cuti_umum} hari`
                    });
                    return false;
                }
                break;
            case 'Menikah':
                if (requestedDays > window.leaveQuotaData.sisa_cuti_menikah) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Jatah Cuti Tidak Mencukupi',
                        text: `Sisa cuti menikah Anda hanya ${window.leaveQuotaData.sisa_cuti_menikah} hari`
                    });
                    return false;
                }
                break;
            case 'Melahirkan':
                if (requestedDays > window.leaveQuotaData.sisa_cuti_melahirkan) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Jatah Cuti Tidak Mencukupi',
                        text: `Sisa cuti melahirkan Anda hanya ${window.leaveQuotaData.sisa_cuti_melahirkan} hari`
                    });
                    return false;
                }
                break;
        }

        return true;
    }

    // Fetch User and Pegawai Details
    async function fetchUserAndPegawai() {
        try {
            const userResponse = await fetch('http://127.0.0.1:8000/api/auth/me', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!userResponse.ok) {
                throw new Error('Gagal mengambil data user');
            }

            const userData = await userResponse.json();
            
            const idPegawai = userData.pegawai?.id_pegawai;
            const idPegawaiInput = document.getElementById('id_pegawai');
            
            if (idPegawaiInput && idPegawai) {
                idPegawaiInput.value = idPegawai;
            }

            // Update pegawai details
            const nameEl = document.getElementById('pegawaiName');
            const nikEl = document.getElementById('pegawaiNIK');
            const positionEl = document.getElementById('pegawaiPosition');
            const divisionEl = document.getElementById('pegawaiDivision');

            if (nameEl) nameEl.textContent = userData.pegawai?.nama_lengkap || '-';
            if (nikEl) nikEl.textContent = userData.pegawai?.nik || '-';

            // Fetch additional details
            const pegawaiResponse = await fetch(`http://127.0.0.1:8000/api/pegawai/${idPegawai}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!pegawaiResponse.ok) {
                throw new Error('Gagal mengambil data pegawai');
            }

            const pegawaiData = await pegawaiResponse.json();

            // Fetch jabatan
            const idJabatan = pegawaiData.data.id_jabatan;
            if (idJabatan) {
                const jabatanResponse = await fetch(`http://127.0.0.1:8000/api/jabatan/${idJabatan}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                if (!jabatanResponse.ok) {
                    throw new Error('Gagal mengambil data jabatan');
                }

                const jabatanData = await jabatanResponse.json();
                if (positionEl) positionEl.textContent = jabatanData.nama_jabatan;

                // Fetch divisi
                const idDivisi = pegawaiData.data.id_divisi;
                if (idDivisi) {
                    const divisiResponse = await fetch(`http://127.0.0.1:8000/api/divisi/${idDivisi}`, {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json'
                        }
                    });

                    if (!divisiResponse.ok) {
                        throw new Error('Gagal mengambil data divisi');
                    }

                    const divisiData = await divisiResponse.json();
                    if (divisionEl) divisionEl.textContent = divisiData.nama_divisi;
                }
            }


            // Fetch Jatah Cuti
            await fetchJatahCuti(idPegawai);

        } catch (error) {
            console.error('Error fetching data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
    }

    // Fetch Jatah Cuti
    async function fetchJatahCuti(idPegawai) {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/jatah-cuti/check-jatah-cuti/${idPegawai}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil jatah cuti');
            }

            const result = await response.json();
            
            if (result.status === 'success') {
                const data = result.data;
                
                // Update leave quota display
                const umum = document.getElementById('sisaCutiUmum');
                const khusus = document.getElementById('sisaCutiKhusus');
                const melahirkan = document.getElementById('sisaCutiMelahirkan');

                if (umum) umum.textContent = `${data.sisa_cuti_umum || 0} hari`;
                if (khusus) khusus.textContent = `${data.sisa_cuti_menikah || 0} hari`;
                if (melahirkan) melahirkan.textContent = `${data.sisa_cuti_melahirkan || 0} hari`;

                window.leaveQuotaData = data;
            }
        } catch (error) {
            console.error('Error fetching jatah cuti:', error);
        }
    }

    // Fetch Jenis Cuti
    async function fetchJenisCuti() {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/jenis-cuti', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil jenis cuti');
            }

            const data = await response.json();
            const jenisCutiSelect = document.getElementById('jenis_cuti');
            jenisCutiSelect.innerHTML = '<option value="" selected disabled>Pilih jenis cuti</option>'; // Reset options
            
            data.forEach(jenis => {
                const option = document.createElement('option');
                option.value = jenis.id_jenis_cuti;
                option.textContent = jenis.nama_jenis_cuti;
                option.setAttribute('data-kategori', jenis.kategori);
                jenisCutiSelect.appendChild(option);
            });

        } catch (error) {
            console.error('Error fetching jenis cuti:', error);
        }
    }

    // Form Submission
    const form = document.getElementById('pengajuanCutiForm');
    if (form) {
        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            // Validasi form kosong dengan SweetAlert2
            const jenisCuti = document.getElementById('jenis_cuti');
            const tanggalMulai = document.getElementById('tanggal_mulai');
            const tanggalSelesai = document.getElementById('tanggal_selesai');
            const keterangan = document.getElementById('keterangan');

            let isValid = true;
            let errorMessage = '';

            if (!jenisCuti.value) {
                isValid = false;
                errorMessage += '- Jenis Cuti harus dipilih<br>';
                jenisCuti.classList.add('is-invalid');
            } else {
                jenisCuti.classList.remove('is-invalid');
            }

            if (!tanggalMulai.value) {
                isValid = false;
                errorMessage += '- Tanggal Mulai harus diisi<br>';
                tanggalMulai.classList.add('is-invalid');
            } else {
                tanggalMulai.classList.remove('is-invalid');
            }

            if (!tanggalSelesai.value) {
                isValid = false;
                errorMessage += '- Tanggal Selesai harus diisi<br>';
                tanggalSelesai.classList.add('is-invalid');
            } else {
                tanggalSelesai.classList.remove('is-invalid');
            }

            if (!keterangan.value.trim()) {
                isValid = false;
                errorMessage += '- Keterangan harus diisi<br>';
                keterangan.classList.add('is-invalid');
            } else {
                keterangan.classList.remove('is-invalid');
            }

            // Jika form tidak valid, tampilkan SweetAlert
            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Formulir Tidak Lengkap',
                    html: `Silakan lengkapi formulir berikut:<br>${errorMessage}`,
                    customClass: {
                        popup: 'swal-error-popup',
                        title: 'swal-error-title',
                        content: 'swal-error-content'
                    }
                });
                return;
            }

            // Validasi tanggal
            if (!validateDates()) return;

            const formData = new FormData(this);
            const data = {
                id_pegawai: formData.get('id_pegawai'),
                id_jenis_cuti: formData.get('jenis_cuti'),
                tanggal_mulai: formData.get('tanggal_mulai'),
                tanggal_selesai: formData.get('tanggal_selesai'),
                alasan: formData.get('keterangan')
            };

            const startDate = new Date(data.tanggal_mulai);
            const endDate = new Date(data.tanggal_selesai);
            const diffDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;

            // Validasi jatah cuti
            if (!validateLeaveQuota(data.id_jenis_cuti, diffDays)) return;

            try {
                const response = await fetch('http://127.0.0.1:8000/api/cuti', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const responseData = await response.json();

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Pengajuan cuti berhasil diajukan'
                    }).then(() => {
                        window.location.href = '/cuti-pribadi';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: responseData.message || 'Gagal mengajukan cuti'
                    });
                }
            } catch (error) {
                console.error('Error submitting cuti:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message
                });
            }
        });
    }

    // Tambahkan fungsi untuk menghitung hari
    function hitungHariCuti() {
        const tanggalMulai = document.getElementById('tanggal_mulai');
        const tanggalSelesai = document.getElementById('tanggal_selesai');
        const totalHariCuti = document.getElementById('totalHariCuti');

        if (tanggalMulai.value && tanggalSelesai.value) {
            const startDate = new Date(tanggalMulai.value);
            const endDate = new Date(tanggalSelesai.value);
            
            // Tambahkan 1 untuk menghitung hari terakhir
            const diffDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
            
            totalHariCuti.textContent = `${diffDays} hari`;
        } else {
            totalHariCuti.textContent = '0 hari';
        }
    }

    // Tambahkan event listener pada input tanggal
    document.getElementById('tanggal_mulai').addEventListener('change', hitungHariCuti);
    document.getElementById('tanggal_selesai').addEventListener('change', hitungHariCuti);

    // Reset button functionality
    const resetButton = document.getElementById('resetButton');
    if (resetButton) {
        resetButton.addEventListener('click', function() {
            // Reset form
            document.getElementById('pengajuanCutiForm').reset();
            
            // Reset total hari cuti
            document.getElementById('totalHariCuti').textContent = '0 hari';
        });
    }

    // Validasi tanggal dengan warna dan efek visual
    function validateDateRange() {
        const tanggalMulai = document.getElementById('tanggal_mulai');
        const tanggalSelesai = document.getElementById('tanggal_selesai');

        // Tambahkan event listener untuk validasi real-time
        tanggalMulai.addEventListener('change', function() {
            // Set min date untuk tanggal selesai
            tanggalSelesai.min = tanggalMulai.value;
            
            // Visual feedback
            if (new Date(this.value) < new Date()) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });

        tanggalSelesai.addEventListener('change', function() {
            // Visual feedback
            if (new Date(this.value) < new Date(tanggalMulai.value)) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    }

    // Panggil fungsi validasi
    validateDateRange();
    // Initialize data fetching
    fetchUserAndPegawai();
    fetchJenisCuti();
});
</script>
@endpush
