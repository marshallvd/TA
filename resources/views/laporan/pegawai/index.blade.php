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
                            {{-- <div class="logo-normal">
                                <img src="{{ asset('assets/images/logo seb.png') }}" alt="Logo HRMS SEB" class="icon-40">
                            </div> --}}
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
                                        <svg class="icon-20 text-primary" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="border rounded p-3 bg-soft-primary me-3">
                                            <i class="fas fa-users icon-20"></i>
                                        </div>
                                        <h2 id="activeEmployeesCount" class="counter mb-0">0</h2>
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="activeEmployees">
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
                                        <span class="text-muted text-uppercase small">Pegawai per Jenis Kelamin</span>
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
                                            <i class="fas fa-venus-mars icon-20"></i>
                                        </div>
                                        <h2 id="genderCount" class="counter mb-0">0</h2>
                                    </div>
                                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="genderCount">
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
                                        <span class="text-muted text-uppercase small">Jumlah Divisi</span>
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
                                        <h2 id="employeesByDivisionCount" class="counter mb-0">0</h2>
                                    </div>
                                    <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="employeesByDivision">
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
                                        <span class="text-muted text-uppercase small">Jumlah Jabatan</span>
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
                                        <h2 id="employeesByPositionCount" class="counter mb-0">0</h2>
                                    </div>
                                    <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#chartModal" data-chart-type="employeesByPosition">
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
                        <h4 class="card-title">Laporan Pegawai</h4>
                    </div>
                    <div class="d-flex">
                        <button class="btn btn-primary me-2" id="exportPdfBtn">
                            <i class="fas fa-file-pdf me-2"></i>Cetak PDF
                        </button>
                    </div>
                </div>

                <div class="card-body">
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
                                        <i class="fas fa-users fa-2x text-primary"></i>
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
                                        <i class="fas fa-venus-mars fa-2x text-success"></i>
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
                                        <i class="fas fa-building fa-2x text-info"></i>
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
                                        <i class="fas fa-user-tie fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Section -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label for="filterJenisKelamin">Jenis Kelamin</label>
                            <select class="form-select" id="filterJenisKelamin">
                                <option value="">Semua</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filterDivisi">Divisi</label>
                            <select class="form-select" id="filterDivisi">
                                <option value="">Semua</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filterJabatan">Jabatan</label>
                            <select class="form-select" id="filterJabatan">
                                <option value="">Semua</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filterStatus">Status</label>
                            <select class="form-select" id="filterStatus">
                                <option value="">Semua</option>
                                <option value="aktif">Aktif</option>
                                <option value="non-aktif">Non-aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12 text-end">
                            <button id="applyFilterBtn" class="btn btn-primary me-2">
                                <i class="fas fa-filter me-1"></i>Terapkan Filter
                            </button>
                            <button id="resetFilterBtn" class="btn btn-secondary">
                                <i class="fas fa-sync me-1"></i>Reset Filter
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
    }

    .modal-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    #chartCanvas {
        max-width: 100%;
        height: auto;
    }
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    let pegawaiData = [];
    let divisiData = [];
    let jabatanData = [];

    // Error Handler dengan SweetAlert
    function showErrorAlert(message) {
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: message
        });
    }

    // Fungsi Fetch Data dengan Error Handling yang Lebih Baik
    async function fetchData(endpoint) {
        try {
            // Cek token
            if (!token) {
                showErrorAlert('Anda belum login. Silakan login terlebih dahulu.');
                return [];
            }

            const response = await fetch(`http://127.0.0.1:8000/api/${endpoint}`, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                }
            });

            if (!response.ok) {
                const errorText = await response.text();
                console.error(`HTTP error! status: ${response.status}`, errorText);
                showErrorAlert(`Gagal mengambil data: ${response.status}`);
                return [];
            }

            const data = await response.json();
            return data.data || data;
        } catch (error) {
            console.error('Fetch error:', error);
            showErrorAlert('Terjadi kesalahan saat memuat data. Silakan coba lagi.');
            return [];
        }
    }

    // Inisialisasi DataTable
    const pegawaiTable = $('#pegawai-list-table').DataTable({
    processing: true,
    pageLength: 10,  // Jumlah default per halaman
    lengthMenu: [
        [10, 25, 50, 100, -1],  // Pilihan jumlah data per halaman
        ['10 Baris', '25 Baris', '50 Baris', '100 Baris', 'Semua Data']
    ],
    dom: 'Blfrtip',  // Tambahkan 'l' untuk length menu
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
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
        { data: 'nama_lengkap' },
        { data: 'telepon' },
        { data: 'email' },
        { data: 'nama_jabatan' },
        { data: 'nama_divisi' },
        { data: 'status_kepegawaian' },
        { data: 'tanggal_masuk' }
    ]
});

    // Event Handler untuk Filter Divisi
                // Perbaikan filter Divisi
                $('#filterDivisi').empty().append('<option value="">Semua</option>');
            const uniqueDivisi = [...new Set(pegawaiData.map(p => p.nama_divisi))];
            uniqueDivisi.forEach(divisi => {
                $('#filterDivisi').append(`<option value="${divisi}">${divisi}</option>`);
            });

            // Perbaikan filter Jabatan
            $('#filterJabatan').empty().append('<option value="">Semua</option>');
            const uniqueJabatan = [...new Set(pegawaiData.map(p => p.nama_jabatan))];
            uniqueJabatan.forEach(jabatan => {
                $('#filterJabatan').append(`<option value="${jabatan}">${jabatan}</option>`);
            });

            // Event Handler untuk Filter
            $('#filterJenisKelamin, #filterDivisi, #filterJabatan, #filterStatus').on('change', function() {
                filterTable();
            });

    // Fungsi Filter Tabel
    // Custom Filtering Function
