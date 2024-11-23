@extends('layouts.app')
@extends('layouts.master')

@section('title')
    Edit Pegawai
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
                                <img src="{{ asset('assets/images/avatars/avtar_1.png') }}" alt="profile-pic" id="preview-photo" class="profile-pic rounded avatar-100">
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
                            <button type="submit" class="btn btn-primary mt-3">Update Data Pegawai</button>
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
    const pegawaiId = window.location.pathname.split('/').pop();
    const divisiSelect = document.getElementById('divisiSelect');
    const jabatanSelect = document.getElementById('jabatanSelect');
    // const photoInput = document.getElementById('photo');
    // const previewPhoto = document.getElementById('preview-photo');
    const pegawaiForm = document.getElementById('pegawaiForm');

    // Preview foto yang dipilih
    // photoInput.addEventListener('change', function(e) {
    //     const file = e.target.files[0];
    //     if (file) {
    //         const reader = new FileReader();
    //         reader.onload = function(e) {
    //             previewPhoto.src = e.target.result;
    //         }
    //         reader.readAsDataURL(file);
    //     }
    // });

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

            // Fetch divisi dengan selected value
            await fetchDivisi(data.data.id_divisi);
            
            // Fetch jabatan dengan selected value jika ada divisi
            if (data.data.id_divisi) {
                await fetchJabatan(data.data.id_divisi, data.data.id_jabatan);
            }
            
            // Populate form setelah dropdown terisi
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

    // Fungsi untuk mengisi form dengan data yang ada
    function populateForm(data) {
        // Fungsi helper untuk menangani nilai null/undefined
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

        // if (data.foto) {
        //     previewPhoto.src = `http://127.0.0.1:8000/storage/${data.foto}`;
        // }
    }

    // Fungsi untuk mengambil data divisi
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
            
            // Populate divisi select
            divisiSelect.innerHTML = '<option value="">Pilih Divisi</option>';
            data.forEach(divisi => {
                const option = document.createElement('option');
                option.value = divisi.id_divisi;
                option.textContent = divisi.nama_divisi;
                // Set selected jika ini adalah divisi yang dimiliki pegawai
                if (divisi.id_divisi == selectedDivisiId) {
                    option.selected = true;
                }
                divisiSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error:', error);
            alert('Gagal mengambil data divisi');
        }
    }

    // Fungsi untuk mengambil jabatan berdasarkan divisi
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
            
            // Filter jabatan berdasarkan id_divisi
            const filteredJabatan = data.filter(jabatan => jabatan.id_divisi == divisiId);
            
            // Populate jabatan select
            jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
            filteredJabatan.forEach(jabatan => {
                const option = document.createElement('option');
                option.value = jabatan.id_jabatan;
                option.textContent = jabatan.nama_jabatan;
                // Set selected jika ini adalah jabatan yang dimiliki pegawai
                if (jabatan.id_jabatan == selectedJabatanId) {
                    option.selected = true;
                }
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
        if (divisiId) {
            // Pass null sebagai selectedJabatanId karena ini perubahan baru
            fetchJabatan(divisiId, null);
        } else {
            jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';
        }
    });

    // Handle form submission untuk update
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
                text: 'Data pegawai berhasil diupdate',
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
                text: 'Gagal mengupdate data pegawai'
            });
        }
    });

    // Load initial data
    fetchPegawaiData();
});
</script>
@endsection