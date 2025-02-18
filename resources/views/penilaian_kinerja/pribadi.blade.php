@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Penilaian Kinerja Pribadi
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
        {{-- Header Card --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <b><h2 class="card-title mb-1">Manajemen Penilaian Kinerja</h2></b>
                        <p class="card-text text-muted">Human Resource Management System SEB</p>
                    </div>
                    <div>
                        <i class="bi bi-person-workspace text-primary" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Penilaian Kinerja Pribadi</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="periodeFilter">Filter Periode:</label>
                                <input type="month" id="periodeFilter" class="form-control">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button id="filterButton" class="btn btn-primary"><i class="bi bi-filter-square me-2"></i>Filter</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="penilaian-kinerja-pribadi-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><i class="bi bi-hash me-1"></i>No</th>
                                        <th><i class="bi bi-calendar-event me-1"></i>Periode Penilaian</th>
                                        <th><i class="bi bi-graph-up me-1"></i>Nilai KPI</th>
                                        <th><i class="bi bi-card-checklist me-1"></i>Nilai Kompetensi</th>
                                        <th><i class="bi bi-heart me-1"></i>Nilai Core Values</th>
                                        <th><i class="bi bi-star me-1"></i>Nilai Akhir</th>
                                        <th><i class="bi bi-award me-1"></i>Predikat</th>
                                        <th><i class="bi bi-three-dots-vertical me-1"></i>Aksi</th>
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
    const baseUrl = API_BASE_URL;
    let pegawaiId = null;
    let penilaianPribadiTable;

    // Fungsi untuk fetch data user dan inisialisasi tabel
    async function initializePage() {
        try {
            // Fetch data user dari endpoint auth/me
            const response = await fetch(`${API_BASE_URL}/auth/me`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data user');
            }

            const userData = await response.json();
            pegawaiId = userData.user.id_pegawai;

            // Setelah dapat ID Pegawai, inisialisasi DataTable
            initDataTable(pegawaiId);
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
    }

    function initDataTable(pegawaiId) {
        // Set default filter ke bulan saat ini
        const currentDate = new Date();
        const currentMonth = currentDate.getFullYear() + '-' + String(currentDate.getMonth() + 1).padStart(2, '0');
        document.getElementById('periodeFilter').value = currentMonth;

        // Inisialisasi DataTable
        penilaianPribadiTable = $('#penilaian-kinerja-pribadi-table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: `${baseUrl}/penilaian-kinerja`,
                type: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                data: function(d) {
                    d.id_pegawai = pegawaiId;
                    // const periode = document.getElementById('periodeFilter').value;
                    // if (periode) {
                    //     d.periode = periode;
                    // }
                },
                dataSrc: function(json) {
                    return json.data || [];
                },
                error: function(xhr, error, thrown) {
                    console.error('DataTables error:', xhr.responseText, error, thrown);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON ? xhr.responseJSON.message : 'Gagal memuat data'
                    });
                }
            },
            columns: [
                { 
                    data: null, 
                    render: (data, type, row, meta) => meta.row + 1 
                },
                { 
                    data: 'periode_penilaian',
                    render: function(data) {
                        return data || '-';
                    }
                },
                { 
                    data: 'penilaian_k_p_i.nilai_rata_rata',
                    render: function(data) {
                        return data ? Number(data).toFixed(2) : '-';
                    }
                },
                { 
                    data: 'penilaian_kompetensi.nilai_rata_rata',
                    render: function(data) {
                        return data ? Number(data).toFixed(2) : '-';
                    }
                },
                { 
                    data: 'penilaian_core_values.nilai_rata_rata',
                    render: function(data) {
                        return data ? Number(data).toFixed(2) : '-';
                    }
                },
                { 
                    data: 'nilai_akhir',
                    render: function(data) {
                        return data ? Number(data).toFixed(2) : '-';
                    }
                },
                { 
                    data: 'predikat',
                    render: function(data) {
                        return data || '-';
                    }
                },
                { 
                    data: null,
                    render: function(data, type, row) {
                        if (row.id_penilaian_kinerja) {
                            return `
                                <div class="flex align-items-center list-user-action">
                                    <a href="/penilaian_kinerja/view/${row.id_penilaian_kinerja}" 
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
                        } else {
                            return '-';
                        }
                    }
                }
            ],
            language: {
                processing: "Loading...",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data penilaian kinerja",
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
            }
        });

        // Event listener untuk filter
        document.getElementById('filterButton').addEventListener('click', function() {
            const periode = document.getElementById('periodeFilter').value;
            penilaianPribadiTable.ajax.reload((json) => {
                penilaianPribadiTable.ajax.params({
                    id_pegawai: pegawaiId,
                    periode: periode
                });
            });
        });
    }

    // Validasi token
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

    // Mulai inisialisasi halaman
    initializePage();
});
</script>
@endpush

@endsection