$.fn.dataTable.ext.search = [
    function(settings, data) {
        const jenisKelamin = $('#filterJenisKelamin').val();
        const divisi = $('#filterDivisi').val();
        const jabatan = $('#filterJabatan').val();
        const status = $('#filterStatus').val();

        const dataJenisKelamin = data[1]; // Sesuaikan index kolom
        const dataDivisi = data[5]; // Sesuaikan index kolom
        const dataJabatan = data[4]; // Sesuaikan index kolom
        const dataStatus = data[6]; // Sesuaikan index kolom

        const matchJenisKelamin = !jenisKelamin || dataJenisKelamin === jenisKelamin;
        const matchDivisi = !divisi || dataDivisi === divisi;
        const matchJabatan = !jabatan || dataJabatan === jabatan;
        const matchStatus = !status || dataStatus === status;

        return matchJenisKelamin && matchDivisi && matchJabatan && matchStatus;
    }
];

// Apply Filter Button
$('#applyFilterBtn').on('click', function() {
    pegawaiTable.draw();
});

// Reset Filter Button
$('#resetFilterBtn').on('click', function() {
    $('#filterJenisKelamin, #filterDivisi, #filterJabatan, #filterStatus').val('');
    pegawaiTable.draw();
});

    // Fungsi Hitung Statistik
    function calculateStatistics(data) {
    const totalPegawai = data.length;
    const aktivPegawai = data.filter(p => p.status_kepegawaian === 'aktif').length;
    
    console.log('Total Pegawai:', totalPegawai);
    console.log('Aktif Pegawai:', aktivPegawai);
    
    const genderCount = data.reduce((acc, curr) => {
        acc[curr.jenis_kelamin] = (acc[curr.jenis_kelamin] || 0) + 1;
        return acc;
    }, {});

    console.log('Gender Count:', genderCount);

    $('#activeEmployeesCount').text(aktivPegawai);
    $('#genderCount').text(`${genderCount['L'] || 0} (L), ${genderCount['P'] || 0} (P)`);

    return genderCount;
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

// Fungsi Load Chart dengan Warna yang Berbeda
function loadChart(chartType) {
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
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        label: 'Jumlah Pegawai Berdasarkan Jenis Kelamin',
                        data: [genderCount['L'] || 0, genderCount['P'] || 0],
                        backgroundColor: colorPalettes.genderCount,
                        borderWidth: 1
                    }]
                };
                break;

            case 'employeesByDivision':
                const divisiCount = pegawaiData.reduce((acc, curr) => {
                    const divisiNama = getNamaDivisi(divisiData, curr.id_divisi);
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
                    const jabatanNama = getNamaJabatan(jabatanData, curr.id_jabatan);
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
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: `Grafik ${chartType}`
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    }

    // Fungsi Utama Memuat Data
    function initializePage() {
        Promise.all([
            fetchData('pegawai'), 
            fetchData('divisi'), 
            fetchData('jabatan')
        ]).then(([fetchedPegawaiData, fetchedDivisiData, fetchedJabatanData]) => {
            if (fetchedPegawaiData.length === 0) {
                showErrorAlert('Tidak ada data pegawai yang ditemukan');
                return;
            }

            // Tambahkan console log untuk melihat data
            console.log('Pegawai Data:', fetchedPegawaiData);
            console.log('Divisi Data:', fetchedDivisiData);
            console.log('Jabatan Data:', fetchedJabatanData);

            pegawaiData = fetchedPegawaiData;
            divisiData = fetchedDivisiData;
            jabatanData = fetchedJabatanData;

            // Tambahkan data nama divisi dan jabatan ke pegawai
            // Tambahkan data nama divisi dan jabatan ke pegawai
        pegawaiData = pegawaiData.map(pegawai => ({
            ...pegawai,
            nama_divisi: getNamaDivisi(divisiData, pegawai.id_divisi),
            nama_jabatan: getNamaJabatan(jabatanData, pegawai.id_jabatan)
        }));

        // Filter pegawai aktif
        const aktivPegawai = pegawaiData.filter(p => p.status_kepegawaian === 'aktif');

                // Populate Divisi Dropdown
                const uniqueDivisi = [...new Set(pegawaiData.map(p => p.nama_divisi))].sort();
        $('#filterDivisi').empty().append('<option value="">Semua</option>');
        uniqueDivisi.forEach(divisi => {
            $('#filterDivisi').append(`<option value="${divisi}">${divisi}</option>`);
        });

        // Populate Jabatan Dropdown
        const uniqueJabatan = [...new Set(pegawaiData.map(p => p.nama_jabatan))].sort();
        $('#filterJabatan').empty().append('<option value="">Semua</option>');
        uniqueJabatan.forEach(jabatan => {
            $('#filterJabatan').append(`<option value="${jabatan}">${jabatan}</option>`);
        });

        // Muat data ke tabel
        pegawaiTable.clear().rows.add(pegawaiData).draw();

            calculateStatistics(pegawaiData);

            // Update widget counts
            $('#employeesByDivisionCount').text(Object.keys(
                pegawaiData.reduce((acc, curr) => {
                    const divisiNama = getNamaDivisi(divisiData, curr.id_divisi);
                    acc[divisiNama] = true;
                    return acc;
                }, {})
            ).length);

            $('#employeesByPositionCount').text(Object.keys(
                pegawaiData.reduce((acc, curr) => {
                    const jabatanNama = getNamaJabatan(jabatanData, curr.id_jabatan);
                    acc[jabatanNama] = true;
                    return acc;
                }, {})
            ).length);
        }).catch(error => {
            console.error('Initialization Error:', error);
            showErrorAlert('Gagal menginisialisasi halaman. Silakan refresh.');
        });
    }

    // Tambahkan event listener untuk tombol chart
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
        button.addEventListener('click', function() {
            const chartType = this.getAttribute('data-chart-type');
            loadChart(chartType);
        });
    });

    // Panggil fungsi inisialisasi
    initializePage();
});
    </script>
    @endpush