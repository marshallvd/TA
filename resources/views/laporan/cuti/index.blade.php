@extends('layouts.master')

@section('title') 
Laporan Cuti Pegawai 
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
                            <b><h2 class="card-title mb-1">Laporan Cuti Pegawai</h2></b>
                            <p class="card-text text-muted">Human Resource Management System SEB</p>
                        </div>
                        <div>
                            <i class="bi bi-calendar-check text-primary" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                </div>
            </div>  

            <!-- Improved Widget Section -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="text-muted text-uppercase small">Total Pengajuan Cuti</span>
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
                                        <i class="fas fa-calendar-alt icon-20"></i>
                                    </div>
                                    <h2 id="totalCutiCount" class="counter mb-0">0</h2>
                                </div>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="totalCuti">
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
                                    <span class="text-muted text-uppercase small">Status Pengajuan Cuti</span>
                                </div>
                                <div>
                                    <svg class="icon-20 text-success" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="border rounded p-3 bg-soft-success me-3">
                                        <i class="fas fa-chart-pie icon-20"></i>
                                    </div>
                                    <h2 id="statusCutiCount" class="counter mb-0">0</h2>
                                </div>
                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="statusCuti">
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
                                    <span class="text-muted text-uppercase small">Cuti per Divisi</span>
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
                                    <h2 id="cutiPerDivisiCount" class="counter mb-0">0</h2>
                                </div>
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="cutiPerDivisi">
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
                                    <span class="text-muted text-uppercase small">Cuti per Jabatan</span>
                                </div>
                                <div>
                                    <svg class="icon-20 text-warning" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="border rounded p-3 bg-soft-warning me-3">
                                        <i class="fas fa-user-tie icon-20"></i>
                                    </div>
                                    <h2 id="cutiPerJabatanCount" class="counter mb-0">0</h2>
                                </div>
                                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="cutiPerJabatan">
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
                        <h4 class="card-title">Data Pengajuan Cuti</h4>
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
                        <div class="col-md-3">
                            <label for="yearFilter">Filter Tahun:</label>
                            <select id="yearFilter" class="form-control">
                                <option value="">Semua Tahun</option>
                                <!-- Years will be populated dynamically -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="monthYearFilter">Filter Bulan & Tahun:</label>
                            <input type="month" id="monthYearFilter" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="statusFilter">Filter Status:</label>
                            <select id="statusFilter" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="menunggu">Menunggu</option>
                                <option value="disetujui">Disetujui</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="leaveTypeFilter">Filter Jenis Cuti:</label>
                            <select id="leaveTypeFilter" class="form-control">
                                <option value="">Semua Jenis Cuti</option>
                                <!-- Leave types will be populated dynamically -->
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button id="applyFilterBtn" class="btn btn-primary me-2">Filter</button>
                            <button id="resetFilterBtn" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="cuti-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pegawai</th>
                                    <th>Jenis Cuti</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
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
    const cutiTable = $('#cuti-table').DataTable({
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
                data: 'id_pegawai',
                render: function(data) {
                    const pegawai = pegawaiData.find(p => p.id_pegawai === data);
                    return pegawai ? pegawai.nama_lengkap : 'Tidak diketahui';
                }
            },
            { 
                data: 'id_jenis_cuti',
                render: function(data) {
                    const jenisCuti = leaveTypes.find(j => j.id_jenis_cuti === data);
                    return jenisCuti ? jenisCuti.nama_jenis_cuti : 'Tidak diketahui';
                }
            },
            { 
                data: 'tanggal_mulai',
                render: function(data) {
                    return data ? new Date(data).toLocaleDateString('id-ID') : '-';
                }
            },
            { 
                data: 'tanggal_selesai',
                render: function(data) {
                    return data ? new Date(data).toLocaleDateString('id-ID') : '-';
                }
            },
            { 
                data: 'status',
                render: function(data) {
                    const statusClasses = {
                        'menunggu': 'badge bg-warning',
                        'disetujui': 'badge bg-success',
                        'ditolak': 'badge bg-danger'
                    };
                    return `<span class="${statusClasses[data] || 'badge bg-secondary'}">${data}</span>`;
                }
            },
            { 
                data: 'id_pegawai',
                render: function(data) {
                    const pegawai = pegawaiData.find(p => p.id_pegawai === data);
                    return pegawai ? getNamaDivisi(divisiData, pegawai.id_divisi) : 'Tidak diketahui';
                }
            },
            { 
                data: 'id_pegawai',
                render: function(data) {
                    const pegawai = pegawaiData.find(p => p.id_pegawai === data);
                    return pegawai ? getNamaJabatan(jabatanData, pegawai.id_jabatan) : 'Tidak diketahui';
                }
            }
        ]
    });

    // Fungsi Utama Memuat Data
    function initializePage() {
        Promise.all([
            fetchData('cuti'), 
            fetchData('pegawai'), 
            fetchData('divisi'), 
            fetchData('jabatan'),
            fetchData('jenis-cuti')
        ]).then(([
            fetchedCutiData, 
            fetchedPegawaiData, 
            fetchedDivisiData, 
            fetchedJabatanData,
            fetchedLeaveTypes
        ]) => {
            console.log('Fetched Cuti Data Length:', fetchedCutiData.length);
            console.log('Fetched Pegawai Data Length:', fetchedPegawaiData.length);
            console.log('Fetched Divisi Data Length:', fetchedDivisiData.length);
            console.log('Fetched Jabatan Data Length:', fetchedJabatanData.length);
            console.log('Fetched Leave Types Length:', fetchedLeaveTypes.length);

            // Tambahkan pengecekan kondisi
            if (fetchedCutiData.length === 0) {
                console.warn('Tidak ada data cuti yang ditemukan');
                $('#cuti-table').find('tbody').html('<tr><td colspan="8" class="text-center">Tidak ada data cuti</td></tr>');
            }

            cutiData = fetchedCutiData;
            pegawaiData = fetchedPegawaiData;
            divisiData = fetchedDivisiData;
            jabatanData = fetchedJabatanData;
            leaveTypes = fetchedLeaveTypes;

                        // Populate Year Filter Dropdown
                        const uniqueYears = [...new Set(fetchedCutiData.map(item => 
                new Date(item.tanggal_mulai).getFullYear()
            ))].sort();
            const yearSelect = $('#yearFilter');
            uniqueYears.forEach(year => {
                yearSelect.append(`<option value="${year}">${year}</option>`);
            });

            // Populate Leave Types Dropdown
            const leaveTypeSelect = $('#leaveTypeFilter');
            fetchedLeaveTypes.forEach(type => {
                leaveTypeSelect.append(
                    `<option value="${type.id_jenis_cuti}">
                        ${type.nama_jenis_cuti}
                    </option>`
                );
            });

            // Custom Filtering Function
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    const yearFilter = $('#yearFilter').val();
                    const monthYearFilter = $('#monthYearFilter').val();
                    const statusFilter = $('#statusFilter').val();
                    const leaveTypeFilter = $('#leaveTypeFilter').val();

                    const startDate = new Date(cutiData[dataIndex].tanggal_mulai);
                    const status = cutiData[dataIndex].status;
                    const leaveTypeId = cutiData[dataIndex].id_jenis_cuti;

                    const matchesYear = !yearFilter || 
                        startDate.getFullYear() == yearFilter;
                    
                    const matchesMonthYear = !monthYearFilter || 
                        (startDate.getFullYear() + '-' + 
                        String(startDate.getMonth() + 1).padStart(2, '0') 
                        === monthYearFilter);
                    
                    const matchesStatus = !statusFilter || status === statusFilter;
                    
                    const matchesLeaveType = !leaveTypeFilter || 
                        leaveTypeId == leaveTypeFilter;

                    return matchesYear && matchesMonthYear && 
                        matchesStatus && matchesLeaveType;
                }
            );

            // Apply Filter Button
            $('#applyFilterBtn').on('click', function() {
                cutiTable.draw();
            });

            // Reset Filter Button
            $('#resetFilterBtn').on('click', function() {
                $('#yearFilter, #monthYearFilter, #statusFilter, #leaveTypeFilter')
                    .val('');
                cutiTable.draw();
            });
            // Update widget counts
$('#totalCutiCount').text(cutiData.length);

// Status Cuti dengan ikon
const statusCounts = cutiData.reduce((acc, curr) => {
    // Change 'pending' to 'menunggu'
    const status = curr.status === 'pending' ? 'menunggu' : curr.status;
    acc[status] = (acc[status] || 0) + 1;
    return acc;
}, {});

// Gunakan ikon untuk menampilkan status
$('#statusCutiCount').html(`
    <span class="badge bg-success me-1" title="Disetujui: ${statusCounts['disetujui'] || 0}">
        <i class="bi bi-check-circle"></i> ${statusCounts['disetujui'] || 0}
    </span>
    <span class="badge bg-warning me-1" title="Menunggu: ${statusCounts['menunggu'] || 0}">
        <i class="bi bi-clock"></i> ${statusCounts['menunggu'] || 0}
    </span>
    <span class="badge bg-danger" title="Ditolak: ${statusCounts['ditolak'] || 0}">
        <i class="bi bi-x-circle"></i> ${statusCounts['ditolak'] || 0}
    </span>
`);

// Cuti per Divisi - Hanya jumlah divisi
$('#cutiPerDivisiCount').text(Object.keys(
    cutiData.reduce((acc, curr) => {
        const pegawai = pegawaiData.find(p => p.id_pegawai === curr.id_pegawai);
        const divisi = pegawai ? pegawai.id_divisi : 'Tidak diketahui';
        acc[divisi] = (acc[divisi] || 0) + 1;
        return acc;
    }, {})
).length);

// Cuti per Jabatan - Hanya jumlah jabatan
$('#cutiPerJabatanCount').text(Object.keys(
    cutiData.reduce((acc, curr) => {
        const pegawai = pegawaiData.find(p => p.id_pegawai === curr.id_pegawai);
        const jabatan = pegawai ? pegawai.id_jabatan : 'Tidak diketahui';
        acc[jabatan] = (acc[jabatan] || 0) + 1;
        return acc;
    }, {})
).length);

            cutiTable.clear().rows.add(cutiData).draw();
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
// Chart Configuration Functions
function configureChartModal(chartType) {
    // Clear previous chart if exists
    if (window.existingChart) {
        window.existingChart.destroy();
    }

    const ctx = document.getElementById('chartCanvas').getContext('2d');
    let chartConfig;

    switch(chartType) {
        case 'totalCuti':
            chartConfig = configureTotalCutiChart();
            break;
        case 'statusCuti':
            chartConfig = configureStatusCutiChart();
            break;
        case 'cutiPerDivisi':
            chartConfig = configureCutiPerDivisiChart();
            break;
        case 'cutiPerJabatan':
            chartConfig = configureCutiPerJabatanChart();
            break;
        default:
            console.error('Invalid chart type');
            return;
    }

    window.existingChart = new Chart(ctx, chartConfig);
}

// Total Cuti Chart
function configureTotalCutiChart() {
    const employeeCutiCounts = cutiData.reduce((acc, curr) => {
        const pegawai = pegawaiData.find(p => p.id_pegawai === curr.id_pegawai);
        const employeeName = pegawai ? pegawai.nama_lengkap : 'Unknown';
        acc[employeeName] = (acc[employeeName] || 0) + 1;
        return acc;
    }, {});

    return {
        type: 'bar',
        data: {
            labels: Object.keys(employeeCutiCounts),
            datasets: [{
                label: 'Total Cuti per Pegawai',
                data: Object.values(employeeCutiCounts),
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
                    text: 'Total Cuti per Pegawai'
                },
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Cuti'
                    }
                }
            }
        }
    };
}

