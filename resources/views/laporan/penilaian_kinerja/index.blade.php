@extends('layouts.master')

@section('title') 
Laporan Penilaian Kinerja 
@endsection

@section('css')
<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            {{-- Header Card --}}
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <b><h2 class="card-title mb-1">Laporan Penilaian Kinerja</h2></b>
                            <p class="card-text text-muted">Human Resource Management System SEB</p>
                        </div>
                        <div>
                            <i class="bi bi-clipboard-check text-primary" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                </div>
            </div>  

            <!-- Widget Section -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="text-muted text-uppercase small">Total Penilaian</span>
                                </div>
                                <div>
                                    <i class="bi bi-info-circle text-primary"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="border rounded p-3 bg-soft-primary me-3">
                                        <i class="bi bi-list-check text-primary"></i>
                                    </div>
                                    <h2 id="totalPenilaianCount" class="counter mb-0">0/0</h2>
                                </div>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="totalPenilaian">
                                    <i class="bi bi-bar-chart-line me-1"></i>Grafik
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="text-muted text-uppercase small">Predikat Penilaian</span>
                                </div>
                                <div>
                                    <i class="bi bi-info-circle text-success"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="border rounded p-3 bg-soft-success me-3">
                                        <i class="bi bi-pie-chart text-success"></i>
                                    </div>
                                    <div id="predikatSummary">
                                        <!-- Predikat akan diisi dinamis -->
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="predikatPenilaian">
                                    <i class="bi bi-graph-up me-1"></i>Grafik
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="text-muted text-uppercase small">Penilaian per Divisi</span>
                                </div>
                                <div>
                                    <i class="bi bi-info-circle text-info"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="border rounded p-3 bg-soft-info me-3">
                                        <i class="bi bi-building text-info"></i>
                                    </div>
                                    <h2 id="divisiTertinggiNilai" class="mb-0">-</h2>
                                </div>
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="penilaianPerDivisi">
                                    <i class="bi bi-bar-chart me-1"></i>Grafik
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="text-muted text-uppercase small">Penilaian per Jabatan</span>
                                </div>
                                <div>
                                    <i class="bi bi-info-circle text-warning"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="border rounded p-3 bg-soft-warning me-3">
                                        <i class="bi bi-person-badge text-warning"></i>
                                    </div>
                                    <h2 id="jabatanTertinggiNilai" class="mb-0">-</h2>
                                </div>
                                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="penilaianPerJabatan">
                                    <i class="bi bi-graph-up me-1"></i>Grafik
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Chart -->
            <div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="chartModalLabel">
                                <i class="bi bi-graph-up me-2"></i>Grafik
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <canvas id="chartCanvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="header-title">
                        <h4 class="card-title">Data Penilaian Kinerja</h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="dropdown me-2">
                            <button class="btn btn-success dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-file-earmark-arrow-up me-2"></i>Ekspor
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                                <li>
                                    <a class="dropdown-item" href="#" id="exportPdfBtn">
                                        <i class="bi bi-file-pdf text-danger me-2"></i>Cetak PDF
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" id="exportExcelBtn">
                                        <i class="bi bi-file-excel text-success me-2"></i>Ekspor Excel
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" id="exportCsvBtn">
                                        <i class="bi bi-filetype-csv text-info me-2"></i>Ekspor CSV
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <button class="btn btn-warning" id="copyTableBtn">
                            <i class="bi bi-clipboard me-2"></i>Salin
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Enhanced Filtering Section -->
                    <div class="row mb-4">
                        <div class="col-md-2">
                            <label for="yearFilter">
                                <i class="bi bi-calendar-year me-1"></i>Filter Tahun:
                            </label>
                            <select id="yearFilter" class="form-control">
                                <option value="">Semua Tahun</option>
                                <!-- Years will be populated dynamically -->
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="monthYearFilter">
                                <i class="bi bi-calendar-month me-1"></i>Filter Bulan & Tahun:
                            </label>
                            <input type="month" id="monthYearFilter" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="predikatFilter">
                                <i class="bi bi-filter-square me-1"></i>Filter Predikat:
                            </label>
                            <select id="predikatFilter" class="form-control">
                                <option value="">Semua Predikat</option>
                                <option value="sangat baik">Sangat Baik</option>
                                <option value="baik">Baik</option>
                                <option value="cukup">Cukup</option>
                                <option value="kurang">Kurang</option>
                                <option value="sangat kurang">Sangat Kurang</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="divisiFilter">
                                <i class="bi bi-building me-1"></i>Filter Divisi:
                            </label>
                            <select id="divisiFilter" class="form-control">
                                <option value="">Semua Divisi</option>
                                <!-- Divisi will be populated dynamically -->
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="jabatanFilter">
                                <i class="bi bi-person-badge me-1"></i>Filter Jabatan:
                            </label>
                            <select id="jabatanFilter" class="form-control">
                                <option value="">Semua Jabatan</option>
                                <!-- Jabatan will be populated dynamically -->
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button id="applyFilterBtn" class="btn btn-primary me-2">
                                <i class="bi bi-funnel me-1"></i>Filter
                            </button>
                            <button id="resetFilterBtn" class="btn btn-secondary">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="penilaian-kinerja-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-hash me-1"></i>No</th>
                                    <th><i class="bi bi-person me-1"></i>Nama Pegawai</th>
                                    <th><i class="bi bi-calendar-event me-1"></i>Periode Penilaian</th>
                                    <th><i class="bi bi-graph-up me-1"></i>Nilai KPI</th>
                                    <th><i class="bi bi-card-checklist me-1"></i>Nilai Kompetensi</th>
                                    <th><i class="bi bi-heart me-1"></i>Nilai Core Values</th>
                                    <th><i class="bi bi-star me-1"></i>Nilai Akhir</th>
                                    <th><i class="bi bi-award me-1"></i>Predikat</th>
                                    <th><i class="bi bi-building me-1"></i>Divisi</th>
                                    <th><i class="bi bi-person-badge me-1"></i>Jabatan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    console.log('Token:', token); // Debug token

    // Fungsi Fetch Data dengan Debugging Lebih Detail
    async function fetchData(endpoint) {
        try {
            if (!token) {
                console.error('Tidak ada token');
                showErrorAlert('Anda belum login. Silakan login terlebih dahulu.');
                return [];
            }

            const fullUrl = `${API_BASE_URL}/${endpoint}`;
            
            console.log(`Fetching data from: ${fullUrl}`); // Debug URL

            const response = await fetch(fullUrl, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                }
            });

            console.log('Response status:', response.status); // Debug status

            if (!response.ok) {
                const errorText = await response.text();
                console.error(`HTTP error! status: ${response.status}`, errorText);
                showErrorAlert(`Gagal mengambil data: ${response.status} - ${errorText}`);
                return [];
            }

            const data = await response.json();
            console.log(`Data from ${endpoint}:`, data); // Debug data

            return data.data || data;
        } catch (error) {
            console.error(`Fetch error for ${endpoint}:`, error);
            showErrorAlert(`Terjadi kesalahan saat memuat data ${endpoint}: ` + error.message);
            return [];
        }
    }

    // Fungsi Ambil Nama Jabatan
    function getNamaJabatan(jabatanData, idJabatan) {
        const jabatan = jabatanData.find(j => j.id_jabatan === idJabatan);
        return jabatan ? jabatan.nama_jabatan : 'Tidak diketahui';
    }

    // Fungsi Ambil Nama Divisi
    function getNamaDivisi(divisiData, idDivisi) {
        const divisi = divisiData.find(d => d.id_divisi === idDivisi);
        return divisi ? divisi.nama_divisi : 'Tidak diketahui';
    }

    // Inisialisasi DataTable
    const penilaianTable = $('#penilaian-kinerja-table').DataTable({
        processing: true,
        pageLength: 10,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            ['10 Baris', '25 Baris', '50 Baris', '100 Baris', 'Semua Data']
        ],
        language: {
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            zeroRecords: "Tidak ada data yang ditemukan",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data tersedia",
            infoFiltered: "(disaring dari _MAX_ total data)",
            search: "Cari:",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            }
        },
        columns: [
            { 
                data: null, 
                render: function(data, type, row, meta) {
                    return meta.row + 1; // Nomor urut
                }
            },
            { 
                data: 'pegawai',
                render: function(data) {
                    return data ? data.nama_lengkap : 'Tidak diketahui';
                }
            },
            { 
                data: 'periode_penilaian',
                render: function(data) {
                    return data || '-';
                }
            },
            { 
                data: 'penilaian_k_p_i',
                render: function(data) {
                    return data ? Number(data.nilai_rata_rata).toFixed(2) : '-';
                }
            },
            { 
                data: 'penilaian_kompetensi',
                render: function(data) {
                    return data ? Number(data.nilai_rata_rata).toFixed(2) : '-';
                }
            },
            { 
                data: 'penilaian_core_values',
                render: function(data) {
                    return data ? Number(data.nilai_rata_rata).toFixed(2) : '-';
                }
            },
            { 
                data: 'nilai_akhir',
                render: function(data) {
                    return data ? Number(data).toFixed(2) : '-';
                }
            },
            { 
                data: 'predikat',
                render: function(data) {
                    const predikatClasses = {
                        'sangat baik': 'badge bg-success',     // Hijau (Sangat Baik)
                        'baik': 'badge bg-primary',            // Biru (Baik)
                        'cukup': 'badge bg-warning',           // Kuning (Cukup)
                        'kurang': 'badge bg-danger',           // Merah (Kurang)
                        'sangat kurang': 'badge bg-secondary'  // Abu-abu (Sangat Kurang)
                    };
                    return `<span class="${predikatClasses[data.toLowerCase()] || 'badge bg-light text-dark'}">${data || '-'}</span>`;
                }
            },
            { 
                data: 'pegawai',
                render: function(data) {
                    return data && data.id_divisi ? 
                        getNamaDivisi(divisiData, data.id_divisi) : 
                        'Tidak diketahui';
                }
            },
            { 
                data: 'pegawai',
                render: function(data) {
                    return data && data.id_jabatan ? 
                        getNamaJabatan(jabatanData, data.id_jabatan) : 
                        'Tidak diketahui';
                }
            }
        ]
    });

 // Fungsi untuk memuat data divisi ke dropdown
 function populateDivisiDropdown() {
        const divisiSelect = $('#divisiFilter');
        divisiSelect.empty().append('<option value="">Semua Divisi</option>');
        
        if (divisiData && divisiData.length > 0) {
            divisiData.forEach(divisi => {
                divisiSelect.append(
                    `<option value="${divisi.id_divisi}">${divisi.nama_divisi}</option>`
                );
            });
        }
    }

    // Fungsi untuk memuat data jabatan ke dropdown berdasarkan divisi
    function populateJabatanDropdown(selectedDivisiId = '') {
        const jabatanSelect = $('#jabatanFilter');
        jabatanSelect.empty().append('<option value="">Semua Jabatan</option>');
        
        let filteredJabatan = jabatanData;
        if (selectedDivisiId) {
            filteredJabatan = jabatanData.filter(jabatan => jabatan.id_divisi === selectedDivisiId);
        }
        
        if (filteredJabatan && filteredJabatan.length > 0) {
            filteredJabatan.forEach(jabatan => {
                jabatanSelect.append(
                    `<option value="${jabatan.id_jabatan}">${jabatan.nama_jabatan}</option>`
                );
            });
        }
    }

    // Event listener untuk perubahan divisi
    $('#divisiFilter').on('change', function() {
        const selectedDivisiId = $(this).val();
        populateJabatanDropdown(selectedDivisiId);
    });

    // Fungsi untuk menerapkan filter
    function applyFilters() {
        const yearFilter = $('#yearFilter').val();
        const monthYearFilter = $('#monthYearFilter').val();
        const predikatFilter = $('#predikatFilter').val();
        const divisiFilter = $('#divisiFilter').val();
        const jabatanFilter = $('#jabatanFilter').val();

        // Reset existing search
        penilaianTable.search('').columns().search('').draw();

        // Custom filtering function
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            const rowData = penilaianData[dataIndex];
            let match = true;

            // Year filter
            if (yearFilter) {
                const penilaianYear = new Date(rowData.periode_penilaian).getFullYear().toString();
                match = match && penilaianYear === yearFilter;
            }

            // Month-Year filter
            if (monthYearFilter) {
                const penilaianDate = rowData.periode_penilaian.substring(0, 7);
                match = match && penilaianDate === monthYearFilter;
            }

            // Predikat filter
            if (predikatFilter) {
                match = match && rowData.predikat.toLowerCase() === predikatFilter.toLowerCase();
            }

            // Divisi filter
            if (divisiFilter) {
                match = match && rowData.pegawai.id_divisi.toString() === divisiFilter;
            }

            // Jabatan filter
            if (jabatanFilter) {
                match = match && rowData.pegawai.id_jabatan.toString() === jabatanFilter;
            }

            return match;
        });

        penilaianTable.draw();

        // Remove custom filter
        $.fn.dataTable.ext.search.pop();
    }

    // Event listener untuk tombol apply filter
    $('#applyFilterBtn').on('click', applyFilters);

    // Fungsi untuk reset filter
    function resetFilters() {
        $('#yearFilter, #monthYearFilter, #predikatFilter').val('');
        $('#divisiFilter').val('').trigger('change');
        $('#jabatanFilter').val('');
        
        // Clear all filters
        $.fn.dataTable.ext.search = [];
        penilaianTable.search('').columns().search('').draw();
    }

    // Event listener untuk tombol reset
    $('#resetFilterBtn').on('click', resetFilters);

    // Fungsi Utama Memuat Data
    function initializePage() {
        Promise.all([
            fetchData('penilaian-kinerja'), 
            fetchData('pegawai'), 
            fetchData('divisi'), 
            fetchData('jabatan')
        ]).then(([
            fetchedPenilaianData, 
            fetchedPegawaiData, 
            fetchedDivisiData, 
            fetchedJabatanData
        ]) => {
            console.log('Fetched Penilaian Data Length:', fetchedPenilaianData.length);
            console.log('Fetched Pegawai Data Length:', fetchedPegawaiData.length);
            console.log('Fetched Divisi Data Length:', fetchedDivisiData.length);
            console.log('Fetched Jabatan Data Length:', fetchedJabatanData.length);

            penilaianData = fetchedPenilaianData;
            pegawaiData = fetchedPegawaiData;
            divisiData = fetchedDivisiData;
            jabatanData = fetchedJabatanData;

            // Populate Year Filter Dropdown
            const uniqueYears = [...new Set(fetchedPenilaianData.map(item => 
                new Date(item.periode_penilaian).getFullYear()
            ))].sort();
            const yearSelect = $('#yearFilter');
            uniqueYears.forEach(year => {
                yearSelect.append(`<option value="${year}">${year}</option>`);
            });


            populateDivisiDropdown();
            populateJabatanDropdown();
            // Update widget counts
           // Calculate total penilaian per periode
            const currentPeriodPenilaianCount = fetchedPenilaianData.filter(penilaian => {
                // Assuming periode_penilaian is in format YYYY-MM
                const currentPeriod = new Date().toISOString().slice(0, 7); // Get current year-month
                return penilaian.periode_penilaian.startsWith(currentPeriod);
            }).length;
            $('#totalPenilaianCount').text(`${currentPeriodPenilaianCount}/${fetchedPegawaiData.length}`);


        // Predikat Penilaian - perbaikan
        const predikatCounts = fetchedPenilaianData.reduce((acc, curr) => {
            // Pastikan predikat tidak null/undefined
            const predikat = (curr.predikat || 'Tidak diketahui').toLowerCase();
            acc[predikat] = (acc[predikat] || 0) + 1;
            return acc;
        }, {});

        console.log('Predikat Counts:', predikatCounts);

        // Perbaikan rendering predikat
        $('#predikatSummary').html(`
            <span class="badge bg-success me-1" title="Sangat Baik: ${predikatCounts['sangat baik'] || 0}">
                <i class="bi bi-star-fill"></i> ${predikatCounts['sangat baik'] || 0}
            </span>
            <span class="badge bg-primary me-1" title="Baik: ${predikatCounts['baik'] || 0}">
                <i class="bi bi-star-fill"></i> ${predikatCounts['baik'] || 0}
            </span>
            <span class="badge bg-warning me-1" title="Cukup: ${predikatCounts['cukup'] || 0}">
                <i class="bi bi-star-fill"></i> ${predikatCounts['cukup'] || 0}
            </span>
            <span class="badge bg-danger me-1" title="Kurang: ${predikatCounts['kurang'] || 0}">
                <i class="bi bi-star-fill"></i> ${predikatCounts['kurang'] || 0}
            </span>
            <span class="badge bg-secondary" title="Sangat Kurang: ${predikatCounts['sangat kurang'] || 0}">
                <i class="bi bi-star-fill"></i> ${predikatCounts['sangat kurang'] || 0}
            </span>
        `);

        // Penilaian per Divisi - perbaikan
        const divisiAverage = fetchedPenilaianData.reduce((acc, curr) => {
            // Tambahkan pengecekan null/undefined
            if (curr.pegawai && curr.pegawai.id_divisi && curr.nilai_akhir) {
                const divisiId = curr.pegawai.id_divisi;
                acc[divisiId] = acc[divisiId] || { total: 0, count: 0 };
                acc[divisiId].total += Number(curr.nilai_akhir);
                acc[divisiId].count += 1;
            }
            return acc;
        }, {});

        const divisiAverages = Object.entries(divisiAverage).map(([id, { total, count }]) => ({
            divisiId: id,
            average: count > 0 ? total / count : 0
        }));

        console.log('Divisi Averages:', divisiAverages);

        const highestDivisi = divisiAverages.length > 0 
            ? divisiAverages.reduce((prev, curr) => (prev.average > curr.average) ? prev : curr, { average: 0 })
            : { average: 0 };
        
        $('#divisiTertinggiNilai').text(highestDivisi.average.toFixed(2));

        // Penilaian per Jabatan - perbaikan serupa
        const jabatanAverage = fetchedPenilaianData.reduce((acc, curr) => {
            // Tambahkan pengecekan null/undefined
            if (curr.pegawai && curr.pegawai.id_jabatan && curr.nilai_akhir) {
                const jabatanId = curr.pegawai.id_jabatan;
                acc[jabatanId] = acc[jabatanId] || { total: 0, count: 0 };
                acc[jabatanId].total += Number(curr.nilai_akhir);
                acc[jabatanId].count += 1;
            }
            return acc;
        }, {});

        const jabatanAverages = Object.entries(jabatanAverage).map(([id, { total, count }]) => ({
            jabatanId: id,
            average: count > 0 ? total / count : 0
        }));

        console.log('Jabatan Averages:', jabatanAverages);

        const highestJabatan = jabatanAverages.length > 0
            ? jabatanAverages.reduce((prev, curr) => (prev.average > curr.average) ? prev : curr, { average: 0 })
            : { average: 0 };
        
        $('#jabatanTertinggiNilai').text(highestJabatan.average.toFixed(2));

            penilaianTable.clear().rows.add(fetchedPenilaianData).draw();
        }).catch(error => {
            console.error('Error initializing page:', error);
            showErrorAlert('Gagal memuat data. Silakan coba lagi.');
        });
    }

    // Pastikan token valid sebelum memuat halaman
    function checkTokenValidity() {
        if (!token) {
            showErrorAlert('Sesi Anda telah berakhir. Silakan login kembali.');
            window.location.href = '/login';
            return false;
        }
        return true;
    }

    // Panggil fungsi inisialisasi hanya jika token valid
    if (checkTokenValidity()) {
        initializePage();
    }

    // Chart Configuration Function
    function configureChartModal(chartType) {
        // Clear previous chart if exists
        if (window.existingChart) {
            window.existingChart.destroy();
        }

        const ctx = document.getElementById('chartCanvas').getContext('2d');
        let chartConfig;

        switch(chartType) {
            case 'totalPenilaian':
                chartConfig = configureTotalPenilaianChart();
                break;
            case 'predikatPenilaian':
                chartConfig = configurePredikatPenilaianChart();
                break;
            case 'penilaianPerDivisi':
                chartConfig = configurePenilaianPerDivisiChart();
                break;
            case 'penilaianPerJabatan':
                chartConfig = configurePenilaianPerJabatanChart();
                break;
            default:
                console.error('Invalid chart type');
                return;
        }

        window.existingChart = new Chart(ctx, chartConfig);
    }

    // Total Penilaian Chart
    function configureTotalPenilaianChart() {
        const employeePenilaianCounts = penilaianData.reduce((acc, curr) => {
            const pegawai = pegawaiData.find(p => p.id_pegawai === curr.pegawai.id_pegawai);
            const employeeName = pegawai ? pegawai.nama_lengkap : 'Unknown';
            acc[employeeName] = (acc[employeeName] || 0) + 1;
            return acc;
        }, {});

        return {
            type: 'bar',
            data: {
                labels: Object.keys(employeePenilaianCounts),
                datasets: [{
                    label: 'Total Penilaian per Pegawai',
                    data: Object.values(employeePenilaianCounts),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Total Penilaian per Pegawai'
                    },
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Penilaian'
                        }
                    }
                }
            }
        };
    }

    // Predikat Penilaian Chart
    function configurePredikatPenilaianChart() {
        const predikatCounts = penilaianData.reduce((acc, curr) => {
            const predikat = curr.predikat.toLowerCase();
            acc[predikat] = (acc[predikat] || 0) + 1;
            return acc;
        }, {});

        return {
            type: 'pie',
            data: {
                labels: Object.keys(predikatCounts).map(predikat => 
                    predikat.charAt(0).toUpperCase() + predikat.slice(1)
                ),
                datasets: [{
                    data: Object.values(predikatCounts),
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',  // Sangat Baik (Green)
                        'rgba(54, 162, 235, 0.6)',  // Baik (Blue)
                        'rgba(255, 206, 86, 0.6)',  // Cukup (Yellow)
                        'rgba(255, 99, 132, 0.6)',   // Kurang (Red)
                        'rgba(153, 102, 255, 0.6)'   // Sangat Kurang (Purple)
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Predikat Penilaian'
                    },
                    legend: { 
                        display: true,
                        position: 'bottom' 
                    }
                }
            }
        };
    }

    // Penilaian per Divisi Chart
    function configurePenilaianPerDivisiChart() {
        const divisiPenilaianCounts = penilaianData.reduce((acc, curr) => {
            const divisiId = curr.pegawai.id_divisi;
            acc[divisiId] = acc[divisiId] || { total: 0, count: 0 };
            acc[divisiId].total += curr.nilai_akhir || 0;
            acc[divisiId].count += 1;
            return acc;
        }, {});

        return {
            type: 'bar',
            data: {
                labels: Object.keys(divisiPenilaianCounts),
                datasets: [{
                    label: 'Rata-rata Penilaian per Divisi',
                    data: Object.values(divisiPenilaianCounts).map(item => item.total / item.count),
                    backgroundColor: 'rgba(153, 102, 255, 0.6)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Rata-rata Penilaian per Divisi'
                    },
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Rata-rata Nilai'
                        }
                    }
                }
            }
        };
    }

    // Penilaian per Jabatan Chart
    function configurePenilaianPerJabatanChart() {
        const jabatanPenilaianCounts = penilaianData.reduce((acc, curr) => {
            const jabatanId = curr.pegawai.id_jabatan;
            acc[jabatanId] = acc[jabatanId] || { total: 0, count: 0 };
            acc[jabatanId].total += curr.nilai_akhir || 0;
            acc[jabatanId].count += 1;
            return acc;
        }, {});

        return {
            type: 'bar',
            data: {
                labels: Object.keys(jabatanPenilaianCounts),
                datasets: [{
                    label: 'Rata-rata Penilaian per Jabatan',
                    data: Object.values(jabatanPenilaianCounts).map(item => item.total / item.count),
                    backgroundColor: 'rgba(255, 159, 64, 0.6)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Rata-rata Penilaian per Jabatan'
                    },
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Rata-rata Nilai'
                        }
                    }
                }
            }
        };
    }

    // Event Listener for Chart Modal
    $(document).ready(function() {
        $('#chartModal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            const chartType = button.data('chart-type');
            
            // Pastikan Chart.js tersedia dan data sudah dimuat
            if (typeof Chart !== 'undefined' && penilaianData && penilaianData.length > 0) {
                configureChartModal(chartType);
            } else {
                console.error('Chart.js not loaded or data not available');
            }
        });
    });
});



