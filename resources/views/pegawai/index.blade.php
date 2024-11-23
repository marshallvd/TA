@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Kepegawaian
@endsection

@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">List Pegawai</h4>
                        </div>
                        <div>
                            <div>
                                <button type="button" class="btn btn-primary" id="tambahPegawaiBtn">
                                    <i class="fas fa-plus me-2"></i>Tambah Pegawai
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <div class="table-responsive">
                            <table id="pegawai-list-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr class="ligth">
                                        <th><b>No</b></th>
                                        <th><b>Nama</b></th>
                                        <th><b>Telepon</b></th>
                                        <th><b>Email</b></th>
                                        <th><b>Jabatan</b></th>
                                        <th><b>Status</b></th>
                                        <th><b>Tanggal Masuk</b></th>
                                        <th style="min-width: 100px"><b>Action</b></th>
                                    </tr>
                                </thead>
                                <tbody id="pegawai-table-body">
                                    <!-- Data Pegawai akan dimasukkan di sini -->
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

    // Tambahkan event listener untuk tombol Tambah Pegawai
    document.getElementById('tambahPegawaiBtn').addEventListener('click', function() {
        window.location.href = "{{ route('pegawai.create') }}";
        console.log('Tombol Tambah Pegawai diklik');
    });

    // Inisialisasi DataTable
    let pegawaiTable = $('#pegawai-list-table').DataTable({
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

    // Fungsi untuk mengambil data dari API
    async function fetchData(endpoint) {
    try {
        console.log('Mengambil data dari endpoint:', endpoint);
        console.log('Menggunakan token:', token); // Log token

        const response = await fetch(`http://127.0.0.1:8000/api/${endpoint}`, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json',
            }
        });

        console.log(`Response dari ${endpoint}:`, response); // Log response

        if (!response.ok) {
            const errorText = await response.text();
            console.error(`Server responded with ${response.status}: ${errorText}`);
            throw new Error(`Error fetching ${endpoint}: ${response.statusText}`);
        }

        return response.json();
    } catch (error) {
        console.error('Fetch error:', error);
        throw error;
    }
}

    // Fungsi untuk menghapus pegawai
    async function deletePegawai(id) {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/pegawai/${id}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal menghapus data');
            }

            const result = await response.json();
            return result;
        } catch (error) {
            console.error('Error:', error);
            throw error;
        }
    }

    // Fungsi untuk mendapatkan nama jabatan dan divisi
    function getNamaJabatan(jabatanList, id_jabatan) {
        const jabatan = jabatanList.find(j => j.id_jabatan === id_jabatan);
        return jabatan ? jabatan.nama_jabatan : 'Tidak ditemukan';
    }

    function getNamaDivisi(divisiList, id_divisi) {
        const divisi = divisiList.find(d => d.id_divisi === id_divisi);
        return divisi ? divisi.nama_divisi : 'Tidak ditemukan';
    }

    // Mengambil semua data yang diperlukan
    Promise.all([
        fetchData('pegawai'),
        fetchData('jabatan'),
        fetchData('divisi'),
        fetchData('users') // Tambahkan endpoint untuk mengambil data users
    ])
    .then(([pegawaiData, jabatanData, divisiData, userData]) => {
        console.log('Data Pegawai:', pegawaiData);
        console.log('Data Jabatan:', jabatanData);
        console.log('Data Divisi:', divisiData);
        console.log('Data Users:', userData);

        // Clear existing data
        pegawaiTable.clear();

        if (pegawaiData && pegawaiData.data) {
            pegawaiData.data.forEach((item, index) => {
                const namaJabatan = getNamaJabatan(jabatanData, item.id_jabatan);
                const namaDivisi = getNamaDivisi(divisiData, item.id_divisi);
                
                // Cek apakah pegawai sudah memiliki user account
                const hasUserAccount = userData.some(user => user.id_pegawai === item.id_pegawai);

                // Buat tombol aksi berdasarkan kondisi user account
                const actionButtons = `
                    <div class="flex align-items-center list-user-action">
                        ${!hasUserAccount ? `
                        <a href="/user/create?id_pegawai=${item.id_pegawai}" 
                        class="btn btn-sm btn-icon btn-success" 
                        data-bs-toggle="tooltip" 
                        data-bs-placement="top" 
                        title="Add">
                            <span class="btn-inner">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87651 15.2063C6.03251 15.2063 2.74951 15.7873 2.74951 18.1153C2.74951 20.4433 6.01251 21.0453 9.87651 21.0453C13.7215 21.0453 17.0035 20.4633 17.0035 18.1363C17.0035 15.8093 13.7415 15.2063 9.87651 15.2063Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.8766 11.886C12.3996 11.886 14.4446 9.841 14.4446 7.318C14.4446 4.795 12.3996 2.75 9.8766 2.75C7.3546 2.75 5.3096 4.795 5.3096 7.318C5.3006 9.832 7.3306 11.877 9.8456 11.886H9.8766Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M19.2036 8.66919V12.6792" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M21.2497 10.6741H17.1597" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>                                        
                            </span>
                        </a>
                        ` : ''}
                        <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" href="/pegawai/edit/${item.id_pegawai}">
                            <span class="btn-inner">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                        <a class="btn btn-sm btn-icon btn-danger delete-pegawai" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-id="${item.id_pegawai}" href="javascript:void(0)">
                            <span class="btn-inner">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                    <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                    </div>`;

                pegawaiTable.row.add([
                    index + 1,
                    item.nama_lengkap,
                    item.telepon,
                    item.email,
                    `${namaJabatan}<br><small class="text-muted">${namaDivisi}</small>`,
                    `<span class="badge ${item.status_kepegawaian === 'aktif' ? 'bg-primary' : 'bg-danger'}">
                        ${item.status_kepegawaian.charAt(0).toUpperCase() + item.status_kepegawaian.slice(1)}
                    </span>`,
                    item.tanggal_masuk,
                    actionButtons
                ]);
            });

            // Draw the table
            pegawaiTable.draw();
        } else {
            console.error('Data tidak ditemukan');
            Swal.fire({
                icon: 'error',
                title: 'Data tidak ditemukan',
                text: 'Tidak ada data pegawai yang tersedia.',
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        let errorMessage = 'Terjadi kesalahan saat mengambil data';
        if (error.response) {
            errorMessage += `: ${error.response.status} ${error.response.statusText}`;
        } else if (error.request) {
            errorMessage += ': Tidak ada respons dari server';
        } else {
            errorMessage += `: ${error.message}`;
        }
        Swal.fire({
            icon: 'error',
            title: 'Gagal mengambil data',
            text: errorMessage,
            confirmButtonText: 'OK'
        });
    });

    // Tambahkan event listener untuk tombol delete
    $('#pegawai-list-table').on('click', '.delete-pegawai', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda akan menghapus pegawai ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Tidak, batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                deletePegawai(id)
                    .then(response => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pegawai berhasil dihapus',
                            text: 'Pegawai berhasil dihapus.',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload();
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal menghapus pegawai',
                            text: 'Gagal menghapus pegawai: ' + error.message,
                            confirmButtonText: 'OK'
                        });
                    });
            }
        });
    });

    // Tambahkan event listener untuk tombol Add
    $('#pegawai-list-table').on('click', '.btn-success', function(e) {
        e.preventDefault();
        const href = $(this).attr('href');
        
        Swal.fire({
            title: 'Tambah User Baru',
            text: 'Anda akan menambahkan user baru?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, lanjutkan!',
            cancelButtonText: 'Tidak, batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });

});
</script>

@endsection