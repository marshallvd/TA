@extends('layouts.app')
@extends('layouts.pelamar_master')

@section('title')
    Hasil Seleksi Saya
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Hasil Seleksi Saya</h2></b>
                    <p class="card-text text-muted">Lacak Progres Hasil Seleksi Anda</p>
                </div>
                <div>
                    <i class="bi bi-check-circle-fill text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-3">Riwayat Hasil Seleksi</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="hasil-seleksi-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Lowongan Pekerjaan</th>
                                    <th>Tanggal Seleksi</th>
                                    <th>Status Seleksi</th>
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

    async function fetchHasilSeleksiData(pelamarId) {
        try {
            const response = await fetch('http://localhost:8000/api/public/hasil-seleksi', {
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

            const hasilSeleksiData = await response.json();
            
            console.log('Raw Hasil Seleksi Data:', hasilSeleksiData);
            
            const hasilSeleksiPelamar = hasilSeleksiData.data.filter(item => {
                console.log('Item:', item);
                return item.id_pelamar === pelamarId || 
                       (item.lamaran && item.lamaran.id_pelamar === pelamarId);
            });
            
            return hasilSeleksiPelamar;
        } catch (error) {
            console.error('Error fetching hasil seleksi data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: error.message || 'Gagal mengambil data hasil seleksi'
            });
            return [];
        }
    }

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

    async function initializeDataTable() {
        try {
            pelamarId = await fetchPelamarData();
            if (!pelamarId) return;

            console.log('Pelamar ID:', pelamarId);

            const hasilSeleksi = await fetchHasilSeleksiData(pelamarId);
            
            console.log('Hasil Seleksi:', hasilSeleksi);

            if (hasilSeleksi.length === 0) {
                $('#hasil-seleksi-table').html('<div class="alert alert-info text-center">Anda belum memiliki hasil seleksi.</div>');
                return;
            }

            table = $('#hasil-seleksi-table').DataTable({
                data: hasilSeleksi.map((item, index) => ({
                    no: index + 1,
                    judulPekerjaan: item.lowongan_pekerjaan?.judul_pekerjaan || 'Tidak Diketahui',
                    tanggalSeleksi: formatDate(item.tanggal_dibuat),
                    statusSeleksi: item.status,
                    hasilId: item.id_hasil_seleksi // Tambahkan ID hasil seleksi
                })),
                columns: [
                    { data: 'no' },
                    { data: 'judulPekerjaan' },
                    { data: 'tanggalSeleksi' },
                    { 
                        data: 'statusSeleksi',
                        render: function(data) {
                            const statusMap = {
                                'lulus': 'success',
                                'tidak lulus': 'danger',
                                'gagal': 'danger',
                                'menunggu': 'warning'
                            };
                            const badgeClass = statusMap[data.toLowerCase()] || 'secondary';
                            return `<span class="badge bg-${badgeClass}">${data}</span>`;
                        }
                    },
                    {
                        data: null,
                        render: function(data) {
                            return `
                                <button class="btn btn-sm btn-icon btn-info view-hasil-seleksi me-1" 
                                    data-id="${data.hasilId}"
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
        } catch (error) {
            console.error('Initialization error:', error);
        }
    }
    
    $('#hasil-seleksi-table').on('click', '.view-hasil-seleksi', function() {
    const hasilId = $(this).data('id');
    console.log('Clicked View Button - Hasil Seleksi ID:', hasilId);
    
    if (hasilId && hasilId !== 'undefined') {
        window.location.href = `/rekrutmen/hasil_seleksi/pribadi/${hasilId}/view-pelamar`;
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: 'ID Hasil Seleksi tidak valid'
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