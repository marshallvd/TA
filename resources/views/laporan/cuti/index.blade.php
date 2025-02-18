@extends('layouts.master')

@section('title') 
Laporan Cuti Pegawai 
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
                                    <i class="bi bi-info-circle text-primary"></i>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="border rounded p-3 bg-soft-primary me-3">
                                        <i class="bi bi-calendar-date text-primary"></i>
                                    </div>
                                    <h2 id="totalCutiCount" class="counter mb-0">0</h2>
                                </div>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#periodModal" data-chart-type="totalCuti">
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
                                    <span class="text-muted text-uppercase small">Status Pengajuan Cuti</span>
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
                                    <h2 id="statusCutiCount" class="counter mb-0">0</h2>
                                </div>
                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#periodModal" data-chart-type="statusCuti">
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
                                    <span class="text-muted text-uppercase small">Cuti per Divisi</span>
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
                                    <h2 id="cutiPerDivisiCount" class="counter mb-0">0</h2>
                                </div>
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#periodModal" data-chart-type="cutiPerDivisi">
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
                                    <span class="text-muted text-uppercase small">Cuti per Jabatan</span>
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
                                    <h2 id="cutiPerJabatanCount" class="counter mb-0">0</h2>
                                </div>
                                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#periodModal" data-chart-type="cutiPerJabatan">
                                    <i class="bi bi-graph-up me-1"></i>Grafik
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal untuk Input Periode -->
<div class="modal fade" id="periodModal" tabindex="-1" aria-labelledby="periodModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periodModalLabel">
                    <i class="bi bi-calendar-check me-2"></i>Pilih Periode Laporan Cuti
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="chartYearFilter" class="form-label">
                            <i class="bi bi-calendar-year me-2"></i>Tahun:
                        </label>
                        <select id="chartYearFilter" class="form-control">
                            <option value="">Pilih Tahun</option>
                            <!-- Tahun akan diisi dinamis -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="chartMonthFilter" class="form-label">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-primary" id="generateWidgetBtn">
                    <i class="bi bi-check-circle me-2"></i>Tampilkan
                </button>
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
                        <h4 class="card-title">Data Pengajuan Cuti</h4>
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
                        <div class="col-md-3">
                            <label for="yearFilter">
                                <i class="bi bi-calendar-year me-1"></i>Filter Tahun:
                            </label>
                            <select id="yearFilter" class="form-control">
                                <option value="">Semua Tahun</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="monthYearFilter">
                                <i class="bi bi-calendar-month me-1"></i>Filter Bulan & Tahun:
                            </label>
                            <input type="month" id="monthYearFilter" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="statusFilter">
                                <i class="bi bi-filter-square me-1"></i>Filter Status:
                            </label>
                            <select id="statusFilter" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="menunggu">Menunggu</option>
                                <option value="disetujui">Disetujui</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="leaveTypeFilter">
                                <i class="bi bi-filter-circle me-1"></i>Filter Jenis Cuti:
                            </label>
                            <select id="leaveTypeFilter" class="form-control">
                                <option value="">Semua Jenis Cuti</option>
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
                        <table id="cuti-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-hash me-1"></i>No</th>
                                    <th><i class="bi bi-person me-1"></i>Nama Pegawai</th>
                                    <th><i class="bi bi-card-list me-1"></i>Jenis Cuti</th>
                                    <th><i class="bi bi-calendar-event me-1"></i>Tanggal Mulai</th>
                                    <th><i class="bi bi-calendar-event me-1"></i>Tanggal Selesai</th>
                                    <th><i class="bi bi-check-square me-1"></i>Status</th>
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



