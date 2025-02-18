@extends('layouts.master')

@section('title')
    Pengaturan Bobot Penilaian
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Pengaturan Bobot Penilaian</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-sliders text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Konfigurasi Bobot Penilaian</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="settingBobotForm" class="needs-validation" novalidate>
                            <div class="row g-4">
                                <!-- Bobot KPI Input -->
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="bobot_kpi">
                                            <i class="bi bi-graph-up me-1"></i>Bobot KPI (%)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="bobot_kpi" 
                                               name="bobot_kpi" 
                                               required 
                                               min="0"
                                               max="100"
                                               step="0.01"
                                               placeholder="Contoh: 80">
                                        <div class="invalid-feedback">
                                            Bobot KPI harus diisi antara 0-100
                                        </div>
                                    </div>
                                </div>

                                <!-- Bobot Kompetensi Input -->
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="bobot_kompetensi">
                                            <i class="bi bi-person-badge me-1"></i>Bobot Kompetensi (%)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="bobot_kompetensi" 
                                               name="bobot_kompetensi" 
                                               required 
                                               min="0"
                                               max="100"
                                               step="0.01"
                                               placeholder="Contoh: 10">
                                        <div class="invalid-feedback">
                                            Bobot Kompetensi harus diisi antara 0-100
                                        </div>
                                    </div>
                                </div>

                                <!-- Bobot Core Values Input -->
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label class="form-label fw-bold" for="bobot_core_values">
                                            <i class="bi bi-star me-1"></i>Bobot Core Values (%)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" 
                                               class="form-control form-control-lg shadow-none border-2" 
                                               id="bobot_core_values" 
                                               name="bobot_core_values" 
                                               required 
                                               min="0"
                                               max="100"
                                               step="0.01"
                                               placeholder="Contoh: 10">
                                        <div class="invalid-feedback">
                                            Bobot Core Values harus diisi antara 0-100
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Bobot Display -->
                                <div class="col-12">
                                    <div class="alert alert-info d-flex align-items-center" role="alert">
                                        <i class="bi bi-info-circle-fill me-2"></i>
                                        <div>
                                            Total Bobot: <span id="totalBobot">0</span>% 
                                            <span id="totalStatus" class="ms-2">(Total harus 100%)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-5">
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <button type="button" id="resetButton" class="btn btn-warning me-2">
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
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('settingBobotForm');
    const totalBobotSpan = document.getElementById('totalBobot');
    const totalStatusSpan = document.getElementById('totalStatus');
    const resetButton = document.getElementById('resetButton');
    const token = localStorage.getItem('token');

    // Function to calculate and update total
    function updateTotal() {
        const kpi = parseFloat(document.getElementById('bobot_kpi').value) || 0;
        const kompetensi = parseFloat(document.getElementById('bobot_kompetensi').value) || 0;
        const coreValues = parseFloat(document.getElementById('bobot_core_values').value) || 0;
        
        const total = kpi + kompetensi + coreValues;
        totalBobotSpan.textContent = total.toFixed(2);
        
        if (total === 100) {
            totalStatusSpan.className = 'ms-2 text-success';
            totalStatusSpan.textContent = '(Valid)';
        } else {
            totalStatusSpan.className = 'ms-2 text-danger';
            totalStatusSpan.textContent = '(Total harus 100%)';
        }
    }

    // Add input event listeners
    ['bobot_kpi', 'bobot_kompetensi', 'bobot_core_values'].forEach(id => {
        document.getElementById(id).addEventListener('input', updateTotal);
    });

    // Fetch current settings
    async function fetchCurrentSettings() {
        try {
            const response = await fetch(`${API_BASE_URL}/setting-bobot`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Failed to fetch settings');

            const data = await response.json();
            if (data.data) {
                document.getElementById('bobot_kpi').value = data.data.bobot_kpi;
                document.getElementById('bobot_kompetensi').value = data.data.bobot_kompetensi;
                document.getElementById('bobot_core_values').value = data.data.bobot_core_values;
                updateTotal();
            }
        } catch (error) {
            console.error('Error fetching settings:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data pengaturan bobot'
            });
        }
    }

    // Handle form submission
form.addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(form);
    const total = parseFloat(totalBobotSpan.textContent);

    if (total !== 100) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Total bobot harus 100%'
        });
        return;
    }

    // Add confirmation dialog
    const confirmResult = await Swal.fire({
        title: 'Konfirmasi Perubahan',
        text: 'Apakah Anda yakin ingin melakukan perubahan pembobotan?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan',
        cancelButtonText: 'Batal'
    });

    // Only proceed if user confirms
    if (confirmResult.isConfirmed) {
        try {
            const response = await fetch(`${API_BASE_URL}/setting-bobot`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    bobot_kpi: parseFloat(formData.get('bobot_kpi')),
                    bobot_kompetensi: parseFloat(formData.get('bobot_kompetensi')),
                    bobot_core_values: parseFloat(formData.get('bobot_core_values'))
                })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Terjadi kesalahan');
            }

            const result = await Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Pengaturan bobot berhasil disimpan'
            });

            // Redirect to penilaian_kinerja page after successful save
            if (result.isConfirmed) {
                window.location.href = '/penilaian_kinerja';
            }

        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
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
            fetchCurrentSettings();
        }
    });

    // Initial fetch
    fetchCurrentSettings();
});
</script>
@endpush