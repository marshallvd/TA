@extends('layouts.master')


@section('title')
    Edit User
@endsection

@section('content')
<div class="container-fluid content-inner mt-n5 py-0">
    {{-- Header Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <b><h2 class="card-title mb-1">Edit User</h2></b>
                    <p class="card-text text-muted">Perbarui Informasi User</p>
                </div>
                <div>
                    <i class="bi bi-pencil-square text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="userForm">
                        <input type="hidden" id="userId" name="id_user">
                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru (Kosongkan jika tidak ingin mengubah):</label>
                            <input type="password" class="form-control" name="password" minlength="8">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru:</label>
                            <input type="password" class="form-control" name="confirm_password" minlength="8">
                        </div>
                        <br>
                        <div class="row mt-3 position-absolute bottom-0 end-0 m-4">
                            <div class="col-12">
                                <a href="/profile/pegawai" class="btn btn-danger me-2">
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
    const token = localStorage.getItem('token');
    const userForm = document.getElementById('userForm');

    if (!token) {
        window.location.href = '/login';
        return;
    }

    async function fetchUserData() {
        try {
            // Fetch user data from auth/me
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
            const userId = userData.user.id_user; // Ambil ID user dari response

            // Fetch user details using the user ID
            const response = await fetch(`http://127.0.0.1:8000/api/users/${userId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('User  not found');
            }

            const data = await response.json();
            document.getElementById('userId').value = data.id_user;
            document.querySelector('input[name="email"]').value = data.email;

        } catch (error) {
            console.error('Error fetching user data:', error);
            Swal.fire({
                icon: 'error',
                title: 'Gagal Memuat Data',
                text: error.message
            });
        }
    }

    userForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(userForm);

        try {
            const response = await fetch(`http://127.0.0.1:8000/api/users/${document.getElementById('userId').value}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(Object.fromEntries(formData.entries()))
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Gagal memperbarui data user');
            }

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data user berhasil diperbarui',
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

    fetchUserData();
});
</script>
@endpush