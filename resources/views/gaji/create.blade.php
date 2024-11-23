@extends('layouts.app')
@extends('layouts.master')

@section('title') Tambah Gaji @endsection

@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Informasi Pegawai</h4>
                    <button type="button" class="btn btn-danger btn-sm" id="btnBack">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </button>
                </div>
                <div class="card-body">
                    <div class="row small" id="pegawaiDetails">
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

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Form Tambah Gaji</h4>
                </div>
                <div class="card-body">
                    <form id="tambahGajiForm">
                        <input type="hidden" id="id_pegawai" name="id_pegawai">
                        <input type="hidden" id="divisi_pegawai" name="divisi_pegawai">

                        <div class="mb-3">
                            <label for="periode" class="form-label">Periode Gaji (YYYY-MM)</label>
                            <input type="month" id="periode" name="periode" class="form-control" required>
                        </div>

                        <!-- Kolom untuk menampilkan predikat penilaian kinerja -->
                        <div class="mb-3">
                            <label for="predikat" class="form-label">Predikat Penilaian Kinerja</label>
                            <input type="text" id="predikat" name="predikat" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_kehadiran" class="form-label">Jumlah Kehadiran</label>
                            <input type="number" id="jumlah_kehadiran" name="jumlah_kehadiran" class="form-control" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_hari_lembur" class="form-label">Jumlah Hari Lembur</label>
                            <input type="number" id="jumlah_hari_lembur" name="jumlah_hari_lembur" class="form-control" min="0" required>
                        </div>

                        <button type="button" class="btn btn-primary" id="submitGaji">Simpan Gaji</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div id="previewSection" style="display: block;">
                        <div class="row">
                            <!-- Kolom Pendapatan -->
                            <div class="col-md-6">
                                <h5 class="mb-3">Pendapatan</h5>
                                <div class="mb-3">
                                    <label class="form-label">Gaji Pokok</label>
                                    <input type="text" id="gajiPokokPreview" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Insentif</label>
                                    <input type="text" id="insentifPreview" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Bonus Kehadiran</label>
                                    <input type="text" id="bonusKehadiranPreview" class="form-control" readonly>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tunjangan Lembur</label>
                                    <input type="text" id="tunjanganLemburPreview" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Total Pendapatan</label>
                                    <input type="text" id="totalPendapatanPreview" class="form-control fw-bold" readonly>
                                </div>
                            </div>
                            
                            <!-- Kolom Potongan -->
                            <div class="col-md-6">
                                <h5 class="mb-3">Potongan</h5>
                                <div class="mb-3">
                                    <label class="form-label">Potongan Pajak</label>
                                    <input type="text" id="potonganPajakPreview" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Potongan BPJS</label>
                                    <input type="text" id="potonganBPJSPreview" class="form-control" readonly value="200000">
                                </div>
                                <div class="mt-4">
                                    <h5 class="mb-3">Gaji Bersih</h5>
                                    <input type="text" id="gajiBersihPreview" class="form-control form-control-lg fw-bold bg-light" readonly>
                                </div>
                            </div>
                        </div>
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
            const response = await fetch(`http://127.0.0.1:8000/api/${endpoint}`, {
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

            // Initialize preview with available data
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

    async function initializePreview() {
        const gajiPokok = await getGajiPokok();
        const periode = new Date(document.getElementById('periode').value); // Ambil periode dari input
        const insentif = await hitungInsentif(periode);
        const potonganBPJS = 200000; // Potongan BPJS tetap

        // Show the preview section immediately
        document.getElementById('previewSection').style.display = 'block';

        // Update fields with known values
        document.getElementById('gajiPokokPreview').value = gajiPokok.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        document.getElementById('insentifPreview').value = insentif.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        document.getElementById('potonganBPJSPreview').value = potonganBPJS.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });

        // Initialize other fields with empty or zero values
        document.getElementById('bonusKehadiranPreview').value = 'Rp 0';
        document.getElementById('tunjanganLemburPreview').value = 'Rp 0';
        document.getElementById('totalPendapatanPreview').value = 'Rp 0';
        document.getElementById('potonganPajakPreview').value = 'Rp 0';
        document.getElementById('gajiBersihPreview').value = 'Rp 0';
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
            const pegawaiResponse = await fetchData(`pegawai/${idPegawai}`);
            if (!pegawaiResponse || !pegawaiResponse.data) {
                console.warn('Data pegawai tidak valid');
                return 0;
            }

            const tahun = periode.getFullYear();
            const bulan = String(periode.getMonth() + 1).padStart(2, '0'); // Menggunakan bulan dalam format 2 digit

            const penilaianResponse = await fetchData(`penilaian-kinerja/pegawai/${idPegawai}/tahun/${tahun}/bulan/${bulan}`);
            if (!penilaianResponse || !penilaianResponse.data || !penilaianResponse.data.predikat) {
                console.warn('Penilaian kinerja tidak ditemukan untuk pegawai ini.');
                await Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Penilaian kinerja tidak ditemukan. Insentif akan dihitung sebagai 0.'
                });
                return 0;
            }

            const predikat = penilaianResponse.data.predikat;
            let persentaseInsentif = 0;

            switch (predikat.toLowerCase()) {
                case 'sangat baik':
                    persentaseInsentif = 0.15;
                    break;
                case 'baik':
                    persentaseInsentif = 0.10;
                    break;
                case 'cukup':
                    persentaseInsentif = 0.05;
                    break;
                case 'kurang':
                    persentaseInsentif = 0.02;
                    break;
                case 'sangat kurang':
                    persentaseInsentif = 0.00;
                    break;
                default:
                    console.warn('Predikat tidak dikenali:', predikat);
                    break;
            }

            const gajiPokok = await getGajiPokok();
            return gajiPokok * persentaseInsentif;
        } catch (error) {
            console.error('Error dalam perhitungan insentif:', error);
            await Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan dalam perhitungan insentif'
            });
            return 0;
        }
    }

    function hitungBonusKehadiran(jumlahKehadiran) {
        return jumlahKehadiran * 25000;
    }

    function hitungTunjanganLembur(jumlahHariLembur, tarifLemburPerHari) {
        return jumlahHariLembur * tarifLemburPerHari;
    }

    function hitungPotonganPajak(totalPendapatan) {
        const potonganPajak = totalPendapatan * 0.1; // Pajak 10%
        return potonganPajak;
    }

    async function updatePreview() {
        const jumlahKehadiran = parseInt(document.getElementById('jumlah_kehadiran').value) || 0;
        const jumlahHariLembur = parseInt(document.getElementById('jumlah_hari_lembur').value) || 0;
        const periode = new Date(document.getElementById('periode').value); // Ambil periode dari input

        const gajiPokok = await getGajiPokok();
        const tarifLemburPerHari = await getTarifLembur();
        const insentif = await hitungInsentif(periode); // Pass periode ke fungsi hitungInsentif
        const bonusKehadiran = hitungBonusKehadiran(jumlahKehadiran);
        const tunjanganLembur = hitungTunjanganLembur(jumlahHariLembur, tarifLemburPerHari);
        
        const totalPendapatan = gajiPokok + insentif + bonusKehadiran + tunjanganLembur;
        const potonganPajak = hitungPotonganPajak(totalPendapatan);
        const potonganBPJS = 200000;
        const totalPotongan = potonganPajak + potonganBPJS;
        const gajiBersih = totalPendapatan - totalPotongan;

        // Update all preview fields
        document.getElementById('gajiPokokPreview').value = gajiPokok.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        document.getElementById('insentifPreview').value = insentif.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        document.getElementById('bonusKehadiranPreview').value = bonusKehadiran.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        document.getElementById('tunjanganLemburPreview').value = tunjanganLembur.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        document.getElementById('totalPendapatanPreview').value = totalPendapatan.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        document.getElementById('potonganPajakPreview').value = potonganPajak.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        document.getElementById('potonganBPJSPreview').value = potonganBPJS.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
        document.getElementById('gajiBersihPreview').value = gajiBersih.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
    }

    document.getElementById('submitGaji').addEventListener('click', async function() {
    await updatePreview();
    
    const result = await Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menyimpan gaji ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, simpan!',
        cancelButtonText: 'Batal'
    });

    if (result.isConfirmed) {
        const form = document.getElementById('tambahGajiForm');
        const formData = new FormData(form);
        
        // Log data yang akan dikirim
        const dataToSend = {
            id_pegawai: formData.get('id_pegawai'),
            periode: formData.get('periode'),
            jumlah_kehadiran: formData.get('jumlah_kehadiran'),
            jumlah_hari_lembur: formData.get('jumlah_hari_lembur')
        };
        
        console.log('Data yang akan dikirim:', dataToSend);

        try {
            const response = await fetch('http://127.0.0.1:8000/api/gaji', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(dataToSend)
            });

            if (!response.ok) {
                throw new Error('Gaji gagal disimpan');
            }

            const result = await response.json();
            
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: result.message
            }).then(() => {
                window.location.href = '/gaji'; // Redirect ke halaman daftar gaji
            });
        } catch (error) {
            console.error('Error saving gaji:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Terjadi kesalahan saat menyimpan gaji'
            });
        }
    }
});

    if (periodeGaji) {
        document.getElementById('periode').value = periodeGaji;
    }

    // Add event listeners for input fields
    document.getElementById('jumlah_kehadiran').addEventListener('input', updatePreview);
    document.getElementById('jumlah_hari_lembur').addEventListener('input', updatePreview);
    
    // Initialize the page
    fetchPegawaiDetails();

    // Handle back button click
document.getElementById('btnBack').addEventListener('click', async function() {
    // Show SweetAlert2 confirmation dialog
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

    // If user confirms, redirect to index page
    if (result.isConfirmed) {
        window.location.href = '/gaji';
    }
});
});
</script>
@endsection