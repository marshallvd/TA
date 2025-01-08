@extends('layouts.app')

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Dashboard Pelamar</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title text-white">Lamaran Aktif</h5>
                                            <h2 class="card-text" id="activeLamaranCount">0</h2>
                                        </div>
                                        <i class="fas fa-file-alt fa-3x opacity-75"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title text-white">Wawancara</h5>
                                            <h2 class="card-text" id="wawancaraCount">0</h2>
                                        </div>
                                        <i class="fas fa-calendar-check fa-3x opacity-75"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title text-white">Status Terakhir</h5>
                                            <h2 class="card-text" id="lastStatusLamaran">-</h2>
                                        </div>
                                        <i class="fas fa-info-circle fa-3x opacity-75"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Riwayat Lamaran</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="lamaranTable">
                                            <thead>
                                                <tr>
                                                    <th>Posisi</th>
                                                    <th>Tanggal Lamaran</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="lamaranTableBody">
                                                <!-- Data akan diisi oleh JavaScript -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Lowongan Tersedia</h5>
                                </div>
                                <div class="card-body" id="lowonganTersediaBody">
                                    <!-- Lowongan akan diisi oleh JavaScript -->
                                </div>
                            </div>
                        </div>
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
    // Ambil token dari localStorage
    const token = localStorage.getItem('token');

    // Fungsi untuk mengambil data dashboard pelamar
    async function fetchDashboardData() {
        try {
            // Ambil data pelamar terlebih dahulu
            const pelamarResponse = await fetch('/api/auth/me', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!pelamarResponse.ok) {
                throw new Error('Gagal mengambil data pelamar');
            }

            const pelamarData = await pelamarResponse.json();
            const idPelamar = pelamarData.pelamar.id_pelamar;

            // Ambil data dashboard
            const dashboardResponse = await fetch(`/api/pelamar/${idPelamar}/dashboard`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!dashboardResponse.ok) {
                throw new Error('Gagal mengambil data dashboard');
            }

            const dashboardData = await dashboardResponse.json();

            // Update statistik
            document.getElementById('activeLamaranCount').textContent = 
                dashboardData.active_lamaran_count || 0;
            
            document.getElementById('wawancaraCount').textContent = 
                dashboardData.wawancara_count || 0;
            
            document.getElementById('lastStatusLamaran').textContent = 
                dashboardData.last_status || '-';

            // Isi tabel riwayat lamaran
            const lamaranTableBody = document.getElementById('lamaranTableBody');
            lamaranTableBody.innerHTML = ''; // Bersihkan tabel

            if (dashboardData.lamaran && dashboardData.lamaran.length > 0) {
                dashboardData.lamaran.forEach(lamaran => {
                    const row = `
                        <tr>
                            <td>${lamaran.lowongan_pekerjaan?.judul_pekerjaan || 'Tidak Diketahui'}</td>
                            <td>${new Date(lamaran.tanggal_lamaran).toLocaleDateString()}</td>
                            <td>
                                <span class="badge 
                                    ${lamaran.status === 'diterima' ? 'bg-success' : 
                                      lamaran.status === 'ditolak' ? 'bg-danger' : 
                                      'bg-warning'}">
                                    ${lamaran.status}
                                </span>
                            </td>
                            <td>
                                <a href="/lamaran/detail/${lamaran.id_lamaran}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    `;
                    lamaranTableBody.innerHTML += row;
                });
            } else {
                lamaranTableBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada riwayat lamaran</td>
                    </tr>
                `;
            }

            // Isi lowongan tersedia
            const lowonganTersediaBody = document.getElementById('lowonganTersediaBody');
            lowonganTersediaBody.innerHTML = ''; // Bersihkan konten

            if (dashboardData.lowongan_tersedia && dashboardData.lowongan_tersedia. length > 0) {
                dashboardData.lowongan_tersedia.forEach(lowongan => {
                    const lowonganCard = `
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title">${lowongan.judul_pekerjaan}</h5>
                                <p class="card-text">${lowongan.deskripsi}</p>
                                <a href="/lowongan/${lowongan.id}" class="btn btn-primary">Lamar</a>
                            </div>
                        </div>
                    `;
                    lowonganTersediaBody.innerHTML += lowonganCard;
                });
            } else {
                lowonganTersediaBody.innerHTML = `
                    <p class="text-center">Tidak ada lowongan tersedia saat ini.</p>
                `;
            }

        } catch (error) {
            console.error('Error fetching dashboard data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
    }

    // Panggil fungsi untuk mengambil data dashboard saat halaman dimuat
    fetchDashboardData();
});
</script>
@endpush