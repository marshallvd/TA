@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Penggajian Pribadi
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
        {{-- Header Card --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <b><h2 class="card-title mb-1">Manajemen Penggajian</h2></b>
                        <p class="card-text text-muted">Human Resource Management System SEB</p>
                    </div>
                    <div>
                        <i class="bi bi-wallet2 text-primary" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Riwayat Penggajian</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="periodeFilter">Filter Periode:</label>
                                <input type="month" id="periodeFilter" class="form-control">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button id="filterButton" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="gaji-pribadi-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><i class="bi bi-hash me-1"></i>No</th>
                                        <th><i class="bi bi-calendar-event me-1"></i>Periode Gaji</th>
                                        <th><i class="bi bi-wallet2 me-1"></i>Gaji Bersih</th>
                                        <th><i class="bi bi-three-dots-vertical me-1"></i>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan diisi melalui JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    //const baseUrl = 'http://127.0.0.1:8000/api';
    let dataTableInstance = null;

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

    // Ambil ID Pegawai dari data user
    let idPegawai = null;
    async function fetchUserData() {
        try {
            const response = await fetch(`${API_BASE_URL}/auth/me`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data user');
            }

            const userData = await response.json();
            idPegawai = userData.pegawai.id_pegawai;
            
            // Set default filter ke bulan saat ini
            const currentDate = new Date();
            const currentMonth = currentDate.getFullYear() + '-' + String(currentDate.getMonth() + 1).padStart(2, '0');
            document.getElementById('periodeFilter').value = currentMonth;

            // Inisialisasi DataTable
            initDataTable(idPegawai);
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
    }

    function initDataTable(idPegawai, periode = null) {
        // Destroy existing DataTable if it exists
        if (dataTableInstance) {
            dataTableInstance.destroy();
        }

        dataTableInstance = $('#gaji-pribadi-table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: `${API_BASE_URL}/gaji/pegawai/${idPegawai}`,
                type: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                data: function(d) {
                    if (periode) {
                        d.periode = periode;
                    }
                },
                dataType: 'json',
                dataSrc: function(json) {
                    console.log('Raw JSON response:', json);
                    
                    // Filter data yang memiliki gaji bersih dan sudah dinilai
                    return json.filter(item => 
                        item.gaji_bersih !== null && 
                        item.gaji_bersih !== undefined
                    );
                },
                error: function(xhr, error, thrown) {
                    console.error('DataTables error:', xhr.responseText, error, thrown);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON ? xhr.responseJSON.message : 'Gagal memuat data gaji'
                    });
                }
            },
            columns: [
                { 
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1 
                },
                { 
                    data: null,
                    render: function(data, type, row) {
                        return `${row.periode_tahun}-${String(row.periode_bulan).padStart(2, '0')}`;
                    }
                },
                { 
                    data: 'gaji_bersih',
                    render: function(data, type, row) {
                        return data ? `Rp ${Number(data).toLocaleString('id-ID')}` : '-';
                    }
                },
                { 
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <div class="flex align-items-center list-user-action">
                                <a href="/gaji/view/${row.id_gaji}" 
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
                            </div>`;
                    }
                }
            ],
            language: {
                processing: "Loading...",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data gaji yang tersedia",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data yang tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)", paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                },
                search: "Cari:"
            }
        });
    }

    document.getElementById('filterButton').addEventListener('click', async function() {
        const periode = document.getElementById('periodeFilter').value;
        try {
            initDataTable(idPegawai, periode);
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal memuat data: ' + error.message
            });
        }
    });

    fetchUserData();
});
</script>
@endpush

@endsection