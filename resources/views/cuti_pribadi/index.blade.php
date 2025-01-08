@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Pengajuan Cuti Pribadi
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
        {{-- Header Card --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <b><h2 class="card-title mb-1">Manajemen Pengajuan Cuti Pribadi</h2></b>
                        <p class="card-text text-muted">Human Resource Management System SEB</p>
                    </div>
                    <div>
                        <i class="bi bi-calendar2-week text-primary" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Pengajuan Cuti Pribadi</h4>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" id="tambahCutiBtn">
                                <i class="bi bi-plus-square me-2"></i>Tambah Pengajuan Cuti
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const baseUrl = 'http://127.0.0.1:8000/api';
    let cutiPribadiTable;
    
    // Fungsi untuk menangani error dengan SweetAlert
    function handleError(title, message) {
        Swal.fire({
            icon: 'error',
            title: title,
            text: message,
            confirmButtonText: 'OK'
        });
    }

    // Cek token keberadaan
    if (!token) {
        handleError('Akses Ditolak', 'Anda harus login untuk mengakses halaman ini.');
        window.location.href = '/login';
        return;
    }

    // Fetch user data terlebih dahulu
    fetch(`${baseUrl}/auth/me`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Gagal mengambil data pengguna');
        }
        return response.json();
    })
    .then(userData => {
        // DEBUGGING: Tambahkan log detail
        console.log('======= DEBUG USER DATA =======');
        console.log('Data Pengguna Lengkap (Stringified):', JSON.stringify(userData, null, 2));
        console.log('Struktur userData:', Object.keys(userData));
        console.log('Struktur pegawai:', Object.keys(userData.pegawai || {}));
        
        // PENTING: Pastikan pengambilan ID Pegawai benar
        const idPegawai = userData.pegawai ? userData.pegawai.id_pegawai : null;
        const idUser = userData.user ? userData.user.id_user : null;
        
        console.log('ID Pegawai yang Sedang Login:', idPegawai);
        console.log('ID User:', idUser);
        console.log('Tipe ID Pegawai:', typeof idPegawai);
        
        if (!idPegawai) {
            throw new Error('Tidak dapat menemukan ID Pegawai');
        }

        // Initialize DataTable dengan ID pengguna
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
                    console.log('======= DEBUG CUTI DATA =======');
                    console.log('Respon API Cuti Mentah (Stringified):', JSON.stringify(response, null, 2));
                    console.log('Total Data Cuti:', response.data.length);
                    
                    // Debugging: Tampilkan detail setiap item cuti
                    response.data.forEach((item, index) => {
                        console.log(`Item Cuti ke-${index + 1}:`, JSON.stringify(item, null, 2));
                    });
                    
                    // Filter data berdasarkan id_pegawai 
                    const filteredData = response.data.filter(item => {
                        console.log('Filtering Cuti - Item Full:', JSON.stringify(item, null, 2));
                        console.log('Comparing ID Pegawai:', item.id_pegawai, 'dengan ID Login:', idPegawai);
                        
                        // Pastikan perbandingan ID dilakukan dengan benar
                        return item.id_pegawai === idPegawai;
                    });

                    console.log('Data Cuti Terfilter:', filteredData);
                    console.log('Jumlah Data Cuti Terfilter:', filteredData.length);
                    
                    // Tambahkan pesan khusus jika tidak ada data
                    if (filteredData.length === 0) {
                        console.warn('Tidak ada data cuti ditemukan untuk pegawai ini');
                    }
                    
                    return filteredData;
                },
                error: function(xhr, error, thrown) {
                    console.error('Error mengambil data:', error);
                    console.error('Response Error:', xhr.responseText);
                    handleError('Error', 'Gagal memuat data: ' + (xhr.responseJSON?.message || 'Error tidak dikenal'));
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
                        // Untuk status menunggu, tampilkan button edit dan delete
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
                        // Untuk status selain menunggu (disetujui atau ditolak), tampilkan hanya button view
                        else {
                            return `
                                <div class="flex align-items-center list-user-action">
                                    <a href="/cuti-pribadi/${data.id_cuti}/view" 
                                    class="btn btn-sm btn-icon btn-info"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Detail">
                                        <span class="btn-inner">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 4.5C7.5 4.5 3.5 8.5 2 12c1.5 3.5 5.5 7.5 10 7.5s8.5-4 10-7.5c-1.5-3.5-5.5-7.5-10-7.5zm0 12c-2.5 0-4.5-2-4.5-4.5S9.5 7.5 12 7.5 16.5 9.5 16.5 12 14.5 16.5 12 16.5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            `;
                        }
                    }
                }
            ],
            language: {
                processing: "Memuat...",
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

        // Inisialisasi tooltip setelah tabel digambar
        cutiPribadiTable.on('draw', function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    })
    .catch(error => {
        console.error('Error Utama:', error);
        handleError('Error', 'Gagal memuat data: ' + error.message);
    });

    // Event listener untuk tombol "Tambah Pengajuan Cuti"
    document.getElementById('tambahCutiBtn').addEventListener('click', function() {
        window.location.href = '/cuti/create';
    });
});

// Definisikan fungsi deleteCuti dalam lingkup global
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
                // Muat ulang DataTable untuk mencerminkan perubahan
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