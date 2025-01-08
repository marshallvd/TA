@extends('layouts.pelamar_master')
@section('title')
Profil Pelamar
@endsection
@section('content')

<div class="container-fluid">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <h2 class="card-title mb-1"><b>Profil Pelamar</b></h2>
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
                                     alt="Profile Picture" 
                                     id="profileImage" 
                                     class="img-fluid rounded-circle shadow-sm" 
                                     style="width: 200px; height: 200px; object-fit: cover;">
                            </div>
                            <h5 id="profileName" class="mt-3 mb-1 fw-bold">-</h5>
                            <small class="text-muted">Pelamar</small>
                        </div>
                        <div class="col-md-8">
                            <div class="profile-details">
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-envelope me-2"></i>Email
                                    </div>
                                    <div class="col-8" id="profileEmail">-</div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-telephone me-2"></i>No. HP
                                    </div>
                                    <div class="col-8" id="profileNoHP">-</div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-geo-alt me-2"></i>Alamat
                                    </div>
                                    <div class="col-8" id="profileAlamat">-</div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-mortarboard me-2"></i>Pendidikan
                                    </div>
                                    <div class="col-8" id="profilePendidikan">-</div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-briefcase me-2"></i>Pengalaman
                                    </div>
                                    <div class="col-8" id="profilePengalaman">-</div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-4 text-muted">
                                        <i class="bi bi-file-earmark-text me-2"></i>CV
                                    </div>
                                    <div class="col-8" id="profileCV">-</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <button class="btn btn-primary me-2" id="editProfileBtn">
                                <i class="bi bi-pencil-square me-2"></i>Edit Profil
                            </button>
                            <button class="btn btn-outline-secondary" id="changePasswordBtn">
                                <i class="bi bi-key me-2"></i>Ganti Password
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
    const token = localStorage.getItem('pelamar_token');
    
    const profileImage = document.getElementById('profileImage');
    const profileName = document.getElementById('profileName');
    const profileEmail = document.getElementById('profileEmail');
    const profileNoHP = document.getElementById('profileNoHP');
    const profileAlamat = document.getElementById('profileAlamat');
    const profilePendidikan = document.getElementById('profilePendidikan');
    const profilePengalaman = document.getElementById('profilePengalaman');
    const profileCV = document.getElementById('profileCV');

    if (!token) {
        window.location.href = '/login';
        return;
    }

    function getRandomAvatar() {
        const randomNum = Math.floor(Math.random() * 20) + 1;
        return `/assets/images/avatars/avatar (${randomNum}).png`;
    }

    async function fetchProfileData() {
        try {
            const response = await fetch('http://localhost:8000/api/pelamar/auth/me', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data pelamar');
            }

            const result = await response.json();
            const data = result.data;

            profileImage.src = getRandomAvatar();
            profileName.textContent = data.nama;
            profileEmail.textContent = data.email;
            profileNoHP.textContent = data.no_hp;
            profileAlamat.textContent = data.alamat;
            profilePendidikan.textContent = data.pendidikan_terakhir;
            profilePengalaman.textContent = data.pengalaman_kerja;
            
            if (data.cv_path) {
                const cvLink = document.createElement('a');
                cvLink.href = data.cv_path;
                cvLink.textContent = 'Lihat CV';
                cvLink.target = '_blank';
                cvLink.className = 'text-primary';
                profileCV.innerHTML = '';
                profileCV.appendChild(cvLink);
            } else {
                profileCV.textContent = 'CV belum diunggah';
            }

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

    document.getElementById('editProfileBtn').addEventListener('click', function() {
        window.location.href = '/profile/pelamar/edit';
    });

    document.getElementById('changePasswordBtn').addEventListener('click', function() {
        window.location.href = '/profile/pelamar/password';
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