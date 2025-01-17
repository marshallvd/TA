@extends('layouts.master')

@section('title') 
Laporan Kepegawaian 
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
                            <b><h2 class="card-title mb-1">Laporan Kepegawaian</h2></b>
                            <p class="card-text text-muted">Human Resource Management System SEB</p>
                        </div>
                        <div>
                            <i class="bi bi-people-fill text-primary" style="font-size: 3rem;"></i>
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
                        <span class="text-muted text-uppercase small">Jumlah Pegawai Aktif</span>
                    </div>
                    <div>
                        <i class="bi bi-person-check text-primary"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="border rounded p-3 bg-soft-primary me-3">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h2 id="activeEmployeesCount" class="counter mb-0">0</h2>
                    </div>
                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="activeEmployees">
                        <i class="bi bi-bar-chart-fill me-1"></i>Grafik
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
                        <span class="text-muted text-uppercase small">Pegawai per Jenis Kelamin</span>
                    </div>
                    <div>
                        <i class="bi bi-gender-ambiguous text-success"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="border rounded p-3 bg-soft-success me-3">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h2 id="genderCount" class="counter mb-0">0</h2>
                    </div>
                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="genderCount">
                        <i class="bi bi-bar-chart-fill me-1"></i>Grafik
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
                        <span class="text-muted text-uppercase small">Jumlah Divisi</span>
                    </div>
                    <div>
                        <i class="bi bi-diagram-3 text-info"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="border rounded p-3 bg-soft-info me-3">
                            <i class="bi bi-building-fill"></i>
                        </div>
                        <h2 id="employeesByDivisionCount" class="counter mb-0">0</h2>
                    </div>
                    <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="employeesByDivision">
                        <i class="bi bi-bar-chart-fill me-1"></i>Grafik
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
                        <span class="text-muted text-uppercase small">Jumlah Jabatan</span>
                    </div>
                    <div>
                        <i class="bi bi-person-badge text-warning"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="border rounded p-3 bg-soft-warning me-3">
                            <i class="bi bi-person-workspace"></i>
                        </div>
                        <h2 id="employeesByPositionCount" class="counter mb-0">0</h2>
                    </div>
                    <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="employeesByPosition">
                        <i class="bi bi-bar-chart-fill me-1"></i>Grafik
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

            <!-- Modal for Chart -->
            <div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
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
                        <h4 class="card-title">Data Kepegawaian</h4>
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
                    <!-- Insights Section -->
                    <div id="insightsSection" class="row mb-4" style="display:none;">
                        <div class="col-md-3">
                            <div class="card bg-soft-primary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title">Jumlah Pegawai Aktif</h5>
                                            <h3 id="activeEmployeesCount">0</h3>
                                        </div>
                                        <i class="bi bi-people fa-2x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-soft-success">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title">Jumlah Pegawai Berdasarkan Jenis Kelamin</h5>
                                            <h3 id="genderCount">0</h3>
                                        </div>
                                        <i class="bi bi-gender-ambiguous fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-soft-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title">Jumlah Pegawai per Divisi</h5>
                                            <h3 id="employeesByDivisionCount">0</h3>
                                        </div>
                                        <i class="bi bi-building fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-soft-warning">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title">Jumlah Pegawai per Jabatan</h5>
                                            <h3 id="employeesByPositionCount">0</h3>
                                        </div>
                                        <i class="bi bi-person-workspace fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="card-body">
                    <!-- Enhanced Filtering Section -->
                    <div class="row mb-4">
                        <div class="col-md-2">
                                <label for="filterJenisKelamin" class="form-label">
                                    <i class="bi bi-gender-ambiguous me-2"></i>Jenis Kelamin
                                </label>
                                <select class="form-select" id="filterJenisKelamin">
                                    <option value="">Semua</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                        </div>
                        <div class="col-md-2">
                                <label for="filterDivisi" class="form-label">
                                    <i class="bi bi-building me-2"></i>Divisi
                                </label>
                                <select class="form-select" id="filterDivisi">
                                    <option value="">Semua</option>
                                </select>
                        </div>
                        <div class="col-md-2">
                                <label for="filterJabatan" class="form-label">
                                    <i class="bi bi-person-workspace me-2"></i>Jabatan
                                </label>
                                <select class="form-select" id="filterJabatan">
                                    <option value="">Semua</option>
                                </select>
                        </div>
                        <div class="col-md-2">
                                <label for="filterStatus" class="form-label">
                                    <i class="bi bi-toggle-on me-2"></i>Status
                                </label>
                                <select class="form-select" id="filterStatus">
                                    <option value="">Semua</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                        </div>
                        

                        <!-- Filter Buttons -->
                        
                        <div class="col-md-2 d-flex align-items-end">
                            <button id="applyFilterBtn" class="btn btn-primary me-2">
                                    <i class="bi bi-funnel me-2"></i>Terapkan Filter
                                </button>
                                <button id="resetFilterBtn" class="btn btn-secondary">
                                    <i class="bi bi-arrow-counterclockwise me-2"></i>Reset Filter
                                </button>
                        </div>
                    </div>

                        <!-- Tabel Pegawai -->
                        <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="pegawai-list-table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Telepon</th>
                                            <th>Email</th>
                                            <th>Jabatan</th>
                                            <th>Divisi</th>
                                            <th>Status</th>
                                            <th>Tanggal Masuk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data akan dimasukkan di sini -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
        /* Additional styles for the new widgets */
     /* Soft background colors */
    .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); }
    .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); }
    .bg-soft-info { background-color: rgba(13, 202, 240, 0.1); }
    .bg-soft-warning { background-color: rgba(255, 193, 7, 0.1); }

    /* Card styles */
    .card {
        background-color: white;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        transform: translateY(-5px);
    }

    /* Icon styles */
    .icon-20 {
        width: 20px;
        height: 20px;
    }

    /* Small icon boxes */
    .border.rounded.p-3 {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
    }

    /* Button styles */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px; 
        margin-bottom: 20px;
    }

    .card h5 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card h3 {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .card button {
        font-size: 16px;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }

    .card button:hover {
        background-color: #0056b3;
    }

    .modal-content {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        max-height: 180vh; /* Atur tinggi maksimum modal */

    }

    .modal-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .modal-xl {
        max-width: 100%; /* Menggunakan persentase dari lebar layar */
    }
    
    .modal-body {
        max-height: 180vh; /* Atur tinggi maksimum modal */
        overflow-y: auto; /* Tambahkan scroll jika konten melebihi tinggi */
    }
    
    /* Mengatur minimum height untuk container grafik */
    #chartCanvas {
        min-height: 1800px;
    }
    
    /* Media queries untuk responsivitas */
    @media (max-width: 768px) {
        .modal-xl {
            max-width: 95%;
        }
        
        #chartCanvas {
            min-height: 300px;
        }
    }
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables Core -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>

<!-- Tambahan ekstensi untuk tombol -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>


<!-- jsPDF untuk PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.15/jspdf.plugin.autotable.min.js"></script>

<!-- SheetJS untuk Excel dan CSV -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>



<script>
 document.addEventListener('DOMContentLoaded', function() {
    // Konfigurasi Awal
    const token = localStorage.getItem('token');
    let pegawaiData = [];
    let divisiData = [];
    let jabatanData = [];

    // Fungsi Error Handling
    function showErrorAlert(message) {
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: message,
            showConfirmButton: true
        });
    }

    // Fungsi Fetch Data dengan Error Handling Komprehensif
    async function fetchData(endpoint) {
        try {
            // Validasi Token
            if (!token) {
                showErrorAlert('Sesi login habis. Silakan login kembali.');
                window.location.href = '/login';
                return [];
            }

            const response = await fetch(`${API_BASE_URL}/${endpoint}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                const errorData = await response.json();
                console.error('Fetch Error:', errorData);
                showErrorAlert(errorData.message || 'Gagal mengambil data');
                return [];
            }

            const data = await response.json();
            return data.data || data;
        } catch (error) {
            console.error('Network Error:', error);
            showErrorAlert('Koneksi bermasalah. Periksa koneksi internet Anda.');
            return [];
        }
    }

    // Inisialisasi DataTable dengan Konfigurasi Lengkap
    const pegawaiTable = $('#pegawai-list-table').DataTable({
    processing: true,
    serverSide: false,
    responsive: true,
    pageLength: 10,
    ajax: {
        url: `${API_BASE_URL}/pegawai`,
        type: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`
        },
        dataSrc: 'data'
    },
    columns: [
        { 
            data: null, 
            render: function(data, type, row, meta) {
                return meta.row + 1;
            }
        },
        { data: 'nama_lengkap', defaultContent: '-' },
        { data: 'jenis_kelamin', defaultContent: '-' },
        { data: 'telepon', defaultContent: '-' },
        { data: 'email', defaultContent: '-' },
        { data: 'jabatan.nama_jabatan', defaultContent: '-' }, // Mengakses nama jabatan
        { data: 'divisi.nama_divisi', defaultContent: '-' }, // Mengakses nama divisi
        { data: 'status_kepegawaian', defaultContent: '-' },
        { data: 'tanggal_masuk', defaultContent: '-' }
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
    }
});

    // Fungsi Utilitas
    function getNamaJabatan(jabatanData, idJabatan) {
        const jabatan = jabatanData.find(j => j.id_jabatan === idJabatan);
        return jabatan ? jabatan.nama_jabatan : 'Tidak diketahui';
    }

    function getNamaDivisi(divisiData, idDivisi) {
        const divisi = divisiData.find(d => d.id_divisi === idDivisi);
        return divisi ? divisi.nama_divisi : 'Tidak diketahui';
    }

    function logDataStructure(data, label = 'Data Structure') {
    console.log(`=== ${label} ===`);
    console.log('Type:', typeof data);
    console.log('Value:', data);
    if (Array.isArray(data)) {
        console.log('Length:', data.length);
        if (data.length > 0) {
            console.log('First item sample:', data[0]);
        }
    }
    console.log('================');
}

    // Fungsi Statistik Komprehensif
    function calculateComprehensiveStatistics(pegawaiData, divisiData, jabatanData) {
    try {
        // Ekstrak data dari response API jika diperlukan
        const employees = pegawaiData?.data || pegawaiData || [];
        const divisions = divisiData?.data || divisiData || [];
        const positions = jabatanData?.data || jabatanData || [];

        const stats = {
            // Hitung pegawai aktif
            pegawaiAktif: employees.filter(p => p?.status_kepegawaian?.toLowerCase() === 'aktif').length,
            
            // Hitung berdasarkan jenis kelamin
            jenisKelamin: {
                laki: employees.filter(p => p?.jenis_kelamin === 'L').length,
                perempuan: employees.filter(p => p?.jenis_kelamin === 'P').length
            },
            
            // Jumlah total divisi dari data API divisi
            totalDivisi: divisions.length,
            
            // Jumlah total jabatan dari data API jabatan
            totalJabatan: positions.length
        };

        return stats;
    } catch (error) {
        console.error('Error calculating statistics:', error);
        return {
            pegawaiAktif: 0,
            jenisKelamin: { laki: 0, perempuan: 0 },
            totalDivisi: 0,
            totalJabatan: 0
        };
    }
}


