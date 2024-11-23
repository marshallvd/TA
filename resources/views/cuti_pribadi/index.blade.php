@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Pengajuan Cuti Pribadi
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Pengajuan Cuti Pribadi</h4>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" id="tambahCutiBtn">
                                <i class="fas fa-plus me-2"></i>Tambah Pengajuan Cuti
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="cuti-pribadi-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Cuti</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Status</th>
                                        <th>Action</th>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const baseUrl = 'http://127.0.0.1:8000/api';
    let cutiPribadiTable;
    
    // Check if token exists
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Anda harus login untuk mengakses halaman ini.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/login';
        });
        return;
    }

    // Fetch user data first
    fetch(`${baseUrl}/auth/me`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to fetch user data');
        }
        return response.json();
    })
    .then(userData => {
        // Get pegawai ID from user data - PERBAIKAN DISINI
        const idPegawai = userData.pegawai.id_pegawai;
        
        // Initialize DataTable with user's ID
        cutiPribadiTable = $('#cuti-pribadi-table').DataTable({
            processing: true,
            serverSide: false,
            pageLength: 10,
            ajax: {
                url: `${baseUrl}/cuti`,
                type: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                dataSrc: function(response) {
                    // Filter data based on id_pegawai - PERBAIKAN DISINI
                    return response.data.filter(item => parseInt(item.id_pegawai) === parseInt(idPegawai));
                },
                error: function(xhr, error, thrown) {
                    console.error('Error fetching data:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data: ' + (xhr.responseJSON?.message || 'Unknown error')
                    });
                }
            },
            columns: [
                { 
                    data: null, 
                    render: (data, type, row, meta) => meta.row + 1 
                },
                { 
                    data: 'jenis_cuti.nama_jenis_cuti',
                    render: function(data, type, row) {
                        return data || 'Tidak ada data';
                    }
                },
                { 
                    data: 'tanggal_mulai',
                    render: function(data) {
                        return data ? new Date(data).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        }) : '-';
                    }
                },
                { 
                    data: 'tanggal_selesai',
                    render: function(data) {
                        return data ? new Date(data).toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        }) : '-';
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
                        const statusText = {
                            'menunggu': 'Menunggu',
                            'disetujui': 'Disetujui',
                            'ditolak': 'Ditolak'
                        };
                        return `<span class="${statusClasses[data] || 'badge bg-secondary'}">${statusText[data] || data}</span>`;
                    }
                },
                { 
                    data: null,
                    render: function(data) {
                        if (data.status === 'menunggu') {
                            return `
                                <div class="flex align-items-center list-user-action">
                                    <a href="/cuti-pribadi/${data.id_cuti}/edit" 
                                       class="btn btn-sm btn-icon btn-warning" 
                                       data-bs-toggle="tooltip" 
                                       data-bs-placement="top" 
                                       title="Edit">
                                        <span class="btn-inner">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </a>
                                    <a href="javascript:void(0)"
                                       class="btn btn-sm btn-icon btn-danger"
                                       data-bs-toggle="tooltip"
                                       data-bs-placement="top"
                                       title="Delete"
                                       onclick="deleteCuti(${data.id_cuti})">
                                        <span class="btn-inner">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            `;
                        }
                        return '-';
                    }
                }
            ],
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
            order: [[2, 'desc']]
        });

        // Debug log untuk memeriksa ID pegawai
        console.log('ID Pegawai yang sedang login:', idPegawai);

        // Initialize tooltips after table is drawn
        cutiPribadiTable.on('draw', function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal memuat data: ' + error.message
        });
    });

    // Event listener for the "Tambah Pengajuan Cuti" button
    document.getElementById('tambahCutiBtn').addEventListener('click', function() {
        window.location.href = '/cuti-pribadi/create';
    });
});

// Define the deleteCuti function in global scope
window.deleteCuti = function(idCuti) {
    const token = localStorage.getItem('token');
    const baseUrl = 'http://127.0.0.1:8000/api';

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`${baseUrl}/cuti/${idCuti}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal menghapus data');
                }
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Pengajuan cuti telah dihapus.',
                    showConfirmButton: false,
                    timer: 1500
                });
                // Reload the DataTable to reflect the changes
                $('#cuti-pribadi-table').DataTable().ajax.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal menghapus data: ' + error.message
                });
            });
        }
    });
};
</script>

@endsection