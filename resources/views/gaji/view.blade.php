@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Rincian Penggajian
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="print-content">

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
                    <!-- Judul Slip Gaji -->
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Slip Gaji</h3>
                        <p>Periode: <span id="periodeView" class="fw-bold">-</span></p>
                    </div>

                    <!-- Informasi Pegawai -->
                    <div class="section-wrapper mb-4">
                        <div class="section-header bg-light p-3 rounded-top border">
                            <h4 class="fw-bold mb-0">Informasi Pegawai</h4>
                        </div>
                        <div class="section-content p-3 border border-top-0">
                            <div class="table-responsive">
                                <table class="table table-bordered">
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
                        </div>
                    </div>

                    <!-- Pendapatan -->
                    <div class="section-wrapper mb-4">
                        <div class="section-header bg-light p-3 rounded-top border">
                            <h4 class="fw-bold mb-0">Pendapatan</h4>
                        </div>
                        <div class="section-content p-3 border border-top-0">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
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
                        </div>
                    </div>

                    <!-- Potongan -->
                    <div class="section-wrapper mb-4">
                        <div class="section-header bg-light p-3 rounded-top border">
                            <h4 class="fw-bold mb-0">Potongan</h4>
                        </div>
                        <div class="section-content p-3 border border-top-0">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
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
                        </div>
                    </div>

                    <!-- Gaji Bersih -->
                    <div class="section-wrapper mb-4">
                        <div class="section-header bg-light p-3 rounded-top border">
                            <h4 class="fw-bold mb-0">Gaji Bersih</h4>
                        </div>
                        <div class="section-content p-3 border border-top-0">
                            <div class="table-responsive">
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="card action-buttons"> <!-- Tambahkan class baru -->
                <div class="card-body py-3"> <!-- Atur padding -->
                    <div class="text-center">
                        <button type="button" class="btn btn-danger px-4 me-2" id="backButton">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </button>
                        <button type="button" class="btn btn-success px-4" id="printButton">
                            <i class="bi bi-file-pdf me-2"></i>Cetak PDF
                        </button>
                    </div>
                </div>
            </div>
            </div>

        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                const response = await fetch(`${API_BASE_URL}/${endpoint}`, {
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
        // Event listener untuk tombol cetak PDF
        document.getElementById('printButton').addEventListener('click', function() {
            exportToPDF();
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


    document.addEventListener('DOMContentLoaded', function() {
    // Event listener untuk tombol kembali
    const backButton = document.getElementById('backButton');
    if (backButton) {
        backButton.addEventListener('click', function() {
            window.history.back();
        });
    }

    // Event listener untuk tombol cetak PDF
    const printButton = document.getElementById('printButton');
    if (printButton) {
        printButton.addEventListener('click', function() {
            // Debug log untuk memastikan event listener terpasang
            console.log('Print button clicked');
            exportToPDF();
        });
    } else {
        console.error('Print button not found');
    }

    // Debug log untuk memastikan script dijalankan
    console.log('DOMContentLoaded event fired');
});
// Perbaiki fungsi exportToPDF
function exportToPDF() {
    try {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({
            orientation: 'portrait',
            unit: 'mm',
            format: 'a4'
        });

        // Ubah selector ke .print-content
        const content = document.querySelector('.print-content');

        // Tampilkan loading
        Swal.fire({
            title: 'Memproses PDF...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Gunakan html2canvas
        html2canvas(content, {
            scale: 2,
            useCORS: true,
            logging: true,
            letterRendering: true,
            allowTaint: true,
            backgroundColor: '#ffffff'
        }).then(function(canvas) {
            const imgData = canvas.toDataURL('image/png');
            
            // Set ukuran halaman
            const imgWidth = 190;  // lebar A4 - margin
            const pageHeight = 290;  // tinggi A4 - margin
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            
            let heightLeft = imgHeight;
            let position = 10; // margin atas
            
            // Tambahkan gambar ke PDF
            doc.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
            
            // Tambahkan halaman baru jika konten terlalu panjang
            while (heightLeft >= pageHeight) {
                position = heightLeft - pageHeight;
                doc.addPage();
                doc.addImage(imgData, 'PNG', 10, -position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }
            
            // Ambil nama file yang sesuai
            const periode = document.getElementById('periodeView').textContent;
            const namaPegawai = document.getElementById('pegawaiNameView').textContent;
            
            // Simpan PDF
            doc.save(`Slip_Gaji_${namaPegawai}_${periode}.pdf`);
            
            // Tutup loading dan tampilkan sukses
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'PDF berhasil dibuat',
                timer: 2000,
                showConfirmButton: false
            });
        });
    } catch (error) {
        console.error('Error creating PDF:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal membuat PDF: ' + error.message
        });
    }

}
</script>

@endpush

@push('styles')
    
<style>
    .action-buttons {
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    background-color: transparent;
}

.action-buttons .card-body {
    background-color: #fff;
    border-radius: 10px;
}

/* Memperbaiki spacing untuk area cetak */
.print-content {
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    margin-bottom: 0;
}

/* Animasi hover untuk button */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
    .section-wrapper {
        border-radius: 4px;
        overflow: hidden;
    }
    
    .section-header {
        border-bottom: none;
    }
    
    .section-content {
        background-color: white;
    }
    
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
    @endpush