// // Perbaiki fungsi initializeDivisiDropdown
// function initializeDivisiDropdown(divisiData) {
//     const $select = $('#filterDivisi');
//     $select.empty().append('<option value="">Semua</option>');
    
//     if (Array.isArray(divisiData)) {
//         divisiData.forEach(divisi => {
//             $select.append(`
//                 <option value="${divisi.id_divisi}">
//                     ${divisi.nama_divisi}
//                 </option>
//             `);
//         });
//     }
// }

// // Perbaiki fungsi initializeJabatanDropdown
// function initializeJabatanDropdown(jabatanData) {
//     const $select = $('#filterJabatan');
//     $select.empty().append('<option value="">Semua</option>');
    
//     if (Array.isArray(jabatanData)) {
//         jabatanData.forEach(jabatan => {
//             $select.append(`
//                 <option value="${jabatan.id_jabatan}">
//                     ${jabatan.nama_jabatan}
//                 </option>
//             `);
//         });
//     }
// }



    // Setup Filter Dinamis Lanjutan
    function populateDropdown(selector, data, namaField, idField) {
    const $select = $(selector);
    $select.empty().append('<option value="">Semua</option>');
    
    try {
        // Ensure we have valid data
        if (!data || (!Array.isArray(data) && !Array.isArray(data.data))) {
            console.warn(`No valid data provided for ${selector}`);
            return;
        }

        // Handle both direct array and nested data property
        const items = Array.isArray(data) ? data : data.data;

        items.forEach(item => {
            if (item && item[idField] && item[namaField]) {
                $select.append(`
                    <option value="${item[idField]}">
                        ${item[namaField]}
                    </option>
                `);
            }
        });

        console.log(`Successfully populated ${selector} with ${items.length} items`);
    } catch (error) {
        console.error(`Error populating dropdown ${selector}:`, error);
    }
}

