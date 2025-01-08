@extends('layouts.app')
@extends('layouts.master')

@section('title') 
Rincian Penggajian 
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Rincian Penggajian</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-wallet2 text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center">
                    <div class="me-3">
                        <img src="{{ asset('assets/images/logo seb.png') }}" alt="Logo Perusahaan" class="mb-3" style="width: 100px;">
                    </div>
                    <div>
                        <h5>BPR Saraswati Eka Bumi</h5>
                        <p>Jalan By Pass Ngurah Rai No 233 Kuta Badung Bali</p>
                        <p>(0361) 756206, 763295</p>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold">Slip Gaji</h4>
                        <p class="text-muted">Periode: <span id="periodeView" class="fw-bold">-</span></p>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th colspan="2" class="text-center">Informasi Pegawai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="30%"><strong><i class="bi bi-person-fill me-2"></i>Nama</strong></td>
                                    <td id="pegawaiNameView">-</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="bi bi-credit-card-fill me-2"></i>NIK</strong></td>
                                    <td id="pegawaiNIKView">-</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="bi bi-diagram-3-fill me-2"></i>Divisi</strong></td>
                                    <td id="pegawaiDivisionView">-</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="bi bi-briefcase-fill me-2"></i>Jabatan</strong></td>
                                    <td id="pegawaiPositionView">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mb-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-cash-stack me-2"></i>Pendapatan</h5>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Komponen</th>
                                    <th width="40%">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Gaji Pokok</strong></td>
                                    <td id="gajiPokokView" class="text-end">-</td>
                                </tr>
                                <tr>
                                    <td><strong>Insentif</strong></td>
                                    <td id="insentifView" class="text-end">-</td>
                                </tr>
                                <tr>
                                    <td><strong>Bonus Kehadiran</strong></td>
                                    <td id="bonusKehadiranView" class="text-end">-</td>
                                </tr>
                                <tr>
                                    <td><strong>Tunjangan Lembur</strong></td>
                                    <td id="tunjanganLemburView" class="text-end">-</td>
                                </tr>
                                <tr class="table-light">
                                    <td><strong>Total Pendapatan</strong></td>
                                    <td id="totalPendapatanView" class="text-end fw-bold">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mb-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-scissors me-2"></i>Potongan</h5>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Komponen</th>
                                    <th width="40%">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Potongan Pajak</strong></td>
                                    <td id="potonganPajakView" class="text-end">-</td>
                                </tr>
                                <tr>
                                    <td><strong>Potongan BPJS</strong></td>
                                    <td id="potonganBPJSView" class="text-end">Rp. 200.000</td>
                                </tr>
                                <tr class="table-light">
                                    <td><strong>Total Potongan</strong></td>
                                    <td id="totalPotonganView" class="text-end fw-bold">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mb-4">
                        <h5 class="fw-bold mb-3"><i class="bi bi-wallet-fill me-2"></i>Gaji Bersih</h5>
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="table-primary">
                                    <th><strong>Gaji Bersih</strong></th>
                                    <th id="gajiBersihView" class="text-end">-</th>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center fst-italic" id="terbilangView">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-primary px-4" id="backButton">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    padding: 20px;
}

.card-body {
    padding: 20px;
}

.table {
    margin-bottom: 0;
}

.table th,
.table td {
    padding: 12px 15px;
    vertical-align: middle;
}

.table-light {
    background-color: #f8f9fa;
}

.table-primary {
    background-color: #e7f1ff;
}

