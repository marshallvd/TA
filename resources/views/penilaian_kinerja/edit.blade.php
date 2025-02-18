@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Edit Penilaian Kinerja
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
                    <i class="bi bi-clipboard-check text-primary" style="font-size: 3rem;"></i>
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
                        <input type="hidden" id="id_penilaian_kinerja" name="id_penilaian_kinerja">
                        <input type="hidden" id="id_penilaian_kpi" name="id_penilaian_kpi">
                        <input type="hidden" id="id_penilaian_kompetensi" name="id_penilaian_kompetensi">
                        <input type="hidden" id="id_penilaian_core_values" name="id_penilaian_core_values">

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="formKPI">
                                <h5 class="mb-3">Edit Penilaian KPI</h5>
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
                                <h5 class="mb-3">Edit Penilaian Kompetensi</h5>
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
                                <h5 class="mb-3">Edit Penilaian Core Values</h5>
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
                                <button type="button" class="btn btn-success mt-3" id="updatePenilaian"><i class="bi bi-arrow-right-square me-2"></i>Update</button>
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
    const idPenilaianKinerja = pathSegments[pathSegments.length - 1];

    document.getElementById('id_penilaian_kinerja').value = idPenilaianKinerja;

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

    async function fetchData(endpoint) {
        try {
            const response = await fetch(`${API_BASE_URL}/${endpoint}`, {
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

    async function fetchPegawaiDetails(idPegawai) {
    try {
        // Fetch all required data in parallel
        const [pegawaiResponse, divisiResponse, jabatanResponse] = await Promise.all([
            fetchData(`pegawai/${idPegawai}`),
            fetchData('divisi'),
            fetchData('jabatan')
        ]);

        if (!pegawaiResponse.data) {
            throw new Error('Data pegawai tidak ditemukan');
        }

        const pegawai = pegawaiResponse.data;
        
        // Find matching divisi and jabatan
        const divisi = divisiResponse.find(d => d.id_divisi === pegawai.id_divisi);
        const jabatan = jabatanResponse.find(j => j.id_jabatan === pegawai.id_jabatan);

        // Update UI
        document.getElementById('pegawaiName').textContent = pegawai.nama_lengkap || '-';
        document.getElementById('pegawaiNIK').textContent = pegawai.nik || '-';
        document.getElementById('pegawaiDivision').textContent = divisi ? divisi.nama_divisi : '-';
        document.getElementById('pegawaiPosition').textContent = jabatan ? jabatan.nama_jabatan : '-';

        // Store divisi_pegawai
        if (pegawai.id_divisi) {
            document.getElementById('divisi_pegawai').value = pegawai.id_divisi;
        }

        // Return complete data object
        return {
            ...pegawai,
            divisi: {
                id_divisi: pegawai.id_divisi,
                nama_divisi: divisi ? divisi.nama_divisi : '-'
            },
            jabatan: {
                id_jabatan: pegawai.id_jabatan,
                nama_jabatan: jabatan ? jabatan.nama_jabatan : '-'
            }
        };

    } catch (error) {
        console.error('Error in fetchPegawaiDetails:', error);
        await Swal.fire({
            icon: 'error',
            title: 'Error',
            text: `Gagal mengambil data pegawai: ${error.message}`
        });

        return {
            nama_lengkap: '-',
            nik: '-',
            divisi: {
                id_divisi: null,
                nama_divisi: '-'
            },
            jabatan: {
                id_jabatan: null,
                nama_jabatan: '-'
            }
        };
    }
}

async function fetchData(endpoint) {
    try {
        const response = await fetch(`${API_BASE_URL}/${endpoint}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log(`Response from ${endpoint}:`, data);
        return data;
    } catch (error) {
        console.error(`Error fetching ${endpoint}:`, error);
        throw new Error(`Failed to fetch ${endpoint}: ${error.message}`);
    }
}

    async function fetchPenilaianDetails() {
    try {
        const penilaianResponse = await fetchData(`penilaian-kinerja/${idPenilaianKinerja}`);
        console.log('Penilaian Response:', penilaianResponse);
        
        if (!penilaianResponse.data) {
            throw new Error('Data penilaian tidak ditemukan');
        }

        const penilaian = penilaianResponse.data;
        
        // Fetch detailed employee data
        const pegawaiData = await fetchPegawaiDetails(penilaian.id_pegawai);
        
        // Update form fields
        document.getElementById('id_pegawai').value = penilaian.id_pegawai;
        document.getElementById('periode_penilaian').value = penilaian.periode_penilaian;
        document.getElementById('id_penilaian_kinerja').value = idPenilaianKinerja;
        document.getElementById('id_penilaian_kpi').value = penilaian.id_penilaian_kpi;
        document.getElementById('id_penilaian_kompetensi').value = penilaian.id_penilaian_kompetensi;
        document.getElementById('id_penilaian_core_values').value = penilaian.id_penilaian_core_values;
        document.getElementById('catatan').value = penilaian.catatan || '';

        // Update pegawai details
        if (pegawaiData) {
            document.getElementById('pegawaiName').textContent = pegawaiData.nama_lengkap || '-';
            document.getElementById('pegawaiNIK').textContent = pegawaiData.nik || '-';
            document.getElementById('pegawaiDivision').textContent = pegawaiData.divisi?.nama_divisi || '-';
            document.getElementById('pegawaiPosition').textContent = pegawaiData.jabatan?.nama_jabatan || '-';
            
            // Store divisi_pegawai if needed for other purposes
            if (pegawaiData.divisi?.id_divisi) {
                document.getElementById('divisi_pegawai').value = pegawaiData.divisi.id_divisi;
            }
        }

        // Load all components in parallel
        await Promise.all([
            // Load KPI details
            penilaian.id_penilaian_kpi ? 
                fetchData(`penilaian-kpi/${penilaian.id_penilaian_kpi}`).then(loadKPIItems) : 
                Promise.resolve(),
            
            // Load Kompetensi details
            penilaian.id_penilaian_kompetensi ? 
                fetchData(`penilaian-kompetensi/${penilaian.id_penilaian_kompetensi}`).then(loadKompetensiItems) : 
                Promise.resolve(),
            
            // Load Core Values details - Fixed this part
            penilaian.id_penilaian_core_values ? 
                fetchData(`penilaian-core-values/${penilaian.id_penilaian_core_values}`).then(response => {
                    console.log('Core Values API Response:', response);
                    return loadCoreValuesItems(response);
                }) : 
                Promise.resolve()
        ]);

    } catch (error) {
        console.error('Error in fetchPenilaianDetails:', error);
        await Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal mengambil data penilaian: ' + error.message
        });
    }
}


async function loadKPIItems(penilaianKPI) {
    try {
        const kpiContainer = document.getElementById('kpiItems');
        const details = penilaianKPI?.detail_penilaian_k_p_i || [];
        
        if (details.length === 0) {
            kpiContainer.innerHTML = '<p class="text-center">Tidak ada komponen KPI</p>';
            return;
        }

        let html = '';
        details.forEach(detail => {
            const komponen = detail.komponen_k_p_i || {};
            html += `
                <div class="mb-4 border-bottom pb-3">
                    <input type="hidden" name="id_komponen_kpi" value="${komponen.id_komponen_kpi}">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">${komponen.nama_indikator || 'Unnamed KPI'}</h6>
                        <span class="badge bg-primary">Bobot: ${komponen.bobot || '0'}%</span>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nilai</label>
                                <input type="number" 
                                    class="form-control" 
                                    name="kpi[${detail.id_detail_penilaian_kpi}]" 
                                    min="1" 
                                    max="5" 
                                    value="${detail.nilai || 1}" 
                                    onchange="validateNilaiInput(this)"
                                    required>
                                <div class="nilai-feedback small text-muted mt-1">
                                    Kategori: ${getNilaiCategory(detail.nilai || 1)}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted"><b>Target:</b> ${komponen.target || '-'}</small><br>
                            <small class="text-muted"><b>Ukuran:</b> ${komponen.ukuran || '-'}</small>
                        </div>
                    </div>
                </div>
            `;
        });

        kpiContainer.innerHTML = html;
        console.log('KPI items loaded:', details.length);
    } catch (error) {
        console.error('Error loading KPI items:', error);
        document.getElementById('kpiItems').innerHTML = 
            '<p class="text-center text-danger">Gagal memuat komponen KPI</p>';
    }
}

async function loadKompetensiItems(penilaianKompetensi) {
    try {
        const kompetensiContainer = document.getElementById('kompetensiItems');
        const details = penilaianKompetensi?.detail_penilaian_kompetensi || [];

        if (!Array.isArray(details) || details.length === 0) {
            kompetensiContainer.innerHTML = '<p class="text-center">Tidak ada komponen Kompetensi</p>';
            return;
        }

        let html = '';
        details.forEach(detail => {
            const komponen = detail.komponen_kompetensi || {};
            html += `
                <div class="mb-4 border-bottom pb-3">
                    <input type="hidden" name="id_komponen_kompetensi" value="${komponen.id_komponen_kompetensi}">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">${komponen.nama_kompetensi || 'Unnamed Kompetensi'}</h6>
                        <span class="badge bg-info">Bobot: ${komponen.bobot || '0'}%</span>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nilai</label>
                                <input type="number" 
                                    class="form-control" 
                                    name="kompetensi[${detail.id_detail_penilaian_kompetensi}]" 
                                    min="1" 
                                    max="5" 
                                    value="${detail.nilai || 1}" 
                                    onchange="validateNilaiInput(this)"
                                    required>
                                <div class="nilai-feedback small text-muted mt-1">
                                    Kategori: ${getNilaiCategory(detail.nilai || 1)}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted"><b>Perilaku Utama:</b></small><br>
                            <p class="small text-muted mb-3">${komponen.perilaku_utama || '-'}</p>
                        </div>
                    </div>
                </div>
            `;
        });

        kompetensiContainer.innerHTML = html;
        console.log('Kompetensi items loaded:', details.length);

    } catch (error) {
        console.error('Error loading Kompetensi items:', error);
        document.getElementById('kompetensiItems').innerHTML = 
            '<p class="text-center text-danger">Gagal memuat komponen Kompetensi</p>';
    }
}

async function loadCoreValuesItems(response) {
    try {
        console.log('Loading Core Values with data:', response);
        const coreValuesContainer = document.getElementById('coreValuesItems');
        
        // Make sure we're accessing the data property correctly
        const penilaianCoreValues = response.data || {};
        const details = penilaianCoreValues.detail_penilaian_core_values || [];

        if (!Array.isArray(details) || details.length === 0) {
            console.log('No Core Values details found');
            coreValuesContainer.innerHTML = '<p class="text-center">Tidak ada komponen Core Values</p>';
            return;
        }

        let html = '';
    details.forEach(detail => {
        const komponen = detail.komponen_core_values || {};
        html += `
        <div class="mb-4 border-bottom pb-3">
            <input type="hidden" name="id_komponen_core_values" value="${komponen.id_komponen_core_values}">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">${komponen.nama_core_values || 'Unnamed Core Value'}</h6>
                <span class="badge bg-success">Bobot: ${komponen.bobot || '0'}%</span>
            </div>
            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nilai</label>
                        <input type="number" 
                            class="form-control" 
                            name="core_values[${detail.id_detail_penilaian_core}]" 
                            min="1" 
                            max="5" 
                            value="${detail.nilai || 1}" 
                            onchange="validateNilaiInput(this)"
                            required>
                        <div class="nilai-feedback small text-muted mt-1">
                            Kategori: ${getNilaiCategory(detail.nilai || 1)}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <small class="text-muted"><b>Perilaku Utama:</b></small><br>
                    <p class="small text-muted mb-3">${komponen.perilaku_utama || '-'}</p>
                </div>
            </div>
        </div>
        `;
    });

        coreValuesContainer.innerHTML = html;
        console.log('Core Values items loaded:', details.length);
    } catch (error) {
        console.error('Error loading Core Values items:', error);
        document.getElementById('coreValuesItems').innerHTML = 
            '<p class="text-center text-danger">Gagal memuat komponen Core Values</p>';
    }
}



    window.validateNilaiInput = function(input) {
        const value = parseFloat(input.value);
        if (value < 1) input.value = 1;
        if (value > 5) input.value = 5;
        const feedbackElement = input.nextElementSibling;
        feedbackElement.textContent = `Kategori: ${getNilaiCategory(parseFloat(input.value))}`;
    };

    
    document.getElementById('nextToKompetensi').addEventListener('click', function() {
        document.getElementById('kompetensi-tab').click();
    });

    document.getElementById('nextToCoreValues').addEventListener('click', function() {
        document.getElementById('core-values-tab').click();
    });

    async function updatePenilaian(formData) {
    try {
        const preparedData = {
            coreValues: [],
            kompetensi: [],
            kpi: []
        };

        for (let [key, value] of formData.entries()) {
            if (key.startsWith('core_values[')) {
                const id = key.match(/\[(.*?)\]/)[1];
                const idKomponenCoreValues = await getIdKomponenCoreValues(id);
                
                if (idKomponenCoreValues !== null) {
                    preparedData.coreValues.push({
                        id_komponen_core_values: idKomponenCoreValues,
                        id_detail_penilaian_core: parseInt(id),
                        nilai: parseFloat(value)
                    });
                } else {
                    console.error(`ID komponen core values untuk detail ${id} tidak ditemukan.`);
                }
            } else if (key.startsWith('kompetensi[')) {
                const id = key.match(/\[(.*?)\]/)[1];
                const idKomponenKompetensi = await getIdKomponenKompetensi(id);
                preparedData.kompetensi.push({
                    id_komponen_kompetensi: idKomponenKompetensi,
                    id_detail_penilaian_kompetensi: parseInt(id),
                    nilai: parseFloat(value)
                });
            } else if (key.startsWith('kpi[')) {
                const id = key.match(/\[(.*?)\]/)[1];
                const idKomponenKPI = await getIdKomponenKPI(id);
                preparedData.kpi.push({
                    id_komponen_kpi: idKomponenKPI,
                    id_detail_penilaian_kpi: parseInt(id),
                    nilai: parseFloat(value)
                });
            }
        }

        // Update Core Values
        if (preparedData.coreValues.length > 0) {
            console.log('Updating Core Values...', preparedData.coreValues);
            await makeApiCall(`penilaian-core-values/${formData.get('id_penilaian_core_values')}/update-details`, 
                { details: preparedData.coreValues }, 'PUT');
        } else {
            console.error('Tidak ada data core values yang perlu diperbarui.');
        }

        // Update Kompetensi
        if (preparedData.kompetensi.length > 0) {
            console.log('Updating Kompetensi...', preparedData.kompetensi);
            await makeApiCall(`penilaian-kompetensi/${formData.get('id_penilaian_kompetensi')}/update-details`, 
                { details: preparedData.kompetensi }, 'PUT');
        } else {
            console.error('Tidak ada data kompetensi yang perlu diperbarui.');
        }

        // Update KPI
        if (preparedData.kpi.length > 0) {
            console.log('Updating KPI...', preparedData.kpi);
            await makeApiCall(`penilaian-kpi/${formData.get('id_penilaian_kpi')}/update-details`, 
                { details: preparedData.kpi }, 'PUT');
        } else {
            console.error('Tidak ada data KPI yang perlu diperbarui.');
        }

        // Update Penilaian Kinerja
        await makeApiCall(`penilaian-kinerja/${formData.get('id_penilaian_kinerja')}`, {
            id_penilaian_kpi: formData.get('id_penilaian_kpi'),
            id_penilaian_kompetensi: formData.get('id_penilaian_kompetensi'),
            id_penilaian_core_values: formData.get('id_penilaian_core_values'),
            catatan: formData.get('catatan')
        }, 'PUT');

    } catch (error) {
        console.error('Error in updatePenilaian:', error);
        throw new Error(`Gagal mengupdate penilaian: ${error.message}`);
    }
}

// Fungsi untuk mendapatkan id_komponen_core_values
async function getIdKomponenCoreValues(detailId) {
    const coreValuesContainer = document.getElementById('coreValuesItems');
    const detailElements = coreValuesContainer.querySelectorAll('input[name^="core_values["]');
    
    for (let input of detailElements) {
        const match = input.name.match(/\[(.*?)\]/);
        if (match && match[1] === detailId) {
            const parentDiv = input.closest('.mb-4');
            const idKomponenInput = parentDiv.querySelector('input[name="id_komponen_core_values"]');
            if (idKomponenInput) {
                return parseInt(idKomponenInput.value);
            } else {
                console.error(`ID komponen untuk detail ID ${detailId} tidak ditemukan di elemen:`, parentDiv);
            }
        }
    }
    return null; // Jika tidak ditemukan
}

// Fungsi untuk mendapatkan id_komponen_kompetensi
async function getIdKomponenKompetensi(detailId) {
    const kompetensiContainer = document.getElementById('kompetensiItems');
    const detailElements = kompetensiContainer.querySelectorAll('input[name^="kompetensi["]');
    
    for (let input of detailElements) {
        const match = input.name.match(/\[(.*?)\]/);
        if (match && match[1] === detailId) {
            const parentDiv = input.closest('.mb-4');
            const idKomponenInput = parentDiv.querySelector('input[name^="id_komponen_kompetensi"]');
            return idKomponenInput ? parseInt(idKomponenInput.value) : null;
        }
    }
    return null; // Jika tidak ditemukan
}

// Fungsi untuk mendapatkan id_komponen_kpi
async function getIdKomponenKPI(detailId) {
    const kpiContainer = document.getElementById('kpiItems');
    const detailElements = kpiContainer.querySelectorAll('input[name^="kpi["]');
    
    for (let input of detailElements) {
        const match = input.name.match(/\[(.*?)\]/);
        if (match && match [1] === detailId) {
            const parentDiv = input.closest('.mb-4');
            const idKomponenInput = parentDiv.querySelector('input[name^="id_komponen_kpi"]');
            return idKomponenInput ? parseInt(idKomponenInput.value) : null;
        }
    }
    return null; // Jika tidak ditemukan
}


async function makeApiCall(endpoint, data, method = 'POST') {
    try {
        console.log(`Making ${method} request to ${endpoint}:`, data);
        
        const response = await fetch(`${API_BASE_URL}/${endpoint}`, {
            method: method,
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const responseData = await response.json();
        console.log(`Response from ${endpoint}:`, responseData);

        if (!response.ok) {
            throw new Error(responseData.message || `Error ${response.status} in ${endpoint}`);
        }

        return responseData;
    } catch (error) {
        console.error(`API error for ${endpoint}:`, error);
        throw new Error(`Failed API call to ${endpoint}: ${error.message}`);
    }
}

// Update the click handler for the update button
document.getElementById('updatePenilaian').addEventListener('click', async function() {
    try {
        // Disable the button to prevent double submission
        this.disabled = true;
        
        const form = document.getElementById('penilaianKinerjaForm');
        const formData = new FormData(form);

        // Show loading dialog
        const loadingSwal = Swal.fire({
            title: 'Mengupdate Penilaian',
            html: `
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" 
                         role="progressbar" 
                         style="width: 25%" 
                         id="updateProgress">25%</div>
                </div>
                <div id="updateStatus" class="mt-2">Memproses data...</div>
            `,
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Perform the update
        await updatePenilaian(formData);

        // Show success message
        await Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Penilaian kinerja berhasil diupdate',
            allowOutsideClick: false
        });

        // Redirect to list page
        window.location.href = '/penilaian_kinerja';

    } catch (error) {
        console.error('Update failed:', error);
        
        // Re-enable the button
        this.disabled = false;
        
        // Show error message
        await Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message || 'Terjadi kesalahan saat mengupdate penilaian',
            footer: 'Silakan coba lagi atau hubungi administrator'
        });
    }
});

    // Initialize the page by fetching initial data
    fetchPenilaianDetails().catch(error => {
        console.error('Initial load error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal memuat data awal: ' + error.message,
            footer: 'Silakan refresh halaman atau hubungi administrator'
        });
    });
});


</script>
@endpush
