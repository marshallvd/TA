@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Penilaian Kinerja
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
                            <h4 class="card-title">Penilaian Kinerja</h4>
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
                            <table id="penilaian-kinerja-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><i class="bi bi-hash me-1"></i>No</th>
                                        <th><i class="bi bi-person me-1"></i>Nama Pegawai</th>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    let penilaianTable;
    const baseUrl = API_BASE_URL;

    // Token validation and redirection (remains the same)
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

    // Fungsi untuk membuat format periode (remains the same)
    function formatPeriode(date) {
        return date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0');
    }

    // Set default filter ke bulan saat ini (remains the same)
    const currentDate = new Date();
    const currentMonth = formatPeriode(currentDate);
    document.getElementById('periodeFilter').value = currentMonth;

    // Inisialisasi DataTable (with updated column rendering)
    penilaianTable = $('#penilaian-kinerja-table').DataTable({
        processing: true,
        serverSide: false,
        pageLength: 10,
        columns: [
            { 
                data: null, 
                render: (data, type, row, meta) => meta.row + 1 
            },
            { 
                data: 'pegawai',
                render: function(data, type, row) {
                    return data ? data.nama_lengkap : '-';
                }
            },
            { 
                data: 'periode_penilaian',
                render: function(data, type, row) {
                    return data || currentMonth;
                }
            },
            { 
                data: 'penilaian_k_p_i',
                render: function(data, type, row) {
                    return data ? Number(data.nilai_rata_rata).toFixed(2) : '-';
                }
            },
            { 
                data: 'penilaian_kompetensi',
                render: function(data, type, row) {
                    return data ? Number(data.nilai_rata_rata).toFixed(2) : '-';
                }
            },
            { 
                data: 'penilaian_core_values',
                render: function(data, type, row) {
                    return data ? Number(data.nilai_rata_rata).toFixed(2) : '-';
                }
            },
            { 
                data: 'nilai_akhir',
                render: function(data, type, row) {
                    return data ? Number(data).toFixed(2) : '-';
                }
            },
            { 
                data: 'predikat',
                render: function(data, type, row) {
                    return data || '-';
                }
            },
            { 
                data: null,
                render: function(data, type, row) {
                    const pegawaiId = row.pegawai ? row.pegawai.id_pegawai : null;
                    
                    if (row.id_penilaian_kinerja) {
                        // Jika sudah dinilai, tampilkan tombol edit dan delete
                        return `
                            <div class="flex align-items-center list-user-action">
                                <a href="/penilaian_kinerja/edit/${row.id_penilaian_kinerja}" 
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
                                   onclick="deletePenilaian(${row.id_penilaian_kinerja})">
                                    <span class="btn-inner">
                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                            <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>`;
                    } else {
                        // Jika belum dinilai, tampilkan tombol tambah
                        return `
                            <div class="flex align-items-center list-user-action">
                                <a href="/penilaian_kinerja/create/${pegawaiId}/${currentMonth}"
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
                            </div>`;
                    }
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
        }
    });

    // Updated fetchData function to handle all employees
    async function fetchData(periode = '') {
        try {
            // First, fetch all employees
            const pegawaiResponse = await fetch(`${baseUrl}/pegawai`, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                }
            });

            if (!pegawaiResponse.ok) {
                throw new Error('Gagal mengambil data pegawai');
            }

            const pegawaiData = await pegawaiResponse.json();

            // Construct URL with period parameter for performance assessments
            const url = new URL(`${baseUrl}/penilaian-kinerja`);
            if (periode) {
                url.searchParams.append('periode', periode);
            }

            // Fetch performance assessments
            const penilaianResponse = await fetch(url, {
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                }
            });

            let penilaianData = [];
            if (penilaianResponse.ok) {
                const penilaianResult = await penilaianResponse.json();
                penilaianData = penilaianResult.data || [];
            }

            // Merge employees with their performance assessments
            const combinedData = pegawaiData.data.map(pegawai => {
                // Find matching performance assessment for this employee
                const penilaian = penilaianData.find(
                    p => p.pegawai && p.pegawai.id_pegawai === pegawai.id_pegawai
                );

                return {
                    pegawai: pegawai,
                    periode_penilaian: penilaian?.periode_penilaian || periode,
                    penilaian_k_p_i: penilaian?.penilaian_k_p_i,
                    penilaian_kompetensi: penilaian?.penilaian_kompetensi,
                    penilaian_core_values: penilaian?.penilaian_core_values,
                    nilai_akhir: penilaian?.nilai_akhir,
                    predikat: penilaian?.predikat,
                    id_penilaian_kinerja: penilaian?.id_penilaian_kinerja
                };
            });

            return combinedData;

        } catch (error) {
            console.error('Error fetching data:', error);
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal memuat data: ' + error.message
            });

            return []; // Return empty array if fetch fails
        }
    }


    // Fungsi untuk memuat data ke tabel tetap sama
    function loadTableData(data) {
        penilaianTable.clear();
        if (Array.isArray(data)) {
            penilaianTable.rows.add(data);
        }
        penilaianTable.draw();
    }

    // Event listener untuk tombol filter
    document.getElementById('filterButton').addEventListener('click', async function() {
        const periode = document.getElementById('periodeFilter').value;
        try {
            const data = await fetchData(periode);
            loadTableData(data);
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal memuat data: ' + error.message
            });
        }
    });

    // Fungsi untuk menghapus penilaian
    window.deletePenilaian = async function(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(`${baseUrl}/penilaian-kinerja/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Accept': 'application/json',
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Gagal menghapus data');
                    }

                    Swal.fire(
                        'Terhapus!',
                        'Data penilaian telah dihapus.',
                        'success'
                    ).then(() => {
                        window.location.reload();
                    });
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal menghapus data: ' + error.message
                    });
                }
            }
        });
    };

    // Load data awal dengan filter bulan ini
    fetchData(currentMonth)
        .then(data => {
            if (!data || data.length === 0) {
                Swal.fire({
                    icon: 'info',
                    title: 'Tidak Ada Data',
                    text: 'Belum ada data penilaian yang tersedia.'
                });
                return;
            }
            loadTableData(data);
        })
        .catch(error => {
            console.error('Error loading initial data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal memuat data: ' + error.message
            });
        });
});

</script>

@endsection