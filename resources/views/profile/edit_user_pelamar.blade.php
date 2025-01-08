@extends('layouts.pelamar_master')

@section('title')
    Ganti Password
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <h2 class="card-title mb-1"><b>Ganti Password</b></h2>
                    <p class="card-text text-muted">Perbarui Password Anda</p>
                </div>
                <div>
                    <i class="bi bi-key text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="passwordForm">
                        <input type="hidden" id="pelamarId" name="id_pelamar">
                        <div class="mb-3">
                            <label class="form-label">Password Baru:</label>
                            <input type="password" class="form-control" name="password" required minlength="8">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru:</label>
                            <input type="password" class="form-control" name="password_confirmation" required minlength="8">
                        </div>
                        <br><br>
                        <div class="row mt-3 position-absolute bottom-0 end-0 m-4">
                            <div class="col-12">
                                <a href="/profile/pelamar" class="btn btn-danger me-2">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="reset" class="btn btn-warning me-2">
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('pelamar_token');
    const passwordForm = document.getElementById('passwordForm');

    if (!token) {
        window.location.href = '/landing/login';
        return;
    }

    async function fetchPelamarData() {
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

            const data = await response.json();
            document.getElementById('pelamarId').value = data.data.id_pelamar;

        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Gagal Memuat Data',
                text: error.message
            });
        }
    }

    passwordForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(passwordForm);

        if (formData.get('password') !== formData.get('password_confirmation')) {
            Swal.fire({
                icon: 'error',
                title: 'Password Tidak Cocok',
                text: 'Password dan konfirmasi password harus sama'
            });
            return;
        }

        try {
            const response = await fetch(`http://localhost:8000/api/pelamar/profile/${document.getElementById('pelamarId').value}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    password: formData.get('password'),
                    password_confirmation: formData.get('password_confirmation')
                })
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Gagal memperbarui password');
            }

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Password berhasil diperbarui',
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

    fetchPelamarData();
});
</script>
@endpush