@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Tambah Pegawai
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row justify-content-center">
        {{-- <div class="col-xl-3 col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Upload Foto</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form id="photoForm">
                        <div class="form-group">
                            <div class="profile-img-edit position-relative">
                                <img src="{{ asset('assets/images/avatars/01.png') }}" alt="profile-pic" id="preview-photo" class="profile-pic rounded avatar-100">
                                <div class="upload-icone bg-primary">
                                    <svg class="upload-button icon-14" width="14" viewBox="0 0 24 24">
                                        <path fill="#ffffff" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z"/>
                                    </svg>
                                    <input class="file-upload" type="file" accept="image/*" id="photo" name="foto">
                                </div>
                            </div>
                            <div class="img-extension mt-3">
                                <div class="d-inline-block align-items-center">
                                    <span>Hanya</span>
                                    <a href="javascript:void();">.jpg</a>
                                    <a href="javascript:void();">.png</a>
                                    <a href="javascript:void();">.jpeg</a>
                                    <span>yang diizinkan</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
        <div class="col-xl-9 col-lg-8">
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
                            <button type="submit" class="btn btn-primary mt-3">Simpan Data Pegawai</button>
                            <a type="button" class="btn btn-secondary mt-3" href="{{ route('pegawai.index') }}">Tutup</a>

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
    const photoInput = document.getElementById('photo');
    const previewPhoto = document.getElementById('preview-photo');
    const pegawaiForm = document.getElementById('pegawaiForm');

    // Preview foto yang dipilih
    photoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewPhoto.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

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
            alert('Gagal mengambil data divisi');
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
            alert('Gagal mengambil data jabatan');
        }
    }

    // Event listener untuk perubahan divisi
    divisiSelect.addEventListener('change', function() {
        const divisiId = this.value;
        console.log('Selected divisi:', divisiId);
        if (divisiId) {
            fetchJabatan(divisiId);
        } else {
            jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
            jabatanSelect.disabled = true;
        }
    });

    // Handle form submission
    pegawaiForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        try {
            const formData = new FormData(this);
            formData.append('foto', photoInput.files[0]);
            
            const response = await fetch('http://127.0.0.1:8000/api/pegawai', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            if (!response.ok) throw new Error('Failed to save pegawai');
            
            const result = await response.json();
            
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data pegawai berhasil disimpan',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '/pegawai'; // Redirect ke halaman list pegawai
            });
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Gagal menyimpan data pegawai'
            });
        }
    });

    // Load initial data
    fetchDivisi();
});
</script>
@endsection