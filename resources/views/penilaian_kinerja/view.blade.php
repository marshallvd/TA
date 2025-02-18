@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Rincian Penilaian Kinerja
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
                    <!-- Judul Penilaian Kinerja -->
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Penilaian Kinerja</h3>
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
                                            <td id="pegawaiName">-</td>
                                        </tr>
                                        <tr>
                                            <td><strong><i class="bi bi-credit-card-fill me-2"></i>NIK</strong></td>
                                            <td id="pegawaiNIK">-</td>
                                        </tr>
                                        <tr>
                                            <td><strong><i class="bi bi-briefcase-fill me-2"></i>Jabatan</strong></td>
                                            <td id="pegawaiPosition">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Rincian Penilaian -->
                    <div class="section-wrapper mb-4">
                        <div class="section-header bg-light p-3 rounded-top border">
                            <h4 class="fw-bold mb-0">Rincian Penilaian Kinerja</h4>
                        </div>
                        <div class="section-content p-3 border border-top-0">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Aspek Penilaian</th>
                                            <th width="40%">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><i class="bi bi-graph-up me-2"></i><strong>KPI</strong></td>
                                            <td id="nilaiKPI">-</td>
                                        </tr>
                                        <tr>
                                            <td><i class="bi bi-trophy me-2"></i><strong>Kompetensi</strong></td>
                                            <td id="nilaiKompetensi">-</td>
                                        </tr>
                                        <tr>
                                            <td><i class="bi bi-heart me-2"></i><strong>Core Values</strong></td>
                                            <td id="nilaiCoreValues">-</td>
                                        </tr>
                                        <tr class="table-light">
                                            <td><i class="bi bi-calculator me-2"></i><strong>Nilai Akhir</strong></td>
                                            <td id="nilaiAkhir" class="fw-bold">-</td>
                                        </tr>
                                        <tr class="table-primary">
                                            <td><i class="bi bi-star-fill me-2"></i><strong>Predikat</strong></td>
                                            <td id="predikat" class="fw-bold">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="section-wrapper mb-4">
                        <div class="section-header bg-light p-3 rounded-top border">
                            <h4 class="fw-bold mb-0">Catatan</h4>
                        </div>
                        <div class="section-content p-3 border border-top-0">
                            <p id="catatan" class="mb-0">-</p>
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
@endsection

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

/* Print content area styling */
.print-content {
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    margin-bottom: 0;
}

/* Button hover animations */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Ensure tables look good in PDF */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1rem;
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: middle;
    border: 1px solid #dee2e6;
}

/* Ensure proper spacing for sections */
.section-wrapper {
    margin-bottom: 1.5rem;
}

