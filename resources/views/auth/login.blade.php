@extends('layouts.auth')

@section('title', 'Login')

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
                    <h2 class="mb-2 text-center">Sign In</h2>
                    <p class="text-center">Tunggu apalagi? Mari kita masuk.</p>
                    
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
                            Don't have an account? <a href="{{ route('register') }}" class="text-underline">Click here to sign up.</a>
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
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenMeta ? csrfTokenMeta.content : '';

            const response = await fetch('/api/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify(data),
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.error || 'Login failed');
            }

            const responseData = await response.json();

            // Simpan token dan data pengguna
            localStorage.setItem('token', responseData.authorization.token);
            localStorage.setItem('user_data', JSON.stringify(responseData.user)); // Simpan data pengguna

            // Beri tahu pengguna bahwa login berhasil
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil',
                text: 'Selamat Datang Pekerja Keras!',
                showConfirmButton: false,
                timer: 1000
            }).then(() => {
                window.location.href = '/dashboard'; // Redirect ke dashboard
            });
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


@endsection