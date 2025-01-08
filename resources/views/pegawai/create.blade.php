@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Tambah Pegawai
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Manajemen Data Pegawai</h2></b>
                    <p class="card-text text-muted">Human Resource Management System SEB</p>
                </div>
                <div>
                    <i class="bi bi-person-lines-fill text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Informasi Pegawai Baru</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="pegawaiForm">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Nama Lengkap:</label>
                                    <input type="text" class="form-control" name="nama_lengkap" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">NIK:</label>
                                    <input type="text" class="form-control" name="nik" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Tanggal Lahir:</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Jenis Kelamin:</label>
                                    <select class="form-control" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label">Alamat:</label>
                                    <textarea class="form-control" name="alamat" rows="3" required></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Telepon:</label>
                                    <input type="tel" class="form-control" name="telepon" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Divisi:</label>
                                    <select class="form-control" name="id_divisi" id="divisiSelect" required>
                                        <option value="">Pilih Divisi</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Jabatan:</label>
                                    <select class="form-control" name="id_jabatan" id="jabatanSelect" required disabled>
                                        <option value="">Pilih Jabatan</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Tanggal Masuk:</label>
                                    <input type="date" class="form-control" name="tanggal_masuk" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Agama:</label>
                                    <select class="form-control" name="agama" required>
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Pendidikan Terakhir:</label>
                                    <select class="form-control" name="pendidikan_terakhir" required>
                                        <option value="">Pilih Pendidikan</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Status Kepegawaian:</label>
                                    <select class="form-control" name="status_kepegawaian" required>
                                        <option value="">Pilih Status</option>
                                        <option value="aktif">Aktif</option>
                                        <option value="tidak aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12 text-end">
                                    <a href="{{ route('pegawai.index') }}" class="btn btn-danger me-2">
                                        <i class="bi bi-arrow-left me-2"></i>Kembali
                                    </a>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const divisiSelect = document.getElementById('divisiSelect');
    const jabatanSelect = document.getElementById('jabatanSelect');
    const pegawaiForm = document.getElementById('pegawaiForm');
    const resetButton = document.getElementById('resetButton');

    // Fungsi untuk mengambil data divisi
    async function fetchDivisi() {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/divisi', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            
            if (!response.ok) throw new Error('Failed to fetch divisi');
            
            const data = await response.json();
            
            // Populate divisi select
            divisiSelect.innerHTML = '<option value="">Pilih Divisi</option>';
            data.forEach(divisi => {
                const option = document.createElement('option');
                option.value = divisi.id_divisi;
                option.textContent = divisi.nama_divisi;
                divisiSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data divisi',
                confirmButtonText: 'OK'
            });
        }
    }

    // Fungsi untuk mengambil jabatan berdasarkan divisi
    async function fetchJabatan(divisiId) {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/jabatan', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            
            if (!response.ok) throw new Error('Failed to fetch jabatan');
            
            const data = await response.json();
            
            // Enable jabatan select
            jabatanSelect.disabled = false;
            
            // Filter jabatan berdasarkan id_divisi
            const filteredJabatan = data.filter(jabatan => jabatan.id_divisi == divisiId);
            
            // Populate jabatan select
            jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
            filteredJabatan.forEach(jabatan => {
                const option = document.createElement('option');
                option.value = jabatan.id_jabatan;
                option.textContent = jabatan.nama_jabatan;
                jabatanSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data jabatan',
                confirmButtonText: 'OK'
            });
        }
    }

    // Event listener untuk perubahan divisi
    divisiSelect.addEventListener('change', function() {
        const divisiId = this.value;
        if (divisiId) {
            fetchJabatan(divisiId);
        } else {
            jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
            jabatanSelect.disabled = true;
        }
    });

    // Event listener untuk reset button
    resetButton.addEventListener('click', function() {
        pegawaiForm.reset();
        jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
        jabatanSelect.disabled = true;
    });

    // Handle form submission
    pegawaiForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        try {
            const formData = new FormData(this);
            
            const response = await fetch('http://127.0.0.1:8000/api/pegawai', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            const result = await response.json();
            if (!response.ok) {
                console.error('Error Response:', result);
                throw new Error(result.message || 'Failed to save pegawai');
            }
            
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data pegawai berhasil disimpan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '/pegawai';
            });
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error.message || 'Gagal menyimpan data pegawai'
            });
        }
    });

    // Load initial data
    fetchDivisi();
});
</script>
@endsection