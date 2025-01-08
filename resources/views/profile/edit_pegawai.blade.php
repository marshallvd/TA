@extends('layouts.master')

@section('content')
<div class="container-fluid">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Edit Profil</h2></b>
                    <p class="card-text text-muted">Perbarui Informasi Pribadi Anda</p>
                </div>
                <div>
                    <i class="bi bi-pencil-square text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form id="editProfileForm">
                        <input type="hidden" id="pegawaiId" name="id_pegawai">
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-person me-2 text-primary"></i>Nama Lengkap
                                </label>
                                <input type="text" class="form-control" name="nama_lengkap" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-card-text me-2 text-primary"></i>NIK
                                </label>
                                <input type="text" class="form-control" name="nik" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-gender-ambiguous me-2 text-primary"></i>Jenis Kelamin
                                </label>
                                <select class="form-control" name="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-envelope me-2 text-primary"></i>Email
                                </label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label">
                                    <i class="bi bi-geo-alt me-2 text-primary"></i>Alamat
                                </label>
                                <textarea class="form-control" name="alamat" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-telephone me-2 text-primary"></i>Telepon
                                </label>
                                <input type="tel" class="form-control" name="telepon" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-heart me-2 text-primary"></i>Agama
                                </label>
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
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-mortarboard me-2 text-primary"></i>Pendidikan Terakhir
                                </label>
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
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <a href="/profile/pegawai" class="btn btn-danger me-2">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save me-2"></i>Simpan Perubahan
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
    const token = localStorage.getItem('token');
    const editProfileForm = document.getElementById('editProfileForm');

    if (!token) {
        window.location.href = '/login';
        return;
    }

    async function fetchProfileData() {
        try {
            // Fetch user data
            const userResponse = await fetch('http://127.0.0.1:8000/api/auth/me', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!userResponse.ok) {
                throw new Error('Gagal mengambil data pengguna');
            }

            const userData = await userResponse.json();
            const pegawai = userData.pegawai;

            // Populate form
            document.getElementById('pegawaiId').value = pegawai.id_pegawai;
            document.querySelector('input[name="nama_lengkap"]').value = pegawai.nama_lengkap;
            document.querySelector('input[name="nik"]').value = pegawai.nik;
            document.querySelector('select[name="jenis_kelamin"]').value = pegawai.jenis_kelamin;
            document.querySelector('input[name="email"]').value = pegawai.email;
            document.querySelector('textarea[name="alamat"]').value = pegawai.alamat;
            document.querySelector('input[name="telepon"]').value = pegawai.telepon;
            document.querySelector('select[name="agama"]').value = pegawai.agama;
            document.querySelector('select[name="pendidikan_terakhir"]').value = pegawai.pendidikan_terakhir;

        } catch (error) {
            console.error('Error fetching profile data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Gagal Memuat Data',
                text: error.message
            });
        }
    }

    editProfileForm.addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(editProfileForm);
    
    // Convert FormData to JSON
    const formDataJson = Object.fromEntries(formData.entries());
    
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/pegawai/${formDataJson.id_pegawai}`, {
            method: 'PUT', // Pastikan ini PUT
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
                'Content-Type': 'application/json' // Tambahkan ini
            },
            body: JSON.stringify(formDataJson) // Ubah ke JSON
        });

        // Log response untuk debugging
        const responseData = await response.json();
        console.log('Response:', response.status, responseData);

        if (!response.ok) {
            throw new Error(responseData.message || 'Gagal memperbarui data pegawai');
        }

        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Data pegawai berhasil diperbarui',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = '/profile/pegawai';
        });
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: error.message
        });
    }
});

    fetchProfileData();
});
</script>
@endpush