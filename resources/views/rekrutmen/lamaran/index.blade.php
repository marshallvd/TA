@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Daftar Lamaran Pekerjaan
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Lamaran Pekerjaan</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-suitcase-lg-fill text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h4 class="card-title mb-3">Daftar Lamaran Pekerjaan</h4>
                            <div class="d-flex flex-wrap gap-3 align-items-end">
                                <div>
                                    <label for="monthYearFilter" class="form-label">Bulan & Tahun</label>
                                    <input type="month" id="monthYearFilter" class="form-control">
                                </div>
                                <div>
                                    <label for="divisiFilter" class="form-label">Divisi</label>
                                    <select id="divisiFilter" class="form-control">
                                        <option value="">Semua Divisi</option>
                                    </select>
                                </div>
                                <div>
                                    <button id="applyFilter" class="btn btn-success">
                                        <i class="bi bi-funnel-fill me-1"></i>Filter
                                    </button>
                                </div>
                                <div>
                                    <button id="resetFilter" class="btn btn-warning text-white">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                                    </button>
                                </div>
                                <div class="ms-auto">
                                    <label for="searchInput" class="form-label">Pencarian</label>
                                    <input type="text" id="searchInput" class="form-control" placeholder="Cari...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="lamaran-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-hash me-1"></i>No</th>
                                    <th><i class="bi bi-person me-1"></i>Nama Pelamar</th>
                                    <th><i class="bi bi-briefcase me-1"></i>Lowongan Pekerjaan</th>
                                    <th><i class="bi bi-building me-1"></i>Divisi</th>
                                    <th><i class="bi bi-calendar me-1"></i>Tanggal Lamaran</th>
                                    <th><i class="bi bi-file-earmark-text me-1"></i>Status Lamaran</th>
                                    <th><i class="bi bi-three-dots-vertical me-1"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be populated by DataTables -->
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

    let table;

    async function fetchAllData() {
    try {
        // First, make all API requests
        const [lamaranResponse, divisiResponse, wawancaraResponse] = await Promise.all([
            fetch(`${API_BASE_URL}/admin/lamaran`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            }),
            fetch(`${API_BASE_URL}/divisi`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            }),
            fetch(`${API_BASE_URL}/wawancara`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            })
        ]);

        // Handle each response individually
        const handleResponse = async (response, endpoint) => {
            if (!response.ok) {
                throw new Error(`${endpoint} returned status: ${response.status}`);
            }
            const data = await response.json();
            return data;
        };

        // Process each response
        const [lamaranData, divisiData, wawancaraData] = await Promise.all([
            handleResponse(lamaranResponse, 'Lamaran API'),
            handleResponse(divisiResponse, 'Divisi API'),
            handleResponse(wawancaraResponse, 'Wawancara API')
        ]);

        // Safely access the data with proper fallbacks
        return {
            lamaran: lamaranData?.data?.data || [],
            divisi: (divisiData?.data || divisiData || []),
            wawancara: (wawancaraData?.data || wawancaraData || [])
        };

    } catch (error) {
        console.error('Error fetching data:', error);
        
        // Show more specific error message to user
        Swal.fire({
            icon: 'error',
            title: 'Error Saat Mengambil Data',
            text: `${error.message || 'Terjadi kesalahan saat mengambil data. Silakan coba lagi.'}`,
            confirmButtonText: 'OK'
        });

        // Return empty arrays as fallback
        return {
            lamaran: [],
            divisi: [],
            wawancara: []
        };
    }
}

    function populateDivisiFilter(divisiData) {
        const divisiSelect = document.getElementById('divisiFilter');
        divisiSelect.innerHTML = '<option value="">Semua Divisi</option>';
        divisiData.forEach(divisi => {
            const option = document.createElement('option');
            option.value = divisi.id_divisi;
            option.textContent = divisi.nama_divisi;
            divisiSelect.appendChild(option);
        });
    }

    function formatDate(date) {
        if (!date) return '-';
        try {
            const options = { 
                day: 'numeric', 
                month: 'long', 
                year: 'numeric' 
            };
            return new Date(date).toLocaleDateString('id-ID', options);
        } catch (error) {
            console.error('Error formatting date:', error);
            return '-';
        }
    }

    function getStatusBadgeClass(status) {
        const statusClasses = {
            'menunggu': 'badge bg-warning',
            'dikirim': 'badge bg-info',
            'diterima': 'badge bg-success',
            'ditolak': 'badge bg-danger'
        };
        return statusClasses[status.toLowerCase()] || 'badge bg-secondary';
    }

    function generateActionButtons(item, hasInterview) {
        let actionsHtml = `
            <div class="flex align-items-center list-user-action">
                <a href="/rekrutmen/lamaran/${item.id_lamaran_pekerjaan}/view" 
                    class="btn btn-sm btn-icon btn-info" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    title="Detail Lamaran">
                    <span class="btn-inner"> 
                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> 
                            <path d="M12 4.5C7.5 4.5 3.5 8.5 2 12c1.5 3.5 5.5 7.5 10 7.5s8.5-4 10-7.5c-1.5-3.5-5.5-7.5-10-7.5zm0 12c-2.5 0-4.5-2-4.5-4.5S9.5 7.5 12 7.5 16.5 9.5 16.5 12 14.5 16.5 12 16.5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> 
                        </svg> 
                    </span>
                </a>`;

        // Only show the Add Interview button if:
        // 1. The application status is 'diterima'
        // 2. There is no existing interview
        if (item.status_lamaran.toLowerCase() === 'diterima' && !hasInterview) {
            actionsHtml += `
                <a href="/rekrutmen/wawancara/create?lamaran_id=${item.id_lamaran_pekerjaan}" 
                    class="btn btn-sm btn-icon btn-success ms-2" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    title="Tambah Wawancara">
                    <span class="btn-inner">
                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.87651 15.2063C6.03251 15.2063 2.74951 15.7873 2.74951 18.1153C2.74951 20.4433 6.01251 21.0453 9.87651 21.0453C13.7215 21.0453 17.0035 20.4633 17.0035 18.1363C17.0035 15.8093 13.7415 15.2063 9.87651 15.2063Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.8766 11.886C12.3996 11.886 14.4446 9.841 14.4446 7.318C14.4446 4.795 12.3996 2.75 9.8766 2.75C7.3546 2.75 5.3096 4.795 5.3096 7.318C5.3006 9.832 7.3306 11.877 9.8456 11.886H9.8766Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M19.2036 8.66919V12.6792" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M21.2497 10.6741H17.1597" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </a>`;
        }

        actionsHtml += '</div>';
        return actionsHtml;
    }

    function filterTable() {
        const monthYear = $('#monthYearFilter').val();
        const divisiId = $('#divisiFilter').val();
        const searchTerm = $('#searchInput').val().toLowerCase();

        table.rows().every(function() {
            const rowData = this.data();
            let show = true;

            if (monthYear) {
                const [filterYear, filterMonth] = monthYear.split('-');
                const rowDate = new Date(rowData.tanggalDibuat);
                if (rowDate.getFullYear() != filterYear || (rowDate.getMonth() + 1) != parseInt(filterMonth)) {
                    show = false;
                }
            }

            if (divisiId) {
                const rowDivisiId = String(rowData.divisiId);
                const filterDivisiId = String(divisiId);
                if (rowDivisiId !== filterDivisiId) {
                    show = false;
                }
            }

            if (searchTerm) {
                const searchText = [
                    rowData.namaPelamar,
                    rowData.judulPekerjaan,
                    rowData.namaDivisi
                ].join(' ').toLowerCase();
                
                if (!searchText.includes(searchTerm)) {
                    show = false;
                }
            }

            this.nodes().to$().toggle(show);
        });

        table.draw(false);
    }

    function resetFilters() {
        $('#monthYearFilter').val('');
        $('#divisiFilter').val('');
        $('#searchInput').val('');
        table.search('').columns().search('');
        table.rows().nodes().to$().show();
        table.draw();
    }

    async function initializeDataTable() {
        const { lamaran, divisi, wawancara } = await fetchAllData();
        populateDivisiFilter(divisi);

        const wawancaraArray = Array.isArray(wawancara) ? wawancara : [];

        table = $('#lamaran-table').DataTable({
            data: lamaran.map((item, index) => {
                const divisiObj = divisi.find(d => d.id_divisi === item.lowongan_pekerjaan?.id_divisi);
                const hasInterview = wawancaraArray.some(w => w.id_lamaran_pekerjaan === item.id_lamaran_pekerjaan);

                return {
                    DT_RowId: item.id_lamaran_pekerjaan,
                    no: index + 1,
                    namaPelamar: item.pelamar?.nama || 'Tidak Diketahui',
                    judulPekerjaan: item.lowongan_pekerjaan?.judul_pekerjaan || 'Tidak Diketahui',
                    namaDivisi: divisiObj?.nama_divisi || 'Tidak Diketahui',
                    tanggalDibuat: item.tanggal_dibuat,
                    statusLamaran: item.status_lamaran,
                    divisiId: item.lowongan_pekerjaan?.id_divisi,
                    _html: {
                        status: `<span class="${getStatusBadgeClass(item.status_lamaran)}">${item.status_lamaran}</span>`,
                        actions: generateActionButtons(item, hasInterview)
                    }
                };
            }),
            columns: [
                { data: 'no' },
                { data: 'namaPelamar' },
                { data: 'judulPekerjaan' },
                { data: 'namaDivisi' },
                { 
                    data: 'tanggalDibuat',
                    render: function(data) {
                        return formatDate(data);
                    }
                },
                { data: '_html.status' },
                { data: '_html.actions' }
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
            pageLength: 10,
            ordering: true,
            dom: 'lrtip'
        });

        $('#applyFilter').on('click', filterTable);
        $('#resetFilter').on('click', resetFilters);
        $('#divisiFilter').on('change', function() {
            if ($('#applyFilter').length) {
                $('#applyFilter').click();
            } else {
                filterTable();
            }
        });
        
        $('#searchInput').on('keyup', function() {
            filterTable();
        });

        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    initializeDataTable();
});
</script>
@endpush