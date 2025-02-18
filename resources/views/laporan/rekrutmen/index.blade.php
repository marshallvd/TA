@extends('layouts.master')

@section('title') 
Laporan Rekrutmen 
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
                            <b><h2 class="card-title mb-1">Laporan Rekrutmen</h2></b>
                            <p class="card-text text-muted">Human Resource Management System</p>
                        </div>
                        <div>
                            <i class="bi bi-people text-primary" style="font-size: 3rem;"></i>
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
                                    <span class="text-muted text-uppercase small">Total Pelamar</span>
                                </div>
                                <div>
                                    <i class="bi bi-info-circle text-primary"></i>
                                </div>
                            </div>
                            <h2 id="totalPelamarCount" class="counter mb-0">0</h2>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#periodModal" data-chart-type="pendidikanPelamar">
                                <i class="bi bi-bar-chart-line me-1"></i>Grafik
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="text-muted text-uppercase small">Jumlah Lowongan</span>
                                </div>
                                <div>
                                    <i class="bi bi-info-circle text-success"></i>
                                </div>
                            </div>
                            <h2 id="totalLowonganCount" class="counter mb-0">0</h2>
                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#periodModal" data-chart-type="lowonganJabatan">
                                <i class="bi bi-bar-chart-line me-1"></i>Grafik
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="text-muted text-uppercase small">Jumlah Lamaran</span>
                                </div>
                                <div>
                                    <i class="bi bi-info-circle text-info"></i>
                                </div>
                            </div>
                            <h2 id="totalLamaranCount" class="counter mb-0">0</h2>
                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#periodModal" data-chart-type="statusLamaran">
                                <i class="bi bi-bar-chart-line me-1"></i>Grafik
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="text-muted text-uppercase small">Jumlah Wawancara</span>
                                </div>
                                <div>
                                    <i class="bi bi-info-circle text-warning"></i>
                                </div>
                            </div>
                            <h2 id="totalWawancaraCount" class="counter mb-0">0</h2>
                            <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#periodModal" data-chart-type="hasilWawancara">
                                <i class="bi bi-bar-chart-line me-1"></i>Grafik
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
                            <h5 class="modal-title" id="chartModalLabel">Grafik Rekrutmen</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <canvas id="chartCanvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Table -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Data Rekrutmen</h4>
                    <div class="d-flex align-items-center">
                        <div class="dropdown me-2">
                            <button class="btn btn-success dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-file-earmark-arrow-up me-2"></i>Ekspor
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                                <li><a class="dropdown-item" href="#" id="exportPdfBtn"><i class="bi bi-file-pdf text-danger me-2"></i>Cetak PDF</a></li>
                                <li><a class="dropdown-item" href="#" id="exportExcelBtn"><i class="bi bi-file-excel text-success me-2"></i>Ekspor Excel</a></li>
                                <li><a class="dropdown-item" href="#" id="exportCsvBtn"><i class="bi bi-filetype-csv text-info me-2"></i>Ekspor CSV</a></li>
                            </ul>
                        </div>
                        <button class="btn btn-warning" id="copyTableBtn">
                            <i class="bi bi-clipboard me-2"></i>Salin
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Filtering Section -->
                    <div class="row mb-4">
                        <div class="col-md-2">
                            <label for="monthYearFilter">
                                <i class="bi bi-calendar-month me-1"></i>Filter Bulan & Tahun:
                            </label>
                            <input type="month" id="monthYearFilter" class="form-control">
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
                        <div class="col-md-2">
                            <label for="statusLamaranFilter">
                                <i class="bi bi-file-earmark-text me-1"></i>Status Lamaran:
                            </label>
                            <select id="statusLamaranFilter" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="diterima">Diterima</option>
                                <option value="menunggu">Menunggu</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="statusWawancaraFilter">
                                <i class="bi bi-chat-dots me-1"></i>Status Wawancara:
                            </label>
                            <select id="statusWawancaraFilter" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="lulus">Lulus</option>
                                <option value="gagal">Gagal</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="statusSeleksiFilter">
                                <i class="bi bi-check-circle me-1"></i>Status Hasil Seleksi:
                            </label>
                            <select id="statusSeleksiFilter" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="lulus">Lulus</option>
                                <option value="gagal">Gagal</option>
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
                        <table id="rekrutmen-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-hash me-1"></i>No</th>
                                    <th><i class="bi bi-person me-1"></i>Nama Pelamar</th>
                                    <th><i class="bi bi-phone me-1"></i>Telepon</th>
                                    <th><i class="bi bi-book me-1"></i>Pendidikan Terakhir</th>
                                    <th><i class="bi bi-briefcase me-1"></i>Judul Pekerjaan</th>
                                    <th><i class="bi bi-person-badge me-1"></i>Jabatan</th>
                                    <th><i class="bi bi-file-earmark-text me-1"></i>Status Lamaran</th>
                                    <th><i class="bi bi-check-circle me-1"></i>Hasil Wawancara</th>
                                    <th><i class="bi bi-check-square me-1"></i>Status Hasil Seleksi</th>
                                    <th><i class="bi bi-calendar me-1"></i>Tanggal Diterima</th>
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


