@extends('layouts.app')

<div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light iq-navbar">
        <div class="container-fluid navbar-inner">
            <div style="width: 10px;"></div>
            <!-- Employee Info -->
            <div class="d-none d-md-block">
                <h6 class="mb-0 caption-title">Nama Pegawai | Jabatan</h6>
            </div>

            <!-- Right side: Profile Actions -->
            <div class="ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a href="#" class="nav-link" id="profileButton">
                            <img src="{{ asset('assets/images/avatars/01.png') }}" alt="Profile" class="rounded-circle" width="32" height="32">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Header Section -->
    <div class="iq-navbar-header" style="height: 215px; position: relative;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-wrap d-flex justify-content-between align-items-center">
                        <div class="text-overlay">
                            <h1>Selamat Datang, Pembuat Perubahan!</h1>
                            <p>Bersama Membangun Mimpi, Mengukir Prestasi, Menginspirasi Masa Depan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="iq-header-img">
            <img src="{{ asset('assets/images/dashboard/top-header.png') }}" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('assets/images/dashboard/top-header1.png') }}" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('assets/images/dashboard/top-header2.png') }}" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('assets/images/dashboard/top-header3.png') }}" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('assets/images/dashboard/top-header4.png') }}" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('assets/images/dashboard/top-header5.png') }}" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
        </div>
    </div>
</div>

