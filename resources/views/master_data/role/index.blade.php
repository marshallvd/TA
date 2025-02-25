@extends('layouts.master')

@section('title')
Manajemen Role
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Daftar Role</h4>
                    </div>
                    <div>
                        <a href="{{ route('master_data.role.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Role
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="role-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="70%">Nama Role</th>
                                    <th width="25%">Aksi</th>
                                </tr>
                            </thead>
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
    // Get token from localStorage
    const token = localStorage.getItem('token');

    // Check if token exists, if not redirect to login
    if (!token) {
        window.location.href = '/login';
        return;
    }

    // Initialize DataTable
    const table = $('#role-table').DataTable({
        processing: true,
        serverSide: false,
        responsive: true,
        ajax: {
            url: '/api/role',
            type: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            dataSrc: function(response) {
                // Log the response for debugging
                console.log('API Response:', response);

                // Handle different response formats
                let data = [];
                
                try {
                    // If response is already an array
                    if (Array.isArray(response)) {
                        data = response;
                    }
                    // If response has a data property containing the array
                    else if (response.data && Array.isArray(response.data)) {
                        data = response.data;
                    }
                    // Handle unexpected response format
                    else {
                        console.error('Unexpected response format:', response);
                        Swal.fire('Error', 'Format data tidak sesuai', 'error');
                        return [];
                    }

                    // Map the data to the required format
                    return data.map((item, index) => ({
                        DT_RowIndex: index + 1,
                        nama_role: item.nama_role,
                        actions: `
                            <div class="flex align-items-center list-user-action">
                                <a class="btn btn-sm btn-icon btn-warning" 
                                   data-bs-toggle="tooltip" 
                                   data-bs-placement="top" 
                                   title="Edit" 
                                   href="/master_data/role/${item.id}/edit">
                                    <span class="btn-inner">
                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </a>
                                <a class="btn btn-sm btn-icon btn-danger delete-role" 
                                   data-bs-toggle="tooltip" 
                                   data-bs-placement="top" 
                                   title="Delete" 
                                   data-id="${item.id}" 
                                   href="javascript:void(0)">
                                    <span class="btn-inner">
                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                            <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        `
                    }));
                } catch (error) {
                    console.error('Error processing response:', error);
                    Swal.fire('Error', 'Gagal memproses data', 'error');
                    return [];
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax error:', { xhr, status, error });
                
                // Handle specific HTTP status codes
                switch (xhr.status) {
                    case 401:
                        localStorage.removeItem('token');
                        window.location.href = '/login';
                        break;
                    case 403:
                        Swal.fire('Error', 'Anda tidak memiliki akses', 'error');
                        break;
                    case 404:
                        Swal.fire('Error', 'Data tidak ditemukan', 'error');
                        break;
                    default:
                        Swal.fire('Error', 'Gagal mengambil data dari server', 'error');
                }
            }
        },
        columns: [
            { 
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false
            },
            { 
                data: 'nama_role',
                name: 'nama_role'
            },
            { 
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            }
        ],
        language: {
            processing: "Memproses...",
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ data keseluruhan)",
            loadingRecords: "Memuat...",
            zeroRecords: "Tidak ditemukan data yang sesuai",
            emptyTable: "Tidak ada data yang tersedia",
            paginate: {
                first: "Pertama",
                previous: "Sebelumnya",
                next: "Selanjutnya",
                last: "Terakhir"
            }
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>'
    });

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Handle delete action
    document.addEventListener('click', function(e) {
        const deleteButton = e.target.closest('.delete-role');
        if (!deleteButton) return;

        e.preventDefault();
        const roleId = deleteButton.dataset.id;

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Role yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/api/role/${roleId}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire(
                        'Dihapus!',
                        'Data role telah dihapus.',
                        'success'
                    );
                    table.ajax.reload(null, false);
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menghapus data.',
                        'error'
                    );
                });
            }
        });
    });
});
</script>
@endpush