<!-- Modal untuk Input Periode -->
<div class="modal fade" id="periodModal" tabindex="-1" aria-labelledby="periodModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periodModalLabel">
                    <i class="bi bi-calendar-check me-2"></i>Pilih Periode Laporan Cuti
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="chartYearFilter" class="form-label">
                            <i class="bi bi-calendar-year me-2"></i>Tahun:
                        </label>
                        <select id="chartYearFilter" class="form-control">
                            <option value="">Pilih Tahun</option>
                            <!-- Tahun akan diisi dinamis -->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="chartMonthFilter" class="form-label">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-primary" id="generateWidgetBtn">
                    <i class="bi bi-check-circle me-2"></i>Tampilkan
                </button>
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
    // Tambahkan di bagian paling awal script
    let cutiData = [];
    let pegawaiData = [];
    let divisiData = [];
    let jabatanData = [];
    let leaveTypes = [];
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

    // Fungsi untuk mendapatkan data berdasarkan periode
    function getFilteredData(data, year, month = '') {
        return data.filter(item => {
            const date = new Date(item.tanggal_mulai);
            if (month) {
                return date.getFullYear() === parseInt(year) && 
                    (date.getMonth() + 1) === parseInt(month);
            }
            return date.getFullYear() === parseInt(year);
        });
    }

    function updateWidgets() {
        // Ambil data periode saat ini
        const currentPeriodData = getCurrentPeriodData(cutiData);

        // Update Total Pengajuan Cuti untuk periode saat ini
        $('#totalCutiCount').text(currentPeriodData.length);

        // Update Status Cuti untuk periode saat ini
        const statusCounts = currentPeriodData.reduce((acc, curr) => {
            const status = curr.status === 'pending' ? 'menunggu' : curr.status;
            acc[status] = (acc[status] || 0) + 1;
            return acc;
        }, {});

        // Update tampilan status dengan badge
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

        // Hitung jumlah divisi yang memiliki cuti pada periode saat ini
        const divisiCounts = currentPeriodData.reduce((acc, curr) => {
            const pegawai = pegawaiData.find(p => p.id_pegawai === curr.id_pegawai);
            if (pegawai) {
                const divisi = pegawai.id_divisi;
                acc[divisi] = (acc[divisi] || 0) + 1;
            }
            return acc;
        }, {});

        // Hitung jumlah jabatan yang memiliki cuti pada periode saat ini
        const jabatanCounts = currentPeriodData.reduce((acc, curr) => {
            const pegawai = pegawaiData.find(p => p.id_pegawai === curr.id_pegawai);
            if (pegawai) {
                const jabatan = pegawai.id_jabatan;
                acc[jabatan] = (acc[jabatan] || 0) + 1;
            }
            return acc;
        }, {});

        // Update counts untuk divisi dan jabatan
        $('#cutiPerDivisiCount').text(Object.keys(divisiCounts).length);
        $('#cutiPerJabatanCount').text(Object.keys(jabatanCounts).length);
    }
        
