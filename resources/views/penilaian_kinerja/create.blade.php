@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Tambah Penilaian Kinerja
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Penilaian Kinerja</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-person-workspace text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Informasi Pegawai</h4>
                    <button type="button" class="btn btn-danger btn-sm" id="btnBack">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </button>
                </div>
                <div class="card-body">
                    <div class="row small" id="pegawaiDetails">
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

    <!-- Panduan Penilaian di atas -->
<div class="row mb-4 justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0 small">Panduan Penilaian</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered mb-0">
                        <thead>
                            <tr class="small text-center">
                                <th class="text-center" style="width: 60px;">Nilai</th>
                                <th>Kategori</th>
                            </tr>
                        </thead>
                        <tbody class="small text-center">
                            <tr>
                                <td class="text-center">5</td>
                                <td>Sangat Baik</td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>Baik</td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>Cukup</td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Kurang</td>
                            </tr>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Sangat Kurang</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-2">
                    <ul class="nav nav-pills nav-fill custom-pills">
                        <li class="nav-item">
                            <a class="nav-link active" id="kpi-tab" data-bs-toggle="pill" href="#formKPI">
                                <i class="bi bi-list-task me-2"></i>KPI
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="kompetensi-tab" data-bs-toggle="pill" href="#formKompetensi">
                                <i class="bi bi-person-badge me-2"></i>Kompetensi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="core-values-tab" data-bs-toggle="pill" href="#formCoreValues">
                                <i class="bi bi-star me-2"></i>Core Values
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Form utama full width -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="penilaianKinerjaForm">
                        <input type="hidden" id="id_pegawai" name="id_pegawai">
                        <input type="hidden" id="periode_penilaian" name="periode_penilaian">
                        <input type="hidden" id="divisi_pegawai" name="divisi_pegawai">

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="formKPI">
                                <h5 class="mb-3">Penilaian KPI</h5>
                                <div id="kpiItems">
                                    <div class="text-center py-3">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary mt-3" id="nextToKompetensi"><i class="bi bi-arrow-right-square me-2"></i>Selanjutnya</button>
                            </div>

                            <div class="tab-pane fade" id="formKompetensi">
                                <h5 class="mb-3">Penilaian Kompetensi</h5>
                                <div id="kompetensiItems">
                                    <div class="text-center py-3">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary mt-3" id="nextToCoreValues"><i class="bi bi-arrow-right-square me-2"></i>Selanjutnya</button>
                            </div>

                            <div class="tab-pane fade" id="formCoreValues">
                                <h5 class="mb-3">Penilaian Core Values</h5>
                                <div id="coreValuesItems">
                                    <div class="text-center py-3">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 mt-4">
                                    <label for="catatan" class="form-label">Catatan Penilaian</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                                </div>
                                <button type="button" class="btn btn-success mt-3" id="submitPenilaian"><i class="bi bi-arrow-right-square me-2"></i>Simpan</button>
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
<style>
    .custom-pills .nav-link {
        border-radius: 4px;
        margin: 0 5px;
        transition: all 0.3s ease;
        padding: 0.75rem 1.25rem;
    }
    
    .custom-pills .nav-link.active {
        background-color: #007bff;
        color: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .custom-pills .nav-link:hover {
        background-color: #0056b3;
        color: white;
    }

    .nav-pills {
        background-color: #f8f9fa;
        padding: 0.5rem;
        border-radius: 4px;
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

    const pathSegments = window.location.pathname.split('/');
    const idPegawai = pathSegments[pathSegments.length - 2];
    const periodePenilaian = pathSegments[pathSegments.length - 1];

    document.getElementById('id_pegawai').value = idPegawai;
    document.getElementById('periode_penilaian').value = periodePenilaian;

    if (!idPegawai || !periodePenilaian) {
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Mohon pilih pegawai dan periode penilaian terlebih dahulu',
            allowOutsideClick: false
        }).then(() => {
            window.location.href = '/penilaian/pilih-pegawai';
        });
        return;
    }

    // Initialize Bootstrap tabs
    const triggerTabList = [].slice.call(document.querySelectorAll('[data-bs-toggle="pill"]'));
    triggerTabList.forEach(function(triggerEl) {
        const tabTrigger = new bootstrap.Tab(triggerEl);
        triggerEl.addEventListener('click', function(event) {
            event.preventDefault();
            tabTrigger.show();
        });
    });

    function getNilaiCategory(nilai) {
        if (nilai >= 5) return 'Sangat Baik';
        if (nilai >= 4) return 'Baik';
        if (nilai >= 3) return 'Cukup';
        if (nilai >= 2) return 'Kurang';
        return 'Sangat Kurang';
    }

    function validateNilaiInput(input) {
        let value = parseFloat(input.value);
        if (isNaN(value) || value < 1) {
            value = 1;
            input.value = 1;
        } else if (value > 5) {
            value = 5;
            input.value = 5;
        }
        
        const feedbackDiv = input.nextElementSibling;
        if (feedbackDiv && feedbackDiv.classList.contains('nilai-feedback')) {
            feedbackDiv.textContent = `Kategori: ${getNilaiCategory(value)}`;
        }
    }

    window.validateNilaiInput = validateNilaiInput;

    async function fetchData(endpoint) {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/${endpoint}`, {
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

            return await response.json();
        } catch (error) {
            console.error(`Fetch error for ${endpoint}:`, error);
            throw error;
        }
    }

    async function fetchPegawaiDetails() {
        try {
            const pegawaiResponse = await fetchData(`pegawai/${idPegawai}`);
            
            if (!pegawaiResponse.data) {
                throw new Error('Data pegawai tidak ditemukan');
            }

            const pegawai = pegawaiResponse.data;
            
            const [divisiResponse, jabatanResponse] = await Promise.all([
                fetchData('divisi'),
                fetchData('jabatan')
            ]);

            const divisi = divisiResponse.find(d => d.id_divisi === pegawai.id_divisi);
            const jabatan = jabatanResponse.find(j => j.id_jabatan === pegawai.id_jabatan);

            document.getElementById('pegawaiName').textContent = pegawai.nama_lengkap || '-';
            document.getElementById('pegawaiNIK').textContent = pegawai.nik || '-';
            document.getElementById('pegawaiDivision').textContent = divisi ? divisi.nama_divisi : '-';
            document.getElementById('pegawaiPosition').textContent = jabatan ? jabatan.nama_jabatan : '-';
            document.getElementById('divisi_pegawai').value = pegawai.id_divisi;

            await Promise.all([
                fetchKPIComponents(pegawai.id_divisi),
                fetchKompetensiComponents(),
                fetchCoreValuesComponents()
            ]);
        } catch (error) {
            console.error('Error in fetchPegawaiDetails:', error);
            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data pegawai: ' + error.message
            });
        }
    }

    async function fetchKPIComponents(idDivisi) {
        try {
            console.log('Fetching KPI for divisi:', idDivisi);
            if (!idDivisi) {
                throw new Error('ID Divisi tidak valid');
            }

            const response = await fetchData(`komponen-kpi?id_divisi=${idDivisi}`);
            console.log('KPI Response:', response);
            
            const kpiContainer = document.getElementById('kpiItems');
            
            if (!response || response.length === 0) {
                kpiContainer.innerHTML = '<p class="text-center">Tidak ada komponen KPI untuk divisi ini</p>';
                return;
            }

            let html = '';
            response.forEach(component => {
                html += `
                    <div class="mb-4 border-bottom pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">${component.nama_indikator}</h6>
                            <span class="badge bg-primary">Bobot: ${component.bobot}%</span>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nilai</label>
                                    <input type="number" 
                                        class="form-control" 
                                        name="kpi[${component.id_komponen_kpi}]" 
                                        min="1" 
                                        max="5" 
                                        value="1" 
                                        onchange="validateNilaiInput(this)" 
                                        required>
                                    <div class="nilai-feedback small text-muted mt-1">Kategori: Sangat Kurang</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted"><b>Target:</b> ${component.target}</small><br>
                                <small class="text-muted"><b>Ukuran:</b> ${component.ukuran}</small>
                            </div>
                        </div>
                    </div>
                `;
            });

            kpiContainer.innerHTML = html;
        } catch (error) {
            console.error('Error fetching KPI components:', error);
            document.getElementById('kpiItems').innerHTML = 
                '<p class="text-center text-danger">Gagal memuat komponen KPI: ' + error.message + '</p>';
        }
    }
    
    async function fetchKompetensiComponents() {
        try {
            const response = await fetchData('komponen-kompetensi');
            const kompetensiContainer = document.getElementById('kompetensiItems');
            
            if (!response.data || response.data.length === 0) {
                kompetensiContainer.innerHTML = '<p class="text-center">Tidak ada komponen Kompetensi</p>';
                return;
            }

            let html = '';
            response.data.forEach(component => {
                html += `
                    <div class="mb-4 border-bottom pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">${component.nama_kompetensi}</h6>
                            <span class="badge bg-info">Bobot: ${component.bobot}%</span>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nilai</label>
                                    <input type="number" 
                                        class="form-control" 
                                        name="kompetensi[${component.id_komponen_kompetensi}]" 
                                        min="1" 
                                        max="5" 
                                        value="1" 
                                        onchange="validateNilaiInput(this)" 
                                        required>
                                    <div class="nilai-feedback small text-muted mt-1">Kategori: Sangat Kurang</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted"><b>Perilaku Utama:</b></small><br>
                                <p class="small text-muted mb-3">${component.perilaku_utama}</p>
                            </div>
                        </div>
                    </div>
                `;
            });

            kompetensiContainer.innerHTML = html;
        } catch (error) {
            document.getElementById('kompetensiItems').innerHTML = 
                '<p class="text-center text-danger">Gagal memuat komponen Kompetensi: ' + error.message + '</p>';
        }
    }

    async function fetchCoreValuesComponents() {
        try {
            const response = await fetchData('komponen-core-values');
            const coreValuesContainer = document.getElementById ('coreValuesItems');
            
            if (!response.data || response.data.length === 0) {
                coreValuesContainer.innerHTML = '<p class="text-center">Tidak ada komponen Core Values</p>';
                return;
            }

            let html = '';
            response.data.forEach(component => {
                html += `
                    <div class="mb-4 border-bottom pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0">${component.nama_core_values}</h6>
                            <span class="badge bg-success">Bobot: ${component.bobot}%</span>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nilai</label>
                                    <input type="number" 
                                        class="form-control" 
                                        name="core_values[${component.id_komponen_core_values}]" 
                                        min="1" 
                                        max="5" 
                                        value="1" 
                                        onchange="validateNilaiInput(this)" 
                                        required>
                                    <div class="nilai-feedback small text-muted mt-1">Kategori: Sangat Kurang</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted"><b>Perilaku Utama:</b></small><br>
                                <p class="small text-muted mb-3">${component.perilaku_utama}</p>
                            </div>
                        </div>
                    </div>
                `;
            });

            coreValuesContainer.innerHTML = html;
        } catch (error) {
            document.getElementById('coreValuesItems').innerHTML = 
                '<p class="text-center text-danger">Gagal memuat komponen Core Values: ' + error.message + '</p>';
        }
    }

    async function submitPenilaian(formData) {
        try {
            const preparedData = {
                coreValues: [],
                kompetensi: [],
                kpi: []
            };

            // Prepare data seperti sebelumnya
            formData.forEach((value, key) => {
                if (key.startsWith('core_values[')) {
                    const id = key.match(/\[(.*?)\]/)[1];
                    preparedData.coreValues.push({
                        id_komponen_core_values: parseInt(id),
                        nilai: parseFloat(value)
                    });
                } else if (key.startsWith('kompetensi[')) {
                    const id = key.match(/\[(.*?)\]/)[1];
                    preparedData.kompetensi.push({
                        id_komponen_kompetensi: parseInt(id),
                        nilai: parseFloat(value)
                    });
                } else if (key.startsWith('kpi[')) {
                    const id = key.match(/\[(.*?)\]/)[1];
                    preparedData.kpi.push({
                        id_komponen_kpi: parseInt(id),
                        nilai: parseFloat(value)
                    });
                }
            });

            // Submit penilaian KPI, Kompetensi, dan Core Values
            const [coreValuesResult, kompetensiResult, kpiResult] = await Promise.all([
                makeApiCall('penilaian-core-values', {
                    details: preparedData.coreValues
                }),
                makeApiCall('penilaian-kompetensi', {
                    details: preparedData.kompetensi
                }),
                makeApiCall('penilaian-kpi', {
                    details: preparedData.kpi,
                    id_divisi: parseInt(formData.get('divisi_pegawai'))
                })
            ]);

            // Pastikan kita mendapatkan ID dari hasil submit sebelumnya
            const idPenilaianCoreValues = coreValuesResult.data.id_penilaian_core_values; // Periksa nama field ini
            const idPenilaianKompetensi = kompetensiResult.id_penilaian_kompetensi; // Periksa nama field ini
            const idPenilaianKPI = kpiResult.id_penilaian_kpi; // Periksa nama field ini

            if (!idPenilaianCoreValues || !idPenilaianKompetensi || !idPenilaianKPI) {
                throw new Error('Gagal mendapatkan ID penilaian dari submit sebelumnya');
            }

            // Submit penilaian kinerja dengan data yang lengkap
            const penilaianKinerjaData = {
                id_pegawai: parseInt(formData.get('id_pegawai')),
                periode_penilaian: formData.get('periode_penilaian'),
                id_penilaian_kpi: idPenilaianKPI,
                id_penilaian_kompetensi: idPenilaianKompetensi,
                id_penilaian_core_values: idPenilaianCoreValues,
                catatan: formData.get('catatan')
            };

            console.log('Data yang akan dikirim ke penilaian-kinerja:', penilaianKinerjaData);

            const finalResult = await makeApiCall('penilaian-kinerja', penilaianKinerjaData);
            return finalResult;

        } catch (error) {
            console.error('Error in submitPenilaian:', error);
            throw error;
        }
    }

    async function makeApiCall(endpoint, data) {
        try {
            console.log(`Sending data to ${endpoint}:`, data);
            
            const response = await fetch(`http://127.0.0.1:8000/api/${endpoint}`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });

            const responseData = await response.json();

            if (!response.ok) {
                console.error(`Error response from ${endpoint}:`, responseData);
                throw new Error(responseData.message || `Error in ${endpoint}`);
            }

            console.log(`Success response from ${endpoint}:`, responseData);
            return responseData;

        } catch (error) {
            console.error(`API error for ${endpoint}:`, error);
            throw error;
        }
    }

    document.getElementById('nextToKompetensi').addEventListener('click', () => {
        const kompetensiTab = document.getElementById('kompetensi-tab');
        bootstrap.Tab.getInstance(kompetensiTab).show();
    });

    document.getElementById('nextToCoreValues').addEventListener('click', () => {
        const coreValuesTab = document.getElementById('core-values-tab');
        bootstrap.Tab.getInstance(coreValuesTab).show();
    });

    document.getElementById('submitPenilaian').addEventListener('click', async function() {
        try {
            const form = document.getElementById('penilaianKinerjaForm');
            const formData = new FormData(form);

            const loadingSwal = Swal.fire({
                title: 'Menyimpan Penilaian',
                html: `
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" 
                             role="progressbar" 
                             style="width: 0%" 
                             id="submitProgress">0%</div>
                    </div>
                    <div id="submitStatus" class="mt-2">Mempersiapkan data...</div>
                `,
                allowOutsideClick: false,
                showConfirmButton: false
            });

            const updateProgress = (percent, status) => {
                document.getElementById('submitProgress').style.width = `${percent}%`;
                document.getElementById('submitProgress').textContent = `${percent}%`;
                document.getElementById('submitStatus').textContent = status;
            };

            updateProgress(25, 'Menyimpan data Core Values...');
            await submitPenilaian(formData);
            
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Penilaian kinerja berhasil disimpan',
                allowOutsideClick: false
            });

            window.location.href = '/penilaian_kinerja';

        } catch (error) {
            console.error('Form submission error:', error);
            
            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Terjadi kesalahan saat menyimpan penilaian',
                footer: 'Silakan coba lagi atau hubungi administrator'
            });
        }
    });

        // Handle back button click
    document.getElementById('btnBack').addEventListener('click', async function() {
        // Show SweetAlert2 confirmation dialog
        const result = await Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin kembali? Data yang belum disimpan akan hilang.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, kembali',
            cancelButtonText: 'Batal',
            allowOutsideClick: false
        });

        // If user confirms, redirect to index page
        if (result.isConfirmed) {
            window.location.href = '/penilaian_kinerja';
        }
    });

    fetchPegawaiDetails();
});
</script>
@endpush