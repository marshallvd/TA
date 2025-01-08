@extends('layouts.auth')

@section('title', 'Register')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="col-md-6">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                <div class="card-body">
                    <a href="{{ route('dashboard.index') }}" class="navbar-brand d-flex align-items-center mb-3">
                        <div class="logo-main">
                            <div class="logo-normal">
                                <img src="{{ asset('assets/images/logo seb.png') }}" alt="Logo HRMS SEB" class="icon-30">
                            </div>
                            <div class="logo-mini">
                                <img src="{{ asset('assets/images/logo seb.png') }}" alt="Logo HRMS SEB" class="icon-30">
                            </div>
                        </div>
                        <h4 class="logo-title ms-3">HRMS SEB</h4>
                    </a>
                    <h2 class="mb-2 text-center">Buat Akun Baru</h2>
                    <p class="text-center"> Selamat datang, pelamar! Daftar untuk melamar pekerjaan Anda !</p>
                    
                    <form id="registerForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="no_hp" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="no_hp" name="no_hp">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                                    <select class="form-select" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                                        <option value="">Pilih Pendidikan Terakhir</option>
                                        <option value="SMA/SMK">SMA/SMK</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                        <p class="mt-3 text-center">
                            Sudah punya akun? <a href="{{ route('pelamar.login') }}" class="text-underline">Masuk di sini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Password validation
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;
        
        if (password !== passwordConfirmation) {
            Swal.fire({
                icon: 'error',
                title: 'Registrasi Gagal',
                text: 'Konfirmasi password tidak cocok'
            });
            return;
        }

        const formData = new FormData(form);
        const data = {
            nama: formData.get('nama'),
            email: formData.get('email'),
            password: password,
            password_confirmation: passwordConfirmation,
            no_hp: formData.get('no_hp'),
            alamat: '', // Optional: Add an address input in your form
            pendidikan_terakhir: formData.get('pendidikan_terakhir'),
            pengalaman_kerja: '' // Optional: Add an experience input in your form
        };

        try {
            const response = await fetch('/api/pelamar/auth/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data),
            });

            const responseData = await response.json();

            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: 'Registrasi Berhasil',
                    text: responseData.message || 'Akun Anda telah dibuat',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    // Store token in localStorage or sessionStorage if needed
                    localStorage.setItem('auth_token', responseData.authorization.token);
                    window.location.href = '{{ route("pelamar.login") }}';
                });
            } else {
                const errorMessage = responseData.errors 
                    ? Object.values(responseData.errors).flat().join('\n')
                    : (responseData.message || 'Registrasi gagal');

                Swal.fire({
                    icon: 'error',
                    title: 'Registrasi Gagal',
                    text: errorMessage,
                });
            }

        } catch (error) {
            console.error('Registration Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: 'Terjadi kesalahan saat registrasi',
            });
        }
    });
});
</script>
@endsection