// Fungsi untuk memfilter data grafik berdasarkan periode yang dipilih
function getFilteredChartData(year, month) {
    return cutiData.filter(item => {
        const itemDate = new Date(item.tanggal_mulai);
        if (month) {
            return itemDate.getFullYear() === parseInt(year) && 
                (itemDate.getMonth() + 1) === parseInt(month);
        }
        return itemDate.getFullYear() === parseInt(year);
    });
}


        $(document).ready(function() {
    // Event listener untuk tombol grafik
    // Event listener untuk tombol grafik
$('[data-bs-target="#periodModal"]').on('click', function() {
    const chartType = $(this).data('chart-type');
    $('#periodModal').data('chart-type', chartType);
});

// Event handler untuk tombol Tampilkan di modal periode
// Modifikasi event handler untuk tombol Tampilkan
$('#generateWidgetBtn').on('click', function() {
    const year = $('#chartYearFilter').val();
    const month = $('#chartMonthFilter').val();
    
    if (!year) {
        showErrorAlert('Silakan pilih tahun terlebih dahulu');
        return;
    }
    
    // Filter data untuk grafik
    const filteredData = getFilteredData(cutiData, year, month);
    
    // Tutup modal periode
    const periodModal = bootstrap.Modal.getInstance($('#periodModal'));
    if (periodModal) {
        periodModal.hide();
    }
    // Tambahkan pembersihan tambahan
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $('body').css({
        'overflow': '',
        'padding-right': ''
    });

    if (filteredData.length === 0) {
        Swal.fire({
            icon: 'info',
            title: 'Tidak Ada Data',
            text: 'Tidak terdapat data cuti untuk periode yang dipilih.',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            didClose: () => {
                // Pastikan body dan modal backdrop dibersihkan
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('body').css({
                    'overflow': '',
                    'padding-right': ''
                });
            }
        });
        
        return; // Hentikan proses selanjutnya
    }

    // Tunggu sebentar sebelum membuka modal chart
    setTimeout(() => {
        // Pastikan tidak ada backdrop yang tersisa
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open').css('padding-right', '');
        
        // Buka modal chart dengan backdrop baru
        const chartModal = new bootstrap.Modal($('#chartModal'), {
            backdrop: 'static', // atau true untuk backdrop yang bisa diklik
            keyboard: false
        });
        chartModal.show();
        
        const chartType = $('#periodModal').data('chart-type');
        if (cutiData && pegawaiData) {
            loadChart(chartType, filteredData, pegawaiData, divisiData, jabatanData);
        }
    }, 300); // Tambahkan delay yang cukup
});

// Tambahkan event listener untuk membersihkan backdrop dan modal
$(document).ready(function() {
    // Event listener untuk menutup modal
    $('.modal').on('hidden.bs.modal', function () {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $('body').css({
            'overflow': '',
            'padding-right': ''
        });
    });
});

// // Tambahkan ini untuk memastikan pembersihan yang tepat saat modal ditutup
// $('#chartModal').on('hidden.bs.modal', function () {
//     // Bersihkan modal-open class dan backdrop jika masih ada
//     $('body').removeClass('modal-open');
//     $('.modal-backdrop').remove();
//     $('body').css('padding-right', '');
// });

// Event listener untuk tombol close modal
$('.btn-close, [data-bs-dismiss="modal"]').on('click', function() {
    const modal = $(this).closest('.modal');
    const modalInstance = bootstrap.Modal.getInstance(modal);
    
    if (modalInstance) {
        modalInstance.hide();
        
        // Bersihkan setelah modal tertutup
        setTimeout(() => {
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            $('body').css({
                'padding-right': '',
                'overflow': ''
            });
        }, 150);
    }
});

// Tambahkan event listener untuk escape key
$(document).on('keydown', function(e) {
    if (e.key === 'Escape') {
        // Tutup semua modal yang terbuka
        $('.modal').each(function() {
            const modalInstance = bootstrap.Modal.getInstance(this);
            if (modalInstance) {
                modalInstance.hide();
            }
        });
        
        // Bersihkan backdrop dan styling
        setTimeout(() => {
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            $('body').css({
                'padding-right': '',
                'overflow': ''
            });
        }, 150);
    }
});
});






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
                    return meta.row + meta.settings._iDisplayStart + 1;
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

    function getCurrentPeriodData(cutiData) {
        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();  // 2025
        const currentMonth = currentDate.getMonth() + 1; // 1 (Januari)

        return cutiData.filter(item => {
            const itemDate = new Date(item.tanggal_mulai);
            return itemDate.getFullYear() === currentYear && 
                (itemDate.getMonth() + 1) === currentMonth;
        });
    }


    function loadFilteredChart(chartType, year, month) {
        const filteredData = getFilteredData(cutiData, year, month);
        loadChart(chartType, filteredData, pegawaiData, divisiData, jabatanData);
    }
    // Fungsi Utama Memuat Data
    function initializePage() {
        const currentYear = new Date().getFullYear();
        const currentMonth = (new Date().getMonth() + 1).toString().padStart(2, '0');
        const uniqueYears = [];

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

            cutiData = fetchedCutiData;
            pegawaiData = fetchedPegawaiData;
            divisiData = fetchedDivisiData;
            jabatanData = fetchedJabatanData;
            leaveTypes = fetchedLeaveTypes;



            updateWidgets();
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

                    // Populate tahun di modal periode
        $('#chartYearFilter').empty().append('<option value="">Pilih Tahun</option>');
        uniqueYears.forEach(year => {
            $('#chartYearFilter').append(`<option value="${year}">${year}</option>`);
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

// Tambahkan di dalam document.ready
$(document).ready(function() {
    if (checkTokenValidity()) {
        initializePage();
    }
    updateWidgets();

});

    function loadChart(chartType, cutiData, pegawaiData, divisiData, jabatanData) {

        if (cutiData.length === 0) {
        Swal.fire({
            icon: 'info',
            title: 'Tidak Ada Data',
            text: 'Tidak terdapat data cuti untuk divisualisasikan.',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        return;
    }
    const ctx = document.getElementById('chartCanvas').getContext('2d');
    let chartData;

    // Warna yang lebih variatif dan konsisten
    const colorPalettes = {
        totalCuti: [
            '#4CAF50', '#2196F3', '#FFC107', '#E91E63', '#9C27B0', 
            '#00BCD4', '#FF9800', '#795548', '#607D8B', '#3F51B5'
        ],
        statusCuti: [
            '#4CAF50', '#2196F3', '#FFC107', '#E91E63', '#9C27B0', 
            '#00BCD4', '#FF9800', '#795548', '#607D8B', '#3F51B5'
        ],
        cutiPerDivisi: [
            '#4CAF50', '#2196F3', '#FFC107', '#E91E63', '#9C27B0', 
            '#00BCD4', '#FF9800', '#795548', '#607D8B', '#3F51B5'
        ],
        cutiPerJabatan: [
            '#4CAF50', '#2196F3', '#FFC107', '#E91E63', '#9C27B0', 
            '#00BCD4', '#FF9800', '#795548', '#607D8B', '#3F51B5'
        ]
    };

    // Fungsi pembantu untuk mendapatkan nama jabatan/divisi
    function getNamaJabatan(idJabatan) {
        const jabatan = jabatanData.find(j => j.id_jabatan === idJabatan);
        return jabatan ? jabatan.nama_jabatan : 'Tidak diketahui';
    }

    function getNamaDivisi(idDivisi) {
        const divisi = divisiData.find(d => d.id_divisi === idDivisi);
        return divisi ? divisi.nama_divisi : 'Tidak diketahui';
    }

    switch (chartType) {
        case 'totalCuti':
            const employeeCutiCounts = cutiData.reduce((acc, curr) => {
                const pegawai = pegawaiData.find(p => p.id_pegawai === curr.id_pegawai);
                const employeeName = pegawai ? pegawai.nama_lengkap : 'Tidak diketahui';
                acc[employeeName] = (acc[employeeName] || 0) + 1;
                return acc;
            }, {});

            chartData = {
                labels: Object.keys(employeeCutiCounts),
                datasets: [{
                    label: 'Total Pengajuan Cuti',
                    data: Object.values(employeeCutiCounts),
                    backgroundColor: colorPalettes.totalCuti.slice(0, Object.keys(employeeCutiCounts).length),
                    borderWidth: 1
                }]
            };
            break;

        case 'statusCuti':
            const statusCounts = cutiData.reduce((acc, curr) => {
                const status = curr.status === 'pending' ? 'menunggu' : curr.status;
                acc[status] = (acc[status] || 0) + 1;
                return acc;
            }, {});

            chartData = {
                labels: Object.keys(statusCounts).map(status => 
                    status.charAt(0).toUpperCase() + status.slice(1)
                ),
                datasets: [{
                    label: 'Status Pengajuan Cuti',
                    data: Object.values(statusCounts),
                    backgroundColor: colorPalettes.statusCuti.slice(0, Object.keys(statusCounts).length),
                    borderWidth: 1
                }]
            };
            break;

        case 'cutiPerDivisi':
            const divisiCutiCounts = cutiData.reduce((acc, curr) => {
                const pegawai = pegawaiData.find(p => p.id_pegawai === curr.id_pegawai);
                if (pegawai) {
                    const divisi = divisiData.find(d => d.id_divisi === pegawai.id_divisi);
                    const divisiName = divisi ? divisi.nama_divisi : 'Tidak Diketahui';
                    acc[divisiName] = (acc[divisiName] || 0) + 1;
                }
                return acc;
            }, {});

            chartData = {
                labels: Object.keys(divisiCutiCounts),
                datasets: [{
                    label: 'Jumlah Cuti per Divisi',
                    data: Object.values(divisiCutiCounts),
                    backgroundColor: colorPalettes.cutiPerDivisi.slice(0, Object.keys(divisiCutiCounts).length),
                    borderWidth: 1
                }]
            };
            break;

        case 'cutiPerJabatan':
            const jabatanCutiCounts = cutiData.reduce((acc, curr) => {
                const pegawai = pegawaiData.find(p => p.id_pegawai === curr.id_pegawai);
                if (pegawai) {
                    const jabatan = jabatanData.find(j => j.id_jabatan === pegawai.id_jabatan);
                    const jabatanName = jabatan ? jabatan.nama_jabatan : 'Tidak Diketahui';
                    acc[jabatanName] = (acc[jabatanName] || 0) + 1;
                }
                return acc;
            }, {});

            chartData = {
                labels: Object.keys(jabatanCutiCounts),
                datasets: [{
                    label: 'Jumlah Cuti per Jabatan',
                    data: Object.values(jabatanCutiCounts),
                    backgroundColor: colorPalettes.cutiPerJabatan.slice(0, Object.keys(jabatanCutiCounts).length),
                    borderWidth: 1
                }]
            };
            break;

        default:
            return;
    }

    // Hapus chart sebelumnya jika ada
    if (window.chart) {
        window.chart.destroy();
    }

    // Buat chart baru dengan konfigurasi yang konsisten
    window.chart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                },
                title: {
                    display: true,
                    text: `Grafik ${chartData.datasets[0].label}`,
                    font: {
                        size: 30
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        font: {
                            size: 22
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            },
            layout: {
                padding: {
                    left: 15,
                    right: 15,
                    top: 15,
                    bottom: 15
                }
            }
        }
    });
}

// Event Listener untuk Chart Modal
$(document).ready(function() {
    $('#chartModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const chartType = button.data('chart-type');
        
        if (typeof Chart !== 'undefined' && cutiData && cutiData.length > 0) {
            loadChart(
                chartType, 
                cutiData, 
                pegawaiData, 
                divisiData, 
                jabatanData
            );
        } else {
            console.error('Chart.js not loaded or data not available');
        }
    });
});
// Fungsi Alert Sederhana
function showSuccessAlert(message) {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
}

function showErrorAlert(message) {
    Swal.fire({
        icon: 'error',
        title: 'Kesalahan',
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
}

// Fungsi Ekspor PDF
function exportToPDF() {
    try {
        const table = $('#cuti-table').DataTable();
        const visibleData = table.rows({ search: 'applied' }).data().toArray();
        const doc = new jspdf.jsPDF({
            orientation: 'landscape',
            unit: 'mm',
            format: 'a4'
        });

        doc.text("Laporan Cuti Pegawai", 14, 15);
        
        // Persiapkan data yang terlihat dengan penomoran baru
        const tableData = visibleData.map((row, index) => ({
            no: (index + 1).toString(),
            nama: pegawaiData.find(p => p.id_pegawai === row.id_pegawai)?.nama_lengkap || 'Tidak diketahui',
            jenis_cuti: leaveTypes.find(j => j.id_jenis_cuti === row.id_jenis_cuti)?.nama_jenis_cuti || 'Tidak diketahui',
            tanggal_mulai: new Date(row.tanggal_mulai).toLocaleDateString('id-ID'),
            tanggal_selesai: new Date(row.tanggal_selesai).toLocaleDateString('id-ID'),
            status: row.status,
            divisi: getNamaDivisi(divisiData, pegawaiData.find(p => p.id_pegawai === row.id_pegawai)?.id_divisi),
            jabatan: getNamaJabatan(jabatanData, pegawaiData.find(p => p.id_pegawai === row.id_pegawai)?.id_jabatan)
        }));

        doc.autoTable({
            head: [['No', 'Nama Pegawai', 'Jenis Cuti', 'Tanggal Mulai', 'Tanggal Selesai', 'Status', 'Divisi', 'Jabatan']],
            body: tableData.map(row => [
                row.no,
                row.nama,
                row.jenis_cuti,
                row.tanggal_mulai,
                row.tanggal_selesai,
                row.status,
                row.divisi,
                row.jabatan
            ]),
            startY: 25,
            styles: { fontSize: 8, cellPadding: 2 },
            columnStyles: {
                0: { cellWidth: 10 },
                1: { cellWidth: 40 },
                2: { cellWidth: 30 },
                3: { cellWidth: 25 },
                4: { cellWidth: 25 },
                5: { cellWidth: 20 },
                6: { cellWidth: 25 },
                7: { cellWidth: 25 }
            }
        });
        
        doc.save(`Laporan_Cuti_${new Date().toLocaleDateString('id-ID')}.pdf`);
        
        showSuccessAlert('PDF berhasil diekspor');
    } catch (error) {
        console.error('Gagal ekspor PDF:', error);
        showErrorAlert('Gagal mengekspor PDF: ' + error.message);
    }
}

// Fungsi Ekspor Excel
function exportToExcel() {
    try {
        const table = $('#cuti-table').DataTable();
        const visibleData = table.rows({ search: 'applied' }).data().toArray();
        
        // Persiapkan data yang terlihat dengan penomoran baru
        const tableData = visibleData.map((row, index) => ({
            'No': index + 1,
            'Nama Pegawai': pegawaiData.find(p => p.id_pegawai === row.id_pegawai)?.nama_lengkap || 'Tidak diketahui',
            'Jenis Cuti': leaveTypes.find(j => j.id_jenis_cuti === row.id_jenis_cuti)?.nama_jenis_cuti || 'Tidak diketahui',
            'Tanggal Mulai': new Date(row.tanggal_mulai).toLocaleDateString('id-ID'),
            'Tanggal Selesai': new Date(row.tanggal_selesai).toLocaleDateString('id-ID'),
            'Status': row.status,
            'Divisi': getNamaDivisi(divisiData, pegawaiData.find(p => p.id_pegawai === row.id_pegawai)?.id_divisi),
            'Jabatan': getNamaJabatan(jabatanData, pegawaiData.find(p => p.id_pegawai === row.id_pegawai)?.id_jabatan)
        }));

        const ws = XLSX.utils.json_to_sheet(tableData);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Laporan Cuti");
        
        XLSX.writeFile(wb, `Laporan_Cuti_${new Date().toLocaleDateString('id-ID')}.xlsx`);
        
        showSuccessAlert('Excel berhasil diekspor');
    } catch (error) {
        console.error('Gagal ekspor Excel:', error);
        showErrorAlert('Gagal mengekspor Excel: ' + error.message);
    }
}

// Fungsi Ekspor CSV
function exportToCSV() {
    try {
        const table = $('#cuti-table').DataTable();
        const visibleData = table.rows({ search: 'applied' }).data().toArray();
        
        // Header untuk CSV
        const headers = ['No', 'Nama Pegawai', 'Jenis Cuti', 'Tanggal Mulai', 'Tanggal Selesai', 'Status', 'Divisi', 'Jabatan'];
        
        // Persiapkan data yang terlihat dengan penomoran baru
        const tableData = visibleData.map((row, index) => [
            index + 1,
            pegawaiData.find(p => p.id_pegawai === row.id_pegawai)?.nama_lengkap || 'Tidak diketahui',
            leaveTypes.find(j => j.id_jenis_cuti === row.id_jenis_cuti)?.nama_jenis_cuti || 'Tidak diketahui',
            new Date(row.tanggal_mulai).toLocaleDateString('id-ID'),
            new Date(row.tanggal_selesai).toLocaleDateString('id-ID'),
            row.status,
            getNamaDivisi(divisiData, pegawaiData.find(p => p.id_pegawai === row.id_pegawai)?.id_divisi),
            getNamaJabatan(jabatanData, pegawaiData.find(p => p.id_pegawai === row.id_pegawai)?.id_jabatan)
        ]);
        
        const csvContent = [
            headers.join(','),
            ...tableData.map(row => row.join(','))
        ].join('\n');
        
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        
        link.setAttribute('href', url);
        link.setAttribute('download', `Laporan_Cuti_${new Date().toLocaleDateString('id-ID')}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        
        showSuccessAlert('CSV berhasil diekspor');
    } catch (error) {
        console.error('Gagal ekspor CSV:', error);
        showErrorAlert('Gagal mengekspor CSV: ' + error.message);
    }
}

// Fungsi Salin Tabel
function copyTableToClipboard() {
    try {
        const table = $('#cuti-table').DataTable();
        const visibleData = table.rows({ search: 'applied' }).data().toArray();
        
        // Header untuk clipboard
        const headers = ['No', 'Nama Pegawai', 'Jenis Cuti', 'Tanggal Mulai', 'Tanggal Selesai', 'Status', 'Divisi', 'Jabatan'];
        
        // Persiapkan data yang terlihat dengan penomoran baru
        const tableData = visibleData.map((row, index) => [
            index + 1,
            pegawaiData.find(p => p.id_pegawai === row.id_pegawai)?.nama_lengkap || 'Tidak diketahui',
            leaveTypes.find(j => j.id_jenis_cuti === row.id_jenis_cuti)?.nama_jenis_cuti || 'Tidak diketahui',
            new Date(row.tanggal_mulai).toLocaleDateString('id-ID'),
            new Date(row.tanggal_selesai).toLocaleDateString('id-ID'),
            row.status,
            getNamaDivisi(divisiData, pegawaiData.find(p => p.id_pegawai === row.id_pegawai)?.id_divisi),
            getNamaJabatan(jabatanData, pegawaiData.find(p => p.id_pegawai === row.id_pegawai)?.id_jabatan)
        ]);
        
        let clipboardText = headers.join('\t') + '\n';
        tableData.forEach(row => {
            clipboardText += row.join('\t') + '\n';
        });
        
        navigator.clipboard.writeText(clipboardText).then(() => {
            showSuccessAlert('Tabel berhasil disalin ke clipboard');
        });
    } catch (error) {
        console.error('Gagal menyalin tabel:', error);
        showErrorAlert('Gagal menyalin tabel: ' + error.message);
    }
}

// Event Listeners untuk Tombol Ekspor dan Salin
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

<!-- SweetAlert2 untuk alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- jsPDF untuk PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.15/jspdf.plugin.autotable.min.js"></script>

<!-- SheetJS untuk Excel dan CSV -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

<!-- Bootstrap JS dan Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

@endpush