// Status Cuti Chart
function configureStatusCutiChart() {
    const statusCounts = cutiData.reduce((acc, curr) => {
        const status = curr.status.toLowerCase();
        acc[status] = (acc[status] || 0) + 1;
        return acc;
    }, {});

    return {
        type: 'pie',
        data: {
            labels: Object.keys(statusCounts).map(status => 
                status.charAt(0).toUpperCase() + status.slice(1)
            ),
            datasets: [{
                data: Object.values(statusCounts),
                backgroundColor: [
                    'rgba(255, 206, 86, 0.6)',  // Menunggu (Yellow)
                    'rgba(75, 192, 192, 0.6)',  // Disetujui (Green)
                    'rgba(255, 99, 132, 0.6)'   // Ditolak (Red)
                ],
                borderColor: [
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Status Pengajuan Cuti'
                },
                legend: { 
                    display: true,
                    position: 'bottom' 
                }
            }
        }
    };
}

// Cuti per Divisi Chart
function configureCutiPerDivisiChart() {
    const divisiCutiCounts = cutiData.reduce((acc, curr) => {
        const pegawai = pegawaiData.find(p => p.id_pegawai === curr.id_pegawai);
        if (pegawai) {
            const divisi = divisiData.find(d => d.id_divisi === pegawai.id_divisi);
            const divisiName = divisi ? divisi.nama_divisi : 'Tidak Diketahui';
            acc[divisiName] = (acc[divisiName] || 0) + 1;
        }
        return acc;
    }, {});

    return {
        type: 'bar',
        data: {
            labels: Object.keys(divisiCutiCounts),
            datasets: [{
                label: 'Jumlah Cuti per Divisi',
                data: Object.values(divisiCutiCounts),
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
                    text: 'Cuti per Divisi'
                },
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Cuti'
                    }
                }
            }
        }
    };
}

// Cuti per Jabatan Chart
function configureCutiPerJabatanChart() {
    const jabatanCutiCounts = cutiData.reduce((acc, curr) => {
        const pegawai = pegawaiData.find(p => p.id_pegawai === curr.id_pegawai);
        if (pegawai) {
            const jabatan = jabatanData.find(j => j.id_jabatan === pegawai.id_jabatan);
            const jabatanName = jabatan ? jabatan.nama_jabatan : 'Tidak Diketahui';
            acc[jabatanName] = (acc[jabatanName] || 0) + 1;
        }
        return acc;
    }, {});

    return {
        type: 'bar',
        data: {
            labels: Object.keys(jabatanCutiCounts),
            datasets: [{
                label: 'Jumlah Cuti per Jabatan',
                data: Object.values(jabatanCutiCounts),
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
                    text: 'Cuti per Jabatan'
                },
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Cuti'
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
        if (typeof Chart !== 'undefined' && cutiData && cutiData.length > 0) {
            configureChartModal(chartType);
        } else {
            console.error('Chart.js not loaded or data not available');
        }
    });
});
});
</script>
@endsection