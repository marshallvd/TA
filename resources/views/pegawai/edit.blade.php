@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Edit Pegawai
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
                        <h4 class="card-title">Edit Informasi Pegawai</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <form id="pegawaiForm">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" id="pegawaiId" name="id_pegawai">
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
                                    <select class="form-control" name="id_jabatan" id="jabatanSelect" required>
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
    const pegawaiId = window.location.pathname.split('/').pop();
    const divisiSelect = document.getElementById('divisiSelect');
    const jabatanSelect = document.getElementById('jabatanSelect');
    const pegawaiForm = document.getElementById('pegawaiForm');
    const resetButton = document.getElementById('resetButton');
    
    // Menyimpan data pegawai original
    let originalData = null;

    // Fungsi untuk mengambil data pegawai yang akan diedit
    async function fetchPegawaiData() {
        try {
            const response = await fetch(`http://127.0.0.1:8000/api/pegawai/${pegawaiId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.message || `HTTP error! status: ${response.status}`);
            }
            
            if (!data || !data.data) {
                throw new Error('Invalid response structure: missing data');
            }

            // Menyimpan data original
            originalData = data.data;

            await fetchDivisi(data.data.id_divisi);
            
            if (data.data.id_divisi) {
                await fetchJabatan(data.data.id_divisi, data.data.id_jabatan);
            }
            
            populateForm(data.data);
            
        } catch (error) {
            console.error('Error fetching pegawai data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: `Failed to load employee data: ${error.message}`,
                confirmButtonText: 'OK'
            });
        }
    }

    function populateForm(data) {
        const setValue = (selector, value) => {
            const element = document.querySelector(selector);
            if (element) {
                element.value = value || '';
            }
        };

        setValue('#pegawaiId', data.id_pegawai);
        setValue('input[name="nama_lengkap"]', data.nama_lengkap);
        setValue('input[name="nik"]', data.nik);
        setValue('input[name="tanggal_lahir"]', data.tanggal_lahir);
        setValue('select[name="jenis_kelamin"]', data.jenis_kelamin);
        setValue('textarea[name="alamat"]', data.alamat);
        setValue('input[name="telepon"]', data.telepon);
        setValue('input[name="email"]', data.email);
        setValue('input[name="tanggal_masuk"]', data.tanggal_masuk);
        setValue('select[name="agama"]', data.agama);
        setValue('select[name="pendidikan_terakhir"]', data.pendidikan_terakhir);
        setValue('select[name="status_kepegawaian"]', data.status_kepegawaian);
    }

    async function fetchDivisi(selectedDivisiId) {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/divisi', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            
            if (!response.ok) throw new Error('Failed to fetch divisi');
            
            const data = await response.json();
            
            divisiSelect.innerHTML = '<option value="">Pilih Divisi</option>';
            data.forEach(divisi => {
                const option = document.createElement('option');
                option.value = divisi.id_divisi;
                option.textContent = divisi.nama_divisi;
                if (divisi.id_divisi == selectedDivisiId) {
                    option.selected = true;
                }
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

    async function fetchJabatan(divisiId, selectedJabatanId) {
        try {
            const response = await fetch('http://127.0.0.1:8000/api/jabatan', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            
            if (!response.ok) throw new Error('Failed to fetch jabatan');
            
            const data = await response.json();
            
            const filteredJabatan = data.filter(jabatan => jabatan.id_divisi == divisiId);
            
            jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
            filteredJabatan.forEach(jabatan => {
                const option = document.createElement('option');
                option.value = jabatan.id_jabatan;
                option.textContent = jabatan.nama_jabatan;
                if (jabatan.id_jabatan == selectedJabatanId) {
                    option.selected = true;
                }
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

    // Event listener untuk reset button
    resetButton.addEventListener('click', function() {
        if (originalData) {
            populateForm(originalData);
            // Reset divisi dan jabatan
            fetchDivisi(originalData.id_divisi).then(() => {
                if (originalData.id_divisi) {
                    fetchJabatan(originalData.id_divisi, originalData.id_jabatan);
                }
            });
        }
    });

    divisiSelect.addEventListener('change', function() {
        const divisiId = this.value;
        if (divisiId) {
            fetchJabatan(divisiId, null);
        } else {
            jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
        }
    });

    pegawaiForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        try {
            const formData = new FormData(this);
            
            const response = await fetch(`http://127.0.0.1:8000/api/pegawai/${pegawaiId}`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            if (!response.ok) throw new Error('Failed to update pegawai');
            
            const result = await response.json();
            
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data pegawai berhasil diperbarui',
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
                text: 'Gagal mengupdate data pegawai',
                confirmButtonText: 'OK'
            });
        }
    });

    fetchPegawaiData();
});
</script>
@endsection