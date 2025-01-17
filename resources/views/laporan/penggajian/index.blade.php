@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Laporan Penggajian
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <b><h2 class="card-title mb-1">Laporan Penggajian</h2></b>
                                <p class="card-text text-muted">Human Resource Management System SEB</p>
                            </div>
                            <div>
                                <i class="bi bi-cash-stack text-primary" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>  

                <!-- Widget Section -->
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="text-muted text-uppercase small">Total Digaji</span>
                                    </div>
                                    <div>
                                        <i class="bi bi-cash-stack text-primary"></i>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="border rounded p-3 bg-soft-primary me-3">
                                            <i class="bi bi-cash-stack"></i>
                                        </div>
                                        <h2 id="totalGajiCount" class="counter mb-0">0/0</h2>
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="totalGaji">
                                        <i class="bi bi-bar-chart-fill me-1"></i>Grafik
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="text-muted text-uppercase small">Rata-rata Gaji per Divisi</span>
                                    </div>
                                    <div>
                                        <i class="bi bi-building-fill text-success"></i>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div id="divisiTertinggiGaji">
                                        <div class="d-flex align-items-center">
                                            <div class="border rounded p-3 bg-soft-success me-3">
                                                <i class="bi bi-building-fill"></i>
                                            </div>
                                            <!-- Rata-rata Gaji per Divisi akan diisi dinamis -->
                                        </div>
                                    </div>
                                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="gajiPerDivisi">
                                        <i class="bi bi-bar-chart-fill me-1"></i>Grafik
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <span class="text-muted text-uppercase small">Rata-rata Gaji per Jabatan</span>
                                    </div>
                                    <div>
                                        <i class="bi bi-person-workspace text-warning"></i>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div id="jabatanTertinggiGaji">
                                        <div class="d-flex align-items-center">
                                            <div class="border rounded p-3 bg-soft-warning me-3">
                                                <i class="bi bi-person-workspace"></i>
                                            </div>
                                            <!-- Rata-rata Gaji per Jabatan akan diisi dinamis -->
                                        </div>
                                    </div>
                                    <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="gajiPerJabatan">
                                        <i class="bi bi-bar-chart-fill me-1"></i>Grafik
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            <h4 class="card-title">Data Penggajian</h4>
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
                                    <i class="bi bi-calendar-year me-2"></i>Filter Tahun:
                                </label>
                                <select id="yearFilter" class="form-control">
                                    <option value="">Semua Tahun</option>
                                    <!-- Years will be populated dynamically -->
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="monthYearFilter">
                                    <i class="bi bi-calendar-month me-2"></i>Filter Bulan & Tahun:
                                </label>
                                <input type="month" id="monthYearFilter" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label for="predikatFilter">
                                    <i class="bi bi-star me-2"></i>Filter Predikat:
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
                                    <i class="bi bi-building me-2"></i>Filter Divisi:
                                </label>
                                <select id="divisiFilter" class="form-control">
                                    <option value="">Semua Divisi</option>
                                    <!-- Divisi will be populated dynamically -->
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="jabatanFilter">
                                    <i class="bi bi-person-workspace me-2"></i>Filter Jabatan:
                                </label>
                                <select id="jabatanFilter" class="form-control">
                                    <option value="">Semua Jabatan</option>
                                    <!-- Jabatan will be populated dynamically -->
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button id="applyFilterBtn" class="btn btn-primary me-2">
                                    <i class="bi bi-funnel me-2"></i>Filter
                                </button>
                                <button id="resetFilterBtn" class="btn btn-secondary">
                                    <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="gaji-karyawan-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pegawai</th>
                                        <th>Periode Gaji</th>
                                        <th>Predikat Penilaian Kinerja</th>
                                        <th>Kehadiran</th>
                                        <th>Lembur</th>
                                        <th>Total Pendapatan</th>
                                        <th>Total Potongan</th>
                                        <th>Gaji Bersih</th>
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
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="chartYearFilter">
                            <i class="bi bi-calendar-year me-2"></i>Tahun:
                        </label>
                        <select id="chartYearFilter" class="form-control">
                            <option value="">Pilih Tahun</option>
                            <!-- Tahun akan diisi dinamis -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="chartMonthFilter">
                            <i class="bi bi-calendar-month me-2"></i>Bulan:
                        </label>
                        <select id="chartMonthFilter" class="form-control">
                            <option value="">Pilih Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                </div>
                <canvas id="chartCanvas"></canvas>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="generateChartBtn">
                    <i class="bi bi-bar-chart-fill me-2"></i>Tampilkan Grafik
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    console.log('Token:', token); // Debug token

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

    const gajiTable = $('#gaji-karyawan-table').DataTable({
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
            data: null, // Gunakan null karena kita akan menggabungkan dua field
            render: function(data) {
                // Gabungkan periode_bulan dan periode_tahun
                return `${data.periode_tahun}-${String(data.periode_bulan).padStart(2, '0')}`; // Format YYYY-MM
            }
        },
        
        { 
            data: 'predikat_penilaian',
            render: function(data) {
                const predikatClasses = {
                    'sangat baik': 'badge bg-success',
                    'baik': 'badge bg-primary',
                    'cukup': 'badge bg-warning',
                    'kurang': 'badge bg-danger',
                    'sangat kurang': 'badge bg-secondary'
                };
                return `<span class="${predikatClasses[data.toLowerCase()] || 'badge bg-light text-dark'}">${data || '-'}</span>`;
            }
        },
        { 
            data: 'jumlah_kehadiran',
            render: function(data) {
                return data || '-';
            }
        },
        { 
            data: 'jumlah_hari_lembur',
            render: function(data) {
                return data || '-';
            }
        },
        { 
            data: 'total_pendapatan',
            render: function(data) {
                return data ? `Rp ${Number(data).toLocaleString('id-ID')}` : '-';
            }
        },
        { 
            data: 'total_potongan',
            render: function(data) {
                return data ? `Rp ${Number(data).toLocaleString('id-ID')}` : '-';
            }
        },
        { 
            data: 'gaji_bersih',
            render: function(data) {
                return data ? `Rp ${Number(data).toLocaleString('id-ID')}` : '-';
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

    let gajiData = [];
    let pegawaiData = [];
    let divisiData = [];
    let jabatanData = [];

    // Populate Year Filter Dropdown
function extractValidYears(gajiData) {
    const validYears = gajiData
        .map(item => {
            // Pastikan periode_gaji tidak null/undefined dan valid
            if (item.periode_gaji) {
                try {
                    const year = new Date(item.periode_gaji).getFullYear();
                    return isNaN(year) ? null : year;
                } catch (error) {
                    console.error('Error parsing year:', item.periode_gaji, error);
                    return null;
                }
            }
            return item.periode_tahun;
        })
        .filter(year => year !== null); // Hapus tahun yang tidak valid

    return [...new Set(validYears)].sort((a, b) => a - b);
}

    function getNamaDivisi(divisiData, divisiId) {
        const divisi = divisiData.find(d => d.id_divisi == divisiId);
        return divisi ? divisi.nama_divisi : 'Tidak diketahui';
    }

    function getNamaJabatan(jabatanData, jabatanId) {
        const jabatan = jabatanData.find(j => j.id_jabatan == jabatanId);
        return jabatan ? jabatan.nama_jabatan : 'Tidak diketahui';
    }
    function initializePage() {
        Promise.all([
            fetchData('gaji'), 
            fetchData('pegawai'), 
            fetchData('divisi'), 
            fetchData('jabatan'),
            fetchData('penilaian-kinerja') // Ambil semua penilaian kinerja

        ]).then(([
            fetchedGajiData, 
            fetchedPegawaiData, 
            fetchedDivisiData, 
            fetchedJabatanData,
            fetchedPenilaianData // Data penilaian kinerja

        ]) => {

            
            gajiData = fetchedGajiData;
            pegawaiData = fetchedPegawaiData;
            divisiData = fetchedDivisiData;
            jabatanData = fetchedJabatanData;

            console.log('Fetched Gaji Data Length:', fetchedGajiData.length);
            console.log('Fetched Pegawai Data Length:', fetchedPegawaiData.length);
            console.log('Fetched Divisi Data Length:', fetchedDivisiData.length);
            console.log('Fetched Jabatan Data Length:', fetchedJabatanData.length);
            console.log('Fetched Penilaian Data Length:', fetchedPenilaianData.length);
            for (const gaji of gajiData) {
            const penilaian = fetchedPenilaianData.find(p => 
                p.pegawai.id_pegawai === gaji.id_pegawai &&
                new Date(p.periode_penilaian).getFullYear() === gaji.periode_tahun &&
                new Date(p.periode_penilaian).getMonth() + 1 === gaji.periode_bulan
            );
            gaji.predikat_penilaian = penilaian ? penilaian.predikat : '-';
        }

            // Populate Year Filter Dropdown
            const uniqueYears = extractValidYears(fetchedGajiData);
            const yearSelect = $('#yearFilter');
            yearSelect.empty().append('<option value="">Semua Tahun</option>');
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
            $('#totalGajiCount').text(`${fetchedGajiData.length}/${fetchedPegawaiData.length}`);

            // Rata-rata Gaji per Divisi
            const divisiAverage = fetchedGajiData.reduce((acc, curr) => {
                if (curr.pegawai && curr.pegawai.id_divisi && curr.gaji_bersih) {
                    const divisiId = curr.pegawai.id_divisi;
                    acc[divisiId] = acc[divisiId] || { total: 0, count: 0 };
                    acc[divisiId].total += Number(curr.gaji_bersih);
                    acc[divisiId].count += 1;
                }
                return acc;
            }, {});

            const divisiAverages = Object.entries(divisiAverage).map(([id, { total, count }]) => ({
                divisiId: id,
                average:count > 0 ? total / count : 0
            }));

            const highestDivisi = divisiAverages.length > 0 
                ? divisiAverages.reduce((prev, curr) => (prev.average > curr.average) ? prev : curr, { average: 0 })
                : { average: 0 };
            
            $('#divisiTertinggiGaji').text(highestDivisi.average.toFixed(2));

            // Rata-rata Gaji per Jabatan
            const jabatanAverage = fetchedGajiData.reduce((acc, curr) => {
                if (curr.pegawai && curr.pegawai.id_jabatan && curr.gaji_bersih) {
                    const jabatanId = curr.pegawai.id_jabatan;
                    acc[jabatanId] = acc[jabatanId] || { total: 0, count: 0 };
                    acc[jabatanId].total += Number(curr.gaji_bersih);
                    acc[jabatanId].count += 1;
                }
                return acc;
            }, {});

            const jabatanAverages = Object.entries(jabatanAverage).map(([id, { total, count }]) => ({
                jabatanId: id,
                average: count > 0 ? total / count : 0
            }));

            const highestJabatan = jabatanAverages.length > 0
                ? jabatanAverages.reduce((prev, curr) => (prev.average > curr.average) ? prev : curr, { average: 0 })
                : { average: 0 };
            
            $('#jabatanTertinggiGaji').text(highestJabatan.average.toFixed(2));

            gajiTable.clear().rows.add(fetchedGajiData).draw();
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

// Event Listener for Chart Modal
$(document).ready(function() {
    $('#chartModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const chartType = button.data('chart-type');
        console.log('Gaji Data:', gajiData); // Debug: Cek isi gajiData

        // Populate Year Filter Dropdown in Chart Modal
        const yearSelect = $('#chartYearFilter');
        yearSelect.empty().append('<option value="">Pilih Tahun</option>');
        const uniqueYears = extractValidYears(gajiData);
        uniqueYears.forEach(year => {
            yearSelect.append(`<option value="${year}">${year}</option>`);
        });
        console.log('Unique Years:', uniqueYears);

        // Clear previous chart if exists
        if (window.existingChart) {
            window.existingChart.destroy();
        }

        // Set up the chart generation button
        $('#generateChartBtn').off('click').on('click', function() {
            const selectedYear = $('#chartYearFilter').val();
            const selectedMonth = $('#chartMonthFilter').val();

            if (!selectedYear || !selectedMonth) {
                alert('Silakan pilih tahun dan bulan.');
                return;
            }

            // Generate the chart based on selected year and month
            configureChartModal(chartType, selectedYear, selectedMonth);
        });
    });
});

// Chart Configuration Function
function configureChartModal(chartType, year, month) {
    console.log('Chart Configuration:', {
        chartType,
        year,
        month,
        gajiData: gajiData.length
    });

    const ctx = document.getElementById('chartCanvas').getContext('2d');
    let chartConfig;

    try {
        // Pastikan year dan month adalah string
        year = String(year);
        month = String(month).padStart(2, '0');

        switch(chartType) {
            case 'totalGaji':
                chartConfig = configureTotalGajiChart(year, month);
                break;
            case 'gajiPerDivisi':
                chartConfig = configureGajiPerDivisiChart(year, month);
                break;
            case 'gajiPerJabatan':
                chartConfig = configureGajiPerJabatanChart(year, month);
                break;
            default:
                console.error('Invalid chart type');
                return;
        }

        // Tambahkan log untuk memastikan data chart valid
        console.log('Chart Config:', chartConfig);

        if (window.existingChart) {
            window.existingChart.destroy();
        }

        // Tambahkan penanganan jika tidak ada data
        if (chartConfig.data.labels.length === 0) {
            alert('Tidak ada data untuk periode yang dipilih');
            return;
        }

        window.existingChart = new Chart(ctx, chartConfig);
    } catch (error) {
        console.error('Chart Creation Error:', error);
        alert('Gagal membuat grafik: ' + error.message);
    }
}

// Total Gaji Chart
function configureTotalGajiChart(year, month) {
    console.log('Total Gaji Chart - Input:', { year, month });
    console.log('Gaji Data:', gajiData);

    const totalGajiCounts = gajiData.reduce((acc, curr) => {
        // Log setiap iterasi untuk memahami filtering
        console.log('Current Item:', {
            periode_tahun: curr.periode_tahun, 
            periode_bulan: curr.periode_bulan,
            gaji_bersih: curr.gaji_bersih
        });

        const pegawai = pegawaiData.find(p => p.id_pegawai === curr.pegawai.id_pegawai);
        const employeeName = pegawai ? pegawai.nama_lengkap : 'Unknown';

        // Konversi tipe data dengan hati-hati
        const currYear = String(curr.periode_tahun);
        const currMonth = String(curr.periode_bulan).padStart(2, '0');

        console.log('Comparison:', {
            currYear, 
            currMonth, 
            inputYear: year, 
            inputMonth: month
        });

        // Gunakan perbandingan string untuk menghindari masalah tipe data
        if (currYear === year && currMonth === month) {
            acc[employeeName] = (acc[employeeName] || 0) + (Number(curr.gaji_bersih) || 0);
        }
        return acc;
    }, {});

    console.log('Total Gaji Counts:', totalGajiCounts);

    // Jika tidak ada data, kembalikan chart kosong
    if (Object.keys(totalGajiCounts).length === 0) {
        return {
            type: 'bar',
            data: {
                labels: ['Tidak Ada Data'],
                datasets: [{
                    label: 'Total Gaji per Pegawai',
                    data: [0],
                    backgroundColor: 'rgba(200, 200, 200, 0.6)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Tidak Ada Data untuk Periode yang Dipilih'
                    }
                }
            }
        };
    }

    return {
        type: 'bar',
        data: {
            labels: Object.keys(totalGajiCounts),
            datasets: [{
                label: 'Total Gaji per Pegawai',
                data: Object.values(totalGajiCounts),
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
                    text: 'Total Gaji per Pegawai'
                },
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Gaji'
                    }
                }
            }
        }
    };
}

// Gaji per Divisi Chart
function configureGajiPerDivisiChart(year, month) {
    console.log('Gaji per Divisi Chart - Input:', { year, month });
    console.log('Gaji Data:', gajiData);

    const divisiGajiCounts = gajiData.reduce((acc, curr) => {
        // Log setiap iterasi untuk memahami filtering
        console.log('Current Item:', {
            periode_tahun: curr.periode_tahun, 
            periode_bulan: curr.periode_bulan,
            gaji_bersih: curr.gaji_bersih
        });

        const divisi = divisiData.find(d => d.id_divisi === curr.pegawai.id_divisi);
        const divisiName = divisi ? divisi.nama_divisi : 'Unknown';

        // Konversi tipe data dengan hati-hati
        const currYear = String(curr.periode_tahun);
        const currMonth = String(curr.periode_bulan).padStart(2, '0');

        console.log('Comparison:', {
            currYear, 
            currMonth, 
            inputYear: year, 
            inputMonth: month
        });

        // Gunakan perbandingan string untuk menghindari masalah tipe data
        if (currYear === year && currMonth === month) {
            acc[divisiName] = (acc[divisiName] || 0) + (Number(curr.gaji_bersih) || 0);
        }
        return acc;
    }, {});

    console.log('Divisi Gaji Counts:', divisiGajiCounts);

    // Jika tidak ada data, kembalikan chart kosong
    if (Object.keys(divisiGajiCounts).length === 0) {
        return {
            type: 'bar',
            data: {
                labels: ['Tidak Ada Data'],
                datasets: [{
                    label: 'Total Gaji per Divisi',
                    data: [0],
                    backgroundColor: 'rgba(200, 200, 200, 0.6)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Tidak Ada Data untuk Periode yang Dipilih'
                    }
                }
            }
        };
    }

    return {
        type: 'bar',
        data: {
            labels: Object.keys(divisiGajiCounts),
            datasets: [{
                label: 'Total Gaji per Divisi',
                data: Object.values(divisiGajiCounts),
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
                    text: 'Total Gaji per Divisi'
                },
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Gaji'
                    }
                }
            }
        }
    };
}

// Gaji per Jabatan Chart
function configureGajiPerJabatanChart(year, month) {
    console.log('Gaji per Jabatan Chart - Input:', { year, month });
    console.log('Gaji Data:', gajiData);

    const jabatanGajiCounts = gajiData.reduce((acc, curr) => {
        // Log setiap iterasi untuk memahami filtering
        console.log('Current Item:', {
            periode_tahun: curr.periode_tahun, 
            periode_bulan: curr.periode_bulan,
            gaji_bersih: curr.gaji_bersih
        });

        const jabatan = jabatanData.find(j => j.id_jabatan === curr.pegawai.id_jabatan);
        const jabatanName = jabatan ? jabatan.nama_jabatan : 'Unknown';

        // Konversi tipe data dengan hati-hati
        const currYear = String(curr.periode_tahun);
        const currMonth = String(curr.periode_bulan).padStart(2, '0');

        console.log('Comparison:', {
            currYear, 
            currMonth, 
            inputYear: year, 
            inputMonth: month
        });

        // Gunakan perbandingan string untuk menghindari masalah tipe data
        if (currYear === year && currMonth === month) {
            acc[jabatanName] = (acc[jabatanName] || 0) + (Number(curr.gaji_bersih) || 0);
        }
        return acc;
    }, {});

    console.log('Jabatan Gaji Counts:', jabatanGajiCounts);

    // Jika tidak ada data, kembalikan chart kosong
    if (Object.keys(jabatanGajiCounts).length === 0) {
        return {
            type: 'bar',
            data: {
                labels: ['Tidak Ada Data'],
                datasets: [{
                    label: 'Total Gaji per Jabatan',
                    data: [0],
                    backgroundColor: 'rgba(200, 200, 200, 0.6)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Tidak Ada Data untuk Periode yang Dipilih'
                    }
                }
            }
        };
    }

    return {
        type: 'bar',
        data: {
            labels: Object.keys(jabatanGajiCounts),
            datasets: [{
                label: 'Total Gaji per Jabatan',
                data: Object.values(jabatanGajiCounts),
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
                    text: 'Total Gaji per Jabatan'
                },
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Gaji'
                    }
                }
            }
        }
    };
}

    // Filter functionality
    $('#applyFilterBtn').on('click', function() {
    // Hapus filter sebelumnya
    $.fn.dataTable.ext.search.length = 0;

    const yearFilter = $('#yearFilter').val();
    const monthYearFilter = $('#monthYearFilter').val();
    const predikatFilter = $('#predikatFilter').val();
    const divisiFilter = $('#divisiFilter').val();
    const jabatanFilter = $('#jabatanFilter').val();

    // Custom filter function
    $.fn .dataTable.ext.search.push(function(settings, data, dataIndex) {
        const rowData = gajiData[dataIndex];

        // Extract year and month from the row data
        const rowYear = rowData.periode_tahun;
        const rowMonth = String(rowData.periode_bulan).padStart(2, '0'); // Format month to two digits

        // Filter Tahun
        if (yearFilter && rowYear.toString() !== yearFilter) {
            return false;
        }

        // Filter Bulan & Tahun
        if (monthYearFilter) {
            const [filterYear, filterMonth] = monthYearFilter.split('-');
            if (rowYear.toString() !== filterYear || rowMonth !== filterMonth) {
                return false;
            }
        }

        // Filter Predikat
        if (predikatFilter && (rowData.predikat_penilaian || '').toLowerCase() !== predikatFilter.toLowerCase()) {
            return false;
        }

        // Filter Divisi
        if (divisiFilter && rowData.pegawai && rowData.pegawai.id_divisi.toString() !== divisiFilter) {
            return false;
        }

        // Filter Jabatan
        if (jabatanFilter && rowData.pegawai && rowData.pegawai.id_jabatan.toString() !== jabatanFilter) {
            return false;
        }

        return true; // If all filters pass, include this row
    });

    gajiTable.draw(); // Render ulang dengan filter
});

