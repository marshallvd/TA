@extends('layouts.master')

@section('title')
    Pengaturan Penggajian
@endsection

@section('css')
<style>
    .formula-card {
        background-color: #f8f9fa;
        border-left: 4px solid #0d6efd;
        margin-bottom: 1rem;
    }
    .calculation-note {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.5rem;
    }
    .formula-title {
        color: #0d6efd;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    .card-hover:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease-in-out;
    }
</style>
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

    {{-- Rumus Perhitungan --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0"><i class="bi bi-calculator me-2"></i>Rumus Perhitungan Komponen Gaji</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Kolom Kiri --}}
                        <div class="col-md-6">
                            {{-- Gaji Pokok --}}
                            <div class="p-3 formula-card">
                                <h5 class="formula-title">
                                    <i class="bi bi-currency-dollar me-2"></i>Gaji Pokok
                                </h5>
                                <div class="formula-content">
                                    <p class="mb-2"><strong>Rumus:</strong></p>
                                    <div class="alert alert-light border">
                                        <code>Gaji Pokok = Gaji Pokok Jabatan</code>
                                    </div>
                                    <p class="calculation-note">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Gaji pokok diambil dari master data jabatan setiap pegawai
                                    </p>
                                </div>
                            </div>

                            {{-- Insentif --}}
                            <div class="p-3 formula-card">
                                <h5 class="formula-title">
                                    <i class="bi bi-graph-up-arrow me-2"></i>Insentif
                                </h5>
                                <div class="formula-content">
                                    <p class="mb-2"><strong>Rumus:</strong></p>
                                    <div class="alert alert-light border">
                                        <code>Insentif = Gaji Pokok × Persentase Predikat</code>
                                    </div>
                                    <div class="table-responsive mt-3">
                                        <table class="table table-sm table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Predikat</th>
                                                    <th>Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Sangat Baik</td>
                                                    <td><span class="insentif-sangat-baik">0</span>%</td>
                                                </tr>
                                                <tr>
                                                    <td>Baik</td>
                                                    <td><span class="insentif-baik">0</span>%</td>
                                                </tr>
                                                <tr>
                                                    <td>Cukup</td>
                                                    <td><span class="insentif-cukup">0</span>%</td>
                                                </tr>
                                                <tr>
                                                    <td>Kurang</td>
                                                    <td><span class="insentif-kurang">0</span>%</td>
                                                </tr>
                                                <tr>
                                                    <td>Sangat Kurang</td>
                                                    <td><span class="insentif-sangat-kurang">0</span>%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Kanan --}}
                        <div class="col-md-6">
                            {{-- Bonus Kehadiran --}}
                            <div class="p-3 formula-card">
                                <h5 class="formula-title">
                                    <i class="bi bi-calendar-check me-2"></i>Bonus Kehadiran
                                </h5>
                                <div class="formula-content">
                                    <p class="mb-2"><strong>Rumus:</strong></p>
                                    <div class="alert alert-light border">
                                        <code>Bonus = Jumlah Kehadiran × <span class="bonus-per-kehadiran">0</span></code>
                                    </div>
                                    <p class="mb-0">Bonus per kehadiran: <span class="badge bg-success bonus-per-kehadiran-display">Rp 0</span></p>
                                </div>
                            </div>

                            {{-- Tunjangan Lembur --}}
                            <div class="p-3 formula-card">
                                <h5 class="formula-title">
                                    <i class="bi bi-clock-history me-2"></i>Tunjangan Lembur
                                </h5>
                                <div class="formula-content">
                                    <p class="mb-2"><strong>Rumus:</strong></p>
                                    <div class="alert alert-light border">
                                        <code>Tunjangan = Jumlah Hari Lembur × Tarif Lembur per Hari</code>
                                    </div>
                                    <p class="calculation-note">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Tarif lembur diambil dari master data jabatan pegawai
                                    </p>
                                </div>
                            </div>

                            {{-- Total Gaji --}}
                            <div class="p-3 formula-card">
                                <h5 class="formula-title">
                                    <i class="bi bi-cash me-2"></i>Total Gaji
                                </h5>
                                <div class="formula-content">
                                    <p class="mb-2"><strong>Rumus-rumus Total:</strong></p>
                                    <div class="alert alert-light border">
                                        <p class="mb-2"><code>Total Pendapatan = Gaji Pokok + Insentif + Bonus Kehadiran + Tunjangan Lembur</code></p>
                                        <p class="mb-2"><code>Total Potongan = (Total Pendapatan × <span class="persentase-pajak">0</span>%) + <span class="potongan-bpjs">Rp 0</span></code></p>
                                        <p class="mb-0"><code>Gaji Bersih = Total Pendapatan - Total Potongan</code></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Last Updated Section --}}
                        <div class="mt-4 text-end">
                            <p class="text-muted mb-0"><small>Terakhir diperbarui: <span id="lastUpdated">-</span></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Pengaturan --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0"><i class="bi bi-gear me-2"></i>Konfigurasi Komponen Gaji</h4>
                </div>
                <div class="card-body">
                    <form id="settingGajiForm" class="needs-validation" novalidate>
                        <div class="row">
                            {{-- Insentif berdasarkan Predikat --}}
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Insentif berdasarkan Predikat (%)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Sangat Baik</label>
                                            <div class="input-group">
                                                <input type="number" name="insentif_sangat_baik" class="form-control" required min="0" max="100" step="0.01">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Baik</label>
                                            <div class="input-group">
                                                <input type="number" name="insentif_baik" class="form-control" required min="0" max="100" step="0.01">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Cukup</label>
                                            <div class="input-group">
                                                <input type="number" name="insentif_cukup" class="form-control" required min="0" max="100" step="0.01">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kurang</label>
                                            <div class="input-group">
                                                <input type="number" name="insentif_kurang" class="form-control" required min="0" max="100" step="0.01">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sangat Kurang</label>
                                            <div class="input-group">
                                                <input type="number" name="insentif_sangat_kurang" class="form-control" required min="0" max="100" step="0.01">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Bonus dan Potongan --}}
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Bonus dan Potongan</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Bonus per Kehadiran</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" name="bonus_per_kehadiran" class="form-control" required min="0">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Potongan BPJS</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" name="potongan_bpjs" class="form-control" required min="0">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Persentase Pajak</label>
                                            <div class="input-group">
                                                <input type="number" name="persentase_pajak" class="form-control" required min="0" max="100" step="0.01">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>

                                        <h5 class="mb-3 mt-4">Komponen Total Pemasukan</h5>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" name="hitung_gaji_pokok" id="hitung_gaji_pokok">
                                            <label class="form-check-label" for="hitung_gaji_pokok">Hitung Gaji Pokok</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" name="hitung_insentif" id="hitung_insentif">
                                            <label class="form-check-label" for="hitung_insentif">Hitung Insentif</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" name="hitung_bonus_kehadiran" id="hitung_bonus_kehadiran">
                                            <label class="form-check-label" for="hitung_bonus_kehadiran">Hitung Bonus Kehadiran</label>
                                        </div>
                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" name="hitung_tunjangan_lembur" id="hitung_tunjangan_lembur">
                                            <label class="form-check-label" for="hitung_tunjangan_lembur">Hitung Tunjangan Lembur</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-end gap-2">
                                <button type="button" id="resetButton" class="btn btn-warning">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save me-2"></i>Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('settingGajiForm');
    const resetButton = document.getElementById('resetButton');
    const token = localStorage.getItem('token');

    // Format currency
    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(amount);
    }

    // Format date
    function formatDate(date) {
        return new Intl.DateTimeFormat('id-ID', {
            dateStyle: 'full',
            timeStyle: 'short'
        }).format(new Date(date));
    }

    // Update display values
    function updateDisplayValues(data) {
        // Update insentif percentages
        document.querySelector('.insentif-sangat-baik').textContent = data.insentif_sangat_baik;
        document.querySelector('.insentif-baik').textContent = data.insentif_baik;
        document.querySelector('.insentif-cukup').textContent = data.insentif_cukup;
        document.querySelector('.insentif-kurang').textContent = data.insentif_kurang;
        document.querySelector('.insentif-sangat-kurang').textContent = data.insentif_sangat_kurang;

        // Update bonus per kehadiran in both formula and display
        const bonusPerKehadiran = formatCurrency(data.bonus_per_kehadiran);
        document.querySelectorAll('.bonus-per-kehadiran').forEach(el => {
            el.textContent = bonusPerKehadiran;
        });
        document.querySelector('.bonus-per-kehadiran-display').textContent = bonusPerKehadiran;

        // Update potongan values
        document.querySelector('.persentase-pajak').textContent = data.persentase_pajak;
        document.querySelector('.potongan-bpjs').textContent = formatCurrency(data.potongan_bpjs);
        
        // Update form fields
        Object.keys(data).forEach(key => {
            const element = form.elements[key];
            if (element) {
                if (element.type === 'checkbox') {
                    element.checked = data[key];
                } else {
                    element.value = data[key];
                }
            }
        });

        // Update last updated timestamp
        if (data.updated_at) {
            document.getElementById('lastUpdated').textContent = formatDate(data.updated_at);
        }
    }

    // Fetch current settings
    async function fetchCurrentSettings() {
        try {
            const response = await fetch('/api/setting-gaji', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                // Add cache control to prevent caching
                cache: 'no-store'
            });

            if (!response.ok) throw new Error('Failed to fetch settings');

            const data = await response.json();
            if (data.data) {
                updateDisplayValues(data.data);
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data pengaturan gaji'
            });
        }
    }

    // Form validation
    function validateForm() {
        const inputs = form.querySelectorAll('input[type="number"]');
        let isValid = true;

        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value) {
                isValid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }

            const min = parseFloat(input.getAttribute('min'));
            const max = parseFloat(input.getAttribute('max'));
            const value = parseFloat(input.value);

            if (!isNaN(min) && value < min) {
                isValid = false;
                input.classList.add('is-invalid');
            }

            if (!isNaN(max) && value > max) {
                isValid = false;
                input.classList.add('is-invalid');
            }
        });

        return isValid;
    }

    // Handle form submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        if (!validateForm()) {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                text: 'Mohon periksa kembali input Anda'
            });
            return;
        }

        const formData = new FormData(form);
        const formDataObj = {};
        
        formData.forEach((value, key) => {
            if (form.elements[key].type === 'checkbox') {
                formDataObj[key] = form.elements[key].checked;
            } else {
                formDataObj[key] = value;
            }
        });

        try {
            const confirmResult = await Swal.fire({
                title: 'Konfirmasi Perubahan',
                text: 'Apakah Anda yakin ingin menyimpan pengaturan gaji?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            });

            if (confirmResult.isConfirmed) {
                const response = await fetch('/api/setting-gaji', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formDataObj)
                });

                if (!response.ok) throw new Error('Gagal menyimpan pengaturan');

                // Refresh the data immediately after saving
                await fetchCurrentSettings();

                await Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Pengaturan gaji berhasil disimpan'
                });

                // Redirect to /gaji after successful save
                window.location.href = '/gaji';
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
    });

    // Handle reset button
    resetButton.addEventListener('click', async function() {
        const result = await Swal.fire({
            title: 'Reset Pengaturan?',
            text: 'Semua nilai akan dikembalikan ke pengaturan terakhir',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset',
            cancelButtonText: 'Batal'
        });

        if (result.isConfirmed) {
            await fetchCurrentSettings();
            Swal.fire({
                icon: 'success',
                title: 'Reset Berhasil',
                text: 'Pengaturan telah dikembalikan ke nilai terakhir'
            });
        }
    });

    // Handle input validation on change
    form.querySelectorAll('input[type="number"]').forEach(input => {
        input.addEventListener('change', function() {
            if (this.hasAttribute('required') && !this.value) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    });

    // Initial fetch
    fetchCurrentSettings();

    // Refresh data every 30 seconds
    setInterval(fetchCurrentSettings, 30000);
});
</script>
@endpush

@push('styles')
<style>
    
    .formula-card {
        background-color: #f8f9fa;
        border-left: 4px solid #0d6efd;
        margin-bottom: 1rem;
    }
    .calculation-note {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.5rem;
    }
    .formula-title {
        color: #0d6efd;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    .card-hover:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease-in-out;
    }
    .card {
        border: 1px solid #ddd;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #ddd;
    }
    .card-title {
        color: #333;
    }
    .alert-light {
        background-color: #f8f9fa;
    }
</style>
@endpush