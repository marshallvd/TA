@extends('layouts.app')

<div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light iq-navbar">
        <div class="container-fluid navbar-inner">
            <div class="input-group search-input">
                <span class="input-group-text" id="search-input">
                    <svg class="icon-18" width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                        <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                <input type="search" class="form-control" placeholder="Search...">
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="caption ms-3 d-none d-md-block">
                                <h6 class="mb-0 caption-title">asad</h6>
                                <p class="mb-0 caption-sub-title">asdas</p>
                            </div>
                            <svg class="icon-18 ms-2" width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 13.5723C12.3373 13.5723 12.6723 13.4967 12.9868 13.3493C13.3013 13.2018 13.5881 12.983 13.8268 12.7089C14.0655 12.4349 14.2499 12.1124 14.3679 11.7653C14.4859 11.4181 14.5339 11.0549 14.5091 10.6937C14.4843 10.3325 14.3873 9.98372 14.2235 9.66563C14.0597 9.34754 13.8315 9.06636 13.5531 8.83994C13.2747 8.61352 12.9522 8.45181 12.6037 8.3573C12.2552 8.26279 11.8892 8.23058 11.5282 8.26195C11.1671 8.29332 10.8142 8.38809 10.4876 8.54254C10.1611 8.69699 9.86446 8.90807 9.61814 9.16804C9.37182 9.428 9.1877 9.73005 9.06938 10.0527C8.95106 10.3754 8.90104 10.7131 8.92258 11.0501C8.94412 11.3871 9.03679 11.714 9.19576 12.0152C9.35472 12.3164 9.57667 12.5876 9.84603 12.8111C10.1154 13.0346 10.4253 13.2062 10.7543 13.3182C11.0832 13.4301 11.4258 13.4797 11.7688 13.4645C12.1118 13.4494 12.4487 13.3704 12.7664 13.2308" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <svg class="icon-18 me-2" width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 15.5723C12.3373 15.5723 12.6723 15.4967 12.9868 15.3493C13.3013 15.2018 13.5881 14.983 13.8268 14.7089C14.0655 14.4349 14.2499 14.1124 14.3679 13.7653C14.4859 13.4181 14.5339 13.0549 14.5091 12.6937C14.4843 12.3325 14.3873 11.9837 14.2235 11.6656C14.0597 11.3475 13.8315 11.0664 13.5531 10.8399C13.2747 10.6135 12.9522 10.4518 12.6037 10.3573C12.2552 10.2628 11.8892 10.2306 11.5282 10.2619C11.1671 10.2933 10.8142 10.3881 10.4876 10.5425C10.1611 10.697 9.86446 10.9081 9.61814 11.168C9.37182 11.428 9.1877 11.7301 9.06938 12.0527C8.95106 12.3754 8.90104 12.7131 8.92258 13.0501C8.94412 13.3871 9.03679 13.714 9.19576 14.0152C9.35472 14.3164 9.57667 14.5876 9.84603 14.8111C10.1154 15.0346 10.4253 15.2062 10.7543 15.3182C11.0832 15.4301 11.4258 15.4797 11.7688 15.4645C12.1118 15.4494 12.4487 15.3704 12.7664 15.2308" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" id="logoutButton">
                                    <svg class="icon-18 me-2" width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.89844 7.55979C9.68226 3.96674 11.6726 2.30923 15.1712 2.30923C19.0454 2.30923 21.551 4.65502 21.551 8.97366C21.551 13.2906 19.0454 15.6365 15.1712 15.6365C11.6726 15.6365 9.68226 13.9743 8.89844 10.3812" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.1712 12.3867V15.6366" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M2.33807 12.3867H15.1709" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <span class="text-danger">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="iq-navbar-header" style="height: 215px; position: relative;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-wrap d-flex justify-content-between align-items-center">
                        <div class="text-overlay">
                            <h1>Hallo Pekerja Keras!</h1>
                            <p>One Team, One Voice, One Family. Evos ROAR!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="iq-header-img">
            <img src="{{ asset('assets/images/dashboard/top-header.png') }}" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated -scaleX">
            <img src ="{{ asset('assets/images/dashboard/top-header1.png') }}" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('assets/images/dashboard/top-header2.png') }}" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('assets/images/dashboard/top-header3.png') }}" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('assets/images/dashboard/top-header4.png') }}" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
            <img src="{{ asset('assets/images/dashboard/top-header5.png') }}" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
        </div>
    </div>
