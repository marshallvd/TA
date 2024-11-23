@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Jatah Cuti Pegawai
@endsection

@section('head')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Jatah Cuti Pegawai</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-1">
                                <label for="yearFilter">Filter Tahun:</label>
                                <select id="yearFilter" class="form-control">
                                    <!-- Years will be populated by JavaScript -->
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button id="filterButton" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="jatah-cuti-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Jatah Cuti Umum</th>
                                        <th>Sisa</th>
                                        <th>Jatah Cuti Menikah</th>
                                        <th>Sisa</th>
                                        <th>Jatah Cuti Melahirkan</th>
                                        <th>Sisa</th>
                                        <th>Action</th>
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const token = localStorage.getItem('token');
        const baseUrl = 'http://127.0.0.1:8000/api';
        let pegawai = []; // Store pegawai data globally
        
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

        // Populate year dropdown
        const yearSelect = document.getElementById('yearFilter');
        const currentYear = new Date().getFullYear();
        // Add last 5 years and next 2 years
        for (let year = currentYear - 5; year <= currentYear + 2; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            if (year === currentYear) {
                option.selected = true;
            }
            yearSelect.appendChild(option);
        }

        const tableBody = document.querySelector('#jatah-cuti-table tbody');

        // Function to fetch pegawai data
        async function fetchPegawai() {
            try {
                const response = await fetch(`${baseUrl}/pegawai`, {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Gagal mengambil data pegawai');
                }

                const data = await response.json();
                return data.data;
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message
                });
                return [];
            }
        }

        // Function to fetch jatah cuti data
        async function fetchJatahCuti(year = currentYear) {
            try {
                const response = await fetch(`${baseUrl}/jatah-cuti?tahun=${year}`, {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Gagal mengambil data jatah cuti');
                }

                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error fetching jatah cuti data:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'Terjadi kesalahan saat mengambil data jatah cuti'
                });
                return [];
            }
        }

        // Function to render table rows
        function renderTableRows(pegawaiData, jatahCuti) {
            let html = '';
            pegawaiData.forEach((pegawaiItem, index) => {
                const jatahCutiItem = jatahCuti.find(jc => jc.id_pegawai === pegawaiItem.id_pegawai);
                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${pegawaiItem.nama_lengkap || '-'}</td>
                        <td>${pegawaiItem.jabatan?.nama_jabatan || '-'}</td>
                        <td>${jatahCutiItem ? jatahCutiItem.jatah_cuti_umum : '0'}</td>
                        <td>${jatahCutiItem ? jatahCutiItem.sisa_cuti_umum : '0'}</td>
                        <td>${jatahCutiItem ? jatahCutiItem.jatah_cuti_menikah : '0'}</td>
                        <td>${jatahCutiItem ? jatahCutiItem.sisa_cuti_menikah : '0'}</td>
                        <td>${jatahCutiItem ? jatahCutiItem.jatah_cuti_melahirkan : '0'}</td>
                        <td>${jatahCutiItem ? jatahCutiItem.sisa_cuti_melahirkan : '0'}</td>
                        <td>
                            <div class="flex align-items-center list-user-action">
                                ${jatahCutiItem ? `
                                    <a href="/jatah_cuti/${jatahCutiItem.id_jatah_cuti}/edit" 
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
                                       onclick="deleteJatahCuti(${jatahCutiItem.id_jatah_cuti})">
                                        <span class="btn-inner">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                            <path d="M 19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </a>
                            ` : `
                                <a href="/jatah_cuti/create?id_pegawai=${pegawaiItem.id_pegawai}" 
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
                            `}
                        </div>
                    </td>
                </tr>
            `;
        });
        tableBody.innerHTML = html;
    }

    // Initial load
    Promise.all([fetchPegawai(), fetchJatahCuti(currentYear)]).then(([pegawaiData, jatahCuti]) => {
        pegawai = pegawaiData; // Store pegawai data globally
        renderTableRows(pegawai, jatahCuti);
        $('#jatah-cuti-table').DataTable(); // Initialize DataTable after render
    });

// Event listener for filter button
document.getElementById('filterButton').addEventListener('click', async function() {
        const year = document.getElementById('yearFilter').value;
        const dataTable = $('#jatah-cuti-table').DataTable();
        dataTable.destroy(); // Destroy existing DataTable instance
        
        const jatahCutiData = await fetchJatahCuti(year);
        renderTableRows(pegawai, jatahCutiData);
        
        // Reinitialize DataTable with new data
        $('#jatah-cuti-table').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                infoFiltered: "(disaring dari _MAX_ total entri)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    });

    // Function to delete jatah cuti (can be called from the table)
    window.deleteJatahCuti = async function(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const response = await fetch(`${baseUrl}/jatah-cuti/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Gagal menghapus data');
                    }

                    Swal.fire(
                        'Terhapus!',
                        'Data berhasil dihapus.',
                        'success'
                    ).then(() => {
                        // Refresh data after successful deletion
                        const year = document.getElementById('yearFilter').value;
                        fetchJatahCuti(year).then(jatahCutiData => {
                            const dataTable = $('#jatah-cuti-table').DataTable();
                            dataTable.destroy();
                            renderTableRows(pegawai, jatahCutiData);
                            $('#jatah-cuti-table').DataTable({
                                responsive: true,
                                language: {
                                    search: "Cari:",
                                    lengthMenu: "Tampilkan _MENU_ entri",
                                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
                                    infoFiltered: "(disaring dari _MAX_ total entri)",
                                    paginate: {
                                        first: "Pertama",
                                        last: "Terakhir",
                                        next: "Selanjutnya",
                                        previous: "Sebelumnya"
                                    }
                                }
                            });
                        });
                    });
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'Terjadi kesalahan saat menghapus data'
                    });
                }
            }
        });
    };
});
</script>
@endsection