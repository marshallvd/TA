@extends('layouts.master')

@section('title') Edit Gaji @endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <h2 class="card-title mb-1"><b>Manajemen Penggajian</b></h2>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-wallet2 text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Employee Information Card --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Informasi Pegawai</h4>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" id="btnBack">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </button>
                </div>
                <div class="card-body">
                    <div class="row" id="pegawaiDetails">
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Nama:</strong></p>
                            <p class="text-muted" id="pegawaiName">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>NIK:</strong></p>
                            <p class="text-muted" id="pegawaiNIK">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Divisi:</strong></p>
                            <p class="text-muted" id="pegawaiDivision">-</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-1"><strong>Jabatan:</strong></p>
                            <p class="text-muted" id="pegawaiPosition">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Salary Form and Preview in one row --}}
    <div class="row">
        {{-- Salary Form --}}
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Form Edit Gaji</h4>
                </div>
                <div class="card-body">
                    <form id="editGajiForm" class="needs-validation" novalidate>
                        <input type="hidden" id="id_pegawai" name="id_pegawai">
                        <input type="hidden" id="divisi_pegawai" name="divisi_pegawai">
                        <input type="hidden" id="id_gaji" name="id_gaji">

                        <div class="mb-3">
                            <label for="periodeView" class="form-label">Periode Gaji</label>
                            <input type="text" id="periodeView" class="form-control bg-light" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="predikat" class="form-label">Predikat Penilaian Kinerja</label>
                            <input type="text" id="predikat" name="predikat" class="form-control bg-light" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_kehadiran" class="form-label">Jumlah Kehadiran <span class="text-danger">*</span></label>
                            <input type="number" id="jumlah_kehadiran" name="jumlah_kehadiran" class="form-control" min="0" required>
                            <div class="invalid-feedback">Masukkan jumlah kehadiran</div>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_hari_lembur" class="form-label">Jumlah Hari Lembur <span class="text-danger">*</span></label>
                            <input type="number" id="jumlah_hari_lembur" name="jumlah_hari_lembur" class="form-control" min="0" required>
                            <div class="invalid-feedback">Masukkan jumlah hari lembur</div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="button" id="resetButton" class="btn btn-warning me-2">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-success" id="updateGaji">
                                    <i class="bi bi-save me-2"></i>Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Salary Preview Card --}}
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Preview Gaji</h4>
                </div>
                <div class="card-body">
                    <div id="previewSection">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="fw-bold mb-3">Pendapatan</h5>
                                <div class="mb-3">
                                    <label for="gajiPokokPreview" class="form-label">Gaji Pokok</label>
                                    <input type="text" id="gajiPokokPreview" class="form-control bg-light" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="insentifPreview" class="form-label">Insentif</label>
                                    <input type="text" id="insentifPreview" class="form-control bg-light" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="bonusKehadiranPreview" class="form-label">Bonus Kehadiran</label>
                                    <input type="text" id="bonusKehadiranPreview" class="form-control bg-light" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="tunjanganLemburPreview" class="form-label">Tunjangan Lembur</label>
                                    <input type="text" id="tunjanganLemburPreview" class="form-control bg-light" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="totalPendapatanPreview" class="form-label fw-bold">Total Pendapatan</label>
                                    <input type="text" id="totalPendapatanPreview" class="form-control bg-light fw-bold" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="fw-bold mb-3">Potongan</h5>
                                <div class="mb-3">
                                    <label for="potonganPajakPreview" class="form-label">Potongan Pajak</label>
                                    <input type="text" id="potonganPajakPreview" class="form-control bg-light" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="potonganBPJSPreview" class="form-label">Potongan BPJS</label>
                                    <input type="text" id="potonganBPJSPreview" class="form-control bg-light" readonly>
                                </div>
                                <div class="mt-4">
                                    <h5 class="fw-bold mb-3">Gaji Bersih</h5>
                                    <input type="text" id="gajiBersihPreview" class="form-control form-control-lg bg-light fw-bold" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Salary Guidelines --}}
    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ketentuan Penggajian</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Komponen Gaji:</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Gaji Pokok: Sesuai dengan jabatan
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Insentif: Berdasarkan penilaian kinerja
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Bonus Kehadiran: Rp 25.000/hari
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Potongan:</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-info-circle text-primary me-2"></i>
                                Pajak: 10% dari total pendapatan
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-info-circle text-primary me-2"></i>
                                BPJS: Rp 200.000 (flat)
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    .card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        padding: 1rem;
    }
    .form-label {
        font-weight: 500;
    }
    .input-group-text {
        background-color: #f8f9fa;
        border-color: #ced4da;
    }
    .input-group-text i {
        color: #6c757d;
    }
    .input-group:focus-within .input-group-text {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .bg-light {
        background-color: #f8f9fa !important;
    }
</style>
@endpush

@push('scripts')
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

    document.getElementById('id_gaji').value = idGaji;

    async function fetchData(endpoint) {
        try {
            const response = await fetch(`${API_BASE_URL}/${endpoint}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.message || `HTTP error! status: ${response.status}`);
            }
            
            return data;
        } catch (error) {
            console.error(`Fetch error for ${endpoint}:`, error);
            throw error;
        }
    }

    async function fetchPegawaiDetails() {
    try {
        const gajiResponse = await fetchData(`gaji/${idGaji}`);
        if (!gajiResponse.data) {
            throw new Error('Data gaji tidak ditemukan');
        }
        
        const gajiData = gajiResponse.data;
        const pegawaiResponse = await fetchData(`pegawai/${gajiData.id_pegawai}`);
        if (!pegawaiResponse.data) {
            throw new Error('Data pegawai tidak ditemukan');
        }
        
        const pegawai = pegawaiResponse.data;
        const jabatanResponse = await fetchData(`jabatan/${pegawai.id_jabatan}`);
        const divisiResponse = await fetchData(`divisi/${pegawai.id_divisi}`);

        // Update UI with employee details
        document.getElementById('pegawaiName').textContent = pegawai.nama_lengkap || '-';
        document.getElementById('pegawaiNIK').textContent = pegawai.nik || '-';
        document.getElementById('pegawaiDivision').textContent = divisiResponse.nama_divisi || '-';
        document.getElementById('pegawaiPosition').textContent = jabatanResponse.nama_jabatan || '-';
        document.getElementById('id_pegawai').value = pegawai.id_pegawai;
        document.getElementById('divisi_pegawai').value = pegawai.id_divisi;

        // Format periode untuk display
        const periodeStr = `${gajiData.periode_tahun}-${String(gajiData.periode_bulan).padStart(2, '0')}`;
        document.getElementById('periodeView').value = periodeStr;
        document.getElementById('jumlah_kehadiran').value = gajiData.jumlah_kehadiran;
        document.getElementById('jumlah_hari_lembur').value = gajiData.jumlah_hari_lembur;

        // Hanya satu kali pemanggilan untuk penilaian kinerja
        try {
            const penilaianResponse = await fetchData(
                `penilaian-kinerja/pegawai/${pegawai.id_pegawai}/tahun/${gajiData.periode_tahun}/bulan/${String(gajiData.periode_bulan).padStart(2, '0')}`
            );
            
            console.log('Penilaian Kinerja Response:', penilaianResponse);
            
            if (penilaianResponse && penilaianResponse.data) {
                const predikat = penilaianResponse.data.predikat;
                document.getElementById('predikat').value = predikat;
                console.log('Setting predikat to:', predikat);
            } else {
                document.getElementById('predikat').value = 'Belum ada penilaian';
            }
        } catch (penilaianError) {
            console.error('Error mengambil penilaian kinerja:', penilaianError);
            // Jangan override nilai jika sudah ada
            if (!document.getElementById('predikat').value || document.getElementById('predikat').value === '-') {
                document.getElementById('predikat').value = 'Data tidak tersedia';
            }
        }

        window.jabatanData = jabatanResponse;
        await updatePreview();
        
    } catch (error) {
        console.error('Error in fetchPegawaiDetails:', error);
        await Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal mengambil data pegawai: ' + error.message
        });
    }
}

    async function fetchSettingGaji() {
        try {
            const response = await fetch('/api/setting-gaji', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            return data.data;
        } catch (error) {
            console.error('Error fetching setting gaji:', error);
            return null;
        }
    }

    async function updatePreview() {
        try {
            const settingGaji = await fetchSettingGaji();
            if (!settingGaji) {
                throw new Error('Gagal mengambil setting gaji');
            }

            // Validasi input
            const jumlahKehadiran = Math.max(0, parseInt(document.getElementById('jumlah_kehadiran').value) || 0);
            const jumlahHariLembur = Math.max(0, parseInt(document.getElementById('jumlah_hari_lembur').value) || 0);
            const periode = new Date(document.getElementById('periodeView').value);

            // Hitung komponen gaji
            const gajiPokok = Number(settingGaji.hitung_gaji_pokok ? window.jabatanData.gaji_pokok : 0);
            const insentif = Number(settingGaji.hitung_insentif ? await hitungInsentif(periode, settingGaji) : 0);
            const bonusKehadiran = Number(settingGaji.hitung_bonus_kehadiran ? jumlahKehadiran * settingGaji.bonus_per_kehadiran : 0);
            const tunjanganLembur = Number(settingGaji.hitung_tunjangan_lembur ? jumlahHariLembur * window.jabatanData.tarif_lembur_per_hari : 0);

            // Hitung total
            const totalPendapatan = gajiPokok + insentif + bonusKehadiran + tunjanganLembur;
            const potonganPajak = totalPendapatan * (Number(settingGaji.persentase_pajak) / 100);
            const potonganBPJS = Number(settingGaji.potongan_bpjs);
            const totalPotongan = potonganPajak + potonganBPJS;
            const gajiBersih = totalPendapatan - totalPotongan;

            // Format currency
            const currencyOptions = { 
                style: 'currency', 
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            };

            // Update UI
            document.getElementById('gajiPokokPreview').value = gajiPokok.toLocaleString('id-ID', currencyOptions);
            document.getElementById('insentifPreview').value = insentif.toLocaleString('id-ID', currencyOptions);
            document.getElementById('bonusKehadiranPreview').value = bonusKehadiran.toLocaleString('id-ID', currencyOptions);
            document.getElementById('tunjanganLemburPreview').value = tunjanganLembur.toLocaleString('id-ID', currencyOptions);
            document.getElementById('totalPendapatanPreview').value = totalPendapatan.toLocaleString('id-ID', currencyOptions);
            document.getElementById('potonganPajakPreview').value = potonganPajak.toLocaleString('id-ID', currencyOptions);
            document.getElementById('potonganBPJSPreview').value = potonganBPJS.toLocaleString('id-ID', currencyOptions);
            document.getElementById('gajiBersihPreview').value = gajiBersih.toLocaleString('id-ID', currencyOptions);

            return {
                gajiPokok,
                insentif,
                bonusKehadiran,
                tunjanganLembur,
                totalPendapatan,
                potonganPajak,
                potonganBPJS,
                gajiBersih
            };
        } catch (error) {
            console.error('Error dalam perhitungan gaji:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan dalam perhitungan gaji'
            });
        }
    }

    async function hitungInsentif(periode, settingGaji) {
        try {
            const tahun = periode.getFullYear();
    const bulan = String(periode.getMonth() + 1).padStart(2, '0');

    console.log(`Fetching penilaian kinerja untuk tahun: ${tahun}, bulan: ${bulan}`); // Tambahkan log

            
            try {
                const penilaianResponse = await fetchData(`penilaian-kinerja/pegawai/${document.getElementById('id_pegawai').value}/tahun/${tahun}/bulan/${bulan}`);
                
                if (penilaianResponse && penilaianResponse.data) {
                    const predikat = penilaianResponse.data.predikat;
                    const gajiPokok = window.jabatanData.gaji_pokok;
                    
                    switch (predikat.toLowerCase()) {
                        case 'sangat baik':
                            return gajiPokok * (settingGaji.insentif_sangat_baik / 100);
                        case 'baik':
                            return gajiPokok * (settingGaji.insentif_baik / 100);
                        case 'cukup':
                            return gajiPokok * (settingGaji.insentif_cukup / 100);
                        case 'kurang':
                            return gajiPokok * (settingGaji.insentif_kurang / 100);
                        case 'sangat kurang':
                            return gajiPokok * (settingGaji.insentif_sangat_kurang / 100);
                        default:
                            return 0;
                    }
                }
            } catch (error) {
                console.warn('Tidak dapat mengambil data penilaian untuk insentif:', error);
                return 0;
            }
            return 0;
        } catch (error) {
            console.error('Error dalam hitungInsentif:', error);
            return 0;
        }
    }

    // Event Listeners
    document.getElementById('editGajiForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        if (!this.checkValidity()) {
            e.stopPropagation();
            this.classList.add('was-validated');
            return;
        }

        try {
            const previewValues = await updatePreview();
            const result = await Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin mengupdate gaji ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, update!',
                cancelButtonText: 'Batal'
            });

            if (result.isConfirmed) {
                const formData = new FormData(this);
                const dataToSend = {
                    id_pegawai: formData.get('id_pegawai'),
                    id_divisi: formData.get('divisi_pegawai'),
                    periode_bulan: document.getElementById('periodeView').value.split('-')[1], // Ambil bulan dari periode
                    periode_tahun: document.getElementById('periodeView').value.split('-')[0], // Ambil tahun dari periode
                    jumlah_kehadiran: formData.get('jumlah_kehadiran'),
                    jumlah_hari_lembur: formData.get('jumlah_hari_lembur'),
                    gaji_pokok: previewValues.gajiPokok,
                    insentif: previewValues.insentif,
                    bonus_kehadiran: previewValues.bonusKehadiran,
                    tunjangan_lembur: previewValues.tunjanganLembur,
                    total_pendapatan: previewValues.totalPendapatan,
                    potongan_pajak: previewValues.potonganPajak,
                    potongan_bpjs: previewValues.potonganBPJS,
                    gaji_bersih: previewValues.gajiBersih
                };

                const response = await fetch(`${API_BASE_URL}/gaji/${idGaji}`, {
                    method: 'PUT',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(dataToSend)
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Gagal mengupdate gaji');
                }

                const responseData = await response.json();
                await Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: responseData.message || 'Gaji berhasil diupdate'
                });

                window.location.href = '/gaji';
            }
        } catch (error) {
            console.error('Error updating gaji:', error);
            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Terjadi kesalahan saat mengupdate gaji'
            });
        }
    });

    document.getElementById('resetButton').addEventListener('click', function() {
        fetchPegawaiDetails();
    });

    document.getElementById('jumlah_kehadiran').addEventListener('input', updatePreview);
    document.getElementById('jumlah_hari_lembur').addEventListener('input', updatePreview);

    document.getElementById('btnBack').addEventListener('click', async function() {
        const result = await Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin kembali? Data yang belum disimpan akan hilang.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, kembali',
            cancelButtonText: 'Batal',
            allowOutsideClick: false
        });

        if (result.isConfirmed) {
            window.location.href = '/gaji';
        }
    });

    // Initialize the page
    fetchPegawaiDetails();
});
</script>
@endpush