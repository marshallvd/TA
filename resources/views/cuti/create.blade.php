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
                                <span>Cuti Menikah</span>
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

                        <input type="hidden" name="id_pegawai" id="id_pegawai">

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
// Constants and Configuration
const ENDPOINTS = {
    AUTH: 'auth/me',
    PEGAWAI: 'pegawai',
    JABATAN: 'jabatan',
    DIVISI: 'divisi',
    JATAH_CUTI: 'jatah-cuti/check-jatah-cuti',
    JENIS_CUTI: 'jenis-cuti',
    CUTI: 'cuti'
};

document.addEventListener('DOMContentLoaded', function() {
    // Check if API_BASE_URL is defined
    if (typeof API_BASE_URL === 'undefined') {
        console.error('API_BASE_URL is not defined');
        return;
    }

    // Initialize necessary variables
    const token = localStorage.getItem('token');
    let leaveQuotaData = null;

    // Utility Functions
    const showErrorAlert = (message) => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message
        }).then(() => {
            if (message.includes('login')) {
                window.location.href = `${BASE_URL}/login`;
            }
        });
    };

    const showSuccessAlert = (message, redirect = null) => {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: message
        }).then(() => {
            if (redirect) window.location.href = redirect;
        });
    };

    // API Handler
    const apiHandler = {
    async fetchData(endpoint, options = {}) {
        try {
            const token = localStorage.getItem('token');
            if (!token) {
                throw new Error('Token tidak ditemukan. Silakan login kembali.');
            }

            const defaultHeaders = {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            };

            const response = await fetch(`${API_BASE_URL}/${endpoint}`, {
                ...options,
                headers: {
                    ...defaultHeaders,
                    ...options.headers
                }
            });

            // Handle different HTTP status codes
            if (response.status === 401) {
                localStorage.removeItem('token'); // Clear invalid token
                throw new Error('Sesi anda telah berakhir. Silakan login kembali.');
            }

            if (response.status === 403) {
                throw new Error('Anda tidak memiliki akses untuk melakukan operasi ini.');
            }

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || `Error! Status: ${response.status}`);
            }

            return await response.json();
        } catch (error) {
            console.error(`API Error (${endpoint}):`, error);
            
            // Handle network errors
            if (error.name === 'TypeError' && error.message === 'Failed to fetch') {
                throw new Error('Tidak dapat terhubung ke server. Periksa koneksi internet Anda.');
            }

            // Re-throw the error to be handled by the calling function
            throw error;
        }
    }
};

    // Data Fetchers
    const dataFetcher = {
        async fetchUserAndPegawaiDetails() {
        try {
            const userData = await apiHandler.fetchData(ENDPOINTS.AUTH);
            const idPegawai = userData.pegawai?.id_pegawai;
            
            if (!idPegawai) throw new Error('ID Pegawai tidak ditemukan');

            // Add null check before setting value
            const idPegawaiInput = document.getElementById('id_pegawai');
            if (idPegawaiInput) {
                idPegawaiInput.value = idPegawai;
            } else {
                console.error('Element id_pegawai not found in the DOM');
                throw new Error('Form tidak lengkap: id_pegawai tidak ditemukan');
            }

            // Update element display with null checks
            this.updatePegawaiDisplay(userData.pegawai);

            // Fetch additional details
            const pegawaiData = await apiHandler.fetchData(`${ENDPOINTS.PEGAWAI}/${idPegawai}`);
            await this.fetchAndDisplayPosition(pegawaiData.data.id_jabatan);
            await this.fetchAndDisplayDivision(pegawaiData.data.id_divisi);
            await this.fetchLeaveQuota(idPegawai);
            await this.fetchLeaveTypes();

        } catch (error) {
            showErrorAlert(error.message);
        }
    },

    updatePegawaiDisplay(pegawai) {
        // Add null checks for all element updates
        const elements = {
            'pegawaiName': pegawai?.nama_lengkap || '-',
            'pegawaiNIK': pegawai?.nik || '-',
            'pegawaiPosition': '-',
            'pegawaiDivision': '-'
        };

        Object.entries(elements).forEach(([id, value]) => {
            const element = document.getElementById(id);
            if (element) {
                element.textContent = value;
            } else {
                console.warn(`Element ${id} not found in the DOM`);
            }
        });
    },

        async fetchAndDisplayPosition(idJabatan) {
            const jabatanData = await apiHandler.fetchData(`${ENDPOINTS.JABATAN}/${idJabatan}`);
            document.getElementById('pegawaiPosition').textContent = jabatanData.nama_jabatan;
        },

        async fetchAndDisplayDivision(idDivisi) {
            const divisiData = await apiHandler.fetchData(`${ENDPOINTS.DIVISI}/${idDivisi}`);
            document.getElementById('pegawaiDivision').textContent = divisiData.nama_divisi;
        },

        async fetchLeaveQuota(idPegawai) {
            const result = await apiHandler.fetchData(`${ENDPOINTS.JATAH_CUTI}/${idPegawai}`);
            if (result.status === 'success') {
                leaveQuotaData = result.data;
                this.updateLeaveQuotaDisplay(result.data);
            }
        },

        updateLeaveQuotaDisplay(data) {
            document.getElementById('sisaCutiUmum').textContent = `${data.sisa_cuti_umum || 0} hari`;
            document.getElementById('sisaCutiKhusus').textContent = `${data.sisa_cuti_menikah || 0} hari`;
            document.getElementById('sisaCutiMelahirkan').textContent = `${data.sisa_cuti_melahirkan || 0} hari`;

            // Update progress bars
            document.getElementById('progressCutiUmum').style.width = `${(data.sisa_cuti_umum / 12) * 100}%`;
            document.getElementById('progressCutiKhusus').style.width = `${(data.sisa_cuti_menikah / 3) * 100}%`;
            document.getElementById('progressCutiMelahirkan').style.width = `${(data.sisa_cuti_melahirkan / 90) * 100}%`;
        },

        async fetchLeaveTypes() {
            const data = await apiHandler.fetchData(ENDPOINTS.JENIS_CUTI);
            const select = document.getElementById('jenis_cuti');
            select.innerHTML = '<option value="" selected disabled>Pilih jenis cuti</option>';
            
            data.forEach(jenis => {
                const option = document.createElement('option');
                option.value = jenis.id_jenis_cuti;
                option.textContent = jenis.nama_jenis_cuti;
                option.setAttribute('data-kategori', jenis.kategori);
                select.appendChild(option);
            });
        }
    };

    // Validators
    const validators = {
        validateDates() {
            const tanggalMulai = new Date(document.getElementById('tanggal_mulai').value);
            const tanggalSelesai = new Date(document.getElementById('tanggal_selesai').value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (tanggalMulai < today) {
                showErrorAlert('Tanggal mulai cuti tidak boleh kurang dari hari ini');
                return false;
            }

            if (tanggalSelesai < tanggalMulai) {
                showErrorAlert('Tanggal selesai harus lebih besar dari tanggal mulai');
                return false;
            }

            return true;
        },

        validateLeaveQuota(selectedLeaveType, requestedDays) {
            if (!leaveQuotaData) {
                showErrorAlert('Data jatah cuti belum dimuat');
                return false;
            }

            const jenisCuti = document.getElementById('jenis_cuti');
            const kategori = jenisCuti.options[jenisCuti.selectedIndex].getAttribute('data-kategori');
            const quotaMap = {
                'Umum': { quota: leaveQuotaData.sisa_cuti_umum, message: 'umum' },
                'Menikah': { quota: leaveQuotaData.sisa_cuti_menikah, message: 'menikah' },
                'Melahirkan': { quota: leaveQuotaData.sisa_cuti_melahirkan, message: 'melahirkan' }
            };

            const selectedQuota = quotaMap[kategori];
            if (requestedDays > selectedQuota.quota) {
                showErrorAlert(`Sisa cuti ${selectedQuota.message} Anda hanya ${selectedQuota.quota} hari`);
                return false;
            }

            return true;
        },

        validateForm() {
            const fields = [
                { id: 'jenis_cuti', label: 'Jenis Cuti' },
                { id: 'tanggal_mulai', label: 'Tanggal Mulai' },
                { id: 'tanggal_selesai', label: 'Tanggal Selesai' },
                { id: 'keterangan', label: 'Keterangan' }
            ];
            
            let isValid = true;
            let errorMessage = '';

            fields.forEach(field => {
                const element = document.getElementById(field.id);
                const value = element.value.trim();
                
                if (!value) {
                    isValid = false;
                    errorMessage += `- ${field.label} harus diisi<br>`;
                    element.classList.add('is-invalid');
                } else {
                    element.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Formulir Tidak Lengkap',
                    html: errorMessage,
                });
            }

            return isValid;
        }
    };

    // Event Handlers
    const eventHandlers = {
        initializeEventListeners() {
            // Form submission
            document.getElementById('pengajuanCutiForm').addEventListener('submit', this.handleFormSubmit.bind(this));
            
            // Date inputs
            ['tanggal_mulai', 'tanggal_selesai'].forEach(id => {
                document.getElementById(id).addEventListener('change', this.updateTotalDays);
            });

            // Reset button
            document.getElementById('resetButton').addEventListener('click', this.handleReset);

            // Back button
            document.getElementById('btnBack').addEventListener('click', () => window.history.back());

            // Date validation
            this.initializeDateValidation();
        },

        async handleFormSubmit(event) {
            event.preventDefault();
            if (!validators.validateForm() || !validators.validateDates()) return;

            const formData = new FormData(event.target);
            const data = {
                id_pegawai: formData.get('id_pegawai'),
                id_jenis_cuti: formData.get('jenis_cuti'),
                tanggal_mulai: formData.get('tanggal_mulai'),
                tanggal_selesai: formData.get('tanggal_selesai'),
                alasan: formData.get('keterangan')
            };

            const diffDays = this.calculateDaysDifference(data.tanggal_mulai, data.tanggal_selesai);
            if (!validators.validateLeaveQuota(data.id_jenis_cuti, diffDays)) return;

            try {
                await apiHandler.fetchData(ENDPOINTS.CUTI, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                showSuccessAlert('Pengajuan cuti berhasil diajukan', window.location.origin + '/cuti-pribadi');
            } catch (error) {
                showErrorAlert(error.message);
            }
        },

        calculateDaysDifference(startDate, endDate) {
            return Math.ceil((new Date(endDate) - new Date(startDate)) / (1000 * 60 * 60 * 24)) + 1;
        },

        updateTotalDays() {
            const start = document.getElementById('tanggal_mulai').value;
            const end = document.getElementById('tanggal_selesai').value;
            const totalElement = document.getElementById('totalHariCuti');

            if (start && end) {
                const days = eventHandlers.calculateDaysDifference(start, end);
                totalElement.textContent = `${days} hari`;
            } else {
                totalElement.textContent = '0 hari';
            }
        },

        handleReset() {
            document.getElementById('pengajuanCutiForm').reset();
            document.getElementById('totalHariCuti').textContent = '0 hari';
            // Remove validation classes
            document.querySelectorAll('.is-invalid').forEach(element => {
                element.classList.remove('is-invalid');
            });
        },

        initializeDateValidation() {
            const tanggalMulai = document.getElementById('tanggal_mulai');
            const tanggalSelesai = document.getElementById('tanggal_selesai');

            tanggalMulai.addEventListener('change', function() {
                tanggalSelesai.min = this.value;
                this.classList.toggle('is-invalid', new Date(this.value) < new Date());
            });

            tanggalSelesai.addEventListener('change', function() {
                this.classList.toggle('is-invalid', new Date(this.value) < new Date(tanggalMulai.value));
            });
        }
    };

    // Initialize Application
    const initialize = async () => {
        if (!token) {
            showErrorAlert('Token tidak ditemukan. Silakan login kembali.');
            return;
        }

        try {
            await dataFetcher.fetchUserAndPegawaiDetails();
            eventHandlers.initializeEventListeners();
        } catch (error) {
            showErrorAlert('Gagal menginisialisasi aplikasi: ' + error.message);
        }
    };

    // Start the application
    initialize();
});
</script>
@endpush
