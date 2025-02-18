@extends('layouts.master')

@section('title')
    Edit Pengajuan Cuti
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Edit Pengajuan Cuti Pribadi</h2></b>
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
                                <span>Cuti Menikah</span>
                                <span class="badge bg-info" id="sisaCutiMenikah">0 hari</span>
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
                    <h4 class="card-title">Form Edit Pengajuan Cuti</h4>
                </div>
                <div class="card-body">
                    <form id="editCutiForm" class="needs-validation" novalidate>
                        <input type="hidden" id="id_cuti" name="id_cuti" value="{{ $cuti->id_cuti }}">
                        <input type="hidden" id="id_pegawai" name="id_pegawai">

                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label class="form-label">Jenis Cuti <span class="text-danger">*</span></label>
                                <select class="form-select" name="jenis_cuti" id="jenis_cuti" required>
                                    <option value="" selected disabled>Pilih jenis cuti</option>
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
                                </ div>
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
                                    <i class="bi bi-save me-2"></i>Perbarui Cuti
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
                                    Cuti Menikah: Untuk acara pernikahan
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
    
    // DOM Elements
    const elements = {
        form: document.getElementById('editCutiForm'),
        idCuti: document.getElementById('id_cuti'),
        idPegawai: document.getElementById('id_pegawai'),
        jenisCuti: document.getElementById('jenis_cuti'),
        tanggalMulai: document.getElementById('tanggal_mulai'),
        tanggalSelesai: document.getElementById('tanggal_selesai'),
        keterangan: document.getElementById('keterangan'),
        totalHariCuti: document.getElementById('totalHariCuti'),
        pegawaiInfo: {
            name: document.getElementById('pegawaiName'),
            nik: document.getElementById('pegawaiNIK'),
            division: document.getElementById('pegawaiDivision'),
            position: document.getElementById('pegawaiPosition')
        },
        cutiBalance: {
            umum: document.getElementById('sisaCutiUmum'),
            menikah: document.getElementById('sisaCutiMenikah'),
            melahirkan: document.getElementById('sisaCutiMelahirkan')
        },
        progressBars: {
            umum: document.getElementById('progressCutiUmum'),
            khusus: document.getElementById('progressCutiKhusus'),
            melahirkan: document.getElementById('progressCutiMelahirkan')
        }
    };

    // Constants for maximum leave days
    const MAX_LEAVE_DAYS = {
        Umum: 12,
        Menikah: 3,
        Melahirkan: 90
    };

    let currentCutiData = null;

    // Utility function to construct API URLs
    const getApiUrl = (endpoint) => {
        return `${API_BASE_URL}/${endpoint}`;
    };

    // Check token
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

    // Initialize data fetching
    init();

    // Event Listeners
    if (elements.tanggalMulai && elements.tanggalSelesai) {
        elements.tanggalMulai.addEventListener('change', hitungHariCuti);
        elements.tanggalSelesai.addEventListener('change', hitungHariCuti);
        elements.tanggalMulai.addEventListener('input', hitungHariCuti);
        elements.tanggalSelesai.addEventListener('input', hitungHariCuti);
    }

    elements.form.addEventListener('submit', handleSubmit);

    // Functions
    async function init() {
        await fetchUserAndPegawai();
        await fetchAndFillCutiDetail(); // Move this before fetchJenisCuti
        await fetchJenisCuti();
    }

    async function fetchUserAndPegawai() {
        try {
            const response = await fetch(getApiUrl('auth/me'), {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data user');
            }

            const userData = await response.json();
            elements.idPegawai.value = userData.pegawai.id_pegawai;

            await fetchPegawaiDetails(userData.pegawai.id_pegawai);
            await fetchJatahCuti(userData.pegawai.id_pegawai);

        } catch (error) {
            handleError(error);
        }
    }

    async function fetchPegawaiDetails(idPegawai) {
        try {
            const response = await fetch(getApiUrl(`pegawai/${idPegawai}`), {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data pegawai');
            }

            const pegawaiData = await response.json();
            elements.pegawaiInfo.name.textContent = pegawaiData.data.nama_lengkap;
            elements.pegawaiInfo.nik.textContent = pegawaiData.data.nik;

            await fetchJabatanAndDivisi(pegawaiData.data);

        } catch (error) {
            handleError(error);
        }
    }

    async function fetchJabatanAndDivisi(pegawaiData) {
        try {
            if (pegawaiData.id_jabatan) {
                const jabatanResponse = await fetch(getApiUrl(`jabatan/${pegawaiData.id_jabatan}`), {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                if (jabatanResponse.ok) {
                    const jabatanData = await jabatanResponse.json();
                    elements.pegawaiInfo.position.textContent = jabatanData.nama_jabatan;
                }
            }

            if (pegawaiData.id_divisi) {
                const divisiResponse = await fetch(getApiUrl(`divisi/${pegawaiData.id_divisi}`), {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                if (divisiResponse.ok) {
                    const divisiData = await divisiResponse.json();
                    elements.pegawaiInfo.division.textContent = divisiData.nama_divisi;
                }
            }
        } catch (error) {
            handleError(error);
        }
    }

    async function fetchJatahCuti(idPegawai) {
        try {
            const response = await fetch(getApiUrl(`jatah-cuti/check-jatah-cuti/${idPegawai}`), {
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
                elements.cutiBalance.umum.textContent = `${data.sisa_cuti_umum || 0} hari`;
                elements.cutiBalance.menikah.textContent = `${data.sisa_cuti_menikah || 0} hari`;
                elements.cutiBalance.melahirkan.textContent = `${data.sisa_cuti_melahirkan || 0} hari`;
                
                // Update progress bars
                updateProgressBar(elements.progressBars.umum, data.sisa_cuti_umum, MAX_LEAVE_DAYS.Umum);
                updateProgressBar(elements.progressBars.khusus, data.sisa_cuti_menikah, MAX_LEAVE_DAYS.Menikah);
                updateProgressBar(elements.progressBars.melahirkan, data.sisa_cuti_melahirkan, MAX_LEAVE_DAYS.Melahirkan);
                
                // Store for validation
                window.leaveQuotaData = data;
            }
        } catch (error) {
            handleError(error);
        }
    }

    function updateProgressBar(progressBar, currentValue, maxValue) {
        if (progressBar) {
            const percentage = (currentValue / maxValue) * 100;
            progressBar.style.width = `${percentage}%`;
        }
    }

    async function fetchJenisCuti() {
        try {
            const response = await fetch(getApiUrl('jenis-cuti'), {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil jenis cuti');
            }

            const data = await response.json();
            elements.jenisCuti.innerHTML = '<option value="" selected disabled>Pilih jenis cuti</option>';
            
            data.forEach(jenis => {
                const option = document.createElement('option');
                option.value = jenis.id_jenis_cuti;
                option.textContent = jenis.nama_jenis_cuti;
                option.setAttribute('data-kategori', jenis.kategori);
                
                // Compare with currentCutiData instead of elements.idCuti
                if (currentCutiData && jenis.id_jenis_cuti === currentCutiData.id_jenis_cuti) {
                    option.selected = true;
                }

                elements.jenisCuti.appendChild(option);
            });
        } catch (error) {
            handleError(error);
        }
    }

    async function fetchAndFillCutiDetail() {
        try {
            const response = await fetch(getApiUrl(`cuti/${elements.idCuti.value}`), {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil detail cuti');
            }

            const result = await response.json();
            currentCutiData = result.data; // Store the current cuti data

            elements.tanggalMulai.value = formatDate(currentCutiData.tanggal_mulai);
            elements.tanggalSelesai.value = formatDate(currentCutiData.tanggal_selesai);
            elements.keterangan.value = currentCutiData.alasan || '';

            hitungHariCuti();
        } catch (error) {
            handleError(error);
        }
    }

    function hitungHariCuti() {
        if (elements.tanggalMulai.value && elements.tanggalSelesai.value) {
            const startDate = new Date(elements.tanggalMulai.value);
            const endDate = new Date(elements.tanggalSelesai.value);
            
            if (startDate > endDate) {
                elements.totalHariCuti.textContent = '0 hari';
                return;
            }
            
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            
            elements.totalHariCuti.textContent = `${diffDays} hari`;
            
            elements.totalHariCuti.classList.add('updated');
            setTimeout(() => elements.totalHariCuti.classList.remove('updated'), 500);
        } else {
            elements.totalHariCuti.textContent = '0 hari';
        }
    }

    function validateLeaveQuota(selectedLeaveType, requestedDays) {
        if (!window.leaveQuotaData) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data jatah cuti belum dimuat'
            });
            return false;
        }

        const selectedOption = elements.jenisCuti.options[elements.jenisCuti.selectedIndex];
        const kategori = selectedOption.getAttribute('data-kategori');

        const quotaMessages = {
            'Umum': `Sisa cuti umum Anda hanya ${window.leaveQuotaData.sisa_cuti_umum} hari`,
            'Menikah': `Sisa cuti menikah Anda hanya ${window.leaveQuotaData.sisa_cuti_menikah} hari`,
            'Melahirkan': `Sisa cuti melahirkan Anda hanya ${window.leaveQuotaData.sisa_cuti_melahirkan} hari`
        };

        const quotaValues = {
            'Umum': window.leaveQuotaData.sisa_cuti_umum,
            'Menikah': window.leaveQuotaData.sisa_cuti_menikah,
            'Melahirkan': window.leaveQuotaData.sisa_cuti_melahirkan
        };

        if (requestedDays > quotaValues[kategori]) {
            Swal.fire({
                icon: 'warning',
                title: 'Jatah Cuti Tidak Mencukupi',
                text: quotaMessages[kategori]
            });
            return false;
        }

        return true;
    }

    function validateDates() {
        const startDate = new Date(elements.tanggalMulai.value);
        const endDate = new Date(elements.tanggalSelesai.value);
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

    function validateForm() {
        let isValid = true;
        let errorMessage = '';

        const requiredFields = [
            { element: elements.jenisCuti, message: 'Jenis Cuti harus dipilih' },
            { element: elements.tanggalMulai, message: 'Tanggal Mulai harus diisi' },
            { element: elements.tanggalSelesai, message: 'Tanggal Selesai harus diisi' },
            { element: elements.keterangan, message: 'Keterangan harus diisi' }
        ];

        requiredFields.forEach(field => {
            if (!field.element.value) {
                isValid = false;
                errorMessage += `- ${field.message}<br>`;
                field.element.classList.add('is-invalid');
            } else {
                field.element.classList.remove('is-invalid');
            }
        });

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
        }

        return isValid;
    }

async function handleSubmit(event) {
    event.preventDefault();

    if (!validateForm()) return;
    if (!validateDates()) return;

    const formData = new FormData(elements.form);
    const data = {
        id_cuti: formData.get('id_cuti'),
        id_pegawai: formData.get('id_pegawai'),
        id_jenis_cuti: formData.get('jenis_cuti'),
        tanggal_mulai: formData.get('tanggal_mulai'),
        tanggal_selesai: formData.get('tanggal_selesai'),
        alasan: formData.get('keterangan')
    };

    const startDate = new Date(data.tanggal_mulai);
    const endDate = new Date(data.tanggal_selesai);
    const diffDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;

    if (!validateLeaveQuota(data.id_jenis_cuti, diffDays)) return;

    try {
        const response = await fetch(getApiUrl(`cuti/${data.id_cuti}`), {
            method: 'PUT',
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
                text: 'Pengajuan cuti berhasil diperbarui'
            }).then(() => {
                window.location.href = '/cuti-pribadi';
            });
        } else {
            throw new Error(responseData.message || 'Gagal memperbarui cuti');
        }
    } catch (error) {
        handleError(error);
    }
}

function formatDate(dateString) {
    if (!dateString) return '';
    const date = new Date(dateString);
    return date.toISOString().split('T')[0];
}

function handleError(error) {
    console.error('Error:', error);
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: error.message || 'Terjadi kesalahan'
    });
}

// Back button handler
document.getElementById('btnBack')?.addEventListener('click', () => {
    window.location.href = '/cuti-pribadi';
});

// Reset button handler
document.getElementById('resetButton')?.addEventListener('click', async () => {
    try {
        await fetchAndFillCutiDetail();
        await fetchJenisCuti(); // Add this to reset jenis cuti selection
        Swal.fire({
            icon: 'success',
            title: 'Form Direset',
            text: 'Form telah dikembalikan ke data awal'
        });
    } catch (error) {
        handleError(error);
    }
});
});
</script>
@endpush