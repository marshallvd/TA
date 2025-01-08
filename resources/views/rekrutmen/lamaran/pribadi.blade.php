@extends('layouts.app')
@extends('layouts.pelamar_master')

@section('title')
    Daftar Lamaran Saya
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Lamaran Pekerjaan Saya</h2></b>
                    <p class="card-text text-muted">Lacak Progress Lamaran Anda</p>
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
                    <h4 class="card-title mb-3">Riwayat Lamaran</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="lamaran-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Lowongan Pekerjaan</th>
                                    <th>Divisi</th>
                                    <th>Tanggal Lamaran</th>
                                    <th>Status Lamaran</th>
                                    <th>Aksi</th>
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

@push('styles')
<style>
    .btn-aksi {
        margin-right: 5px;
        margin-bottom: 5px;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pelamarToken = localStorage.getItem('pelamar_token');

    if (!pelamarToken) {
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Anda harus login untuk mengakses halaman ini.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '/landing/login';
        });
        return;
    }

    let table;
    let pelamarId = null;

    // Fungsi untuk mengambil data pelamar
    async function fetchPelamarData() {
        try {
            const response = await fetch('http://localhost:8000/api/pelamar/auth/me', {
                headers: {
                    'Authorization': `Bearer ${pelamarToken}`,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data pelamar');
            }

            const result = await response.json();
            return result.data.id_pelamar;
        } catch (error) {
            console.error('Error fetching pelamar data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: 'Gagal mengambil data pelamar'
            });
            return null;
        }
    }

    // Fungsi untuk mengambil data lamaran
    async function fetchLamaranData(pelamarId) {
        try {
            const response = await fetch('http://localhost:8000/api/admin/lamaran', {
                headers: {
                    'Authorization': `Bearer ${pelamarToken}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            console.log('Response Status:', response.status);

            if (response.status === 401) {
                Swal.fire({
                    icon: 'error',
                    title: 'Sesi Berakhir',
                    text: 'Silakan login kembali',
                    confirmButtonText: 'Login'
                }).then(() => {
                    localStorage.removeItem('pelamar_token');
                    window.location.href = '/landing/login';
                });
                return [];
            }

            if (!response.ok) {
                const errorText = await response.text();
                console.error('Error response:', errorText);
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const lamaranData = await response.json();
            
            console.log('Full Lamaran Data:', lamaranData);

            // Filter lamaran berdasarkan ID pelamar
            const lamaranPelamar = lamaranData.data.data.filter(item => 
                item.id_pelamar === pelamarId
            );

            console.log('Lamaran Pelamar:', lamaranPelamar);
            
            return lamaranPelamar;
        } catch (error) {
            console.error('Error fetching lamaran data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: error.message || 'Gagal mengambil data lamaran',
                footer: 'Pastikan Anda sudah login dengan benar'
            });
            return [];
        }
    }

    // Fungsi untuk menginisialisasi DataTable
    async function initializeDataTable() {
        try {
            pelamarId = await fetchPelamarData();
            if (!pelamarId) return;

            console.log('Pelamar ID:', pelamarId);

            const lamaran = await fetchLamaranData(pelamarId);
            
            // Tambahkan penanganan jika tidak ada lamaran
            if (lamaran.length === 0) {
                $('#lamaran-table').html('<div class="alert alert-info text-center">Anda belum memiliki riwayat lamaran.</div>');
                return;
            }

            table = $('#lamaran-table').DataTable({
                data: lamaran.map((item, index) => ({
                    no: index + 1,
                    judulPekerjaan: item.lowongan_pekerjaan?.judul_pekerjaan || 'Tidak Diketahui',
                    namaDivisi: item.lowongan_pekerjaan?.divisi?.nama_divisi || 'Tidak Diketahui',
                    tanggalDibuat: formatDate(item.tanggal_dibuat),
                    statusLamaran: item.status_lamaran,
                    idLamaran: item.id_lamaran_pekerjaan
                })),
                columns: [
                    { data: 'no' },
                    { data: 'judulPekerjaan' },
                    { data: 'namaDivisi' },
                    { data: 'tanggalDibuat' },
                    { 
                        data: 'statusLamaran',
                        render: function(data) {
                            const statusMap = {
                                'menunggu': 'warning',
                                'dikirim': 'info',
                                'diterima': 'success',
                                'ditolak': 'danger'
                            };
                            const badgeClass = statusMap[data.toLowerCase()] || 'secondary';
                            return `<span class="badge bg-${badgeClass}">${data}</span>`;
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            // View button is always shown
                            let buttons = `
                                <button class="btn btn-sm btn-icon btn-info view-lamaran me-1" 
                                    data-id="${data.idLamaran}"
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    title="Lihat Detail">
                                    <span class="btn-inner"> 
                                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> 
                                            <path d="M12 4.5C7.5 4.5 3.5 8.5 2 12c1.5 3.5 5.5 7.5 10 7.5s8.5-4 10-7.5c-1.5-3.5-5.5-7.5-10-7.5zm0 12c-2.5 0-4.5-2-4.5-4.5S9.5 7.5 12 7.5 16.5 9.5 16.5 12 14.5 16.5 12 16.5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> 
                                        </svg> 
                                    </span>
                                </button>`;
                            
                            // Only show delete button if status is 'menunggu'
                            if (data.statusLamaran.toLowerCase() === 'menunggu') {
                                buttons += `
                                    <button class="btn btn-sm btn-icon btn-danger btn-delete me-1" 
                                        data-id="${data.idLamaran}"
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="top" 
                                        title="Hapus Lamaran">
                                        <span class="btn-inner">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1888 16.1088 21.2128C13.4998 21.2598 10.8878 21.2628 8.27979 21.2078C6.96079 21.1818 6.13779 20.3743 5.99079 19.0473C5.67279 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4496 3.21973 14.9796 2.87573 14.4796 2.87573H10.5226C10.0226 2.87573 9.5526 3.21973 9.4196 3.69973L9.1766 4.91573C9.0226 5.68473 8.3466 6.23973 7.5606 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    </button>`;
                            }
                            
                            return buttons;
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
                },
                pageLength: 10,
                ordering: true,
                dom: 'lrtip'
            });
        } catch (error) {
            console.error('Initialization error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: 'Gagal menginisialisasi tabel lamaran'
            });
        }
    }

    // Fungsi format tanggal
    function formatDate(dateString, options = {}) {
        if (!dateString) return '-';
        
        try {
            const defaultOptions = { 
                day: 'numeric', 
                month: 'long', 
                year: 'numeric' 
            };
            
            const mergedOptions = { ...defaultOptions, ...options };
            const date = new Date(dateString);
            
            if (isNaN(date.getTime())) {
                return '-';
            }
            
            return date.toLocaleDateString('id-ID', mergedOptions);
        } catch (error) {
            console.error('Error formatting date:', error);
            return '-';
        }
    }

    // Event listener untuk tombol view
    $('#lamaran-table').on('click', '.view-lamaran', function() {
        const lamaranId = $(this).data('id');
        console.log('Clicked View Button - Lamaran ID:', lamaranId);
        
        if (lamaranId && lamaranId !== 'undefined') {
            window.location.href = "{{ route('pelamar.lamaran.view', ['id' => ':id']) }}".replace(':id', lamaranId);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: 'ID Lamaran tidak valid'
            });
        }
    });

    // Event listener untuk tombol delete
    $('#lamaran-table').on('click', '.btn-delete', async function() {
        const lamaranId = $(this).data('id');
        const confirmDelete = await Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus lamaran ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        });

        if (confirmDelete.isConfirmed) {
            try {
                const response = await fetch(`http://localhost:8000/api/pelamar/lamaran/${lamaranId}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${pelamarToken}`,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const responseData = await response.json();

                if (response.ok) {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: responseData.message || 'Lamaran berhasil dihapus'
                    });
                    
                    // Reload the entire page to refresh data
                    window.location.reload();
                } else {
                    throw new Error(responseData.message || 'Gagal menghapus lamaran');
                }
            } catch (error) {
                console.error('Delete error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: error.message || 'Gagal menghapus lamaran'
                });
            }
        }
    });

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize the DataTable when page loads
    initializeDataTable();
});
</script>
@endpush