.btn-primary {
    padding: 10px 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

h4, h5 {
    color: #343a40;
}

.text-muted {
    color: #6c757d !important;
}

.table-responsive {
    border-radius: 8px;
    overflow: hidden;
}

.fst-italic {
    color: #6c757d;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const token = localStorage.getItem('token');
        const pathSegments = window.location.pathname.split('/');
        const idGaji = pathSegments[pathSegments.length - 1];

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
                const response = await fetch(`http://127.0.0.1:8000/api/${endpoint}`, {
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

        async function fetchGajiDetails() {
    try {
        const gajiResponse = await fetchData(`gaji/${idGaji}`);
        if (!gajiResponse || !gajiResponse.data) {
            throw new Error('Data gaji tidak ditemukan');
        }

        const gaji = gajiResponse.data;

        // Debug log untuk memeriksa data gaji
        console.log('Respons gaji:', gaji);

        // Menampilkan periode gaji
        const periodeView = document.getElementById('periodeView');
        if (periodeView) {
            periodeView.textContent = `${gaji.periode_tahun}-${gaji.periode_bulan.padStart(2, '0')}`;
        } else {
            console.error("Elemen dengan ID 'periodeView' tidak ditemukan.");
        }

        // Menampilkan informasi pegawai
        document.getElementById('pegawaiNameView').textContent = gaji.pegawai.nama_lengkap || '-';
        document.getElementById('pegawaiNIKView').textContent = gaji.pegawai.nik || '-';

        // Ambil detail pegawai
        const idPegawai = gaji.pegawai.id_pegawai;
        await fetchPegawaiDetails(idPegawai);

                let gajiPokok = 0;
                let insentif = 0;
                let bonusKehadiran = 0;
                let tunjanganLembur = 0;
                let totalPotongan = 0;

                gaji.detail_gaji.forEach(detail => {
                    const jumlah = parseFloat(detail.jumlah);
                    switch (detail.komponen_gaji.nama_komponen) {
                        case 'Gaji Pokok':
                            gajiPokok = jumlah;
                            break;
                        case 'Insentif':
                            insentif = jumlah;
                            break;
                        case 'Bonus Kehadiran':
                            bonusKehadiran = jumlah;
                            break;
                        case 'Tunjangan Lembur':
                            tunjanganLembur = jumlah;
                            break;
                    }
                });

                totalPotongan = gaji.total_potongan || 0;

                document.getElementById('gajiPokokView').textContent = formatCurrency(gajiPokok);
                document.getElementById('insentifView').textContent = formatCurrency(insentif);
                document.getElementById('bonusKehadiranView').textContent = formatCurrency(bonusKehadiran);
                document.getElementById('tunjanganLemburView').textContent = formatCurrency(tunjanganLembur);
                document.getElementById('totalPendapatanView').textContent = formatCurrency(gaji.total_pendapatan || 0);
                document.getElementById('potonganPajakView').textContent = formatCurrency(totalPotongan);
                document.getElementById('totalPotonganView').textContent = formatCurrency(totalPotongan);
                document.getElementById('gajiBersihView').textContent = formatCurrency(gaji.gaji_bersih || 0);
                document.getElementById('terbilangView').textContent = terbilang(gaji.gaji_bersih) + ' Rupiah';
            } catch (error) {
                console.error('Error in fetchGajiDetails:', error);
                await Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal mengambil data gaji: ' + error.message
                });
            }
        }

        async function fetchPegawaiDetails(idPegawai) {
            try {
                const pegawaiResponse = await fetchData(`pegawai/${idPegawai}`);
                if (!pegawaiResponse || !pegawaiResponse.data) {
                    throw new Error('Data pegawai tidak ditemukan');
                }
                const pegawai = pegawaiResponse.data;

                const jabatanResponse = await fetchData(`jabatan/${pegawai.id_jabatan}`);
                if (!jabatanResponse || !jabatanResponse.nama_jabatan) {
                    throw new Error('Data jabatan tidak ditemukan');
                }

                const divisiResponse = await fetchData(`divisi/${pegawai.id_divisi}`);
                if (!divisiResponse || !divisiResponse.nama_divisi) {
                    throw new Error('Data divisi tidak ditemukan');
                }

                document.getElementById('pegawaiPositionView').textContent = jabatanResponse.nama_jabatan || '-';
                document.getElementById('pegawaiDivisionView').textContent = divisiResponse.nama_divisi || '-';

            } catch (error) {
                console.error('Error in fetchPegawaiDetails:', error);
                await Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal mengambil data pegawai: ' + error.message
                });
            }
        }

        document.getElementById('backButton').addEventListener('click', function() {
            window.history.back();
        });

        fetchGajiDetails();
    });

    function formatCurrency(value) {
        return 'Rp. ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Format currency
    }

    function terbilang(angka) {
        const bilangan = [
            '', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan',
            'Sepuluh', 'Sebelas', 'Dua Belas', 'Tiga Belas', 'Empat Belas', 'Lima Belas', 'Enam Belas',
            'Tujuh Belas', 'Delapan Belas', 'Sembilan Belas', 'Dua Puluh', 'Dua Puluh Satu', 'Dua Puluh Dua',
            'Dua Puluh Tiga', 'Dua Puluh Empat', 'Dua Puluh Lima', 'Dua Puluh Enam', 'Dua Puluh Tujuh',
            'Dua Puluh Delapan', 'Dua Puluh Sembilan', 'Tiga Puluh', 'Empat Puluh', 'Lima Puluh', 'Enam Puluh',
            'Tujuh Puluh', 'Delapan Puluh', 'Sembilan Puluh'
        ];

        if (angka < 0) return 'Minus ' + terbilang(Math.abs(angka));
        if (angka < 12) return bilangan[angka];
        if (angka < 20) return bilangan[angka - 10] + ' Belas';
        if (angka < 100) return bilangan[Math.floor(angka / 10)] + ' Puluh ' + terbilang(angka % 10);
        if (angka < 200) return 'Seratus ' + terbilang(angka - 100);
        if (angka < 1000) return bilangan[Math.floor(angka / 100)] + ' Ratus ' + terbilang(angka % 100);
        if (angka < 2000) return 'Seribu ' + terbilang(angka - 1000);
        if (angka < 1000000) return terbilang(Math.floor(angka / 1000)) + ' Ribu ' + terbilang(angka % 1000);
        if (angka < 1000000000) return terbilang(Math.floor(angka / 1000000)) + ' Juta ' + terbilang(angka % 1000000);
        
        return 'Angka Terlalu Besar';
    }

    // Memanggil fungsi dan menampilkan hasil
    document.getElementById('terbilangView').textContent = terbilang(gaji.gaji_bersih) + ' Rupiah';
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
    }
</style>

@endsection