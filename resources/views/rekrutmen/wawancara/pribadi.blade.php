@extends('layouts.app')
@extends('layouts.pelamar_master')

@section('title')
    Jadwal Wawancara Saya
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Jadwal Wawancara Saya</h2></b>
                    <p class="card-text text-muted">Lacak Progres Wawancara Anda</p>
                </div>
                <div>
                    <i class="bi bi-calendar-check text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-3">Riwayat Wawancara</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="wawancara-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-hash me-1"></i>No</th>
                                    <th><i class="bi bi-briefcase me-1"></i>Lowongan Pekerjaan</th>
                                    <th><i class="bi bi-calendar-event me-1"></i>Tanggal Wawancara</th>
                                    <th><i class="bi bi-geo-alt me-1"></i>Lokasi</th>
                                    <th><i class="bi bi-check-circle me-1"></i>Status</th>
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
            const response = await fetch(`${API_BASE_URL}/pelamar/auth/me`, {
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

    // Fungsi untuk mengambil data wawancara
    async function fetchWawancaraData(pelamarId) {
        try {
            const response = await fetch(`${API_BASE_URL}/public/wawancara`, {
                headers: {
                    'Authorization': `Bearer ${pelamarToken}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                const errorText = await response.text();
                console.error('Error response:', errorText);
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const wawancaraData = await response.json();
            
            // Filter wawancara berdasarkan ID pelamar
            const wawancaraPelamar = wawancaraData.data.filter(item => 
                item.lamaran_pekerjaan.id_pelamar === pelamarId
            );
            
            return wawancaraPelamar;
        } catch (error) {
            console.error('Error fetching wawancara data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: error.message || 'Gagal mengambil data wawancara'
            });
            return [];
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

    // Fungsi untuk menginisialisasi DataTable
    async function initializeDataTable() {
        pelamarId = await fetchPelamarData();
        if (!pelamarId) return;

        const wawancara = await fetchWawancaraData(pelamarId);
        
        if (wawancara.length === 0) {
            $('#wawancara-table').html('<div class="alert alert-info text-center">Anda belum memiliki jadwal wawancara.</div>');
            return;
        }

        table = $('#wawancara-table').DataTable({
            data: wawancara.map((item, index) => ({
                no: index + 1,
                judulPekerjaan: item.lamaran_pekerjaan.lowongan_pekerjaan.judul_pekerjaan || 'Tidak Diketahui',
                tanggalWawancara: formatDate(item.tanggal_wawancara),
                lokasi: item.lokasi || 'Tidak Ditentukan',
                statusWawancara: item.hasil || 'Belum Diproses',
                idWawancara: item.id_wawancara
            })),
            columns: [
                { data: 'no' },
                { data: 'judulPekerjaan' },
                { data: 'tanggalWawancara' },
                { data: 'lokasi' },
                { 
                    data: 'statusWawancara',
                    render: function(data) {
                        const statusMap = {
                            'dijadwalkan': 'info',
                            'selesai': 'success',
                            'dibatalkan': 'danger',
                            'lulus': 'success',
                            'gagal': 'danger',
                            'tertunda': 'warning'
                        };
                        const badgeClass = statusMap[data.toLowerCase( )] || 'secondary';
                        return `<span class="badge bg-${badgeClass}">${data}</span>`;
                    }
                },
                {
                    data: null,
                    render: function(data) {
                        return `
                            <button class="btn btn-sm btn-icon btn-info view-wawancara me-1" 
                                data-id="${data.idWawancara}"
                                data-bs-toggle="tooltip" 
                                data-bs-placement="top" 
                                title="Lihat Detail">
                                <span class="btn-inner"> 
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> 
                                        <path d="M12 4.5C7.5 4.5 3.5 8.5 2 12c1.5 3.5 5.5 7.5 10 7.5s8.5-4 10-7.5c-1.5-3.5-5.5-7.5-10-7.5zm0 12c-2.5 0-4.5-2-4.5-4.5S9.5 7.5 12 7.5 16.5 9.5 16.5 12 14.5 16.5 12 16.5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> 
                                    </svg> 
                                </span>
                            </button>`;
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
    }

    // Event listener untuk tombol view
    $('#wawancara-table').on('click', '.view-wawancara', function() {
        const wawancaraId = $(this).data('id');
        console.log('Clicked View Button - Wawancara ID:', wawancaraId);
        
        if (wawancaraId && wawancaraId !== 'undefined') {
            window.location.href = "{{ route('pelamar.wawancara.view', ['id' => ':id']) }}".replace(':id', wawancaraId);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: 'ID Wawancara tidak valid'
            });
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