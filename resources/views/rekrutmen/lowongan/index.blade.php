@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Lowongan Pekerjaan
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
        {{-- Header Card --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <b><h2 class="card-title mb-1">Manajemen Lowongan Pekerjaan</h2></b>
                        <p class="card-text text-muted">Human Resource Management System SEB</p>
                    </div>
                    <div>
                        <i class="bi bi-briefcase text-primary" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Daftar Lowongan Pekerjaan</h4>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" id="tambahLowonganBtn">
                                <i class="bi bi-plus-square me-2"></i>Tambah Lowongan
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <div class="table-responsive">
                            <table id="lowongan-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr class="ligth">
                                        <th><b>No</b></th>
                                        <th><b>Judul Pekerjaan</b></th>
                                        <th><b>Jabatan</b></th>
                                        <th><b>Lokasi</b></th>
                                        <th><b>Rentang Gaji</b></th>
                                        <th><b>Status</b></th>
                                        <th><b>Periode</b></th>
                                        <th><b>Total Pelamar</b></th>
                                        <th style="min-width: 100px"><b>Action</b></th>
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

    // Event listener untuk tombol Tambah Lowongan
    document.getElementById('tambahLowonganBtn').addEventListener('click', function() {
        window.location.href = "{{ route('rekrutmen.lowongan.create') }}";
    });

    // Inisialisasi DataTable
    let lowonganTable = $('#lowongan-table').DataTable({
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

    // Fungsi untuk format currency
    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    }

    // Fungsi untuk mengambil data lowongan dan lamaran
    async function fetchData() {
        try {
            // Mengambil data lowongan
            const lowonganResponse = await fetch('http://127.0.0.1:8000/api/lowongan', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!lowonganResponse.ok) {
                throw new Error('Failed to fetch job postings');
            }

            const lowonganData = await lowonganResponse.json();

            // Mengambil data lamaran untuk setiap lowongan
            const lamaranResponse = await fetch('http://127.0.0.1:8000/api/admin/lamaran', {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!lamaranResponse.ok) {
                throw new Error('Failed to fetch applications');
            }

            const lamaranData = await lamaranResponse.json();

            // Menghitung jumlah lamaran untuk setiap lowongan
            const applicantCounts = {};
            lamaranData.data.data.forEach(lamaran => {
                const lowonganId = lamaran.id_lowongan_pekerjaan;
                applicantCounts[lowonganId] = (applicantCounts[lowonganId] || 0) + 1;
            });

            return {
                lowongan: lowonganData.data,
                applicantCounts: applicantCounts
            };
        } catch (error) {
            console.error('Error:', error);
            throw error;
        }
    }

    // Fungsi untuk menghapus lowongan
    async function deleteLowongan(id) {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/lowongan/${id}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            return await response.json();
        } catch (error) {
            console.error('Error:', error);
            throw error;
        }
    }

    // Load data lowongan dan update tabel
    fetchData()
        .then(({ lowongan, applicantCounts }) => {
            lowonganTable.clear();

            lowongan.forEach((item, index) => {
                const actionButtons = `
                    <div class="flex align-items-center list-user-action">
                        <a href="/rekrutmen/lowongan/${item.id_lowongan_pekerjaan}/edit" 
                           class="btn btn-sm btn-icon btn-warning" 
                           data-bs-toggle="tooltip" 
                           data-bs-placement="top" 
                           title="Edit">
                            <span class="btn-inner">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                        <a href="javascript:void(0)" 
                           class="btn btn-sm btn-icon btn-danger delete-lowongan" 
                           data-id="${item.id_lowongan_pekerjaan}" 
                           data-bs-toggle="tooltip" 
                           data-bs-placement="top" 
                           title="Delete">
                            <span class="btn-inner">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                    <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                `;

                const rentangGaji = `${formatRupiah(item.gaji_minimal)} - ${formatRupiah(item.gaji_maksimal)}`;
                const periode = `${item.tanggal_mulai} s/d ${item.tanggal_selesai}`;
                const statusBadge = item.status === 'aktif' 
                    ? '<span class="badge bg-primary">Aktif</span>' 
                    : '<span class="badge bg-danger">Tutup</span>';

                // Get total applicants for this job posting
                const totalPelamar = applicantCounts[item.id_lowongan_pekerjaan] || 0;

                lowonganTable.row.add([
                    index + 1,
                    item.judul_pekerjaan,
                    `${item.jabatan.nama_jabatan}<br><small class="text-muted">${item.divisi.nama_divisi}</small>`,
                    item.lokasi_pekerjaan,
                    rentangGaji,
                    statusBadge,
                    periode,
                    `<span class="badge bg-info">${totalPelamar}</span>`,
                    actionButtons
                ]);
            });

            lowonganTable.draw();
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Gagal mengambil data',
                text: 'Terjadi kesalahan saat mengambil data lowongan.',
                confirmButtonText: 'OK'
            });
        });

    // Event handler untuk tombol delete
    $('#lowongan-table').on('click', '.delete-lowongan', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus lowongan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                deleteLowongan(id)
                    .then(response => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Lowongan berhasil dihapus',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.reload();
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal menghapus lowongan',
                            confirmButtonText: 'OK'
                        });
                    });
            }
        });
    });
});
</script>
@endsection