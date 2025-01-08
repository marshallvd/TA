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
           const response = await fetch(`http://127.0.0.1:8000/api/${endpoint}`, {
               method: 'GET',
               headers: {
                   'Authorization': `Bearer ${token}`,
                   'Accept': 'application/json',
                   'Content-Type': 'application/json'
               }
           });

           if (!response.ok) {
               throw new Error(`HTTP error! status: ${response.status}`);
           }

           const data = await response.json();
           return data;
       } catch (error) {
           console.error(`Fetch error for ${endpoint}:`, error);
           throw new Error(error.message || 'Terjadi kesalahan saat mengambil data');
       }
   }

   async function fetchDivisiDetails(idDivisi) {
       try {
           const data = await fetchData(`divisi/${idDivisi}`);
           if (!data) {
               throw new Error('Data divisi tidak ditemukan');
           }
           return data;
       } catch (error) {
           console.error('Error fetching divisi details:', error);
           throw error;
       }
   }

   let jabatanData = null;

   async function fetchJabatanDetails(idJabatan) {
       try {
           const data = await fetchData(`jabatan/${idJabatan}`);
           if (!data) {
               throw new Error('Data jabatan tidak ditemukan');
           }
           jabatanData = data;
           console.log('Jabatan Data:', jabatanData);
           return data;
       } catch (error) {
           console.error('Error fetching jabatan details:', error);
           throw error;
       }
   }

   async function fetchGajiDetails() {
       try {
           const data = await fetchData(`gaji/${idGaji}`);
           
           if (!data.data) {
               throw new Error('Data gaji tidak ditemukan');
           }
           
           const gajiData = data.data;
           
           // Debug logs
           console.log('Gaji Data:', gajiData);
           console.log('Pegawai Data:', gajiData.pegawai);
           
           // Set form values
           document.getElementById('id_pegawai').value = gajiData.id_pegawai;
           document.getElementById('divisi_pegawai').value = gajiData.pegawai.id_divisi;
           document.getElementById('jumlah_kehadiran').value = gajiData.jumlah_kehadiran;
           document.getElementById('jumlah_hari_lembur').value = gajiData.jumlah_hari_lembur;
           document.getElementById('periodeView').value = `${gajiData.periode_tahun}-${String(gajiData.periode_bulan).padStart(2, '0')}`;
           
           // Update pegawai basic details
           document.getElementById('pegawaiName').textContent = gajiData.pegawai?.nama_lengkap || '-';
           document.getElementById('pegawaiNIK').textContent = gajiData.pegawai?.nik || '-';

           // Fetch and update divisi details
           if (gajiData.pegawai?.id_divisi) {
               try {
                   const divisiData = await fetchDivisiDetails(gajiData.pegawai.id_divisi);
                   document.getElementById('pegawaiDivision').textContent = divisiData.nama_divisi || '-';
               } catch (error) {
                   console.error('Error fetching divisi:', error);
                   document.getElementById('pegawaiDivision').textContent = '-';
               }
           }

           // Fetch and update jabatan details
           if (gajiData.pegawai?.id_jabatan) {
               try {
                   const jabatanData = await fetchJabatanDetails(gajiData.pegawai.id_jabatan);
                   document.getElementById('pegawaiPosition').textContent = jabatanData.nama_jabatan || '-';
                   // Setelah mendapatkan data jabatan, update preview
                   await updatePreview();
               } catch (error) {
                   console.error('Error fetching jabatan:', error);
                   document.getElementById('pegawaiPosition').textContent = '-';
               }
           }

       } catch (error) {
           console.error('Error fetching gaji details:', error);
           await Swal.fire({
               icon: 'error',
               title: 'Error',
               text: error.message || 'Gagal mengambil data gaji'
           });
       }
   }

   function getGajiPokok() {
       if (!jabatanData) {
           console.warn("Data jabatan belum tersedia");
           return 0;
       }
       const gajiPokok = parseFloat(jabatanData.gaji_pokok) || 0;
       console.log('Gaji Pokok from jabatanData:', gajiPokok);
       return gajiPokok;
   }

   function getTarifLembur() {
       if (!jabatanData) {
           console.warn("Data jabatan belum tersedia");
           return 0;
       }
       return parseFloat(jabatanData.tarif_lembur_per_hari) || 0;
   }

   async function hitungInsentif() {
       const idPegawai = document.getElementById('id_pegawai').value;
       const periodeView = document.getElementById('periodeView').value;
       
       console.log('Menghitung insentif untuk:', {
           idPegawai,
           periodeView
       });

       try {
           const data = await fetchData(`penilaian-kinerja?id_pegawai=${idPegawai}&periode=${periodeView}`);
           console.log('Data Penilaian Kinerja:', data);
           
           if (!data.data || data.data.length === 0) {
               console.warn('Penilaian kinerja tidak ditemukan');
               return 0;
           }

           const penilaian = data.data[0];
           console.log('Predikat Penilaian:', penilaian.predikat);

           const gajiPokok = getGajiPokok();
           console.log('Gaji Pokok untuk perhitungan insentif:', gajiPokok);

           const persentaseInsentif = {
               'sangat baik': 0.15,
               'baik': 0.10,
               'cukup': 0.05,
               'kurang': 0.02,
               'sangat kurang': 0.00
           }[penilaian.predikat.toLowerCase()] || 0;

           console.log('Persentase Insentif:', persentaseInsentif);

           const insentif = gajiPokok * persentaseInsentif;
           console.log('Hasil perhitungan insentif:', insentif);

           return insentif;
       } catch (error) {
           console.error('Error dalam perhitungan insentif:', error);
           console.error('Detail Error:', {
               message: error.message,
               stack: error.stack
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
       return totalPendapatan * 0.1;
   }

   function formatCurrency(value) {
       const numValue = typeof value === 'string' ? parseFloat(value.replace(/[^\d.-]/g, '')) : value;
       
       if (isNaN(numValue)) {
           return 'Rp 0';
       }

       return new Intl.NumberFormat('id-ID', {
           style: 'currency',
           currency: 'IDR',
           minimumFractionDigits: 0,
           maximumFractionDigits: 0
       }).format(numValue);
   }

   function parseCurrencyToNumber(currencyString) {
       if (!currencyString) return 0;
       return parseFloat(currencyString.replace(/[^0-9-]/g, '')) || 0;
   }

   async function updatePreview() {
       try {
           const jumlahKehadiran = parseInt(document.getElementById('jumlah_kehadiran').value) || 0;
           const jumlahHariLembur = parseInt(document.getElementById('jumlah_hari_lembur').value) || 0;
           
           const gajiPokok = getGajiPokok();
           console.log('Preview - Gaji Pokok:', gajiPokok);
           
           const tarifLemburPerHari = getTarifLembur();
           console.log('Preview - Tarif Lembur:', tarifLemburPerHari);
           
           const insentif = await hitungInsentif();
           console.log('Preview - Insentif:', insentif);
           
           const bonusKehadiran = hitungBonusKehadiran(jumlahKehadiran);
           const tunjanganLembur = hitungTunjanganLembur(jumlahHariLembur, tarifLemburPerHari);
           
           const totalPendapatan = gajiPokok + insentif + bonusKehadiran + tunjanganLembur;
           const potonganPajak = hitungPotonganPajak(totalPendapatan);
           const potonganBPJS = 200000;
           const totalPotongan = potonganPajak + potonganBPJS;
           const gajiBersih = totalPendapatan - totalPotongan;

           document.getElementById('gajiPokokPreview').value = formatCurrency(gajiPokok);
           document.getElementById('insentifPreview').value = formatCurrency(insentif);
           document.getElementById('bonusKehadiranPreview').value = formatCurrency(bonusKehadiran);
           document.getElementById('tunjanganLemburPreview').value = formatCurrency(tunjanganLembur);
           document.getElementById('totalPendapatanPreview').value = formatCurrency(totalPendapatan);
           document.getElementById('potonganPajakPreview').value = formatCurrency(potonganPajak);
           document.getElementById('potonganBPJSPreview').value = formatCurrency(potonganBPJS);
           document.getElementById('gajiBersihPreview').value = formatCurrency(gajiBersih);
       } catch (error) {
           console.error('Error updating preview:', error);
           await Swal.fire({
               icon: 'error',
               title: 'Error',
               text: 'Gagal mengupdate preview gaji'
           });
       }
   }

   document.getElementById('jumlah_kehadiran').addEventListener('input', updatePreview);
   document.getElementById('jumlah_hari_lembur').addEventListener('input', updatePreview);
   
   fetchGajiDetails();
   
// Add form submit handler
const editGajiForm = document.getElementById('editGajiForm');
editGajiForm.addEventListener('submit', async function(e) {
    // Prevent default form submission
    e.preventDefault();
    
    try {
        const idPegawai = document.getElementById('id_pegawai').value;
        if (!idPegawai) {
            throw new Error('ID Pegawai tidak ditemukan');
        }

        const periodeView = document.getElementById('periodeView').value;
        const [tahun, bulan] = periodeView.split('-');
        
        const getNumericValue = (elementId) => {
            const value = document.getElementById(elementId).value;
            return parseCurrencyToNumber(value);
        };

        const requestBody = {
            id_pegawai: idPegawai,
            id_divisi: document.getElementById('divisi_pegawai').value,
            periode_tahun: tahun,
            periode_bulan: bulan,
            jumlah_kehadiran: parseInt(document.getElementById('jumlah_kehadiran').value) || 0,
            jumlah_hari_lembur: parseInt(document.getElementById('jumlah_hari_lembur').value) || 0,
            gaji_pokok: getGajiPokok(),
            insentif: await hitungInsentif(),
            bonus_kehadiran: getNumericValue('bonusKehadiranPreview'),
            tunjangan_lembur: getNumericValue('tunjanganLemburPreview'),
            total_pendapatan: getNumericValue('totalPendapatanPreview'),
            potongan_pajak: getNumericValue('potonganPajakPreview'),
            potongan_bpjs: 200000,
            gaji_bersih: getNumericValue('gajiBersihPreview')
        };

        const confirmation = await Swal.fire({
            title: 'Konfirmasi Update',
            text: 'Apakah Anda yakin ingin mengupdate data gaji ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Update',
            cancelButtonText: 'Batal'
        });

        if (confirmation.isConfirmed) {
            const response = await fetch(`http://127.0.0.1:8000/api/gaji/${idGaji}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestBody)
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Gagal mengupdate gaji');
            }

            const result = await response.json();
            await Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: result.message || 'Gaji berhasil diupdate'
            });

            // Redirect after successful update
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

// Remove the click event listener from the update button since we're handling the form submit

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
@endpush