@extends('layouts.master')

@section('title')
    Daftar Wawancara
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Wawancara</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-briefcase text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Daftar Wawancara</h4>
                    </div>
                    {{-- <div>
                        <button type="button" class="btn btn-primary" id="tambahWawancaraBtn">
                            <i class="bi bi-plus-square me-2"></i>Tambah Wawancara
                        </button>
                    </div> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="wawancara-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelamar</th>
                                    <th>Lowongan Pekerjaan</th>
                                    <th>Tanggal Wawancara</th>
                                    <th>Lokasi</th>
                                    <th>Hasil</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="wawancara-body">
                                <!-- Data akan dimuat di sini -->
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
    // Constants
    const API_CONFIG = {
        baseUrl: 'http://127.0.0.1:8000/api',
        endpoints: {
            wawancara: '/wawancara',
            hasilSeleksi: '/hasil-seleksi'
        }
    };

    // Utility Functions
    const getAuthHeaders = () => ({
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
        'Accept': 'application/json'
    });

    const formatDate = (date) => {
        return date ? new Date(date).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        }) : '-';
    };

    const getStatusBadgeClass = (status) => {
        if (!status) {
            return 'badge bg-secondary';
        }

        const statusClasses = {
            'lulus': 'badge bg-success',
            'gagal': 'badge bg-danger',
            'tertunda': 'badge bg-warning'
        };
        
        return statusClasses[status.toLowerCase()] || 'badge bg-secondary';
    };

    // Helper Functions
    const showError = (message) => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            confirmButtonText: 'OK'
        });
    };

    const checkAuth = () => {
        const token = localStorage.getItem('token');
        if (!token) {
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: 'Anda harus login untuk mengakses halaman ini.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '/login';
            });
            return false;
        }
        return true;
    };

    // Setup table filters
    function setupTableFilters() {
        // Month Year Filter
        $('#monthYearFilter').on('change', function() {
            wawancaraTable.draw();
        });

        // Search Input
        $('#searchInput').on('keyup', function() {
            wawancaraTable.search(this.value).draw();
        });

        // Reset Filter
        $('#resetFilter').on('click', function() {
            $('#monthYearFilter').val('');
            $('#searchInput').val('');
            wawancaraTable.search('').columns().search('').draw();
        });
    }

    // Custom DataTables Filtering
    $.fn.dataTable.ext.search.push(
        function(settings, data) {
            const monthYearFilter = $('#monthYearFilter').val();
            
            if (!monthYearFilter) return true;

            const [filterYear, filterMonth] = monthYearFilter.split('-');
            const rowDate = new Date(data[3]); // Kolom tanggal wawancara

            return (
                rowDate.getFullYear() === parseInt(filterYear) && 
                (rowDate.getMonth() + 1) === parseInt(filterMonth)
            );
        }
    );

    // Fetch Wawancara Data
    const fetchWawancaraData = async () => {
        try {
            // Fetch wawancara dan hasil seleksi secara bersamaan
            const [wawancaraResponse, hasilSeleksiResponse] = await Promise.all([
                fetch(`${API_CONFIG.baseUrl}${API_CONFIG.endpoints.wawancara}`, {
                    method: 'GET',
                    headers: getAuthHeaders()
                }),
                fetch(`${API_CONFIG.baseUrl}${API_CONFIG.endpoints.hasilSeleksi}`, {
                    method: 'GET',
                    headers: getAuthHeaders()
                })
            ]);

            // Periksa response
            if (!wawancaraResponse.ok) {
                throw new Error(`Wawancara HTTP error! status: ${wawancaraResponse.status}`);
            }

            if (!hasilSeleksiResponse.ok) {
                throw new Error(`Hasil Seleksi HTTP error! status: ${hasilSeleksiResponse.status}`);
            }

            // Parse data JSON
            const wawancaraData = await wawancaraResponse.json();
            const hasilSeleksiData = await hasilSeleksiResponse.json();

            // Inisialisasi DataTable
            initializeDataTable(
                wawancaraData.data || [], 
                hasilSeleksiData.data || []
            );

        } catch (error) {
            console.error('Error fetching data:', error);
            showError('Gagal memuat data: ' + error.message);
        }
    };

    // Inisialisasi DataTable
    function initializeDataTable(wawancaraList, hasilSeleksiList) {
        // Persiapkan data untuk DataTable
        const tableData = wawancaraList.map((wawancara, index) => {
            // Cek apakah sudah ada hasil seleksi untuk wawancara ini
            const hasilSeleksiExist = hasilSeleksiList.some(
                hasil => hasil.id_wawancara === wawancara.id_wawancara
            );

            // Tentukan apakah tombol tambah hasil seleksi akan ditampilkan
            const shouldShowAddResultButton = 
                wawancara.hasil === 'lulus' && !hasilSeleksiExist;

            return {
                no: index + 1,
                namaPelamar: wawancara.pelamar?.nama || 'Nama Tidak Tersedia',
                judulPekerjaan: wawancara.judul_pekerjaan || 'Tidak Diketahui',
                tanggalWawancara: formatDate(wawancara.tanggal_wawancara),
                lokasi: wawancara.lokasi || '-',
                hasil: {
                    text: wawancara.hasil || 'Belum Ada',
                    badgeClass: getStatusBadgeClass(wawancara.hasil)
                },
                aksi: {
                    id: wawancara.id_wawancara,
                    showAddResultButton: shouldShowAddResultButton
                }
            };
        });

        // Inisialisasi DataTable
        wawancaraTable = $('#wawancara-table').DataTable({
            data: tableData,
            columns: [
                { 
                    data: 'no',
                    width: '5%'
                },
                { data: 'namaPelamar' },
                { data: 'judulPekerjaan' },
                { data: 'tanggalWawancara' },
                { data: 'lokasi' },
                { 
                    data: 'hasil',
                    render: function(data) {
                        return `<span class="${data.badgeClass}">${data.text}</span>`;
                    }
                },
                { 
                    data: 'aksi',
                    render: function(data) {
                        let actionButtons = `
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-icon btn-info view-wawancara me-1" 
                                        data-id="${data.id}"
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Lihat Detail">
                                        <span class="btn-inner"> 
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> 
                                                <path d="M12 4.5C7.5 4.5 3.5 8.5 2 12c1.5 3.5 5.5 7.5 10 7.5s8.5-4 10-7.5c-1.5-3.5-5.5-7.5-10-7.5zm0 12c-2.5 0-4.5-2-4.5-4.5S9.5 7.5 12 7.5 16.5 9.5 16.5 12 14.5 16.5 12 16.5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> 
                                            </svg> 
                                        </span>
                                </button>
                                <button class="btn btn-sm btn-icon btn-warning edit-wawancara me-1" 
                                        data-id="${data.id}"
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Edit Wawancara">
                                    <span class="btn-inner">
                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                            </span>
                                </button>
                            `;
                        if (data.showAddResultButton) {
                            actionButtons += `
                                <button class="btn btn-sm btn-icon btn-success add-wawancara" 
                                        data-id="${data.id}"
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Tambah Hasil Seleksi">
                                    <span class="btn-inner">
                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87651 15.2063C6.03251 15.2063 2.74951 15.7873 2.74951 18.1153C2.74951 20.4433 6.01251 21.0453 9.87651 21.0453C13.7215 21.0453 17.0035 20.4633 17.0035 18.1363C17.0035 15.8093 13.7415 15.2063 9.87651 15.2063Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.8766 11.886C12.3996 11.886 14.4446 9.841 14.4446 7.318C14.4446 4.795 12.3996 2.75 9.8766 2.75C7.3546 2.75 5.3096 4.795 5.3096 7.318C5.3006 9.832 7.3306 11.877 9.8456 11.886H9.8766Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M19.2036 8.66919V12.6792" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M21.2497 10.6741H17.1597" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </button>
                            `;
                        }
                        actionButtons += `</div>`;
                        return actionButtons;
                    }
                }
            ],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });

        // Setup event listeners for action buttons
        setupActionButtons();
    }

    // Setup event listeners for action buttons
    function setupActionButtons() {
        $('#wawancara-table tbody').on('click', '.view-wawancara', function() {
            const wawancaraId = $(this).data('id');
            console.log(`Melihat detail wawancara ID: ${wawancaraId}`);
            // Logic to display wawancara details
            window.location.href = `/rekrutmen/wawancara/${wawancaraId}/view`;
        });

        $('#wawancara-table tbody').on('click', '.edit-wawancara', function() {
            const wawancaraId = $(this).data('id');
            console.log(`Mengedit wawancara ID: ${wawancaraId}`);
            // Logic to open edit wawancara form
            window.location.href = `/rekrutmen/wawancara/${wawancaraId}/edit`;
        });

        $('#wawancara-table tbody').on('click', '.add-wawancara', function() {
            const wawancaraId = $(this).data('id');
            // Redirect to hasil-seleksi.create route
            window.location.href = `/rekrutmen/hasil_seleksi/create?wawancara_id=${wawancaraId}`;
        });
    }

    // Check authentication before fetching data
    if (checkAuth()) {
        fetchWawancaraData();
    }
});
</script>
@endpush