function setupAdvancedDynamicFilters() {
    // Populate initial dropdowns
    populateDropdown('#filterDivisi', divisiData, 'nama_divisi', 'id_divisi');
    populateDropdown('#filterJabatan', jabatanData, 'nama_jabatan', 'id_jabatan');

    // Event listener for divisi change
    $('#filterDivisi').on('change', function() {
        const selectedDivisiId = $(this).val();
        const $jabatanSelect = $('#filterJabatan');
        
        // Reset jabatan dropdown
        $jabatanSelect.empty().append('<option value="">Semua</option>');
        
        if (selectedDivisiId && jabatanData) {
            // Filter jabatan based on selected divisi
            const jabatanArray = Array.isArray(jabatanData) ? jabatanData : jabatanData.data;
            const filteredJabatan = jabatanArray.filter(
                jabatan => jabatan.id_divisi === parseInt(selectedDivisiId)
            );
            
            // Populate filtered jabatan
            filteredJabatan.forEach(jabatan => {
                $jabatanSelect.append(`
                    <option value="${jabatan.id_jabatan}">
                        ${jabatan.nama_jabatan}
                    </option>
                `);
            });
            
            console.log(`Filtered ${filteredJabatan.length} jabatan for divisi ${selectedDivisiId}`);
        }
    });

    // Custom filtering function for DataTable
// Custom filtering function for DataTable
$.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
    const jenisKelamin = $('#filterJenisKelamin').val();
    const divisi = $('#filterDivisi').val();
    const jabatan = $('#filterJabatan').val();
    const status = $('#filterStatus').val();

    // Get row data
    const rowData = pegawaiTable.row(dataIndex).data();

    // Match conditions
    const matchJenisKelamin = !jenisKelamin || rowData.jenis_kelamin === jenisKelamin;
    const matchDivisi = !divisi || rowData.divisi.id_divisi.toString() === divisi;
    const matchJabatan = !jabatan || rowData.jabatan.id_jabatan.toString() === jabatan;
    const matchStatus = !status || rowData.status_kepegawaian.toLowerCase() === status.toLowerCase();

    return matchJenisKelamin && matchDivisi && matchJabatan && matchStatus;
});

    // Button event handlers
    $('#applyFilterBtn').on('click', function() {
        console.log('Applying filters...');
        pegawaiTable.draw();
    });

    $('#resetFilterBtn').on('click', function() {
        console.log('Resetting filters...');
        $('#filterJenisKelamin, #filterDivisi, #filterJabatan, #filterStatus').val('');
        populateDropdown('#filterDivisi', divisiData, 'nama_divisi', 'id_divisi');
        populateDropdown('#filterJabatan', jabatanData, 'nama_jabatan', 'id_jabatan');
        pegawaiTable.draw();
    });
}


    // Fungsi Utama Memuat Data
    function initializePage() {
    Promise.all([
        fetchData('pegawai'),
        fetchData('divisi'),
        fetchData('jabatan')
    ]).then(([fetchedPegawaiData, fetchedDivisiData, fetchedJabatanData]) => {
        try {
            // Store the fetched data
            pegawaiData = fetchedPegawaiData?.data || fetchedPegawaiData;
            divisiData = fetchedDivisiData?.data || fetchedDivisiData;
            jabatanData = fetchedJabatanData?.data || fetchedJabatanData;

            console.log('Initializing with data:', {
                pegawai: pegawaiData,
                divisi: divisiData,
                jabatan: jabatanData
            });

            // Setup filters and populate dropdowns
            setupAdvancedDynamicFilters();

            // Update table if it exists
            if ($.fn.DataTable.isDataTable('#pegawai-list-table')) {
                pegawaiTable.clear().rows.add(pegawaiData).draw();
            }

            // Calculate and update statistics
            const statistics = calculateComprehensiveStatistics(pegawaiData, divisiData, jabatanData);
            updateUIStatistics(statistics);

            // Setup chart listeners
            setupChartListeners();

        } catch (error) {
            console.error('Error in initializePage:', error);
            showErrorAlert('Terjadi kesalahan saat memproses data');
        }
    }).catch(error => {
        console.error('Failed to fetch data:', error);
        showErrorAlert('Gagal mengambil data');
    });
}

