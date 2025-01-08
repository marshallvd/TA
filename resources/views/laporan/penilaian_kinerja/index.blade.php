@extends('layouts.master')

@section('title') 
Laporan Penilaian Kinerja 
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
                                    <svg class="icon-20 text-primary" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="border rounded p-3 bg-soft-primary me-3">
                                        <i class="fas fa-clipboard-list icon-20"></i>
                                    </div>
                                    <h2 id="totalPenilaianCount" class="counter mb-0">0/0</h2>
                                </div>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="totalPenilaian">
                                    Grafik
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
                                    <svg class="icon-20 text-success" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div id="predikatSummary">
                                    <!-- Predikat akan diisi dinamis -->
                                </div>
                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="predikatPenilaian">
                                    Grafik
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
                                    <svg class="icon-20 text-info" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="border rounded p-3 bg-soft-info me-3">
                                        <i class="fas fa-building icon-20"></i>
                                    </div>
                                    <h2 id="divisiTertinggiNilai" class="mb-0">-</h2>
                                </div>
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="penilaianPerDivisi">
                                    Grafik
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
                                    <svg class="icon-20 text-warning" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" 
                                        />
                                    </svg>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="border rounded p-3 bg-soft-warning me-3">
                                        <i class="fas fa-user-tie icon-20"></i>
                                    </div>
                                    <h2 id="jabatanTertinggiNilai" class="mb-0">-</h2>
                                </div>
                                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="penilaianPerJabatan">
                                    Grafik
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
                            <h5 class="modal-title" id="chartModalLabel">Grafik</h5>
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
                    <div class="d-flex">
                        <button class="btn btn-primary me-2" id="exportPdfBtn">
                            <i class="fas fa-file-pdf me-2"></i>Cetak PDF
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Enhanced Filtering Section -->
                    <div class="row mb-4">
                        <div class="col-md-2">
                            <label for="yearFilter">Filter Tahun:</label>
                            <select id="yearFilter" class="form-control">
                                <option value="">Semua Tahun</option>
                                <!-- Years will be populated dynamically -->
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="monthYearFilter">Filter Bulan & Tahun:</label>
                            <input type="month" id="monthYearFilter" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="predikatFilter">Filter Predikat:</label>
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
                            <label for="divisiFilter">Filter Divisi:</label>
                            <select id="divisiFilter" class="form-control">
                                <option value="">Semua Divisi</option>
                                <!-- Divisi will be populated dynamically -->
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="jabatanFilter">Filter Jabatan:</label>
                            <select id="jabatanFilter" class="form-control">
                                <option value="">Semua Jabatan</option>
                                <!-- Jabatan will be populated dynamically -->
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button id="applyFilterBtn" class="btn btn-primary me-2">Filter</button>
                            <button id="resetFilterBtn" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="penilaian-kinerja-table" class="table table-striped" style="width:100%">
                            <thead >
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pegawai</th>
                                    <th>Periode Penilaian</th>
                                    <th>Nilai KPI</th>
                                    <th>Nilai Kompetensi</th>
                                    <th>Nilai Core Values</th>
                                    <th>Nilai Akhir</th>
                                    <th>Predikat</th>
                                    <th>Divisi</th>
                                    <th>Jabatan</th>
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

            const fullUrl = `http://127.0.0.1:8000/api/${endpoint}`;
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

            // Populate Divisi Dropdown
            const divisiSelect = $('#divisiFilter');
            fetchedDivisiData.forEach(divisi => {
                divisiSelect.append(
                    `<option value="${divisi.id_divisi}"> ${divisi.nama_divisi}</option>`
                );
            });

            // Populate Jabatan Dropdown
            const jabatanSelect = $('#jabatanFilter');
            fetchedJabatanData.forEach(jabatan => {
                jabatanSelect.append(
                    `<option value="${jabatan.id_jabatan}">${jabatan.nama_jabatan}</option>`
                );
            });

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


            // Fungsi untuk menerapkan filter
$('#applyFilterBtn').on('click', function() {
    const yearFilter = $('#yearFilter').val();
    const monthYearFilter = $('#monthYearFilter').val();
    const predikatFilter = $('#predikatFilter').val();
    const divisiFilter = $('#divisiFilter').val();
    const jabatanFilter = $('#jabatanFilter').val();

    penilaianTable.column(2).search(yearFilter ? yearFilter : '').draw();
    
    // Filter bulan dan tahun
    if (monthYearFilter) {
        const [filterYear, filterMonth] = monthYearFilter.split('-');
        penilaianTable.column(2).search(filterYear + '-' + filterMonth).draw();
    }

    // Filter predikat
    if (predikatFilter) {
        penilaianTable.column(7).search(predikatFilter).draw();
    }

    // Filter divisi
    if (divisiFilter) {
        penilaianTable.column(8).search(
            getNamaDivisi(divisiData, divisiFilter)
        ).draw();
    }

    // Filter jabatan
    if (jabatanFilter) {
        penilaianTable.column(9).search(
            getNamaJabatan(jabatanData, jabatanFilter)
        ).draw();
    }
});

// Fungsi reset filter
$('#resetFilterBtn').on('click', function() {
    $('#yearFilter, #monthYearFilter, #predikatFilter, #divisiFilter, #jabatanFilter').val('');
    penilaianTable.search('').columns().search('').draw();
});
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
</script>
@endsection