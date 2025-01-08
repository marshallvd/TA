@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Manajemen User Pelamar
@endsection

@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
            {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen User Pelamar</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-postcard-heart text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">List User Pelamar</h4>
                        </div>
                        <div>
                            <a href="{{ route('pelamar.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-square me-2"></i>Tambah Pelamar
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <div class="table-responsive">
                            <table id="user-list-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr class="ligth">
                                        <th><b>No</b></th>
                                        <th><b>Nama Pelamar</b></th>
                                        <th><b>Email</b></th>
                                        <th><b>No HP</b></th>
                                        <th><b>Pendidikan Terakhir</b></th>
                                        <th style="min-width: 100px"><b>Action</b></th>
                                    </tr>
                                </thead>
                                <tbody id="user-table-body">
                                    <!-- Data User akan dimasukkan di sini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
// Include these in your HTML head or before the script
// <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
// <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
// <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
// <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Konfigurasi Utama
    const token = localStorage.getItem('token');
    const API_URL = 'http://localhost:8000/api/pelamar';
    let userTable; // Variabel global untuk DataTable

    // SVG Icons
    const editSvg = `
        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    `;

    const deleteSvg = `
        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
            <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    `;

    // Validasi Token
    function validateToken() {
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
    }

    // Inisialisasi DataTable
    function initDataTable() {
        userTable = $('#user-list-table').DataTable({
            processing: true,
            pageLength: 10,
            language: {
                processing: "Loading...",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data yang tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
                search: "Cari:"
            },
            ordering: true,
            searching: true,
            responsive: true
        });
    }

    // Fetch Data Pelamar
    async function fetchPelamar() {
        try {
            const response = await fetch(API_URL, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
            }

            const responseData = await response.json();
            return responseData.data.data || []; 

        } catch (error) {
            console.error('Error fetching pelamar:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: `Gagal mengambil data pelamar: ${error.message}`,
                confirmButtonText: 'OK'
            });
            return [];
        }
    }

    // Render Data ke Tabel
    function renderPelamarData(pelamarData) {
        // Clear existing data
        userTable.clear();

        if (pelamarData.length > 0) {
            pelamarData.forEach((pelamar, index) => {
                // Pastikan pelamar.id_pelamar atau pelamar.id digunakan
                const pelamarId = pelamar.id_pelamar || pelamar.id;
                
                userTable.row.add([
                    index + 1,
                    pelamar.nama || 'N/A',
                    pelamar.email || 'N/A',
                    pelamar.no_hp || 'N/A',
                    pelamar.pendidikan_terakhir || 'N/A',
                    `<div class="flex align-items-center list-user-action">
                        <a class="btn btn-sm btn-icon btn-warning me-2 edit-pelamar" 
                           data-bs-toggle="tooltip" 
                           data-bs-placement="top" 
                           title="Edit" 
                           href="/pelamar/edit/${pelamarId}" 
                           data-id="${pelamarId}">
                            <span class="btn-inner ">
                                ${editSvg}
                            </span>
                        </a>
                        <a class="btn btn-sm btn-icon btn-danger delete-pelamar" 
                           data-bs-toggle="tooltip" 
                           data-bs-placement="top" 
                           title="Hapus" 
                           href="javascript:void(0)" 
                           data-id="${pelamarId}">
                            <span class="btn-inner">
                                ${deleteSvg}
                            </span>
                        </a>
                    </div>`
                ]).draw();
            });

            // Attach delete event after drawing the table
            attachDeleteEvents();
        } else {
            userTable.row.add(['', 'Tidak ada data', '', '', '', '']).draw();
        }
    }

    // Attach delete events to dynamically created buttons
    function attachDeleteEvents() {
        document.querySelectorAll('.delete-pelamar').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const pelamarId = this.getAttribute('data-id');

                // Tambahkan validasi
                if (pelamarId && pelamarId !== 'undefined') {
                    console.log('ID yang akan dihapus:', pelamarId);
                    deletePelamar(pelamarId);
                } else {
                    Swal.fire('Error', 'ID Pelamar tidak valid', 'error');
                }
            });
        });
    }

    // Function to delete pelamar
    async function deletePelamar(id) {
        // Validasi ID dengan lebih ketat
        if (!id || id === 'undefined') {
            Swal.fire('Error', 'ID Pelamar tidak valid', 'error');
            return;
        }

        const confirmDelete = await Swal.fire({
            title: 'Konfirmasi Hapus',
            text: "Apakah Anda yakin ingin menghapus pelamar ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        });

        if (confirmDelete.isConfirmed) {
            try {
                const response = await fetch(`${API_URL}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const responseData = await response.json();

                if (response.ok && responseData.status === 'success') {
                    Swal.fire('Terhapus!', responseData.message, 'success');

                    // Hapus baris dari DataTable
                    const rowToRemove = $(`a.delete-pelamar[data-id="${id}"]`).closest('tr');
                    userTable.row(rowToRemove).remove().draw();
                } else {
                    throw new Error(responseData.message || 'Gagal menghapus pelamar');
                }
            } catch (error) {
                console.error('Delete error:', error);
                Swal.fire('Error', error.message, 'error');
            }
        }
    }

    // Main Function
    async function main() {
        if (!validateToken()) return;

        initDataTable();
        const pelamarData = await fetchPelamar();
        renderPelamarData(pelamarData);
    }

    main();
});
</script>
@endsection