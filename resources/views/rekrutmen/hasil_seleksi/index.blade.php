@extends('layouts.master')

@section('title')
    Daftar Hasil Seleksi
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Hasil Seleksi</h2></b>
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
                        <h4 class="card-title">Daftar Hasil Seleksi</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="hasil-seleksi-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelamar</th>
                                    <th>Lowongan Pekerjaan</th>
                                    <th>Status</th>
                                    <th>Catatan</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="hasil-seleksi-body">
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
        const statusClasses = {
            'lulus': 'badge bg-success',
            'gagal': 'badge bg-danger',
            'tertunda': 'badge bg-warning'
        };
        
        return statusClasses[status?.toLowerCase()] || 'badge bg-secondary';
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

    // Fetch Hasil Seleksi Data
    const fetchHasilSeleksiData = async () => {
        try {
            const response = await fetch(`${API_CONFIG.baseUrl}${API_CONFIG.endpoints.hasilSeleksi}`, {
                method: 'GET',
                headers: getAuthHeaders()
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const hasilSeleksiData = await response.json();
            initializeDataTable(hasilSeleksiData.data || []);

        } catch (error) {
            console.error('Error fetching data:', error);
            showError('Gagal memuat data: ' + error.message);
        }
    };

    // Inisialisasi DataTable
    function initializeDataTable(hasilSeleksiList) {
        // Persiapkan data untuk DataTable
        const tableData = hasilSeleksiList.map((hasil, index) => ({
            no: index + 1,
            namaPelamar: hasil.pelamar?.nama || 'Nama Tidak Tersedia',
            judulPekerjaan: hasil.lowongan_pekerjaan?.judul_pekerjaan || 'Tidak Diketahui',
            status: {
                text: hasil.status || 'Belum Ada',
                badgeClass: getStatusBadgeClass(hasil.status)
            },
            catatan: hasil.catatan || '-',
            tanggalDibuat: formatDate(hasil.tanggal_dibuat),
            aksi: {
                id: hasil.id_hasil_seleksi
            }
        }));

        // Inisialisasi DataTable
        hasilSeleksiTable = $('#hasil-seleksi-table').DataTable({
            data: tableData,
            columns: [
                { 
                    data: 'no',
                    width: '5%'
                },
                { data: 'namaPelamar' },
                { data: 'judulPekerjaan' },
                { 
                    data: 'status',
                    render: function(data) {
                        return `<span class="${data.badgeClass}">${data.text}</span>`;
                    }
                },
                { data: 'catatan' },
                { data: 'tanggalDibuat' },
                { 
                    data: 'aksi',
                    render: function(data) {
                        return `
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-icon btn-info view-hasil-seleksi me-1" 
                                        data-id="${data.id}"
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Lihat Detail">
                                    <span class="btn-inner"> 
                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> 
                                            <path d="M12 4.5C7.5 4.5 3.5 8.5 2 12c1.5 3.5 5.5 7.5 10 7.5s8.5-4 10-7.5c-1.5-3.5-5.5-7.5-10-7.5zm0 12c-2.5 0-4.5-2-4.5-4.5S9.5 7.5 12 7.5 16.5 9.5 16.5 12 14.5 16.5 12 16.5z" stroke="currentColor" stroke -width="1.5" stroke-linecap="round" stroke-linejoin="round"/> 
                                        </svg> 
                                    </span>
                                </button>
                                <button class="btn btn-sm btn-icon btn-warning edit-hasil-seleksi me-1" 
                                        data-id="${data.id}"
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Edit Hasil Seleksi">
                                    <span class="btn-inner">
                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </button>
                            </div>`;
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
        $('#hasil-seleksi-table tbody').on('click', '.view-hasil-seleksi', function() {
            const hasilId = $(this).data('id');
            window.location.href = `/rekrutmen/hasil_seleksi/${hasilId}/view`;
        });

        $('#hasil-seleksi-table tbody').on('click', '.edit-hasil-seleksi', function() {
            const hasilId = $(this).data('id');
            window.location.href = `/rekrutmen/hasil_seleksi/${hasilId}/edit`;
        });
    }

    // Check authentication before fetching data
    if (checkAuth()) {
        fetchHasilSeleksiData();
    }
});
</script>
@endpush