<style>
    .caption-title {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 250px;
        margin-right: 15px; /* Tambahan margin di sebelah kanan */

    }
    .iq-navbar-header .text-overlay h1 {
    color: #ffffff !important;
}

    .text-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #ffffff !important; /* Tambahkan !important */
        z-index: 10;
        text-align: center;
    }

    .iq-header-img img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const captionTitle = document.querySelector('.caption-title');
        const profileButton = document.getElementById('profileButton');
        const token = localStorage.getItem('token');
    
        // Create a more elegant dropdown menu
        const dropdownMenu = document.createElement('div');
        dropdownMenu.id = 'profileDropdown';
        dropdownMenu.classList.add('profile-dropdown');
        dropdownMenu.innerHTML = `
        <div class="profile-dropdown-container">
            <div class="profile-dropdown-header">
                <img src="{{ asset('assets/images/avatars/01.png') }}" alt="Profile" class="profile-dropdown-avatar">
                <div class="profile-dropdown-user-info">
                    <span class="profile-dropdown-name" id="dropdownUserName">User Name</span>
                    <span class="profile-dropdown-role" id="dropdownUserRole">Role</span>
                </div>
            </div>
            <div class="profile-dropdown-divider"></div>
            <div class="profile-dropdown-actions">
                <button id="profileMenuOption" class="profile-dropdown-action">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </button>
                <button id="logoutMenuOption" class="profile-dropdown-action logout-action">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </div>
        </div>
    `;
    
        // Add custom styles for the dropdown
        const style = document.createElement('style');
        style.textContent = `
            .profile-dropdown {
                position: absolute;
                right: 10px;
                top: 70px;
                width: 300px;
                background-color: white;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.1);
                overflow: hidden;
                display: none;
                opacity: 0;
                transform: translateY(-10px);
                transition: opacity 0.3s ease, transform 0.3s ease;
                z-index: 1000;
            }
    
            .profile-dropdown.show {
                display: block;
                opacity: 1;
                transform: translateY(0);
            }
    
            .profile-dropdown-container {
                padding: 20px;
            }
    
            .profile-dropdown-header {
                display: flex;
                align-items: center;
                margin-bottom: 15px;
            }
    
            .profile-dropdown-avatar {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                margin-right: 15px;
                object-fit: cover;
            }
    
            .profile-dropdown-user-info {
                display: flex;
                flex-direction: column;
            }
    
            .profile-dropdown-name {
                font-weight: 600;
                font-size: 16px;
                color: #333;
            }
    
            .profile-dropdown-role {
                font-size: 14px;
                color: #777;
            }
    
            .profile-dropdown-divider {
                height: 1px;
                background-color: #eee;
                margin: 15px 0;
            }
    
            .profile-dropdown-actions {
                display: flex;
                flex-direction: column;
            }
    
            .profile-dropdown-action {
                display: flex;
                align-items: center;
                background: none;
                border: none;
                padding: 10px 0;
                cursor: pointer;
                transition: background-color 0.2s ease;
                text-align: left;
                width: 100%;
            }
    
            .profile-dropdown-action:hover {
                background-color: #f5f5f5;
            }
    
            .profile-dropdown-action i {
                margin-right: 10px;
                color: #666;
            }
    
            .profile-dropdown-action span {
                font-size: 15px;
            }

            .logout-action {
                color: #dc3545 !important;
            }

            .logout-action:hover {
                background-color: #f8d7da !important;
            }

            .logout-action i {
                color: #dc3545 !important;
            }
        `;
        document.head.appendChild(style);
    
        document.body.appendChild(dropdownMenu);
    
        if (token) {
            async function fetchUserAndPegawai() {
                try {
                    const userResponse = await fetch('http://127.0.0.1:8000/api/auth/me', {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json'
                        }
                    });
    
                    if (userResponse.status === 401) {
                        localStorage.removeItem('token');
                        await Swal.fire({
                            icon: 'warning',
                            title: 'Sesi Berakhir',
                            text: 'Sesi Anda sudah berakhir. SIlahkan Login kembali.',
                            confirmButtonText: 'OK'
                        });
                        window.location.href = '/login';
                        return;
                    }
    
                    if (!userResponse.ok) {
                        throw new Error('Failed to fetch user data');
                    }
    
                    const userData = await userResponse.json();
    
                    if (!userData.pegawai || !userData.pegawai.nama_lengkap) {
                        throw new Error('Pegawai data not found');
                    }
    
                    const idJabatan = userData.pegawai.id_jabatan;
    
                    const jabatanResponse = await fetch(`http://127.0.0.1:8000/api/jabatan/${idJabatan}`, {
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Accept': 'application/json'
                        }
                    });
    
                    if (jabatanResponse.status === 401) {
                        localStorage.removeItem('token');
                        await Swal.fire({
                            icon: 'warning',
                            title: 'Session Expired',
                            text: 'Your session has expired. Please login again.',
                            confirmButtonText: 'OK'
                        });
                        window.location.href = '/login';
                        return;
                    }
    
                    if (!jabatanResponse.ok) {
                        throw new Error('Failed to fetch jabatan data');
                    }
    
                    const jabatan = await jabatanResponse.json();
    
                    if (captionTitle) {
                        captionTitle.textContent = `${userData.pegawai.nama_lengkap} | ${jabatan.nama_jabatan}`;
                    }
    
                    // Update dropdown user info
                    document.getElementById('dropdownUserName').textContent = userData.pegawai.nama_lengkap;
                    document.getElementById('dropdownUserRole').textContent = jabatan.nama_jabatan;
                } catch (error) {
                    console.error('Error detail:', error);
                    Swal.fire({
                        icon: 'error', 
                        title: 'Oops...',
                        text: error.message
                    });
                }
            }
    
            fetchUserAndPegawai();
        }
    
   // Logout function with improved error handling
    async function performLogout() {
        try {
            // Attempt to call logout API (adjust the endpoint as needed)
            const response = await fetch('http://127.0.0.1:8000/api/auth/logout', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            // Remove token from local storage
            localStorage.removeItem('token');

            if (response.ok) {
                // Successful logout
                await Swal.fire({
                    icon: 'success',
                    title: 'Logout Berhasil',
                    text: 'Anda telah berhasil logout.',
                    confirmButtonColor: '#3085d6'
                });
                window.location.href = '/login';
            } else {
                // Logout failed on server
                const errorData = await response.json();
                throw new Error(errorData.message || 'Logout gagal. Silakan coba lagi.');
            }
        } catch (error) {
            // Network error or other issues
            console.error('Logout error:', error);
            
            // Always remove token and redirect on catch
            localStorage.removeItem('token');
            
            await Swal.fire({
                icon: 'error',
                title: 'Logout Gagal',
                text: error.message || 'Terjadi kesalahan saat logout. Silakan coba lagi.',
                confirmButtonColor: '#d33'
            });
            window.location.href = '/login';
        }
    }

        // Toggle dropdown with smooth animation
        profileButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });

        // Profile menu option
  
        document.getElementById('profileMenuOption').addEventListener('click', function() {
            window.location.href = '/profile/pegawai';
            dropdownMenu.classList.remove('show');
        });

        // Logout menu option
        document.getElementById('logoutMenuOption').addEventListener('click', function() {
            Swal.fire({
                title: 'Logout',
                text: 'Anda yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout'
            }).then((result) => {
                if (result.isConfirmed) {
                    performLogout();
                }
            });
            dropdownMenu.classList.remove('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!dropdownMenu.contains(event.target) && !profileButton.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    });
    </script>