function updateUIStatistics(stats) {
    try {
        // Update jumlah pegawai aktif
        const activeEmployeesElements = document.querySelectorAll('#activeEmployeesCount');
        activeEmployeesElements.forEach(el => {
            el.textContent = stats.pegawaiAktif || '0';
        });

        // Update statistik gender
        const genderCountElements = document.querySelectorAll('#genderCount');
        genderCountElements.forEach(el => {
            el.innerHTML = `
                <span class="me-2">
                    <i class="bi bi-gender-male text-primary"></i> : ${stats.jenisKelamin.laki}
                </span>, 
                <span>
                    <i class="bi bi-gender-female text-danger"></i> : ${stats.jenisKelamin.perempuan}
                </span>`;
        });

        // Update jumlah divisi
        const divisionCountElements = document.querySelectorAll('#employeesByDivisionCount');
        divisionCountElements.forEach(el => {
            el.textContent = stats.totalDivisi || '0';
        });

        // Update jumlah jabatan
        const positionCountElements = document.querySelectorAll('#employeesByPositionCount');
        positionCountElements.forEach(el => {
            el.textContent = stats.totalJabatan || '0';
        });

        console.log('Updated statistics:', stats); // Untuk debugging
    } catch (error) {
        console.error('Error updating UI statistics:', error);
    }
}

    // Fungsi Load Chart dengan Warna yang Berbeda