</div>

<style>
    .iq-navbar-header {
        position: relative; /* Pastikan posisi relatif untuk posisi absolut di dalamnya */
    }

    .text-overlay {
        position: absolute; /* Mengatur posisi absolut */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%); /* Pusatkan teks */
        color: white; /* Warna teks */
        z-index: 10; /* Pastikan teks di atas gambar */
        text-align: center; /* Pusatkan teks */
    }

    .caption-title {
        white-space: nowrap; /* Mencegah teks membungkus ke baris berikutnya */
        overflow: hidden; /* Menyembunyikan teks yang melampaui batas */
        text-overflow: ellipsis; /* Menambahkan '...' di akhir teks yang terpotong */
        max-width: 200px; /* Atur lebar maksimum sesuai kebutuhan */
    }

    .iq-header-img img {
        width: 100%;
        height: auto;
        object-fit: cover; /* Pastikan gambar menutupi area */
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const captionTitle = document.querySelector('.caption-title');
    const captionSubTitle = document.querySelector('.caption-sub-title');
    const logoutButton = document.getElementById('logoutButton');

    // Ambil token dari localStorage
    const token = localStorage.getItem('token'); // Pastikan kunci yang benar

    if (token) {
        async function fetchUserAndPegawai() {
            try {
                // Mengambil data user dari /api/auth/me
                const userResponse = await fetch('http://127.0.0.1:8000/api/auth/me', {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                // Periksa jika token kedaluwarsa atau tidak valid (status 401)
                if (userResponse.status === 401) {
                    // Hapus token yang tidak valid
                    localStorage.removeItem('auth_token');

                    // Tampilkan peringatan menggunakan SweetAlert2
                    await Swal.fire({
                        icon: 'warning',
                        title: 'Session Expired',
                        text: 'Your session has expired. Please login again.',
                        confirmButtonText: 'OK'
                    });

                    // Redirect ke halaman login
                    window.location.href = '/login';
                    return;
                }

                if (!userResponse.ok) {
                    throw new Error('Failed to fetch user data');
                }

                const userData = await userResponse.json();
                console.log('User  Data:', userData);

                // Data pegawai sudah ada dalam response /api/auth/me
                if (!userData.pegawai || !userData.pegawai.nama_lengkap) {
                    throw new Error('Pegawai data not found');
                }

                const idJabatan = userData.pegawai.id_jabatan;
                console.log('ID Jabatan:', idJabatan);

                // Mengambil data jabatan
                const jabatanResponse = await fetch(`http://127.0.0.1:8000/api/jabatan/${idJabatan}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });

                // Periksa jika token kedaluwarsa saat mengambil data jabatan
                if (jabatanResponse.status === 401) {
                    localStorage.removeItem('auth_token');

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
                console.log('Jabatan Data:', jabatan);

                // Perbarui UI
                if (captionTitle) {
                    captionTitle.textContent = userData.pegawai.nama_lengkap;
                }

                if (captionSubTitle && jabatan.nama_jabatan) {
                    captionSubTitle.textContent = jabatan.nama_jabatan; // Pastikan ini di-set dengan benar
                } else {
                    captionSubTitle.textContent = 'Jabatan not available';
                }

            } catch (error) {
                console.error('Error detail:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.message
                });
            }
        }

        // Panggil fungsi untuk mengambil data
        fetchUserAndPegawai();
    }

// Event listener untuk tombol logout
logoutButton.addEventListener('click', async function(e) {
        e.preventDefault();

        // Tampilkan konfirmasi logout menggunakan SweetAlert2
        const { isConfirmed } = await Swal.fire({
            icon: 'warning',
            title: 'Konfirmasi Logout',
            text: 'Apakah kamu yakin mau logout?',
            showCancelButton: true,
            confirmButtonText: 'Logout',
            cancelButtonText: 'Batal'
        });

        if (isConfirmed) {
            localStorage.removeItem('auth_token');

            await Swal.fire({
                icon: 'success',
                title: 'Logout Sukses',
                text: 'Kamu Sudah Logout.'
            });

            window.location.href = '/login';
        }
    });
});
</script>