/* Ensure text is readable in PDF */
body {
    color: #000;
    font-size: 14px;
}
</style>
@endpush


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    
    const getIdFromUrl = () => {
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');
        if (id) return id;
        
        const pathSegments = window.location.pathname.split('/');
        return pathSegments[pathSegments.length - 1] === 'view' 
            ? pathSegments[pathSegments.length - 2]
            : pathSegments[pathSegments.length - 1];
    };

    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Session Expired',
            text: 'Token tidak ditemukan. Silakan login kembali.',
            confirmButtonText: 'Login'
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
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || `Error ${response.status}: ${response.statusText}`);
            }

            return data;
        } catch (error) {
            console.error(`API Error (${endpoint}):`, error);
            throw new Error(error.message || 'Terjadi kesalahan saat mengambil data');
        }
    }

    const formatNumber = (number) => {
        return Number(number).toFixed(2);
    };

    const safeGet = (obj, ...props) => {
        return props.reduce((acc, curr) => 
            (acc && acc[curr] !== undefined) ? acc[curr] : '-', obj);
    };

    const setPredikatStyle = (element, predikat) => {
        const styleMap = {
            'sangat baik': 'text-success',
            'baik': 'text-primary',
            'cukup': 'text-warning',
            'kurang': 'text-danger'
        };

        const matchedStyle = Object.entries(styleMap)
            .find(([key]) => predikat.toLowerCase().includes(key));
        
        element.className = `fw-bold ${matchedStyle ? matchedStyle[1] : ''}`;
    };

    let positionsMap = new Map();

    async function fetchPositions() {
        try {
            const response = await fetchData('jabatan');
            response.forEach(position => {
                positionsMap.set(position.id_jabatan, position.nama_jabatan);
            });
        } catch (error) {
            console.error('Error fetching positions:', error);
        }
    }

    async function fetchPenilaianKinerja() {
        try {
            await fetchPositions();

            const id = getIdFromUrl();
            if (!id) throw new Error('ID Penilaian tidak ditemukan');

            const response = await fetchData(`penilaian-kinerja/${id}`);
            const penilaian = response.data;

            // Updated period display
            document.getElementById('periodeView').textContent = penilaian.periode_penilaian || '-';

            // ... (rest of the code remains the same)
            document.getElementById('pegawaiName').textContent = safeGet(penilaian, 'pegawai', 'nama_lengkap');
            document.getElementById('pegawaiNIK').textContent = safeGet(penilaian, 'pegawai', 'nik');

            if (penilaian.pegawai?.id_jabatan) {
                const positionName = positionsMap.get(penilaian.pegawai.id_jabatan);
                document.getElementById('pegawaiPosition').textContent = positionName || '-';
            } else {
                document.getElementById('pegawaiPosition').textContent = '-';
            }

            document.getElementById('nilaiKPI').textContent = 
                formatNumber(safeGet(penilaian, 'penilaian_k_p_i', 'nilai_rata_rata'));
            document.getElementById('nilaiKompetensi').textContent = 
                formatNumber(safeGet(penilaian, 'penilaian_kompetensi', 'nilai_rata_rata'));
            document.getElementById('nilaiCoreValues').textContent = 
                formatNumber(safeGet(penilaian, 'penilaian_core_values', 'nilai_rata_rata'));
            document.getElementById('nilaiAkhir').textContent = 
                formatNumber(safeGet(penilaian, 'nilai_akhir'));

            const predikatElement = document.getElementById('predikat');
            const predikatValue = safeGet(penilaian, 'predikat');
            predikatElement.textContent = predikatValue;
            setPredikatStyle(predikatElement, predikatValue);

            document.getElementById('catatan').textContent = penilaian.catatan || '-';

        } catch (error) {
            console.error('Error in fetchPenilaianKinerja:', error);
            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: `Gagal mengambil data: ${error.message}`,
                confirmButtonText: 'OK'
            });
        }
    }
    const printButton = document.getElementById('printButton');
    if (printButton) {
        printButton.addEventListener('click', function() {
            exportToPDF();
        });
    }
    document.getElementById('backButton').addEventListener('click', () => {
        window.history.back();
    });

    fetchPenilaianKinerja();

    function exportToPDF() {
    try {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({
            orientation: 'portrait',
            unit: 'mm',
            format: 'a4'
        });

        // Select the content to be printed
        const content = document.querySelector('.print-content');

        // Show loading indicator
        Swal.fire({
            title: 'Memproses PDF...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Convert content to canvas
        html2canvas(content, {
            scale: 2,
            useCORS: true,
            logging: true,
            letterRendering: true,
            allowTaint: true,
            backgroundColor: '#ffffff'
        }).then(function(canvas) {
            const imgData = canvas.toDataURL('image/png');
            
            // Set page dimensions
            const imgWidth = 190;  // A4 width - margins
            const pageHeight = 290;  // A4 height - margins
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            
            let heightLeft = imgHeight;
            let position = 10; // top margin
            
            // Add first page
            doc.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
            
            // Add new pages if content is too long
            while (heightLeft >= pageHeight) {
                position = heightLeft - pageHeight;
                doc.addPage();
                doc.addImage(imgData, 'PNG', 10, -position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }
            
            // Get employee name and period for filename
            const periode = document.getElementById('periodeView').textContent;
            const namaPegawai = document.getElementById('pegawaiName').textContent;
            
            // Save PDF
            doc.save(`Penilaian_Kinerja_${namaPegawai}_${periode}.pdf`);
            
            // Show success message
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
@endpush
