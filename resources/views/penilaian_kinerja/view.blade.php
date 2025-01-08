@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Rincian Penilaian Kinerja
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Rincian Penilaian Kinerja</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-person-check text-primary" style="font-size: 3rem;"></i>
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
                        <h4 class="fw-bold">Informasi Pegawai</h4>
                    </div>
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

                    <div class="mt-4">
                        <h4 class="text-center fw-bold mb-4">Rincian Penilaian Kinerja</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
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

                        <div class="mt-4 bg-light p-4 rounded">
                            <h5 class="mb-3 fw-bold">
                                <i class="bi bi-chat-square-text me-2"></i>Catatan
                            </h5>
                            <p id="catatan" class="mb-0 ps-4">-</p>
                        </div>

                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-primary px-4" id="btnBack">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </button>
                        </div>
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
    padding: 20px;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    padding: 20px;
}

.card-body {
    padding: 20px;
}

h4, h5 {
    color: #343a40;
    margin-bottom: 15px;
}

.table {
    width: 100%;
    margin-top: 15px;
}

.table th,
.table td {
    padding: 12px 15px;
    vertical-align: middle;
}

.table th {
    background-color: #f1f1f1;
}

.btn-primary {
    padding: 10px 25px;
    font-weight: 500;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    
    // Improved URL parameter extraction
    const getIdFromUrl = () => {
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id'); // If using query parameters
        if (id) return id;
        
        // Fallback to path parameter
        const pathSegments = window.location.pathname.split('/');
        return pathSegments[pathSegments.length - 1] === 'view' 
            ? pathSegments[pathSegments.length - 2]
            : pathSegments[pathSegments.length - 1];
    };

    // Token validation
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

    // Improved API fetch with better error handling
    async function fetchData(endpoint) {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/${endpoint}`, {
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

    // Format number helper
    const formatNumber = (number) => {
        return Number(number).toFixed(2);
    };

    // Safe object property accessor
    const safeGet = (obj, ...props) => {
        return props.reduce((acc, curr) => 
            (acc && acc[curr] !== undefined) ? acc[curr] : '-', obj);
    };

    // Set predikat styling
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

    // Create positions map
    let positionsMap = new Map();

    // Fetch all positions
    async function fetchPositions() {
        try {
            const response = await fetchData('jabatan');
            response.forEach(position => {
                positionsMap.set(position.id_jabatan, position.nama_jabatan);
            });
        } catch (error) {
            console.error('Error fetching positions:', error);
            // Continue execution even if positions fetch fails
        }
    }

    // Main data fetching and display function
    async function fetchPenilaianKinerja() {
        try {
            // First fetch all positions
            await fetchPositions();

            const id = getIdFromUrl();
            if (!id) throw new Error('ID Penilaian tidak ditemukan');

            const response = await fetchData(`penilaian-kinerja/${id}`);
            const penilaian = response.data;

            // Update employee details
            document.getElementById('pegawaiName').textContent = safeGet(penilaian, 'pegawai', 'nama_lengkap');
            document.getElementById('pegawaiNIK').textContent = safeGet(penilaian, 'pegawai', 'nik');

            // Set position from map
            if (penilaian.pegawai?.id_jabatan) {
                const positionName = positionsMap.get(penilaian.pegawai.id_jabatan);
                document.getElementById('pegawaiPosition').textContent = positionName || '-';
            } else {
                document.getElementById('pegawaiPosition').textContent = '-';
            }

            // Update assessment values
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

    // Back button handler
    document.getElementById('btnBack').addEventListener('click', () => {
        window.history.back();
    });

    // Initialize
    fetchPenilaianKinerja();
});
</script>
@endpush

@endsection