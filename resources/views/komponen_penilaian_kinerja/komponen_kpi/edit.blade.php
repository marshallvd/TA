@extends('layouts.master')

@section('title')
    Edit Komponen KPI
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Komponen KPI</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="kpiForm">
                            <div class="row">
                                <input type="hidden" id="kpiId" name="id_komponen_kpi" value="{{ request('id') }}">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Divisi:</label>
                                    <select class="form-control" name="id_divisi" id="divisiSelect" required>
                                        <option value="">Pilih Divisi</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Bobot (%):</label>
                                    <input type="number" class="form-control" name="bobot" id="bobotInput" required min="0" max="100">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label">Nama Indikator:</label>
                                    <input type="text" class="form-control" name="nama_indikator" id="indikatorInput" required maxlength="100">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Target:</label>
                                    <input type="text" class="form-control" name="target" id="targetInput" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Ukuran:</label>
                                    <input type="text" class="form-control" name="ukuran" id="ukuranInput" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update Komponen KPI</button>
                            <a href="{{ route('komponen-kpi.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const divisiSelect = document.getElementById('divisiSelect');
    const kpiForm = document.getElementById('kpiForm');
    const kpiId = document.getElementById('kpiId').value;
    const bobotInput = document.getElementById('bobotInput');
    const indikatorInput = document.getElementById('indikatorInput');
    const targetInput = document.getElementById('targetInput');
    const ukuranInput = document.getElementById('ukuranInput');

    // Check token
    if (!token) {
        Swal.fire({
            icon: 'error',
            title: 'Authentication Error',
            text: 'Token tidak ditemukan. Silakan login kembali.'
        }).then(() => {
            window.location.href = '/login';
        });
        return;
    }

    // Fetch divisi options
    fetch('http://127.0.0.1:8000/api/divisi', {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        data.forEach(divisi => {
            const option = document.createElement('option');
            option.value = divisi.id_divisi;
            option.textContent = divisi.nama_divisi;
            divisiSelect.appendChild(option);
        });
        
        // After populating divisi, fetch KPI data
        fetchKpiData();
    })
    .catch(error => {
        console.error('Error fetching divisi:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Gagal mengambil data divisi: ' + error.message
        });
    });

    // Fetch KPI data
    function fetchKpiData() {
        fetch(`http://127.0.0.1:8000/api/komponen-kpi/${kpiId}`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Populate form with existing data
            divisiSelect.value = data.id_divisi;
            bobotInput.value = data.bobot;
            indikatorInput.value = data.nama_indikator;
            targetInput.value = data.target || '';
            ukuranInput.value = data.ukuran || '';
        })
        .catch(error => {
            console.error('Error fetching KPI data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data KPI: ' + error.message
            }).then(() => {
                window.location.href = '{{ route("komponen-kpi.index") }}';
            });
        });
    }

    // Form submission
    kpiForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());

        // Validate bobot
        const bobot = parseFloat(data.bobot);
        if (bobot < 0 || bobot > 100) {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Error',
                text: 'Bobot harus berada di antara 0 dan 100'
            });
            return;
        }

        // Show loading
        Swal.fire({
            title: 'Mohon Tunggu',
            text: 'Sedang memperbarui data...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(`http://127.0.0.1:8000/api/komponen-kpi/${kpiId}`, {
            method: 'PUT',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(result => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data KPI berhasil diperbarui',
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route("komponen-kpi.index") }}';
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan saat memperbarui data: ' + error.message,
                showConfirmButton: true
            });
        });
    });

    // Add global fetch error handler
    window.addEventListener('unhandledrejection', function(event) {
        if (event.reason && event.reason.name === 'TypeError') {
            console.error('Network error occurred:', event.reason);
            Swal.fire({
                icon: 'error',
                title: 'Network Error',
                text: 'Terjadi kesalahan jaringan. Silakan coba lagi.'
            });
        }
    });
});
</script>
@endpush
@endsection