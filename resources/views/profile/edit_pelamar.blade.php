@extends('layouts.pelamar_master')

@section('content')
<div class="container-fluid">
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
                        <input type="hidden" id="pelamarId" name="id_pelamar">
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-person me-2 text-primary"></i>Nama Lengkap
                                </label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-envelope me-2 text-primary"></i>Email
                                </label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-telephone me-2 text-primary"></i>No. HP
                                </label>
                                <input type="tel" class="form-control" name="no_hp" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="bi bi-mortarboard me-2 text-primary"></i>Pendidikan Terakhir
                                </label>
                                <select class="form-control" name="pendidikan_terakhir" required>
                                    <option value="">Pilih Pendidikan</option>
                                    <option value="SMA">SMA</option>
                                    <option value="D3">D3</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
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
                            <div class="col-12">
                                <label class="form-label">
                                    <i class="bi bi-briefcase me-2 text-primary"></i>Pengalaman Kerja
                                </label>
                                <textarea class="form-control" name="pengalaman_kerja" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label">
                                    <i class="bi bi-link me-2 text-primary"></i>Link CV
                                </label>
                                <input type="text" class="form-control" name="cv_path" placeholder="Masukkan link CV">
                                <div id="currentCV" class="mt-2"></div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <a href="/profile/pelamar" class="btn btn-danger me-2">
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
    const token = localStorage.getItem('pelamar_token');
    const editProfileForm = document.getElementById('editProfileForm');
    const currentCV = document.getElementById('currentCV');

    if (!token) {
        window.location.href = '/landing/login';
        return;
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
                if (response.status === 401) {
                    localStorage.removeItem('pelamar_token');
                    window.location.href = '/landing/login';
                    return;
                }
                throw new Error('Gagal mengambil data pelamar');
            }

            const result = await response.json();
            const data = result.data;

            // Populate form fields
            document.getElementById('pelamarId').value = data.id_pelamar;
            document.querySelector('input[name="nama"]').value = data.nama;
            document.querySelector('input[name="email"]').value = data.email;
            document.querySelector('input[name="no_hp"]').value = data.no_hp;
            document.querySelector('textarea[name="alamat"]').value = data.alamat;
            document.querySelector('select[name="pendidikan_terakhir"]').value = data.pendidikan_terakhir;
            document.querySelector('textarea[name="pengalaman_kerja"]').value = data.pengalaman_kerja;
            document.querySelector('input[name="cv_path"]').value = data.cv_path || '';

            if (data.cv_path) {
                currentCV.innerHTML = `<small class="text-muted">CV saat ini: <a href="${data.cv_path}" target="_blank">${data.cv_path}</a></small>`;
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

    editProfileForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(editProfileForm);
        const jsonData = Object.fromEntries(formData.entries());
        
        try {
            const response = await fetch(`http://localhost:8000/api/pelamar/profile/${jsonData.id_pelamar}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(jsonData)
            });

            if (!response.ok) {
                if (response.status === 401) {
                    localStorage.removeItem('pelamar_token');
                    window.location.href = '/landing/login';
                    return;
                }
                const errorData = await response.json();
                throw new Error(errorData.message || 'Gagal memperbarui data pelamar');
            }

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data pelamar berhasil diperbarui',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.href = '/profile/pelamar';
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