// Modifikasi fungsi reset filter
$('#resetFilterBtn').on('click', function() {
    $('#yearFilter, #monthYearFilter, #predikatFilter, #divisiFilter, #jabatanFilter').val('');
    
    // Hapus semua custom filter
    $.fn.dataTable.ext.search.length = 0;
    
    gajiTable.draw(); // Render ulang tanpa filter
});

// Fungsi Ekspor PDF
function exportToPDF() {
    try {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l'); // Landscape
        
        // Gunakan DataTable yang benar
        const table = $('#gaji-karyawan-table').DataTable();
        const headers = ['No', 'Nama Pegawai', 'Periode Gaji', 'Predikat', 'Kehadiran', 'Lembur', 
                        'Total Pendapatan', 'Total Potongan', 'Gaji Bersih', 'Divisi', 'Jabatan'];
        
        // Ambil data dari DataTable
        const allData = table.rows().data().toArray().map((row, index) => [
            index + 1,
            row.pegawai?.nama_lengkap || '',
            `${row.periode_tahun}-${String(row.periode_bulan).padStart(2, '0')}`,
            row.predikat_penilaian || '',
            row.jumlah_kehadiran || '',
            row.jumlah_hari_lembur || '',
            `Rp ${Number(row.total_pendapatan).toLocaleString('id-ID')}`,
            `Rp ${Number(row.total_potongan).toLocaleString('id-ID')}`,
            `Rp ${Number(row.gaji_bersih).toLocaleString('id-ID')}`,
            getNamaDivisi(divisiData, row.pegawai?.id_divisi) || '',
            getNamaJabatan(jabatanData, row.pegawai?.id_jabatan) || ''
        ]);
        
        doc.text("Laporan Penggajian", 14, 15);
        doc.autoTable({
            head: [headers],
            body: allData,
            startY: 25,
            styles: {
                fontSize: 8,
                cellPadding: 2,
                overflow: 'linebreak'
            },
            margin: { top: 20 }
        });
        
        doc.save(`Laporan_Penggajian_${new Date().toLocaleDateString('id-ID')}.pdf`);
        
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'PDF berhasil diekspor',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    } catch (error) {
        console.error('Gagal ekspor PDF:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Gagal mengekspor PDF: ' + error.message
        });
    }
}

