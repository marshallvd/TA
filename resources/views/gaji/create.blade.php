@extends('layouts.master')

@section('title')
    Tambah Gaji
@endsection

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

    <div class="row">
        {{-- Employee Information Card --}}
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
    {{-- Salary Form dan Preview dalam satu row --}}
    <div class="row">
        {{-- Salary Form --}}
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Form Tambah Gaji</h4>
                </div>
                <div class="card-body">
                    <form id="tambahGajiForm" class="needs-validation" novalidate>
                        <input type="hidden" id="id_pegawai" name="id_pegawai">
                        <input type="hidden" id="divisi_pegawai" name="divisi_pegawai">

                        <div class="mb-3">
                            <label for="periode" class="form-label">Periode Gaji <span class="text-danger">*</span></label>
                            <input type="month" id="periode" name="periode" class="form-control" required>
                            <div class="invalid-feedback">Periode gaji tidak boleh kosong</div>
                        </div>

                        <div class="mb-3">
                            <label for="predikat" class="form-label">Predikat Penilaian Kinerja</label>
                            <input type=" text" id="predikat" name="predikat" class="form-control bg-light" readonly>
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
                                <button type="submit" class="btn btn-success" id="submitGaji">
                                    <i class="bi bi-save me-2"></i>Simpan
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
                    <div id="previewSection" style="display: none;">
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
    const idPegawai = pathSegments[pathSegments.length - 2];
    const periodeGaji = pathSegments[pathSegments.length - 1];

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

    document.getElementById('id_pegawai').value = idPegawai;

    async function fetchData(endpoint) {
        const token = localStorage.getItem('token');
        try {
            const response = await fetch(`${API_BASE_URL}/${endpoint}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error(`Fetch error for ${endpoint}:`, error);
            throw error;
        }
    }

    async function fetchPegawaiDetails() {
        try {
            const pegawaiResponse = await fetchData(`pegawai/${idPegawai}`);
            if (!pegawaiResponse.data) {
                throw new Error('Data pegawai tidak ditemukan');
            }
            const pegawai = pegawaiResponse.data;
            const jabatanResponse = await fetchData(`jabatan/${pegawai.id_jabatan}`);
            const divisiResponse = await fetchData(`divisi/${pegawai.id_divisi}`);

            if (!jabatanResponse || !divisiResponse) {
                throw new Error('Data jabatan atau divisi tidak ditemukan');
            }

            document.getElementById('pegawaiName').textContent = pegawai.nama_lengkap || '-';
            document.getElementById('pegawaiNIK').textContent = pegawai.nik || '-';
            document.getElementById('pegawaiDivision').textContent = divisiResponse.nama_divisi || '-';
            document.getElementById('pegawaiPosition').textContent = jabatanResponse.nama_jabatan || '-';
            document.getElementById('divisi_pegawai').value = pegawai.id_divisi;

            // Ambil dan tampilkan predikat penilaian kinerja
            const periode = new Date(document.getElementById('periode').value);
            const penilaianResponse = await fetchData(`penilaian-kinerja/pegawai/${idPegawai}/tahun/${periode.getFullYear()}/bulan/${String(periode.getMonth() + 1).padStart(2, '0')}`);
            if (penilaianResponse && penilaianResponse.data) {
                document.getElementById('predikat').value = penilaianResponse.data.predikat || '-';
            } else {
                document.getElementById('predikat').value = '-';
            }

            window.jabatanData = jabatanResponse;

            await initializePreview();
        } catch (error) {
            console.error('Error in fetchPegawaiDetails:', error);
            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data pegawai: ' + error.message
            });
        }
    }

    async function checkExistingGaji(idPegawai, periode) {
        try {
            const response = await fetch(`${API_BASE_URL}/gaji/check/${idPegawai}/${periode}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            return data.exists;
        } catch (error) {
            console.error('Error checking existing gaji:', error);
            return false;
        }
    }

    async function initializePreview() {
        try {
            const settingGaji = await fetchSettingGaji();
            if (!settingGaji) {
                console.error('Setting gaji tidak tersedia');
                return;
            }

            const gajiPokok = await getGajiPokok();
            const periode = new Date(document.getElementById('periode').value);
            const insentif = await hitungInsentif(periode);
            const potonganBPJS = settingGaji.potongan_bpjs || 200000;

            document.getElementById('previewSection').style.display = 'block';

            document.getElementById('gajiPokokPreview').value = gajiPokok.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
            document.getElementById('insentifPreview').value = insentif.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
            document.getElementById('potonganBPJSPreview').value = potonganBPJS.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

            document.getElementById('bonusKehadiranPreview').value = 'Rp 0';
            document.getElementById('tunjanganLemburPreview').value = 'Rp 0';
            document.getElementById('totalPendapatanPreview').value = 'Rp 0';
            document.getElementById('potonganPajakPreview').value = 'Rp 0';
            document.getElementById('gajiBersihPreview').value = 'Rp 0';
        } catch (error) {
            console.error('Error dalam initializePreview:', error);
        }
    }

    async function getGajiPokok() {
        if (window.jabatanData && window.jabatanData.gaji_pokok) {
            return parseFloat(window.jabatanData.gaji_pokok);
        }
        console.error("Data jabatan tidak tersedia");
        return 0;
    }

    async function getTarifLembur() {
        if (window.jabatanData && window.jabatanData.tarif_lembur_per_hari) {
            return parseFloat(window.jabatanData.tarif_lembur_per_hari);
        }
        console.error("Data jabatan tidak tersedia");
        return 0;
    }

    async function hitungInsentif(periode) {
    try {
        const settingGaji = await fetchSettingGaji(); // Tambahkan ini
        if (!settingGaji) {
            console.error('Setting gaji tidak tersedia');
            return 0;
        }

        const penilaianResponse = await fetchData(`penilaian-kinerja/pegawai/${idPegawai}/tahun/${periode.getFullYear()}/bulan/${String(periode.getMonth() + 1).padStart(2, '0')}`);
        
        if (penilaianResponse && penilaianResponse.data) {
            const predikat = penilaianResponse.data.predikat;
            const gajiPokok = await getGajiPokok();
            
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
        return 0;
    } catch (error) {
        console.error('Error dalam hitungInsentif:', error);
        return 0;
    }
}

async function hitungTunjanganLembur(jumlahHariLembur) {
    const pegawai = await fetchData(`pegawai/${idPegawai}`);
    return jumlahHariLembur * pegawai.data.jabatan.tarif_lembur_per_hari;
}

    // function hitungBonusKehadiran(jumlahKehadiran) {
    //     return jumlahKehadiran * 25000;
    // }

    // function hitungTunjanganLembur(jumlahHariLembur, tarifLemburPerHari) {
    //     return jumlahHariLembur * tarifLemburPerHari;
    // }

    // function hitungPotonganPajak(totalPendapatan) {
    //     return totalPendapatan * 0.1;
    // }

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
        const periode = new Date(document.getElementById('periode').value);

        // Hitung komponen gaji
        const gajiPokok = Number(settingGaji.hitung_gaji_pokok ? await getGajiPokok() : 0);
        const insentif = Number(settingGaji.hitung_insentif ? await hitungInsentif(periode, settingGaji) : 0);
        const bonusKehadiran = Number(settingGaji.hitung_bonus_kehadiran ? jumlahKehadiran * settingGaji.bonus_per_kehadiran : 0);
        const tunjanganLembur = Number(settingGaji.hitung_tunjangan_lembur ? await hitungTunjanganLembur(jumlahHariLembur) : 0);

        // Hitung total
        const totalPendapatan = gajiPokok + insentif + bonusKehadiran + tunjanganLembur;
        const potonganPajak = totalPendapatan * (Number(settingGaji.persentase_pajak) / 100);
        const potonganBPJS = Number(settingGaji.potongan_bpjs);
        const totalPotongan = potonganPajak + potonganBPJS;
        const gajiBersih = totalPendapatan - totalPotongan;

        // Log untuk debugging
        console.log('Perhitungan Gaji:', {
            gajiPokok,
            insentif,
            bonusKehadiran,
            tunjanganLembur,
            totalPendapatan,
            potonganPajak,
            potonganBPJS,
            totalPotongan,
            gajiBersih
        });

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
        alert('Terjadi kesalahan dalam perhitungan gaji');
    }
}

    // Event Listeners
    document.getElementById('submitGaji').addEventListener('click', async function(e) {
        e.preventDefault(); // Tambahkan ini untuk mencegah default behavior

        // Validasi form
        const form = document.getElementById('tambahGajiForm');
        if (!form.checkValidity()) {
            e.preventDefault(); // Mencegah submit form jika tidak valid
            form.classList.add('was-validated');
            return;
        }

        // Validasi field yang diperlukan
        if (!document.getElementById('periode').value) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Periode gaji harus diisi!'
            });
            return;
        }

        if (!document.getElementById('jumlah_kehadiran').value) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Jumlah kehadiran harus diisi!'
            });
            return;
        }

        if (!document.getElementById('jumlah_hari_lembur').value) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Jumlah hari lembur harus diisi!'
            });
            return;
        }

        const idPegawai = document.getElementById('id_pegawai').value;
        const periode = document.getElementById('periode').value;

        // Cek apakah gaji untuk periode ini sudah ada
        const gajiExists = await checkExistingGaji(idPegawai, periode);
        if (gajiExists) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gaji untuk periode ini sudah ada!'
            });
            return;
        }

        const settingGaji = await fetchSettingGaji();
        const previewValues = await updatePreview(settingGaji);

            const result = await Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menyimpan gaji ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, simpan!',
        cancelButtonText: 'Batal'
    });

    if (result.isConfirmed) {
    try {
        const formData = new FormData(form);
        const dataToSend = {
            id_pegawai: formData.get('id_pegawai'),
            periode: formData.get('periode'),
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

        const response = await fetch(`${API_BASE_URL}/gaji`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(dataToSend)
        });

        const responseData = await response.json();

        if (!response.ok) {
            throw new Error(responseData.message || 'Gaji gagal disimpan');
        }

        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: responseData.message
        }).then(() => {
            window.location.href = '/gaji';
        });
    } catch (error) {
        console.error('Error saving gaji:', error);
        let errorMessage = error.message;
        
        if (error.response) {
            try {
                const errorData = await error.response.json();
                errorMessage = errorData.message || errorMessage;
            } catch (e) {
                console.error('Error parsing error response:', e);
            }
        }
        
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage
        });
    }
}
});

document.getElementById('resetButton').addEventListener('click', function() {
    const form = document.getElementById('tambahGajiForm');
    form.reset();
    initializePreview();
});

document.getElementById('jumlah_kehadiran').addEventListener('input', updatePreview);
document.getElementById('jumlah_hari_lembur').addEventListener('input', updatePreview);
document.getElementById('periode').addEventListener('change', async function() {
    const periode = new Date(this.value);
    const penilaianResponse = await fetchData(`penilaian-kinerja/pegawai/${idPegawai}/tahun/${periode.getFullYear()}/bulan/${String(periode.getMonth() + 1).padStart(2, '0')}`);
    if (penilaianResponse && penilaianResponse.data) {
        document.getElementById('predikat').value = penilaianResponse.data.predikat || '-';
    } else {
        document.getElementById('predikat').value = '-';
    }
    await updatePreview();
});

if (periodeGaji) {
    document.getElementById('periode').value = periodeGaji;
}

// Initialize the page
fetchPegawaiDetails();

// Handle back button click
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
});
</script>
@endpush