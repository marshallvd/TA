@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Detail Pengajuan Cuti
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
                    <!-- Judul Pengajuan Cuti -->
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Pengajuan Cuti</h3>
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

                    <!-- Informasi Pengajuan Cuti -->
                    <div class="section-wrapper mb-4">
                        <div class="section-header bg-light p-3 rounded-top border">
                            <h4 class="fw-bold mb-0">Informasi Pengajuan Cuti</h4>
                        </div>
                        <div class="section-content p-3 border border-top-0">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td width="30%"><strong><i class="bi bi-layers-fill me-2"></i>Jenis Cuti</strong></td>
                                            <td id="jenisCutiView">-</td>
                                        </tr>
                                        <tr>
                                            <td><strong><i class="bi bi-check-circle-fill me-2"></i>Status</strong></td>
                                            <td id="statusCutiView">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Periode Cuti -->
                    <div class="section-wrapper mb-4">
                        <div class="section-header bg-light p-3 rounded-top border">
                            <h4 class="fw-bold mb-0">Periode Cuti</h4>
                        </div>
                        <div class="section-content p-3 border border-top-0">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="50%">Tanggal Mulai</th>
                                            <th width="50%">Tanggal Selesai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="tanggalMulaiView">-</td>
                                            <td id="tanggalSelesaiView">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Alasan -->
                    <div class="section-wrapper mb-4">
                        <div class="section-header bg-light p-3 rounded-top border">
                            <h4 class="fw-bold mb-0">Alasan Cuti</h4>
                        </div>
                        <div class="section-content p-3 border border-top-0">
                            <p class="mb-0" id="alasanCutiView">-</p>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="section-wrapper mb-4">
                        <div class="section-header bg-light p-3 rounded-top border">
                            <h4 class="fw-bold mb-0">Keterangan</h4>
                        </div>
                        <div class="section-content p-3 border border-top-0">
                            <p class="mb-0" id="keteranganView">-</p>
                        </div>
                    </div>

                    <!-- Catatan (jika ada) -->
                    <div class="section-wrapper mb-4" id="catatanContainer" style="display: none;">
                        <div class="section-header bg-light p-3 rounded-top border">
                            <h4 class="fw-bold mb-0">Catatan</h4>
                        </div>
                        <div class="section-content p-3 border border-top-0">
                            <p class="mb-0" id="catatanView">-</p>
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

@push('styles')
    

<style>
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

.badge {
    padding: 8px 12px;
    font-size: 0.9rem;
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

/* Add these to your existing styles */
.action-buttons {
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    background-color: transparent;
}

.action-buttons .card-body {
    background-color: #fff;
    border-radius: 10px;
}

.print-content {
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    margin-bottom: 0;
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>
@endpush

@push('scripts')
    

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const token = localStorage.getItem('token');
        const pathSegments = window.location.pathname.split('/');
        const idCuti = pathSegments[pathSegments.length - 2];

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
                console.log(`Fetching from endpoint: ${endpoint}`); // Debug log
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
                console.error(`Error fetching ${endpoint}:`, error);
                throw new Error(error.message || 'Terjadi kesalahan saat mengambil data');
            }
        }

        async function fetchCutiDetails() {
            try {
                console.log('Fetching cuti details for ID:', idCuti); // Debug log

                // Fetch cuti data
                const cutiResponse = await fetchData(`cuti/${idCuti}`); // Modified endpoint
                if (!cutiResponse || !cutiResponse.data) {
                    throw new Error('Data cuti tidak ditemukan');
                }
                const cuti = cutiResponse.data;

                // Debug log
                console.log('Cuti data received:', cuti);

                // Fetch pegawai data
                const pegawaiResponse = await fetchData(`pegawai/${cuti.id_pegawai}`);
                if (!pegawaiResponse || !pegawaiResponse.data) {
                    throw new Error('Data pegawai tidak ditemukan');
                }
                const pegawai = pegawaiResponse.data;

                // Fetch divisi data
                const divisiResponse = await fetchData(`divisi/${pegawai.id_divisi}`);
                if (!divisiResponse) {
                    throw new Error('Data divisi tidak ditemukan');
                }

                // Fetch jabatan data
                const jabatanResponse = await fetchData(`jabatan/${pegawai.id_jabatan}`);
                if (!jabatanResponse) {
                    throw new Error('Data jabatan tidak ditemukan');
                }

                // Fetch jenis cuti data
                const jenisCutiResponse = await fetchData(`jenis-cuti/${cuti.id_jenis_cuti}`);
                if (!jenisCutiResponse) {
                    throw new Error('Data jenis cuti tidak ditemukan');
                }

                // Update UI
                updateUI(cuti, pegawai, divisiResponse, jabatanResponse, jenisCutiResponse);

            } catch (error) {
                console.error('Error in fetchCutiDetails:', error);
                await Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Gagal mengambil data: ' + error.message
                });
            }
        }

        function updateUI(cuti, pegawai, divisi, jabatan, jenisCuti) {
            // Employee Info
            document.getElementById('pegawaiNameView').textContent = pegawai.nama_lengkap || '-';
            document.getElementById('pegawaiNIKView').textContent = pegawai.nik || '-';
            document.getElementById('pegawaiDivisionView').textContent = divisi.nama_divisi || '-';
            document.getElementById('pegawaiPositionView').textContent = jabatan.nama_jabatan || '-';

            // Leave Info
            document.getElementById('jenisCutiView').textContent = jenisCuti.nama_jenis_cuti || '-';

            // Status badge
            const statusBadgeClass = {
                'menunggu': 'badge bg-warning',
                'disetujui': 'badge bg-success',
                'ditolak': 'badge bg-danger'
            };

            document.getElementById('statusCutiView').innerHTML = `
                <span class="${statusBadgeClass[cuti.status] || 'badge bg-secondary'}">
                    ${cuti.status ? cuti.status.charAt(0).toUpperCase() + cuti.status.slice(1) : '-'}
                </span>`;

            // Dates
            const formatDate = (dateString) => {
                if (!dateString) return '-';
                return new Date(dateString).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            };

            document.getElementById('tanggalMulaiView').textContent = formatDate(cuti.tanggal_mulai);
            document.getElementById('tanggalSelesaiView').textContent = formatDate(cuti.tanggal_selesai);

            // Alasan
            document.getElementById('alasanCutiView').textContent = cuti.alasan || '-';

            // Keterangan
            document.getElementById('keteranganView').textContent = cuti.keterangan || '-';

            // Catatan (if exists)
            const catatanContainer = document.getElementById('catatanContainer');
            if (cuti.status !== 'menunggu' && cuti.catatan) {
                catatanContainer.style.display = 'block';
                document.getElementById('catatanView').textContent = cuti.catatan;
            } else {
                catatanContainer.style.display = 'none';
            }
        }


        // Back button handler
        document.getElementById('backButton').addEventListener('click', function() {
            window.history.back();
        });
        const printButton = document.getElementById('printButton');
        if (printButton) {
            printButton.addEventListener('click', function() {
                exportToPDF();
            });
        }

        // Initialize
        fetchCutiDetails();

        // Add the exportToPDF function
function exportToPDF() {
    try {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({
            orientation: 'portrait',
            unit: 'mm',
            format: 'a4'
        });

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
            
            // Ambil nama pegawai dan tanggal pengajuan
            const namaPegawai = document.getElementById('pegawaiNameView').textContent;
            const tanggalMulai = document.getElementById('tanggalMulaiView').textContent;
            
            // Simpan PDF
            doc.save(`Pengajuan_Cuti_${namaPegawai}_${tanggalMulai}.pdf`);
            
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
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush