@extends('layouts.master')
@section('title')
Profil Pegawai
@endsection
@section('content')
<div class="container-fluid">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Profil Pegawai</h2></b>
                    <p class="card-text text-muted">Informasi Detail Profil Anda</p>
                </div>
                <div>
                    <i class="bi bi-person-badge text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <div class="position-relative d-inline-block">
                                <img src="" 
                                     alt="User  Profile" 
                                     id="profileImage" 
                                     class="img-fluid rounded-circle shadow-sm" 
                                     style="width: 200px; height: 200px; object-fit: cover;">
                                <div class="badge bg-primary position-absolute bottom-0 end-0 p-2 rounded-circle">
                                    <i class="bi bi-camera-fill text-white"></i>
                                </div>
                            </div>
                            <h5 id="profileName" class="mt-3 mb-1 fw-bold">-</h5>
                            <small id="profileRole" class="text-muted">-</small>
                        </div>
                        <div class="col-md-8">
                            <div class="profile-details">
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-briefcase me-2"></i>Jabatan
                                    </div>
                                    <div class="col-8" id="profileJabatan">-</div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-building me-2"></i>Divisi
                                    </div>
                                    <div class="col-8" id="profileDivisi">-</div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-card-text me-2"></i>NIK
                                    </div>
                                    <div class="col-8" id="profileNIK">-</div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-gender-ambiguous me-2"></i>Jenis Kelamin
                                    </div>
                                    <div class="col-8" id="profileJenisKelamin">-</div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-envelope me-2"></i>Email
                                    </div>
                                    <div class="col-8" id="profileEmail">-</div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-geo-alt me-2"></i>Alamat
                                    </div>
                                    <div class="col-8" id="profileAlamat">-</div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-telephone me-2"></i>Telepon
                                    </div>
                                    <div class="col-8" id="profileTelepon">-</div>
                                </div>

                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-heart me-2"></i>Agama
                                    </div>
                                    <div class="col-8" id="profileAgama">-</div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-mortarboard me-2"></i>Pendidikan Terakhir
                                    </div>
                                    <div class="col-8" id="profilePendidikan">-</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <button class="btn btn-primary me-2" id="editProfileBtn">
                                <i class="bi bi-pencil-square me-2"></i>Edit Data
                            </button>
                            <button class="btn btn-outline-secondary" id="changePasswordBtn">
                                <i class="bi bi-key me-2"></i>Edit Akun
                            </button>
                        </div>
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
    const token = localStorage.getItem('token');
    
    // Elemen-elemen yang akan diupdate
    const profileImage = document.getElementById('profileImage');
    const profileName = document.getElementById('profileName');
    const profileRole = document.getElementById('profileRole');
    const profileJabatan = document.getElementById('profileJabatan');
    const profileDivisi = document.getElementById('profileDivisi');
    const profileNIK = document.getElementById('profileNIK');
    const profileJenisKelamin = document.getElementById('profileJenisKelamin');
    const profileEmail = document.getElementById('profileEmail');
    const profileAlamat = document.getElementById('profileAlamat');
    const profileTelepon = document.getElementById('profileTelepon');
    const profileAgama = document.getElementById('profileAgama');
    const profilePendidikan = document.getElementById('profilePendidikan');

    if (!token) {
        window.location.href = '/login';
        return;
    }

    // Fungsi untuk memilih avatar secara acak
    function getRandomAvatar() {
        const randomNum = Math.floor(Math.random() * 20) + 1;
        return `/assets/images/avatars/avatar (${randomNum}).png`;
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

            // Fetch jabatan data
            const jabatanResponse = await fetch(`http://127.0.0.1:8000/api/jabatan/${pegawai.id_jabatan}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            const jabatanData = await jabatanResponse.json();

            // Fetch divisi data
            const divisiResponse = await fetch(`http://127.0.0.1:8000/api/divisi/${pegawai.id_divisi}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            const divisiData = await divisiResponse.json();

            // Update profile data
            profileImage.src = getRandomAvatar();
            profileName.textContent = pegawai.nama_lengkap;
            profileRole.textContent = jabatanData.nama_jabatan;
            profileJabatan.textContent = jabatanData.nama_jabatan;
            profileDivisi.textContent = divisiData.nama_divisi;
            profileNIK.textContent = pegawai.nik;
            profileJenisKelamin.textContent = pegawai.jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
            profileEmail.textContent = pegawai.email;
            profileAlamat.textContent = pegawai.alamat;
            profileTelepon.textContent = pegawai.telepon;
            profileAgama.textContent = pegawai.agama;
            profilePendidikan.textContent = pegawai.pendidikan_terakhir;

        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Gagal Memuat Data',
                text: error.message
            });
        }
    }

    fetchProfileData();

    // Event listeners untuk tombol
    document.getElementById('editProfileBtn').addEventListener('click', function() {
        window.location.href = '/profile/pegawai/edit';
    });

    document.getElementById('changePasswordBtn').addEventListener('click', function() {
        window.location.href = '/profile/user/edit'; // Mengarahkan ke halaman edit user
    });
});
</script>
@endpush

@push('styles')
<style>
    .profile-details .row {
        border-bottom: 1px solid #f1f1f1;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }
    .profile-details .row:last-child {
        border-bottom: none;
    }
    .profile-details .text-muted i {
        color: #6c757d;
        margin-right: 10px;
    }
</style>
@endpush