@extends('layouts.auth')

@section('title', 'Login Pelamar')

@section('content')
<div class="col-md-6">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                <div class="card-body">
                    <a href="{{ route('landing.index') }}" class="navbar-brand d-flex align-items-center mb-3">
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
                    <h2 class="mb-2 text-center">Pelamar</h2>
                    <p class="text-center">Selamat datang, pelamar! Masuk untuk melamar pekerjaan Anda !</p>
                    
                    <form id="loginForm" method="POST" action="javascript:void(0);">
                        @csrf
                        <div class="row">
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
                            <div class="col-lg-12 d-flex justify-content-between">
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                        <p class="mt-3 text-center">
                            Don't have an account? <a href="{{ route('pelamar.register') }}" class="text-underline">Click here to sign up.</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    
    if (!form) {
        console.error('Login form not found!');
        return;
    }

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(form);
        const data = {
            email: formData.get('email'),
            password: formData.get('password'),
        };

        try {
            const response = await fetch('http://localhost:8000/api/pelamar/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            });

            const responseData = await response.json();

            if (responseData.status === 'success') {
                // Simpan token dan data pengguna
                localStorage.setItem('pelamar_token', responseData.authorization.token);
                localStorage.setItem('pelamar_data', JSON.stringify(responseData.data));

                // Beri tahu pengguna bahwa login berhasil
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil',
                    text: 'Selamat Datang ' + responseData.data.nama + '!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '{{ route('dashboard.pelamar') }}';
                });
            } else {
                throw new Error(responseData.message || 'Login gagal');
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: error.message,
            });
        }
    });
});
</script>
@endpush