function loadChart(chartType, pegawaiData, divisiData, jabatanData) {
    const ctx = document.getElementById('chartCanvas').getContext('2d');
    let chartData;

    // Warna yang lebih variatif
    const colorPalettes = {
        activeEmployees: ['#4CAF50', '#F44336'],
        genderCount: ['#2196F3', '#E91E63'],
        employeesByDivision: [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
            '#9966FF', '#FF9F40', '#8AC926', '#00BCD4'
        ],
        employeesByPosition: [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
            '#9966FF', '#FF9F40', '#8AC926', '#00BCD4'
        ]
    };

    // Fungsi pembantu untuk mendapatkan nama divisi/jabatan
    function getNamaJabatan(idJabatan) {
        const jabatan = jabatanData.find(j => j.id_jabatan === idJabatan);
        return jabatan ? jabatan.nama_jabatan : 'Tidak diketahui';
    }

    function getNamaDivisi(idDivisi) {
        const divisi = divisiData.find(d => d.id_divisi === idDivisi);
        return divisi ? divisi.nama_divisi : 'Tidak diketahui';
    }

    switch (chartType) {
        case 'activeEmployees':
            const aktivPegawai = pegawaiData.filter(p => p.status_kepegawaian === 'aktif').length;
            const nonAktifPegawai = pegawaiData.filter(p => p.status_kepegawaian !== 'aktif').length;

            chartData = {
                labels: ['Aktif', 'Non-Aktif'],
                datasets: [{
                    label: 'Status Kepegawaian',
                    data: [aktivPegawai, nonAktifPegawai],
                    backgroundColor: colorPalettes.activeEmployees,
                    borderWidth: 1
                }]
            };
            break;

            case 'genderCount':
            const genderCount = pegawaiData.reduce((acc, curr) => {
                acc[curr.jenis_kelamin] = (acc[curr.jenis_kelamin] || 0) + 1;
                return acc;
            }, {});

            chartData = {
                labels: [
                    'Laki-laki (♂)', 
                    'Perempuan (♀)'
                ],
                datasets: [{
                    label: 'Jumlah Pegawai Berdasarkan Jenis Kelamin',
                    data: [genderCount['L'] || 0, genderCount['P'] || 0],
                    backgroundColor: ['#0d6efd', '#dc3545'], // Bootstrap primary and danger colors
                    borderWidth: 1
                }]
            };
            break;

        case 'employeesByDivision':
            const divisiCount = pegawaiData.reduce((acc, curr) => {
                const divisiNama = getNamaDivisi(curr.id_divisi);
                acc[divisiNama] = (acc[divisiNama] || 0) + 1;
                return acc;
            }, {});

            chartData = {
                labels: Object.keys(divisiCount),
                datasets: [{
                    label: 'Jumlah Pegawai per Divisi',
                    data: Object.values(divisiCount),
                    backgroundColor: colorPalettes.employeesByDivision.slice(0, Object.keys(divisiCount).length),
                    borderWidth: 1
                }]
            };
            break;

        case 'employeesByPosition':
            const jabatanCount = pegawaiData.reduce((acc, curr) => {
                const jabatanNama = getNamaJabatan(curr.id_jabatan);
                acc[jabatanNama] = (acc[jabatanNama] || 0) + 1;
                return acc;
            }, {});

            chartData = {
                labels: Object.keys(jabatanCount),
                datasets: [{
                    label: 'Jumlah Pegawai per Jabatan',
                    data: Object.values(jabatanCount),
                    backgroundColor: colorPalettes.employeesByPosition.slice(0, Object.keys(jabatanCount).length),
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

    // Buat chart baru
    window.chart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: false, // Penting untuk kontrol ukuran
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14 // Ukuran font legend
                        }
                    }
                },
                title: {
                    display: true,
                    text: `Grafik Kepegawaian`,
                    font: {
                        size: 30 // Ukuran font judul
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        font: {
                            size: 22 // Ukuran font skala
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 12 // Ukuran font skala
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

// Tambahkan event listener untuk tombol chart di dalam fungsi inisialisasi
function setupChartListeners() {
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            const chartType = this.getAttribute('data-chart-type');
            loadChart(
                chartType, 
                pegawaiData,   // Pastikan variabel global tersedia
                divisiData,    // Pastikan variabel global tersedia
                jabatanData    // Pastikan variabel global tersedia
            );
        });
    });
}

// Modifikasi fungsi inisialisasi untuk menambahkan setup chart
function initializePage() {
    Promise.all([
        fetchData('pegawai'),
        fetchData('divisi'),
        fetchData('jabatan')
    ]).then(([fetchedPegawaiData, fetchedDivisiData, fetchedJabatanData]) => {
        try {
            // Log data yang diterima untuk debugging
            console.log('Fetched Data:', {
                pegawai: fetchedPegawaiData,
                divisi: fetchedDivisiData,
                jabatan: fetchedJabatanData
            });

            // Hitung statistik dengan semua data yang diperlukan
            const statistics = calculateComprehensiveStatistics(
                fetchedPegawaiData,
                fetchedDivisiData,
                fetchedJabatanData
            );

            // Update UI dengan statistik yang baru dihitung
            updateUIStatistics(statistics);

            // Simpan data untuk penggunaan lainnya
            pegawaiData = fetchedPegawaiData?.data || fetchedPegawaiData;
            divisiData = fetchedDivisiData?.data || fetchedDivisiData;
            jabatanData = fetchedJabatanData?.data || fetchedJabatanData;

            // Update tabel dan setup fitur lainnya
            if ($.fn.DataTable.isDataTable('#pegawai-list-table')) {
                pegawaiTable.clear().rows.add(pegawaiData).draw();
            }

            setupAdvancedDynamicFilters(pegawaiData);
            setupChartListeners();

        } catch (error) {
            console.error('Error in initializePage:', error);
            showErrorAlert('Terjadi kesalahan saat memproses data. Silakan refresh halaman.');
        }
    }).catch(error => {
        console.error('Failed to fetch data:', error);
        showErrorAlert('Gagal mengambil data. Silakan periksa koneksi internet Anda.');
    });
}

// Fungsi Ekspor PDF
function exportToPDF() {
    try {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l'); // Landscape
        
        // Gunakan DataTable yang benar
        const table = $('#pegawai-list-table').DataTable();
        const headers = ['No', 'Nama', 'Jenis Kelamin', 'Telepon', 'Email', 'Jabatan', 'Divisi', 'Status', 'Tanggal Masuk'];
        
        // Ambil data dari DataTable
        const allData = table.rows().data().toArray().map((row, index) => [
            index + 1,
            row.nama_lengkap || '',
            row.jenis_kelamin || '',
            row.telepon || '',
            row.email || '',
            row.jabatan?.nama_jabatan || '',
            row.divisi?.nama_divisi || '',
            row.status_kepegawaian || '',
            row.tanggal_masuk || ''
        ]);
        
        doc.text("Laporan Kepegawaian", 14, 15);
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
        
        doc.save(`Laporan_Kepegawaian_${new Date().toLocaleDateString('id-ID')}.pdf`);
        
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
        const table = $('#pegawai-list-table').DataTable();
        const headers = ['No', 'Nama', 'Jenis Kelamin', 'Telepon', 'Email', 'Jabatan', 'Divisi', 'Status', 'Tanggal Masuk'];
        
        // Ambil data dari DataTable
        const allData = table.rows().data().toArray().map((row, index) => [
            index + 1,
            row.nama_lengkap || '',
            row.jenis_kelamin || '',
            row.telepon || '',
            row.email || '',
            row.jabatan?.nama_jabatan || '',
            row.divisi?.nama_divisi || '',
            row.status_kepegawaian || '',
            row.tanggal_masuk || ''
        ]);
        
        const workSheetData = [headers, ...allData];
        
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(workSheetData);
        
        // Atur lebar kolom
        ws['!cols'] = headers.map(() => ({ wch: 20 }));
        
        XLSX.utils.book_append_sheet(wb, ws, "Kepegawaian");
        XLSX.writeFile(wb, `Laporan_Kepegawaian_${new Date().toLocaleDateString('id-ID')}.xlsx`);
        
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
        const table = $('#pegawai-list-table').DataTable();
        const headers = ['No', 'Nama', 'Jenis Kelamin', 'Telepon', 'Email', 'Jabatan', 'Divisi', 'Status', 'Tanggal Masuk'];
        
        // Ambil data dari DataTable
        const allData = table.rows().data().toArray().map((row, index) => [
            index + 1,
            row.nama_lengkap || '',
            row.jenis_kelamin || '',
            row.telepon || '',
            row.email || '',
            row.jabatan?.nama_jabatan || '',
            row.divisi?.nama_divisi || '',
            row.status_kepegawaian || '',
            row.tanggal_masuk || ''
        ]);
        
        const csvContent = [
            headers.join(','),
            ...allData.map(row => row.join(','))
        ].join('\n');
        
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        
        link.setAttribute('href', url);
        link.setAttribute('download', `Laporan_Kepegawaian_${new Date().toLocaleDateString('id-ID')}.csv`);
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
        const table = $('#pegawai-list-table').DataTable();
        const headers = ['No', 'Nama', 'Jenis Kelamin', 'Telepon', 'Email', 'Jabatan', 'Divisi', 'Status', 'Tanggal Masuk'];
        
        // Ambil data dari DataTable
        const allData = table.rows().data().toArray().map((row, index) => [
            index + 1,
            row.nama_lengkap || '',
            row.jenis_kelamin || '',
            row.telepon || '',
            row.email || '',
            row.jabatan?.nama_jabatan || '',
            row.divisi?.nama_divisi || '',
            row.status_kepegawaian || '',
            row.tanggal_masuk || ''
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

// Event Listeners dengan Debug
$(document).ready(function() {
    console.log('Document ready - Kepegawaian Export');

    // Debug: Cek keberadaan tombol dan tabel
    const $exportDropdown = $('#exportDropdown');
    const $copyTableBtn = $('#copyTableBtn');
    const $pegawaiTable = $('#pegawai-table');

    console.log('Export Dropdown exists:', $exportDropdown.length);
    console.log('Copy Table Button exists:', $copyTableBtn.length);
    console.log('Pegawai Table exists:', $pegawaiTable.length);

    // Event listener dengan log
    $exportDropdown.on('click', function(e) {
        console.log('Export dropdown clicked');
    });

    $('#exportPdfBtn').on('click', function() {
        console.log('Export PDF button clicked');
        exportToPDF();
    });
    
    $('#exportExcelBtn').on('click', function() {
        console.log('Export Excel button clicked');
        exportToExcel();
    });
    
    $('#exportCsvBtn').on('click', function() {
        console.log('Export CSV button clicked');
        exportToCSV();
    });
    
    $('#copyTableBtn').on('click', function() {
        console.log('Copy Table button clicked');
        copyTableToClipboard();
    });
});

    // Ambil data pegawai saat halaman dimuat
    fetchData('pegawai').then(data => {
        pegawaiData = data;
        console.log('Data Pegawai:', pegawaiData); // Debugging untuk memastikan data tersedia
    });
    // Panggil fungsi inisialisasi
    initializePage();
});

    </script>
    @endpush