// Fungsi Ekspor Excel
function exportToExcel() {
    try {
        const table = $('#gaji-karyawan-table').DataTable();
        const headers = ['No', 'Nama Pegawai', 'Periode Gaji', 'Predikat', 'Kehadiran', 'Lembur', 
                        'Total Pendapatan', 'Total Potongan', 'Gaji Bersih', 'Divisi', 'Jabatan'];
        
        // Ambil data dari DataTable
        const allData = table.rows().data().toArray().map((row, index) => [
            index + 1,
            row.pegawai?.nama_lengkap || '',
            `${row.periode_tahun}-${String(row.periode_bulan).padStart(2, '0')}`,
            row.predikat_penilaian || '',
            row.jumlah_kehadiran || '',
            row.jumlah_hari_lembur || '',
            row.total_pendapatan || '',
            row.total_potongan || '',
            row.gaji_bersih || '',
            getNamaDivisi(divisiData, row.pegawai?.id_divisi) || '',
            getNamaJabatan(jabatanData, row.pegawai?.id_jabatan) || ''
        ]);
        
        const workSheetData = [headers, ...allData];
        
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(workSheetData);
        
        // Atur lebar kolom
        ws['!cols'] = headers.map(() => ({ wch: 20 }));
        
        XLSX.utils.book_append_sheet(wb, ws, "Penggajian");
        XLSX.writeFile(wb, `Laporan_Penggajian_${new Date().toLocaleDateString('id-ID')}.xlsx`);
        
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Excel berhasil diekspor',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    } catch (error) {
        console.error('Gagal ekspor Excel:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Gagal mengekspor Excel: ' + error.message
        });
    }
}