<!-- Modal for Selecting Period -->
<!-- Modal for Selecting Period -->
<div class="modal fade" id="periodChartModal" tabindex="-1" aria-labelledby="periodModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="periodModalLabel">
                    <i class="bi bi-calendar-check me-2"></i>Pilih Periode Laporan Rekrutmen
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
                            <!-- Years will be populated dynamically -->
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
                <button type="button" class="btn btn-primary" id="generateChartBtn">
                    <i class="bi bi-check-circle me-2"></i>Tampilkan
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="chartModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <canvas id="chartCanvas"></canvas> <!-- Pastikan id ini benar -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let rekrutmenTable;
    const token = localStorage.getItem('token');

    // Fungsi untuk mengambil data dari API
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

            if (endpoint === 'admin/lamaran') {
                return data.data.data || [];
            }
            return data.data || data;
        } catch (error) {
            console.error(`Fetch error for ${endpoint}:`, error);
            showErrorAlert(`Terjadi kesalahan saat memuat data ${endpoint}: ` + error.message);
            return [];
        }
    }

    // Fungsi untuk memformat tanggal
    function formatDate(dateString) {
        if (!dateString) return '-';
        return new Date(dateString).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }

    // Inisialisasi DataTable dan data
    async function initializePage() {
        try {
            const [lowonganData, lamaranData, wawancaraData, hasilSeleksiData] = await Promise.all([
                fetchData('lowongan'),
                fetchData('admin/lamaran'),
                fetchData('wawancara'),
                fetchData('hasil-seleksi'),
                fetchData('pelamar')
            ]);

            // Update widget counts
            updateWidgetCounts(lamaranData, lowonganData, wawancaraData, hasilSeleksiData);

            // Initialize DataTable
            rekrutmenTable = initializeDataTable(lamaranData, lowonganData, wawancaraData, hasilSeleksiData);

            // Initialize filters
            await initializeFilters(lowonganData);

            // Setup event handlers
            setupEventHandlers();

        } catch (error) {
            console.error('Error initializing page:', error);
            showErrorAlert('Terjadi kesalahan saat memuat data');
        }
    }

    // Update widget counts
    function updateWidgetCounts(lamaranData, lowonganData, wawancaraData, hasilSeleksiData) {
        $('#totalPelamarCount').text(lamaranData.length);
        $('#totalLowonganCount').text(lowonganData.length);
        $('#totalLamaranCount').text(lamaranData.length);
        $('#totalWawancaraCount').text(wawancaraData.length);
    }

    // Initialize DataTable
    function initializeDataTable(lamaranData, lowonganData, wawancaraData, hasilSeleksiData) {
        return $('#rekrutmen-table').DataTable({
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
            data: lamaranData,
            columns: [
                { 
                    data: null, 
                    render: (data, type, row, meta) => meta.row + 1 
                },
                { data: 'nama_pelamar' },
                { data: 'telepon_pelamar' },
                { data: 'pendidikan_terakhir' },
                { 
                    data: 'lowongan_pekerjaan',
                    render: (data) => data ? data.judul_pekerjaan : 'N/A'
                },
                { 
                    data: null,
                    render: function(data) {
                        const lowongan = lowonganData.find(l => l.id_lowongan_pekerjaan === data.id_lowongan_pekerjaan);
                        return lowongan?.jabatan?.nama_jabatan || 'N/A';
                    }
                },
                { 
                    data: 'status_lamaran',
                    render: function(data) {
                        const badgeClass = {
                            'diterima': 'badge bg-success',
                            'ditolak': 'badge bg-danger',
                            'menunggu': 'badge bg-warning'
                        }[data] || 'badge bg-secondary';
                        return `<span class="${badgeClass}">${data}</span>`;
                    }
                },
                { 
                    data: null,
                    render: function(data) {
                        const wawancara = wawancaraData.find(w => w.id_lamaran_pekerjaan === data.id_lamaran_pekerjaan);
                        if (!wawancara) return '<span class="badge bg-secondary">Belum Wawancara</span>';
                        const badgeClass = wawancara.hasil === 'lulus' ? 'badge bg-success' : 'badge bg-danger';
                        return `<span class="${badgeClass}">${wawancara.hasil}</span>`;
                    }
                },
                {
                    data: null,
                    render: function(data) {
                        const hasilSeleksi = hasilSeleksiData.find(hs => 
                            hs.id_lowongan_pekerjaan === data.id_lowongan_pekerjaan && 
                            hs.id_pelamar === data.id_pelamar
                        );
                        if (!hasilSeleksi) return '<span class="badge bg-secondary">Belum Ada Hasil</span>';
                        const badgeClass = hasilSeleksi.status === 'lulus' ? 'badge bg-success' : 'badge bg-danger';
                        return `<span class="${badgeClass}">${hasilSeleksi.status}</span>`;
                    }
                },
                { 
                    data: 'tanggal_dibuat',
                    render: formatDate
                }
            ]
        });
    }

    // Initialize filters
    async function initializeFilters(lowonganData) {
        // Populate jabatan filter
        const uniqueJabatan = [...new Set(lowonganData
            .map(item => item.jabatan?.nama_jabatan)
            .filter(Boolean))];
        
        const jabatanFilter = $('#jabatanFilter');
        jabatanFilter.html('<option value="">Semua Jabatan</option>');
        uniqueJabatan.sort().forEach(jabatan => {
            jabatanFilter.append(`<option value="${jabatan}">${jabatan}</option>`);
        });

        // Add custom filtering function
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            const monthYearFilter = $('#monthYearFilter').val();
            const jabatanFilter = $('#jabatanFilter').val();
            const statusLamaranFilter = $('#statusLamaranFilter').val();
            const statusWawancaraFilter = $('#statusWawancaraFilter').val();
            const statusSeleksiFilter = $('#statusSeleksiFilter').val();

            // Check month-year filter
            if (monthYearFilter) {
                const rowDate = new Date(data[9]);
                const filterDate = new Date(monthYearFilter);
                if (rowDate.getMonth() !== filterDate.getMonth() || 
                    rowDate.getFullYear() !== filterDate.getFullYear()) {
                    return false;
                }
            }

            // Check other filters
            if (jabatanFilter && !data[5].includes(jabatanFilter)) return false;
            if (statusLamaranFilter && !data[6].toLowerCase().includes(statusLamaranFilter.toLowerCase())) return false;
            if (statusWawancaraFilter && !data[7].toLowerCase().includes(statusWawancaraFilter.toLowerCase())) return false;
            if (statusSeleksiFilter && !data[8].toLowerCase().includes(statusSeleksiFilter.toLowerCase())) return false;

            return true;
        });
    }

    // Setup event handlers
    function setupEventHandlers() {
        // Filter buttons
        $('#applyFilterBtn').on('click', function() {
            rekrutmenTable.draw();
            showSuccessAlert('Filter diterapkan', 'Data telah difilter sesuai kriteria');
        });

        $('#resetFilterBtn').on('click', function() {
            $('select.form-control, input.form-control').val('');
            rekrutmenTable.draw();
            showSuccessAlert('Filter direset', 'Semua filter telah direset');
        });

        // Export buttons
        $('#exportPdfBtn').on('click', exportToPDF);
        $('#exportExcelBtn').on('click', exportToExcel);
        $('#exportCsvBtn').on('click', exportToCSV);
        $('#copyTableBtn').on('click', copyTableToClipboard);

        // Real-time filtering

    }

    // Alert helpers
    function showSuccessAlert(title, text) {
        Swal.fire({
            icon: 'success',
            title: title,
            text: text,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    }

    function showErrorAlert(text) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: text,
            confirmButtonText: 'OK'
        });
    }

    // Export functions
    async function exportToPDF() {
        try {
            Swal.fire({
                title: 'Mengekspor PDF...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({ orientation: 'landscape', unit: 'mm', format: 'a4' });
            const tableElement = document.getElementById('rekrutmen-table');
            const rows = Array.from(tableElement.querySelectorAll('tr'));
            const tableData = rows.map(row => 
                Array.from(row.querySelectorAll('th, td')).map(cell => cell.textContent.trim())
            );

            await doc.autoTable({
                head: [tableData[0]],
                body: tableData.slice(1),
                startY: 25,
                theme: 'grid',
                styles: { fontSize: 8, cellPadding: 2 },
                headStyles: { fillColor: [41, 128, 185], textColor: 255 },
                columnStyles: {
                    0: { cellWidth: 15 }, 1: { cellWidth: 35 }, 2: { cellWidth: 25 },
                    3: { cellWidth: 25 }, 4: { cellWidth: 35 }, 5: { cellWidth: 25 },
                    6: { cellWidth: 25 }, 7: { cellWidth: 25 }, 8: { cellWidth: 25 }
                },
                margin: { top: 25 }
            });

            const currentDate = new Date().toLocaleDateString('id-ID').replace(/[/]/g, '-');
            doc.save(`Laporan_Rekrutmen_${currentDate}.pdf`);
            showSuccessAlert('Berhasil', 'File PDF berhasil diunduh');

        } catch (error) {
            console.error('Error generating PDF:', error);
            showErrorAlert('Terjadi kesalahan saat mengekspor PDF');
        }
    }

    function exportToExcel() {
        try {
            Swal.fire({
                title: 'Mengekspor Excel...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            const table = document.getElementById('rekrutmen-table');
            const wb = XLSX.utils.table_to_book(table);
            XLSX.writeFile(wb, `Laporan_Rekrutmen_${new Date().toLocaleDateString('id-ID')}.xlsx`);
            showSuccessAlert('Berhasil', 'File Excel berhasil diunduh');

        } catch (error) {
            console.error('Error exporting to Excel:', error);
            showErrorAlert('Terjadi kesalahan saat mengekspor Excel');
        }
    }

    function exportToCSV() {
        try {
            Swal.fire({
                title: 'Mengekspor CSV...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            const table = document.getElementById('rekrutmen-table');
            const wb = XLSX.utils.table_to_book(table);
            const csv = XLSX.utils.sheet_to_csv(wb.Sheets[wb.SheetNames[0]]);
            
            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement("a");
            link.href = url;
            link.download = `Laporan_Rekrutmen_${new Date().toLocaleDateString('id-ID')}.csv`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(url);

            showSuccessAlert('Berhasil', 'File CSV berhasil diunduh');

        } catch (error) {
            console.error('Error exporting to CSV:', error);
            showErrorAlert('Terjadi kesalahan saat mengekspor CSV');
        }
    }

    async function copyTableToClipboard() {
        try {
            Swal.fire({
                title: 'Menyalin tabel...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            const table = document.getElementById('rekrutmen-table');
            const rows = table.querySelectorAll('tr');
            const clipboardText = Array.from(rows)
                .map(row => Array.from(row.querySelectorAll('th, td'))
                    .map(cell => cell.textContent.trim())
                    .join('\t'))
                .join('\n');
            
            await navigator.clipboard.writeText(clipboardText);
            showSuccessAlert('Berhasil', 'Tabel berhasil disalin ke clipboard');

        } catch (error) {
            console.error('Error copying table:', error);
            showErrorAlert('Terjadi kesalahan saat menyalin tabel ke clipboard');
        }
    }

        // Configure Chart Modal Function
    function configureChartModal(chartType, data) {
        // Clear previous chart if exists
        if (window.existingChart) {
            window.existingChart.destroy();
        }

        const ctx = document.getElementById('chartCanvas').getContext('2d');
        let chartConfig;

        switch(chartType) {
            case 'pendidikanPelamar':
                chartConfig = configurePendidikanPelamarChart(data);
                break;
            case 'lowonganJabatan':
                chartConfig = configureLowonganJabatanChart(data);
                break;
            case 'statusLamaran':
                chartConfig = configureStatusLamaranChart(data);
                break;
            case 'hasilWawancara':
                chartConfig = configureHasilWawancaraChart(data);
                break;
            case 'hasilSeleksi':
                chartConfig = configureHasilSeleksiChart(data);
                break;
            default:
                console.error('Invalid chart type');
                return;
        }

        window.existingChart = new Chart(ctx, chartConfig);
    }

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
// Common chart options with updated colors
const commonBarChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: { display: false },
    },
    scales: {
        y: {
            beginAtZero: true,
            ticks: { stepSize: 1 }
        },
        x: {
            ticks: {
                maxRotation: 45,
                minRotation: 45
            }
        }
    }
};

// Pendidikan Pelamar Chart
function configurePendidikanPelamarChart(lamaranData) {
    const pendidikanCounts = lamaranData.reduce((acc, curr) => {
        const pendidikan = curr.pendidikan_terakhir || 'Tidak Diketahui';
        acc[pendidikan] = (acc[pendidikan] || 0) + 1;
        return acc;
    }, {});

    return {
        type: 'bar',
        data: {
            labels: Object.keys(pendidikanCounts),
            datasets: [{
                label: 'Jumlah Pelamar',
                data: Object.values(pendidikanCounts),
                backgroundColor: colorPalettes.totalCuti,
                borderColor: colorPalettes.totalCuti,
                borderWidth: 1
            }]
        },
        options: {
            ...commonBarChartOptions,
            plugins: {
                title: {
                    display: true,
                    text: 'Distribusi Pendidikan Pelamar'
                }
            }
        }
    };
}

// Lowongan per Jabatan Chart
function configureLowonganJabatanChart(lowonganData) {
    const jabatanCounts = lowonganData.reduce((acc, curr) => {
        const jabatan = curr.jabatan?.nama_jabatan || 'Tidak Diketahui';
        acc[jabatan] = (acc[jabatan] || 0) + 1;
        return acc;
    }, {});

    return {
        type: 'bar',
        data: {
            labels: Object.keys(jabatanCounts),
            datasets: [{
                label: 'Jumlah Lowongan',
                data: Object.values(jabatanCounts),
                backgroundColor: colorPalettes.cutiPerJabatan,
                borderColor: colorPalettes.cutiPerJabatan,
                borderWidth: 1
            }]
        },
        options: {
            ...commonBarChartOptions,
            plugins: {
                title: {
                    display: true,
                    text: 'Lowongan per Jabatan'
                }
            }
        }
    };
}

// Status Lamaran Chart
function configureStatusLamaranChart(lamaranData) {
    const statusCounts = lamaranData.reduce((acc, curr) => {
        const status = curr.status_lamaran || 'Tidak Diketahui';
        acc[status] = (acc[status] || 0) + 1;
        return acc;
    }, {});

    return {
        type: 'bar',
        data: {
            labels: Object.keys(statusCounts),
            datasets: [{
                label: 'Jumlah Lamaran',
                data: Object.values(statusCounts),
                backgroundColor: colorPalettes.statusCuti,
                borderColor: colorPalettes.statusCuti,
                borderWidth: 1
            }]
        },
        options: {
            ...commonBarChartOptions,
            plugins: {
                title: {
                    display: true,
                    text: 'Status Lamaran'
                }
            }
        }
    };
}

// Hasil Wawancara Chart
function configureHasilWawancaraChart(wawancaraData) {
    const hasilCounts = wawancaraData.reduce((acc, curr) => {
        const hasil = curr.hasil || 'Belum Wawancara';
        acc[hasil] = (acc[hasil] || 0) + 1;
        return acc;
    }, {});

    return {
        type: 'bar',
        data: {
            labels: Object.keys(hasilCounts),
            datasets: [{
                label: 'Jumlah Wawancara',
                data: Object.values(hasilCounts),
                backgroundColor: colorPalettes.cutiPerDivisi,
                borderColor: colorPalettes.cutiPerDivisi,
                borderWidth: 1
            }]
        },
        options: {
            ...commonBarChartOptions,
            plugins: {
                title: {
                    display: true,
                    text: 'Hasil Wawancara'
                }
            }
        }
    };
}

// Hasil Seleksi Chart
function configureHasilSeleksiChart(hasilSeleksiData) {
    const statusCounts = hasilSeleksiData.reduce((acc, curr) => {
        const status = curr.status || 'Belum Ada Hasil';
        acc[status] = (acc[status] || 0) + 1;
        return acc;
    }, {});

    return {
        type: 'bar',
        data: {
            labels: Object.keys(statusCounts),
            datasets: [{
                label: 'Jumlah Hasil Seleksi',
                data: Object.values(statusCounts),
                backgroundColor: colorPalettes.totalCuti,
                borderColor: colorPalettes.totalCuti,
                borderWidth: 1
            }]
        },
        options: {
            ...commonBarChartOptions,
            plugins: {
                title: {
                    display: true,
                    text: 'Status Hasil Seleksi'
                }
            }
        }
    };
}

        // Add event listener for chart buttons
        $('.btn[data-chart-type]').on('click', function(e) {
        e.preventDefault();
        const chartType = $(this).data('chart-type');
        
        // Store chart type in the period modal's data
        $('#periodChartModal').data('chartType', chartType);
        
        // Populate year dropdown (last 5 years)
        const currentYear = new Date().getFullYear();
        const yearSelect = $('#chartYearFilter');
        yearSelect.empty();
        yearSelect.append('<option value="">Pilih Tahun</option>');
        for (let year = currentYear; year >= currentYear - 4; year--) {
            yearSelect.append(`<option value="${year}">${year}</option>`);
        }
        
        // Show period selection modal
        $('#periodChartModal').modal('show');
    });

    // Handle generate chart button click
    $('#generateChartBtn').on('click', async function() {
    const year = $('#chartYearFilter').val();
    const month = $('#chartMonthFilter').val();
    
    if (!year || !month) {
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Silakan pilih tahun dan bulan terlebih dahulu!'
        });
        return;
    }

    const chartType = $('#periodChartModal').data('chartType');
    
    try {
        // Close period modal
        $('#periodChartModal').modal('hide');
        
        // Show loading
        Swal.fire({
            title: 'Memuat data...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        // Fetch data based on selected period
        let chartData;
        switch(chartType) {
            case 'pendidikanPelamar':
            case 'statusLamaran':
                chartData = await fetchData('admin/lamaran');
                break;
            case 'lowonganJabatan':
                chartData = await fetchData('lowongan');
                break;
            case 'hasilWawancara':
                chartData = await fetchData('wawancara');
                break;
            case 'hasilSeleksi':
                chartData = await fetchData('hasil-seleksi');
                break;
        }

        // Filter data based on selected period
        const filteredData = chartData.filter(item => {
            const itemDate = new Date(item.tanggal_dibuat);
            return itemDate.getFullYear() === parseInt(year) && 
                   (itemDate.getMonth() + 1) === parseInt(month);
        });

        // Close loading
        Swal.close();

        // Check if filtered data is empty
        if (!filteredData || filteredData.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'Tidak Ada Data',
                text: 'Tidak terdapat data rekrutmen untuk periode yang dipilih.',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }

        // Show chart modal
        $('#chartModal').modal('show');

        // Update modal title with period
        const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const periodText = `${monthNames[parseInt(month) - 1]} ${year}`;
        
        const titles = {
            pendidikanPelamar: `Grafik Distribusi Pendidikan Pelamar - ${periodText}`,
            lowonganJabatan: `Grafik Lowongan per Jabatan - ${periodText}`,
            statusLamaran: `Grafik Status Lamaran - ${periodText}`,
            hasilWawancara: `Grafik Hasil Wawancara - ${periodText}`,
            hasilSeleksi: `Grafik Status Hasil Seleksi - ${periodText}`
        };
        $('#chartModalLabel').text(titles[chartType]);

        // Configure and show chart
        if (typeof Chart !== 'undefined' && filteredData) {
            configureChartModal(chartType, filteredData);
        } else {
            throw new Error('Chart.js not loaded or data not available');
        }

    } catch (error) {
        console.error('Error generating chart:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan saat memuat grafik'
        });
    }
});

    // Reset period selection when period modal is hidden
    $('#periodChartModal').on('hidden.bs.modal', function() {
        $('#chartYearFilter').val('');
        $('#chartMonthFilter').val('');
    });

    // Cleanup when chart modal is hidden
    $('#chartModal').on('hidden.bs.modal', function() {
        if (window.existingChart) {
            window.existingChart.destroy();
        }
    });

    // Initialize everything when document is ready
    initializePage().catch(error => {
        console.error('Error during initialization:', error);
        showErrorAlert('Terjadi kesalahan saat memuat halaman');
    });
});


</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
@endpush