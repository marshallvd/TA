@extends('layouts.app')
@extends('layouts.master')

@section('title') 
Rincian Hasil Seleksi 
@endsection

@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
    
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Hasil Seleksi</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-briefcase text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <h4 class="card-title mb-0">Rincian Hasil Seleksi</h4>
                </div>
                <div class="card-body">

                    <!-- Informasi Pelamar di bagian atas -->
                    <h5><strong>Informasi Pelamar</strong></h5>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td id="pelamarName">-</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td id="pelamarEmail">-</td>
                            </tr>
                            <tr>
                                <td><strong>Telepon</strong></td>
                                <td id="pelamarPhone">-</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td id="pelamarAddress">-</td>
                            </tr>
                            <tr>
                                <td><strong>Pendidikan Terakhir</strong></td>
                                <td id="pelamarEducation">-</td>
                            </tr>
                            <tr>
                                <td><strong>Pengalaman Kerja</strong></td>
                                <td id="pelamarExperience">-</td>
                            </tr>
                        </tbody>
                    </table>

                    <h5 class="mt-4"><strong>Informasi Lowongan Pekerjaan</strong></h5>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Judul Pekerjaan</strong></td>
                                <td id="lowonganTitle">-</td>
                            </tr>
                            <tr>
                                <td><strong>Lokasi</strong></td>
                                <td id="lowonganLocation">-</td>
                            </tr>
                            <tr>
                                <td><strong>Gaji Minimal</strong></td>
                                <td id="lowonganGajiMinimal">-</td>
                            </tr>
                            <tr>
                                <td><strong>Gaji Maksimal</strong></td>
                                <td id="lowonganGajiMaksimal">-</td>
                            </tr>
                            <tr>
                                <td><strong>Deskripsi</strong></td>
                                <td id="lowonganDescription">-</td>
                            </tr>
                        </tbody>
                    </table>

                    <h5 class="mt-4"><strong>Informasi Lamaran</strong></h5>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Status Lamaran</strong></td>
                                <td id="lamaranStatus">-</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Lamaran</strong></td>
                                <td id="lamaranDate">-</td>
                            </tr>
                        </tbody>
                    </table>

                    <h5 class="mt-4"><strong>Riwayat Wawancara</strong></h5>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Tanggal Wawancara</strong></td>
                                <td id="wawancaraDate">-</td>
                            </tr>
                            <tr>
                                <td><strong>Lokasi</strong></td>
                                <td id="wawancaraLocation">-</td>
                            </tr>
                            <tr>
                                <td><strong>Catatan</strong></td>
                                <td id="wawancaraNotes">-</td>
                            </tr>
                            <tr>
                                <td><strong>Hasil</strong></td>
                                <td id="wawancaraResult">-</td>
                            </tr>
                        </tbody>
                    </table>

                    <h5 class="mt-4"><strong>Hasil Seleksi</strong></ h5>
                    <div id="hasilSeleksi" class="alert" role="alert">
                        <!-- Status kelulusan akan ditampilkan di sini -->
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary" id="backButton">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const pathSegments = window.location.pathname.split('/');
    const idHasilSeleksi = pathSegments[pathSegments.length - 2];

    function getBadgeForStatus(status) {
        switch(status.toLowerCase()) {
            case 'diterima':
                return '<span class="badge bg-success">Diterima</span>';
            case 'diproses':
                return '<span class="badge bg-warning">Diproses</span>';
            case 'ditolak':
                return '<span class="badge bg-danger">Ditolak</span>';
            default:
                return `<span class="badge bg-secondary">${status}</span>`;
        }
    }

    function getBadgeForWawancaraResult(result) {
        switch(result.toLowerCase()) {
            case 'lulus':
                return '<span class="badge bg-success">Lulus</span>';
            case 'tidak lulus':
                return '<span class="badge bg-danger">Tidak Lulus</span>';
            default:
                return `<span class="badge bg-secondary">${result}</span>`;
        }
    }

    function getMotivationNote(status) {
        const motivationNotes = {
            'lulus': [
                'Selamat! Kerja kerasmu membuahkan hasil. Tetap rendah hati dan terus berkembang.',
                'Kamu telah membuktikan bahwa kamu layak berada di sini. Teruslah belajar dan tumbuh!',
                'Pencapaian ini adalah awal dari perjalanan suksesmu. Tetap semangat!',
                'Kamu telah melewati tantangan dengan luar biasa. Masa depan cerah menunggumu!'
            ],
            'tidak lulus': [
                'Setiap kegagalan adalah kesempatan untuk belajar dan tumbuh. Jangan menyerah!',
                'Ingat, kegagalan adalah bagian dari proses menuju kesuksesan. Tetap optimis!',
                'Satu pintu tertutup, seribu pintu lain akan terbuka. Teruslah berusaha!',
                'Kekuatanmu terletak pada kemampuanmu bangkit setelah jatuh. Tetap semangat!'
            ]
        };

        const notes = motivationNotes[status.toLowerCase()] || [];
        return notes.length > 0 
            ? notes[Math.floor(Math.random() * notes.length)] 
            : 'Tetap semangat dan terus berusaha!';
    }

    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Token tidak ditemukan. Silakan login kembali.'
        }).then(() => {
            window.location.href = '/login';
        });
        return;
    }

    async function fetchData(endpoint) {
        try {
            const fullUrl = endpoint.startsWith('http') 
                ? endpoint 
                : `${API_BASE_URL}/${endpoint}`;

            const response = await fetch(fullUrl, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || `HTTP error! status: ${response.status}`);
            }

            return data;
        } catch (error) {
            console.error(`Fetch error for ${endpoint}:`, error);
            throw new Error(error.message || 'Terjadi kesalahan saat mengambil data');
        }
    }

    function formatDate(dateString) {
        if (!dateString) return '-';
        try {
            const date = new Date(dateString);
            return isNaN(date) ? '-' : date.toLocaleString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        } catch (error) {
            console.error('Error formatting date:', error);
            return '-';
        }
    }

    function formatCurrency(value) {
        if (!value) return '-';
        try {
            return 'Rp. ' + parseFloat(value).toLocaleString('id-ID');
        } catch (error) {
            return '-';
        }
    }

    async function fetchDetails() {
    try {
        const hasilSeleksiResponse = await fetchData(`hasil-seleksi/${idHasilSeleksi}`);
        if (!hasilSeleksiResponse.data) {
            throw new Error('Data hasil seleksi tidak ditemukan');
        }

        const wawancaraResponse = await fetchData(`wawancara/${hasilSeleksiResponse.data.id_wawancara}`);
        console.log('Wawancara Response:', wawancaraResponse);
        
        const wawancara = wawancaraResponse.data || {};
        const lamaranPekerjaan = wawancara.lamaran_pekerjaan;
        console.log('Lamaran Pekerjaan:', lamaranPekerjaan);

        if (!lamaranPekerjaan) {
            throw new Error('Data lamaran pekerjaan tidak ditemukan');
        }

        const idLamaran = lamaranPekerjaan.id_lamaran_pekerjaan || lamaranPekerjaan.id;
        if (!idLamaran) {
            console.log('ID Lamaran not found. Available fields:', Object.keys(lamaranPekerjaan));
            throw new Error('ID Lamaran tidak valid');
        }

        const lamaranResponse = await fetchData(`admin/lamaran/${idLamaran}`);
        

        // Update DOM elements with safe access
        const pelamar = wawancara.pelamar || {};
        document.getElementById('pelamarName').textContent = pelamar.nama || '-';
        document.getElementById('pelamarEmail').textContent = pelamar.email || '-';
        document.getElementById('pelamarPhone').textContent = pelamar.no_hp || '-';
        document.getElementById('pelamarAddress').textContent = pelamar.alamat || '-';
        document.getElementById('pelamarEducation').textContent = pelamar.pendidikan_terakhir || '-';
        document.getElementById('pelamarExperience').textContent = pelamar.pengalaman_kerja || '-';

        const lowongan = lamaranPekerjaan.lowongan_pekerjaan || {};
        document.getElementById('lowonganTitle').textContent = lowongan.judul_pekerjaan || '-';
        document.getElementById('lowonganLocation').textContent = lowongan.lokasi_pekerjaan || '-';
        document.getElementById('lowonganGajiMinimal').textContent = formatCurrency(lowongan.gaji_minimal) || '-';
        document.getElementById('lowonganGajiMaksimal').textContent = formatCurrency(lowongan.gaji_maksimal) || '-';
        document.getElementById('lowonganDescription').textContent = lowongan.deskripsi || '-';

        document.getElementById('wawancaraDate').textContent = formatDate(wawancara.tanggal_wawancara);
        document.getElementById('wawancaraLocation').textContent = wawancara.lokasi || '-';
        document.getElementById('wawancaraNotes').textContent = wawancara.catatan || '-';
        document.getElementById('wawancaraResult').innerHTML = getBadgeForWawancaraResult(wawancara.hasil || '-');

        document.getElementById('lamaranStatus').innerHTML = getBadgeForStatus(lamaranPekerjaan.status_lamaran || '-');
        document.getElementById('lamaranDate').textContent = formatDate(lamaranPekerjaan.tanggal_dibuat);

        const hasilSeleksi = hasilSeleksiResponse.data.status;
        const hasilSeleksiDiv = document.getElementById('hasilSeleksi');
        hasilSeleksiDiv.classList.remove('alert-success', 'alert-danger');

        if (hasilSeleksi === 'lulus') {
            hasilSeleksiDiv.classList.add('alert-success');
            hasilSeleksiDiv.innerHTML = `
                <div>
                    <span class="badge bg-success">Selamat! Anda telah lulus seleksi.</span>
                    <p class="mt-2 text-muted fst-italic">${getMotivationNote(hasilSeleksi)}</p>
                </div>
            `;
        } else {
            hasilSeleksiDiv.classList.add('alert-danger');
            hasilSeleksiDiv.innerHTML = `
                <div>
                    <span class="badge bg-danger">Sayang sekali, Anda tidak lulus seleksi.</span>
                    <p class="mt-2 text-muted fst-italic">${getMotivationNote(hasilSeleksi)}</p>
                </div>
            `;
        }
    } catch (error) {
        console.error('Error in fetchDetails:', error);
        await Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal mengambil data: ' + error.message
        });
    }
}

    document.getElementById('backButton').addEventListener('click', function() {
        window.history.back();
    });

    fetchDetails();
});
</script>

<style>
    /* Tambahkan beberapa gaya CSS untuk meningkatkan tampilan */
    body {
        font-family: 'Arial', sans-serif; /* Mengubah font menjadi Arial */
    }
    .card {
        border: none;
        border-radius: 10px;
        padding: 20px; /* Menambahkan padding pada card */
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        padding: 20px;
    }
    .card-body {
        padding: 20px;
    }
    h5 {
        color: #343a40;
        margin-bottom: 15px;
        font-size: 18px; /* Mengubah ukuran font untuk h5 */
    }
    hr {
        border-top: 1px solid #dee2e6;
        margin: 20px 0;
    }
    .text-center {
        margin-top: 20px;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    /* Menambahkan padding untuk elemen */
    table {
        width: 100%;
        margin-top: 15px; /* Menambahkan margin atas untuk tabel */
    }
    th, td {
        padding: 10px; /* Menambahkan padding pada sel tabel */
        text-align: left; /* Mengatur teks ke kiri */
    }
    th {
        background-color: #f1f1f1; /* Warna latar belakang untuk header tabel */
        font-weight: bold; /* Membuat header tabel menjadi bold */
    }
</style>

@endsection