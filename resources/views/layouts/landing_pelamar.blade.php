<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRMS SEB - @yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/logo_app.png') }}" />


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- CSS untuk AOS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --elektrik-blue: #0077be;
            --elektrik-blue-dark: #005b8e;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f7fa;
        }

        .navbar-custom {
            background-color: white;
            padding: 15px 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-custom .navbar-brand {
            color: #2c3e50;
            font-weight: bold;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-right: auto;
        }

        .navbar-custom .navbar-brand img {
            height: 40px;
            width: auto;
        }

        .navbar-nav {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 30px;
        }

        .navbar-custom .nav-link {
            color: #2c3e50;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }

        .navbar-custom .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background-color: var(--elektrik-blue);
            transition: width 0.3s ease, left 0.3s ease;
        }

        .navbar-custom .nav-link:hover {
            color: var(--elektrik-blue);
        }

        .navbar-custom .nav-link:hover::after {
            width: 100%;
            left: 0;
        }

        .btn-login {
            background-color: var(--elektrik-blue);
            color: white;
            border: none;
            transition: all 0.3s ease;
            margin-left: auto;
        }

        .btn-login:hover {
            background-color: var(--elektrik-blue-dark);
            transform: translateY(-2px);
        }

        @media (max-width: 992px) {
            .navbar-nav {
                position: static;
                transform: none;
                flex-direction: column;
                align-items: center;
            }

            .navbar-custom {
                flex-direction: column;
                align-items: flex-start;
            }
        }
        .modal-content {
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.modal-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 1.5rem;
}

.modal-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
}

.login-card {
    border: none;
    border-radius: 15px;
    transition: all 0.3s ease;
    height: 100%;
    background: linear-gradient(145deg, #ffffff, #f8f9fa);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

.hover-effect:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.icon-circle {
    width: 120px;
    height: 120px;
    margin: 0 auto;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    border: 4px solid #fff;
}

.login-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.login-btn {
    border-radius: 10px;
    padding: 12px 20px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border: none;
}

.btn-success {
    background: linear-gradient(135deg, #28a745 0%, #218838 100%);
    border: none;
}

.login-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.card-title {
    color: #2c3e50;
    font-weight: 600;
}

@media (max-width: 768px) {
    .modal-dialog {
        margin: 1rem;
    }
    
    .icon-circle {
        width: 100px;
        height: 100px;
    }
}

.navbar-brand {
        display: flex;
        align-items: center;
        padding: 0;
        margin: 0;
    }

    .brand-container {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .navbar-brand img {
        height: 40px;
        width: auto;
        margin-right: 0;
    }

    .brand-title {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .brand-name, .brand-subtitle {
        font-size: 1rem;
        font-weight: bold;
        text-transform: uppercase;
        line-height: 1.2;
        text-align: left;
        margin: 0;
    }

    @media (max-width: 992px) {
        .brand-container {
            gap: 10px;
        }
        
        .brand-name, .brand-subtitle {
            font-size: 0.9rem;
        }
    }
    </style>
    
    @stack('styles')
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand" href="{{ route('landing.index') }}">
        <div class="brand-container">
            <img src="{{ asset('assets/images/logo seb.png') }}" alt="Logo HRMS SEB">
            <div class="brand-title">
                <span class="brand-name">PT. BANK PEREKONOMIAN RAKYAT</span>
                <span class="brand-subtitle">SARASWATI EKA BUMI</span>
            </div>
        </div>
    </a>
    
    <div class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('landing.index') }}">Beranda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('landing.career') }}">Karir</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('landing.about') }}">Tentang</a>
        </li>
    </div>
    
    <button class="btn btn-login" data-bs-toggle="modal" data-bs-target="#loginModal">
        <i class="fas fa-sign-in-alt me-2"></i>Login
    </button>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="loginModalLabel">
                    <i class="fas fa-key text-primary me-2"></i>
                    Pilih Jenis Login
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="login-option h-100">
                            <div class="card login-card hover-effect">
                                <div class="card-body text-center p-4">
                                    <div class="icon-circle mb-3">
                                        <img src="{{ asset('assets/images/avatars/avatar (14).png') }}" 
                                             alt="Login Pelamar" 
                                             class="img-fluid rounded-circle login-image">
                                    </div>
                                    <h4 class="card-title mb-3">Pelamar</h4>
                                    <p class="text-muted mb-4">Akses untuk pelamar kerja</p>
                                    <a href="{{ route('pelamar.login') }}" 
                                       class="btn btn-primary btn-lg w-100 login-btn">
                                        <i class="fas fa-user-tie me-2"></i>
                                        Masuk sebagai Pelamar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="login-option h-100">
                            <div class="card login-card hover-effect">
                                <div class="card-body text-center p-4">
                                    <div class="icon-circle mb-3">
                                        <img src="{{ asset('assets/images/avatars/avatar (1).png') }}" 
                                             alt="Login Pegawai" 
                                             class="img-fluid rounded-circle login-image">
                                    </div>
                                    <h4 class="card-title mb-3">Pegawai</h4>
                                    <p class="text-muted mb-4">Akses untuk pegawai dan staff internal</p>
                                    <a href="{{ route('login') }}" 
                                       class="btn btn-success btn-lg w-100 login-btn">
                                        <i class="fas fa-user-shield me-2"></i>
                                        Masuk sebagai Pegawai
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <main>
        @yield('content')
    </main>

    <footer class="bg-light text-center py-4">
        <div class="container">
            <p class="mb-0">© {{ date('Y') }} BPR Saraswati Eka Bumi. All rights reserved.</p>
        </div>
    </footer>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script untuk AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>
</html>




