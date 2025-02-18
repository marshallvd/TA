@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Manajemen User Pegawai
@endsection

@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen User Pegawai</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-person-vcard text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">List User Pegawai</h4>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table id="user-list-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr class="ligth">
                                    <th><i class="bi bi-hash me-1"></i>No</th>
                                    <th><i class="bi bi-person me-1"></i>Nama Pegawai</th>
                                    <th><i class="bi bi-envelope me-1"></i>Email</th>
                                    <th><i class="bi bi-person-vcard me-1"></i>Role</th>
                                    <th><i class="bi bi-check-square me-1"></i>Status</th>
                                    <th style="min-width: 100px"><i class="bi bi-gear me-1"></i>Action</th>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const API_URL = API_BASE_URL;

    // Cek token
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

    // Inisialisasi DataTable
    let userTable = $('#user-list-table').DataTable({
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
        searching: true
    });

    // Fungsi untuk mengambil data role
    async function fetchRole() {
        try {
            const response = await fetch(`${API_URL}/role`, {
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
            console.log('Role Response:', responseData); // Debug log
            
            // Handle berbagai kemungkinan struktur response
            let roleData;
            if (responseData.data) {
                roleData = responseData.data;
            } else if (Array.isArray(responseData)) {
                roleData = responseData;
            } else {
                throw new Error('Invalid role data structure');
            }

            if (!Array.isArray(roleData)) {
                throw new Error('Role data is not an array');
            }

            return roleData;

        } catch (error) {
            console.error('Error fetching roles:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: `Gagal mengambil data role: ${error.message}`,
                confirmButtonText: 'OK'
            });
            throw error;
        }
    }

    // Fungsi untuk menghapus user
    async function deleteUser(userId) {
        try {
            const response = await fetch(`${API_URL}/users/${userId}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                const error = await response.json();
                throw new Error(error.message || `HTTP error! status: ${response.status}`);
            }

            const result = await response.json();
            console.log('Delete Response:', result); // Debug log
            return result;

        } catch (error) {
            console.error('Error deleting user:', error);
            throw error;
        }
    }

    // Event handler untuk tombol delete
    $(document).on('click', '.delete-user', function(e) {
        e.preventDefault();
        const userId = $(this).data('id');
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data user yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteUser(userId)
                    .then(() => {
                        Swal.fire(
                            'Terhapus!',
                            'User berhasil dihapus.',
                            'success'
                        );
                        // Refresh halaman
                        window.location.reload();
                    })
                    .catch(error => {
                        Swal.fire(
                            'Error!',
                            'Gagal menghapus user: ' + error.message,
                            'error'
                        );
                    });
            }
        });
    });

    // Fungsi untuk mengambil data dari API
    async function fetchData(endpoint) {
        try {
            const response = await fetch(`${API_URL}/${endpoint}`, {
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
            console.log(`${endpoint} Response:`, responseData); // Debug log
            return responseData;
            
        } catch (error) {
            console.error(`Error fetching ${endpoint}:`, error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: `Gagal mengambil data ${endpoint}: ${error.message}`,
                confirmButtonText: 'OK'
            });
            throw error;
        }
    }

    // Mengambil dan menampilkan data
    Promise.all([
        fetchData('users'),
        fetchData('pegawai'),
        fetchRole()
    ])
    .then(([userData, pegawaiData, roleData]) => {
        console.log('Combined Data:', { userData, pegawaiData, roleData }); // Debug log

        // Normalisasi data
        const userArray = userData.data || userData || [];
        const pegawaiArray = pegawaiData.data || pegawaiData || [];
        const roleArray = roleData || [];

        // Clear existing data
        userTable.clear();

        if (userArray.length > 0) {
            userArray.forEach((item, index) => {
                const pegawai = pegawaiArray.find(p => p.id_pegawai === item.id_pegawai) || {};
                const role = roleArray.find(r => r.id_role === item.id_role) || {};

                userTable.row.add([
                    index + 1,
                    pegawai.nama_lengkap || 'N/A',
                    item.email || 'N/A',
                    role.nama_role || 'N/A',
                    `<span class="badge ${item.status === 'aktif' ? 'bg-primary' : 'bg-danger'}">
                        ${(item.status || 'N/A').charAt(0).toUpperCase() + (item.status || 'N/A').slice(1)}
                    </span>`,
                    `<div class="flex align-items-center list-user-action">
                        <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" href="/user/edit/${item.id_user}">
                            <span class="btn-inner">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                        <a class="btn btn-sm btn-icon btn-danger delete-user" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-id="${item.id_user}" href="javascript:void(0)">
                            <span class="btn-inner">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                    <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                    </div>`
                ]);
            });

            userTable.draw();
        } else {
            console.warn('No user data available');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: `Gagal mengambil data: ${error.message}`,
            confirmButtonText: 'OK'
        });
    });
});
</script>

@endsection