async function exportToPDF() {
    try {
        // Show loading notification
        Swal.fire({
            title: 'Mengekspor PDF...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Function to load script and wait for it
        const loadScript = async (url) => {
            return new Promise((resolve, reject) => {
                const script = document.createElement('script');
                script.src = url;
                script.onload = resolve;
                script.onerror = reject;
                document.head.appendChild(script);
            });
        };

        // Load required scripts if not already loaded
        if (typeof window.jspdf === 'undefined') {
            await loadScript('https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js');
        }
        
        // Ensure jsPDF is loaded
        if (typeof window.jspdf === 'undefined') {
            throw new Error('jsPDF could not be loaded');
        }

        // Create new document
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({
            orientation: 'landscape',
            unit: 'mm',
            format: 'a4'
        });

        // Load autoTable if not already loaded
        if (typeof doc.autoTable === 'undefined') {
            await loadScript('https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js');
            // Small delay to ensure plugin is initialized
            await new Promise(resolve => setTimeout(resolve, 100));
        }

        // Check again if autoTable is available
        if (typeof doc.autoTable !== 'function') {
            throw new Error('AutoTable plugin could not be loaded');
        }

        // Add title
        doc.setFontSize(14);
        doc.text("Laporan Penilaian Kinerja", 15, 15);

        // Get table data
        const tableElement = document.getElementById('penilaian-kinerja-table');
        if (!tableElement) {
            throw new Error('Table element not found');
        }

        // Extract table data
        const rows = Array.from(tableElement.querySelectorAll('tr'));
        const tableData = rows.map(row => 
            Array.from(row.querySelectorAll('th, td')).map(cell => {
                // Handle badge elements
                const badge = cell.querySelector('.badge');
                return badge ? badge.textContent.trim() : cell.textContent.trim();
            })
        );

        // Generate PDF table
        await doc.autoTable({
            head: [tableData[0]],
            body: tableData.slice(1),
            startY: 25,
            theme: 'grid',
            styles: {
                fontSize: 8,
                cellPadding: 2
            },
            headStyles: {
                fillColor: [41, 128, 185],
                textColor: 255
            },
            columnStyles: {
                0: { cellWidth: 15 },  // No
                1: { cellWidth: 35 },  // Nama
                2: { cellWidth: 25 },  // Periode
                3: { cellWidth: 20 },  // KPI
                4: { cellWidth: 20 },  // Kompetensi
                5: { cellWidth: 20 },  // Core Values
                6: { cellWidth: 20 },  // Nilai Akhir
                7: { cellWidth: 25 },  // Predikat
                8: { cellWidth: 25 },  // Divisi
                9: { cellWidth: 25 }   // Jabatan
            },
            margin: { top: 25 }
        });

        // Save the PDF
        const currentDate = new Date().toLocaleDateString('id-ID').replace(/[/]/g, '-');
        doc.save(`Laporan_Penilaian_Kinerja_${currentDate}.pdf`);

        // Show success notification
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'File PDF berhasil diunduh',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

    } catch (error) {
        console.error('Error generating PDF:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal mengekspor PDF',
            text: `Terjadi kesalahan: ${error.message}`,
            confirmButtonText: 'OK'
        });
    }
}

// Fungsi Ekspor Excel
function exportToExcel() {
    try {
        // Show loading notification
        Swal.fire({
            title: 'Mengekspor Excel...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        const table = document.getElementById('penilaian-kinerja-table');
        const wb = XLSX.utils.table_to_book(table);
        
        XLSX.writeFile(wb, `Laporan_Penilaian_Kinerja_${new Date().toLocaleDateString('id-ID')}.xlsx`);

        // Show success notification
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'File Excel berhasil diunduh',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

    } catch (error) {
        console.error('Error exporting to Excel:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal mengekspor Excel',
            text: 'Terjadi kesalahan saat membuat file Excel',
            confirmButtonText: 'OK'
        });
    }
}

// Fungsi Ekspor CSV
function exportToCSV() {
    try {
        // Show loading notification
        Swal.fire({
            title: 'Mengekspor CSV...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        const table = document.getElementById('penilaian-kinerja-table');
        const wb = XLSX.utils.table_to_book(table);
        const csv = XLSX.utils.sheet_to_csv(wb.Sheets[wb.SheetNames[0]]);
        
        const csvData = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const csvUrl = URL.createObjectURL(csvData);
        
        const link = document.createElement("a");
        link.setAttribute("href", csvUrl);
        link.setAttribute("download", `Laporan_Penilaian_Kinerja_${new Date().toLocaleDateString('id-ID')}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        
        // Cleanup
        URL.revokeObjectURL(csvUrl);

        // Show success notification
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'File CSV berhasil diunduh',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

    } catch (error) {
        console.error('Error exporting to CSV:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal mengekspor CSV',
            text: 'Terjadi kesalahan saat membuat file CSV',
            confirmButtonText: 'OK'
        });
    }
}

// Fungsi Salin Tabel dengan Loading State
async function copyTableToClipboard() {
    try {
        // Show loading notification
        Swal.fire({
            title: 'Menyalin tabel...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        const table = document.getElementById('penilaian-kinerja-table');
        const rows = table.querySelectorAll('tr');
        
        let clipboardText = '';
        rows.forEach((row) => {
            const cells = row.querySelectorAll('th, td');
            const rowText = Array.from(cells)
                .map(cell => cell.textContent.trim())
                .join('\t');
            clipboardText += rowText + '\n';
        });
        
        await navigator.clipboard.writeText(clipboardText);

        // Show success notification
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Tabel berhasil disalin ke clipboard',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

    } catch (error) {
        console.error('Error copying table:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal menyalin',
            text: 'Terjadi kesalahan saat menyalin tabel ke clipboard',
            confirmButtonText: 'OK'
        });
    }
}

// Event Listeners
$(document).ready(function() {
    $('#exportPdfBtn').on('click', exportToPDF);
    $('#exportExcelBtn').on('click', exportToExcel);
    $('#exportCsvBtn').on('click', exportToCSV);
    $('#copyTableBtn').on('click', copyTableToClipboard);
});
</script>
<!-- Add these script tags in the correct order -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Excel/CSV Export Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<!-- Bootstrap JS dan Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
@endpush