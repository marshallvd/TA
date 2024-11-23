@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Edit Jatah Cuti
@endsection

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
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form id="jatahCutiForm" method="POST" action="{{ route('jatah_cuti.update', $jatahCuti->id_jatah_cuti) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="id_jatah_cuti" name="id_jatah_cuti" value="{{ $jatahCuti->id_jatah_cuti }}">
                        <input type="hidden" id="id_pegawai" name="id_pegawai" value="{{ $jatahCuti->id_pegawai }}">
                        
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="number" class="form-control" id="tahun" name="tahun" value="{{ $jatahCuti->tahun }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label for="jatah_cuti_umum" class="form-label">Jatah Cuti Umum</label>
                            <input type="number" class="form-control" id="jatah_cuti_umum" name="jatah_cuti_umum" value="{{ $jatahCuti->jatah_cuti_umum }}" required>
                            <small class="text-muted">Sisa Cuti Umum: {{ $jatahCuti->sisa_cuti_umum }}</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="jatah_cuti_menikah" class="form-label">Jatah Cuti Menikah</label>
                            <input type="number" class="form-control" id="jatah_cuti_menikah" name="jatah_cuti_menikah" value="{{ $jatahCuti->jatah_cuti_menikah }}" required>
                            <small class="text-muted">Sisa Cuti Menikah: {{ $jatahCuti->sisa_cuti_menikah }}</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="jatah_cuti_melahirkan" class="form-label">Jatah Cuti Melahirkan</label>
                            <input type="number" class="form-control" id="jatah_cuti_melahirkan" name="jatah_cuti_melahirkan" value="{{ $jatahCuti->jatah_cuti_melahirkan }}" required>
                            <small class="text-muted">Sisa Cuti Melahirkan: {{ $jatahCuti->sisa_cuti_melahirkan }}</small>
                        </div>
                        
                        <button type="submit" class="btn btn-success">Perbarui Jatah Cuti</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0 small">Panduan Perubahan Jatah Cuti</h5>
                </div>
                <div class="card-body p-2">
                    <p class="small">Silakan ubah jatah cuti sesuai kebutuhan. Pastikan informasi sudah benar.</p>
                    <ul class="small">
                        <li>Tahun tidak dapat diubah.</li>
                        <li>Perhatikan sisa cuti yang sudah digunakan.</li>
                        <li>Pastikan jumlah jatah cuti sesuai dengan kebijakan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Constants and Configurations
    const token = localStorage.getItem('token');
    const baseUrl = 'http://127.0.0.1:8000/api';
    const idPegawai = document.getElementById('id_pegawai').value;
    const idJatahCuti = document.getElementById('id_jatah_cuti').value;

    // Initial token check
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

    // Utility Functions
    function showError(message) {
        console.error('Error occurred:', message);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message
        });
    }

    function showSuccess(message) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: message,
            timer: 2000,
            showConfirmButton: false
        });
    }

    function validateForm() {
        const jatahCutiUmum = parseInt(document.getElementById('jatah_cuti_umum').value);
        const jatahCutiMenikah = parseInt(document.getElementById('jatah_cuti_menikah').value);
        const jatahCutiMelahirkan = parseInt(document.getElementById('jatah_cuti_melahirkan').value);

        if (isNaN(jatahCutiUmum) || isNaN(jatahCu tiMenikah) || isNaN(jatahCutiMelahirkan)) {
            throw new Error('Semua jatah cuti harus berupa angka');
        }

        if (jatahCutiUmum < 0 || jatahCutiMenikah < 0 || jatahCutiMelahirkan < 0) {
            throw new Error('Jatah cuti tidak boleh negatif');
        }
    }

    // API Functions
    async function fetchPegawaiDetails() {
        try {
            const pegawaiResponse = await fetch(`${baseUrl}/pegawai/${idPegawai}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!pegawaiResponse.ok) {
                throw new Error('Gagal mengambil data pegawai');
            }

            const pegawaiData = await pegawaiResponse.json();
            document.getElementById('pegawaiName').textContent = pegawaiData.data.nama_lengkap;
            document.getElementById('pegawaiNIK').textContent = pegawaiData.data.nik;

            if (pegawaiData.data.id_jabatan) {
                await fetchJabatan(pegawaiData.data.id_jabatan);
            }

            if (pegawaiData.data.id_divisi) {
                await fetchDivisi(pegawaiData.data.id_divisi);
            }
        } catch (error) {
            showError(error.message);
        }
    }

    async function fetchJabatan(idJabatan) {
        try {
            const response = await fetch(`${baseUrl}/jabatan/${idJabatan}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Gagal mengambil data jabatan');

            const data = await response.json();
            document.getElementById('pegawaiPosition').textContent = data.nama_jabatan;
        } catch (error) {
            document.getElementById('pegawaiPosition').textContent = '-';
        }
    }

    async function fetchDivisi(idDivisi) {
        try {
            const response = await fetch(`${baseUrl}/divisi/${idDivisi}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Gagal mengambil data divisi');

            const data = await response.json();
            document.getElementById('pegawaiDivision').textContent = data.nama_divisi;
        } catch (error) {
            document.getElementById('pegawaiDivision').textContent = '-';
        }
    }

    async function handleSubmit(event) {
        event.preventDefault();
        
        try {
            validateForm();
            
            const formData = {
                id_pegawai: document.getElementById('id_pegawai').value,
                tahun: document.getElementById('tahun').value,
                jatah_cuti_umum: document.getElementById('jatah_cuti_umum').value,
                jatah_cuti_menikah: document.getElementById('jatah_cuti_menikah').value,
                jatah_cuti_melahirkan: document.getElementById('jatah_cuti_melahirkan').value
            };

            const response = await fetch(`${baseUrl}/jatah-cuti/${idJatahCuti}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Gagal memperbarui jatah cuti');
            }

            showSuccess(result.message || 'Jatah cuti berhasil diperbarui');
            setTimeout(() => {
                window.location.href = '/jatah_cuti';
            }, 2000);
        } catch (error) {
            showError(error.message);
        }
    }

    // Initialize
    document.getElementById('jatahCutiForm').addEventListener('submit', handleSubmit);
    
    document.getElementById('btnBack').addEventListener('click', function() {
        window.location.href = '/jatah_cuti';
    });

    // Fetch pegawai details on load
    fetchPegawaiDetails();
});
</script>
@endpush
@endsection