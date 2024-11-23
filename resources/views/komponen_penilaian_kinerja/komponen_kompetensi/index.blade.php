@extends('layouts.master')

@section('title')
Manajemen Komponen Kompetensi
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Daftar Komponen Kompetensi</h4>
                    </div>
                    <div>
                        <a href="{{ route('komponen-kompetensi.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Komponen Kompetensi
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="kompetensi-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="30%">Nama Kompetensi</th>
                                    <th width="35%">Perilaku Utama</th>
                                    <th width="10%">Bobot</th>
                                    <th width="20%">Aksi</th>
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
    const token = localStorage.getItem('token');
    
    if (!token) {
        window.location.href = '{{ route('login') }}';
        return;
    }

    const table = $('#kompetensi-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: '{{ url('api/komponen-kompetensi') }}',
            type: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            },
            dataSrc: function(response) {
                if (!Array.isArray(response.data)) {
                    console.error('Invalid response format:', response);
                    return [];
                }
                return response.data.map((item, index) => ({
                    DT_RowIndex: index + 1,
                    nama_kompetensi: item.nama_kompetensi,
                    perilaku_utama: item.perilaku_utama,
                    bobot: item.bobot,
                    actions: `
                        <div class="flex align-items-center list-user-action">
                            <a class="btn btn-sm btn-icon btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" href="{{ url('komponen-penilaian/kompetensi/edit') }}/${item.id_komponen_kompetensi}">
                                <span class="btn-inner">
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </a>
                            <a class="btn btn-sm btn-icon btn-danger delete-kompetensi" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-id="${item.id_komponen_kompetensi}" href="javascript:void(0)">
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
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
            { data: 'nama_kompetensi', name: 'nama_kompetensi' },
            { data: 'perilaku_utama', name: 'perilaku_utama' },
            { data: 'bobot', name: 'bobot' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
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
        }
    });

    // Delete handler
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-kompetensi')) {
            e.preventDefault();
            const deleteButton = e.target.closest('.delete-kompetensi');
            const kompetensiId = deleteButton.dataset.id;

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data Kompetensi yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ url('api/komponen-kompetensi') }}/${kompetensiId}`, {
                        method: 'DELETE',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            if (response.status === 401) {
                                throw new Error('Unauthorized');
                            }
                            return response.json().then(err => { throw err; });
                        }
                        return response.json();
                    })
                    .then(() => {
                        Swal.fire(
                            'Terhapus!',
                            'Data Kompetensi berhasil dihapus.',
                            'success'
                        );
                        table.ajax.reload();
                    })
                    .catch(error => {
                        if (error.message === 'Unauthorized') {
                            window.location.href = '{{ route('login') }}';
                            return;
                        }
                        Swal.fire(
                            'Error!',
                            error.message || 'Terjadi kesalahan saat menghapus data',
                            'error'
                            );
                    });
                }
            });
        }
    });

    // Fungsi refresh token
    async function refreshToken() {
        try {
            const response = await fetch('{{ url('api/auth/refresh') }}', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });
            
            if (!response.ok) {
                throw new Error('Token refresh failed');
            }
            
            const data = await response.json();
            localStorage.setItem('token', data.access_token);
        } catch (error) {
            window.location.href = '{{ route('login') }}';
        }
    }

    // Handler untuk error network yang tidak tertangani
    window.addEventListener('unhandledrejection', function(event) {
        if (event.reason && event.reason.name === 'TypeError') {
            console.error('Network error occurred:', event.reason);
        }
    });
});
</script>
@endpush