// Fungsi Ekspor CSV
function exportToCSV() {
    try {
        const table = $('#gaji-karyawan-table').DataTable();
        const headers = ['No', 'Nama Pegawai', 'Periode Gaji', 'Predikat', 'Kehadiran', 'Lembur', 
                        'Total Pendapatan', 'Total Potongan', 'Gaji Bersih', 'Divisi', 'Jabatan'];
        
        // Ambil data dari DataTable
        const allData = table.rows().data().toArray().map((row, index) => [
            index + 1,
            row.pegawai?.nama_lengkap || '',
            `${row.periode_tahun}-${String(row.periode_bulan).padStart(2, '0')}`,
            row.predikat_penilaian || '',
            row.jumlah_kehadiran || '',
            row.jumlah_hari_lembur || '',
            row.total_pendapatan || '',
            row.total_potongan || '',
            row.gaji_bersih || '',
            getNamaDivisi(divisiData, row.pegawai?.id_divisi) || '',
            getNamaJabatan(jabatanData, row.pegawai?.id_jabatan) || ''
        ]);
        
        const csvContent = [
            headers.join(','),
            ...allData.map(row => row.join(','))
        ].join('\n');
        
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        
        link.setAttribute('href', url);
        link.setAttribute('download', `Laporan_Penggajian_${new Date().toLocaleDateString('id-ID')}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'CSV berhasil diekspor',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    } catch (error) {
        console.error('Gagal ekspor CSV:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Gagal mengekspor CSV: ' + error.message
        });
    }
}

// Fungsi Salin Tabel
function copyTableToClipboard() {
    try {
        const table = $('#gaji-karyawan-table').DataTable();
        const headers = ['No', 'Nama Pegawai', 'Periode Gaji', 'Predikat', 'Kehadiran', 'Lembur', 
                        'Total Pendapatan', 'Total Potongan', 'Gaji Bersih', 'Divisi', 'Jabatan'];
        
        // Ambil data dari DataTable
        const allData = table.rows().data().toArray().map((row, index) => [
            index + 1,
            row.pegawai?.nama_lengkap || '',
            `${row.periode_tahun}-${String(row.periode_bulan).padStart(2, '0')}`,
            row.predikat_penilaian || '',
            row.jumlah_kehadiran || '',
            row.jumlah_hari_lembur || '',
            `Rp ${Number(row.total_pendapatan).toLocaleString('id-ID')}`,
            `Rp ${Number(row.total_potongan).toLocaleString('id-ID')}`,
            `Rp ${Number(row.gaji_bersih).toLocaleString('id-ID')}`,
            getNamaDivisi(divisiData, row.pegawai?.id_divisi) || '',
            getNamaJabatan(jabatanData, row.pegawai?.id_jabatan) || ''
        ]);
        
        let clipboardText = headers.join('\t') + '\n';
        allData.forEach(row => {
            clipboardText += row.join('\t') + '\n';
        });
        
        navigator.clipboard.writeText(clipboardText).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Tabel berhasil disalin ke clipboard',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        });
    } catch (error) {
        console.error('Gagal menyalin tabel:', error);
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'Gagal menyalin tabel: ' + error.message
        });
    }
}

// Event Listeners
$(document).ready(function() {
    $('#exportPdfBtn').on('click', function() {
        exportToPDF();
    });
    
    $('#exportExcelBtn').on('click', function() {
        exportToExcel();
    });
    
    $('#exportCsvBtn').on('click', function() {
        exportToCSV();
    });
    
    $('#copyTableBtn').on('click', function() {
        copyTableToClipboard();
    });
});

});
</script>
@endpush