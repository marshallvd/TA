@extends('layouts.landing_pelamar')

@section('title')
Beranda
@endsection

@section('content')
<div class="landing-page">
    <!-- Hero Section dengan Carousel -->
    <header class="hero-section">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" aria-label="Carousel Promosi">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active" style="background-image: url('{{ asset('assets/images/landing_page/landing1.jpg') }}');">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption">
                        <div class="content-wrapper" data-aos="fade-up">
                            <h1 class="display-4 fw-bold mb-4">Transformasi Keuangan Berkelanjutan</h1>
                            <p class="lead mb-4">
                                BPR Saraswati Ekabumi hadir sebagai mitra keuangan yang mendukung 
                                pertumbuhan ekonomi lokal melalui layanan perbankan inovatif.
                            </p>
                            <a href="#services" class="btn btn-primary btn-lg">
                                <i class="fas fa-arrow-right me-2"></i>Jelajahi Layanan
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="background-image: url('{{ asset('assets/images/landing_page/landing2.jpg') }}');">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption">
                        <div class="content-wrapper" data-aos="fade-up">
                            <h2 class="display-4 mb-4">Pemberdayaan Ekonomi Lokal</h2>
                            <p class="lead mb-4">
                                Fokus kami adalah mendukung UMKM melalui pendekatan keuangan yang 
                                inklusif dan berkelanjutan.
                            </p>
                            <a href="/landing/career" class="btn btn-primary btn-lg">
                                <i class="fas fa-users me-2"></i>Bergabung Bersama Kami
                            </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="background-image: url('{{ asset('assets/images/landing_page/landing3.jpg') }}');">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption">
                        <div class="content-wrapper" data-aos="fade-up">
                            <h2 class="display-4 mb-4">Teknologi dan Pelayanan Terpadu</h2>
                            <p class="lead mb-4">
                                Kami mengintegrasikan teknologi canggih dengan pelayanan personal untuk 
                                pengalaman perbankan yang lebih baik.
                            </p>
                            <a href="#about" class="btn btn-primary btn-lg">
                                <i class="fas fa-info-circle me-2"></i>Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>

    <!-- Stats Section -->
    <section class="stats-section py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-card text-center p-4 rounded-3 bg-white shadow-sm">
                        <i class="fas fa-users fa-2x text-primary mb-3"></i>
                        <h3 class="count mb-2">10000+</h3>
                        <p class="text-muted mb-0">Nasabah Aktif</p>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-card text-center p-4 rounded-3 bg-white shadow-sm">
                        <i class="fas fa-chart-line fa-2x text-primary mb-3"></i>
                        <h3 class="count mb-2">85%</h3>
                        <p class="text-muted mb-0">Tingkat Kepuasan</p>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card text-center p-4 rounded-3 bg-white shadow-sm">
                        <i class="fas fa-handshake fa-2x text-primary mb-3"></i>
                        <h3 class="count mb-2">1500+</h3>
                        <p class="text-muted mb-0">UMKM Mitra</p>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-card text-center p-4 rounded-3 bg-white shadow-sm">
                        <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                        <h3 class="count mb-2">25+</h3>
                        <p class="text-muted mb-0">Cabang</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="products-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" data-aos="fade-up">Produk Kami</h2>
                <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
                    Solusi finansial untuk setiap kebutuhan Anda
                </p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="product-card h-100 p-4 rounded-3 bg-white shadow-hover">
                        <div class="product-icon mb-4">
                            <i class="fas fa-money-bill-wave fa-3x text-primary"></i>
                        </div>
                        <h4 class="product-title mb-3">Pinjaman</h4>
                        <p class="product-desc text-muted mb-4">
                            Produk kredit diperuntukan bagi debitur perorangan/badan usaha yang
                            membutuhkan pembiayaan modal kerja, pembelian aset atau kebutuhan lainnya.
                        </p>
                        <a href="#" class="btn btn-outline-primary">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-card h-100 p-4 rounded-3 bg-white shadow-hover">
                        <div class="product-icon mb-4">
                            <i class="fas fa-wallet fa-3x text-primary"></i>
                        </div>
                        <h4 class="product-title mb-3">Tabungan Harian</h4>
                        <p class="product-desc text-muted mb-4">
                            Memberikan Anda kemudahan bertransaksi. Ayo segera buka Tabungan
                            Saraswati sekarang juga!
                        </p>
                        <a href="#" class="btn btn-outline-primary">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="product-card h-100 p-4 rounded-3 bg-white shadow-hover">
                        <div class="product-icon mb-4">
                            <i class="fas fa-piggy-bank fa-3x text-primary"></i>
                        </div>
                        <h4 class="product-title mb-3">Tabungan Berjangka</h4>
                        <p class="product-desc text-muted mb-4">
                            Rencanakan keuangan untuk keluarga Anda sejak dini dengan Simpanan Masa
                            Depan (Simapan) BPR, membantu perencanaan keuangan Anda untuk
                            mewujudkan tujuan masa depan dengan lebih pasti.
                        </p>
                        <a href="#" class="btn btn-outline-primary">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="product-card h-100 p-4 rounded-3 bg-white shadow-hover">
                        <div class="product-icon mb-4">
                            <i class="fas fa-credit-card fa-3x text-primary"></i>
                        </div>
                        <h4 class="product-title mb-3">Tabungan Kredit</h4>
                        <p class="product-desc text-muted mb-4">
                            Produk tabungan yang diperuntukkan khusus bagi penabung yang berkaitan
                            dengan kredit angsuran.
                        </p>
                        <a href="#" class="btn btn-outline-primary">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="facilities" class="facilities-section py-5 bg-light">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" data-aos="fade-up">Fasilitas</h2>
                <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
                    Kami menawarkan berbagai fasilitas untuk memudahkan dan meningkatkan keamanan serta efisiensi transaksi Anda
                </p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="facility-card h-100 p-4 rounded-3 bg-white shadow-hover">
                        <div class="facility-icon mb-4">
                            <i class="fas fa-home fa-3x text-primary"></i>
                        </div>
                        <h4 class="facility-title mb-3">Home Banking</h4>
                        <p class="facility-desc text-muted mb-4">
                            Tim Kolektor Dana dan kredit kami akan membantu pemungutan dana dan angsuran
                            nasabah dari rumah, kantor, dan tempat usaha nasabah tanpa biaya tambahan.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="facility-card h-100 p-4 rounded-3 bg-white shadow-hover">
                        <div class="facility-icon mb-4">
                            <i class="fas fa-mobile-alt fa-3x text-primary"></i>
                        </div>
                        <h4 class="facility-title mb-3">Setoran Branchless</h4>
                        <p class="facility-desc text-muted mb-4">
                            Aplikasi mobile berbasis Android untuk membantu petugas bank menjemput
                            transaksi ke lapangan sebagai upaya memberikan layanan prima.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="facility-card h-100 p-4 rounded-3 bg-white shadow-hover">
                        <div class="facility-icon mb-4">
                            <i class="fas fa-money-check fa-3x text-primary"></i>
                        </div>
                        <h4 class="facility-title mb-3">Virtual Account</h4>
                        <p class="facility-desc text-muted mb-4">
                            Nomor rekening virtual untuk mempercepat proses identifikasi transaksi
                            non tunai melalui transfer antar bank.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="facility-card h-100 p-4 rounded-3 bg-white shadow-hover">
                        <div class="facility-icon mb-4">
                            <i class="fas fa-sync fa-3x text-primary"></i>
                        </div>
                        <h4 class="facility-title mb-3">Autodebet Tabungan</h4>
                        <p class="facility-desc text-muted mb-4">
                            Layanan pembayaran otomatis untuk angsuran kredit dan setoran tabungan
                            berjangka tanpa perlu mengingat tanggal jatuh tempo.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                    <img src="{{ asset('assets/images/logo seb.png') }}" class="img-fluid rounded-3 shadow" alt="BPR Saraswati Ekabumi">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="about-content">
                        <h2 class="display-5 fw-bold mb-4">Tentang Kami</h2>
                        <p class="lead mb-4">
                            BPR Saraswati Ekabumi adalah lembaga keuangan yang berkomitmen untuk 
                            mendukung pemberdayaan ekonomi masyarakat.
                        </p>
                        <div class="feature-list">
                            <div class="feature-item d-flex align-items-center mb-3">
                                <div class="feature-icon me-3">
                                    <i class="fas fa-check-circle text-primary"></i>
                                </div>
                                <div class="feature-text">
                                    Pelayanan profesional dan terpercaya
                                </div>
                            </div>
                            <div class="feature-item d-flex align-items-center mb-3">
                                <div class="feature-icon me-3">
                                    <i class="fas fa-check-circle text-primary"></i>
                                </div>
                                <div class="feature-text">
                                    Solusi keuangan yang inovatif
                                </div>
                            </div>
                            <div class="feature-item d-flex align-items-center">
                                <div class="feature-icon me-3">
                                    <i class="fas fa-check-circle text-primary"></i>
                                </div>
                                <div class="feature-text">
                                    Fokus pada pemberdayaan UMKM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="faq-section py-5 bg-light">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" data-aos="fade-up">FAQ</h2>
                <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
                    Pertanyaan yang Sering Diajukan
                </p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="100">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Berapa lama proses pengajuan kredit di BPR Saraswati?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    BPR Saraswati berkomitmen memberikan kepastian mengenai pengajuan kredit Anda
                                    selambat-lambatnya 3 (tiga) hari kerja sejak pengajuan kredit apabila seluruh
                                    persyaratan pengajuan kredit sudah dilengkapi oleh calon nasabah.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="200">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Apakah untuk pengajuan pinjaman harus datang ke kantor BPR Saraswati?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Anda dapat mengajukan pinjaman di BPR Saraswati di manapun Anda berada. 
                                    Pengajuan dapat dilakukan secara online atau petugas kami siap berkunjung 
                                    untuk membantu proses pengajuan Anda. Hubungi kami untuk menjadwalkan kunjungan.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="300">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Apakah untuk membayar angsuran harus datang ke BPR Saraswati?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Nasabah dapat membayar angsuran dengan datang ke kantor BPR Saraswati atau 
                                    melalui transfer ke rekening resmi BPR Saraswati. Bagi nasabah yang melakukan 
                                    pembayaran melalui transfer mohon menginfokan kepada marketing kredit yang menghandle Anda.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="400">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Apa saja keunggulan kredit di BPR Saraswati?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <p><strong>Proses Anti Ribet:</strong> Tanpa perlu berbelit-belit, kami 
                                    pastikan proses pengajuan kredit Anda berjalan lancar dan cepat. 
                                    Persyaratan yang mudah dan pelayanan yang ramah siap menyambut Anda!</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-primary me-2"></i>Proses cepat dan mudah</li>
                                        <li><i class="fas fa-check text-primary me-2"></i>Persyaratan minimal</li>
                                        <li><i class="fas fa-check text-primary me-2"></i>Layanan personal</li>
                                        <li><i class="fas fa-check text-primary me-2"></i>Suku bunga kompetitif</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Footer -->
<footer class="footer py-5 bg-dark text-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="mb-4">Tentang Kami</h5>
                <p>PT Bank Perekonomian Rakyat Saraswati Eka Bumi berizin dan diawasi oleh Otoritas Jasa
                    Keuangan (OJK) serta merupakan peserta penjaminan LPS</p>
                <div class="social-links mt-4">
                    <h6 class="mb-3">Media Sosial</h6>
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="mb-4">Kantor Pusat</h5>
                <p><i class="fas fa-map-marker-alt me-2"></i>Jalan By Pass Ngurah Rai No 233 Kuta Badung Bali</p>
                <p><i class="fas fa-phone me-2"></i>(0361) 756206, 763295</p>
                <p><i class="fas fa-clock me-2"></i>Jam buka:</p>
                <p class="ms-4">Senin - Jumat: 08.00 – 16.00 wita<br>
                Sabtu dan Minggu: TUTUP</p>
            </div>
            <div class="col-lg-4">
                <h5 class="mb-4">Kantor Kas</h5>
                <div class="branch-office">
                    <h6 class="mb-3">Kas Sempidi:</h6>
                    <p><i class="fas fa-map-marker-alt me-2"></i>Jalan Raya Sempidi No.12a Badung Bali</p>
                    <p><i class="fas fa-phone me-2"></i>(0361) 9561143, 9561144</p>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
@endsection


@push('styles')
<style>
:root {
    --primary-color: #2a4ec5;
    --primary-dark: #1e3a8a;
    --primary-light: #3b82f6;
    --transition-base: all 0.3s ease;
}

/* Hero Section */
.hero-section {
    position: relative;
    height: 100vh;
    overflow: hidden;
}
.footer {
    background: linear-gradient(135deg, #1a237e, #283593);
}
.carousel-item {
    height: 100vh;
    background-size: cover;
    background-position: center;
}

.carousel-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(74, 67, 168, 0.8), rgba(0, 0, 0, 0.6));
}

.carousel-caption {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 0 15%;
}

/* Stats Section */
.stat-card {
    transition: var(--transition-base);
    border: 1px solid rgba(0,0,0,0.08);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.count {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-color);
}

/* Services Section */
.service-card {
    transition: var(--transition-base);
    border: 1px solid rgba(0,0,0,0.08);
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.service-icon {
    background: rgba(42, 78, 197, 0.1);
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.shadow-hover {
    transition: var(--transition-base);
}

.shadow-hover:hover {
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

/* About Section */
.feature-item {
    padding: 1rem;
    border-radius: 0.5rem;
    background: white;
    margin-bottom: 1rem;
    transition: var(--transition-base);
}

.feature-item:hover {
    transform: translateX(10px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.feature-icon {
    font-size: 1.5rem;
}

/* Responsive Adjustments */
@media (max-width: 991.98px) {
    .hero-section {
        height: auto;
        min-height: 70vh;
    }

    .carousel-item {
        height: 70vh;
    }

    .carousel-caption {
        padding: 0 5%;
    }
}

@media (max-width: 767.98px) {
    .display-4 {
        font-size: 2rem;
    }

    .lead {
        font-size: 1rem;
    }

    .stat-card {
        padding: 1.5rem !important;
    }

    .count {
        font-size: 2rem;
    }

    .service-icon {
        width: 60px;
        height: 60px;
    }

    .service-icon i {
        font-size: 1.5rem;
    }

    .about-content {
        text-align: center;
        padding-top: 2rem;
    }

    .feature-item {
        justify-content: center;
    }
}

@media (max-width: 575.98px) {
    .carousel-caption {
        padding: 0 3%;
    }

    .btn-lg {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    .stat-card {
        padding: 1rem !important;
    }

    .count {
        font-size: 1.75rem;
    }
}

/* Animation Classes */
.fade-up {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.fade-up.active {
    opacity: 1;
    transform: translateY(0);
}

.fade-in {
    opacity: 0;
    transition: opacity 0.6s ease-out;
}

.fade-in.active {
    opacity: 1;
}

/* Enhanced Hover Effects */
.btn-primary {
    background: var(--primary-color);
    border-color: var(--primary-color);
    transition: var(--transition-base);
}

.btn-primary:hover {
    background: var(--primary-dark);
    border-color: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(42, 78, 197, 0.3);
}

.btn-outline-primary {
    color: var(--primary-color);
    border-color: var(--primary-color);
    transition: var(--transition-base);
}

.btn-outline-primary:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(42, 78, 197, 0.3);
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--primary-dark);
}
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- CSS untuk AOS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush



@push('scripts')

<!-- Script untuk AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
        duration: 1000,
        once: false,
        mirror: false,
        offset: 50
    });

    // Carousel Configuration
    const heroCarousel = new bootstrap.Carousel(document.querySelector('#heroCarousel'), {
        interval: 5000,
        touch: true,
        pause: 'hover'
    });

    // Smooth Scroll for Navigation Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Animated Counter for Stats
    function animateCounter(el) {
        const target = parseInt(el.textContent.replace(/[^0-9]/g, ''));
        let current = 0;
        const increment = target / 50; // Adjust speed here
        const duration = 2000; // Animation duration in milliseconds
        const stepTime = duration / 50;

        const counter = setInterval(() => {
            current += increment;
            if (current >= target) {
                el.textContent = target.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "+";
                clearInterval(counter);
            } else {
                el.textContent = Math.floor(current).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "+";
            }
        }, stepTime);
    }

    // Intersection Observer for Counter Animation
    const observerOptions = {
        threshold: 0.5
    };

    const counterObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target.querySelector('.count');
                if (counter && !counter.classList.contains('counted')) {
                    animateCounter(counter);
                    counter.classList.add('counted');
                }
            }
        });
    }, observerOptions);

    // Observe all stat cards
    document.querySelectorAll('.stat-card').forEach(card => {
        counterObserver.observe(card);
    });

    // Header Scroll Effect
    let lastScroll = 0;
    const header = document.querySelector('header');

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;

        if (currentScroll <= 0) {
            header.classList.remove('scrolled-up');
            header.classList.remove('scrolled-down');
            return;
        }

        if (currentScroll > lastScroll && !header.classList.contains('scrolled-down')) {
            // Scrolling down
            header.classList.remove('scrolled-up');
            header.classList.add('scrolled-down');
        } else if (currentScroll < lastScroll && header.classList.contains('scrolled-down')) {
            // Scrolling up
            header.classList.remove('scrolled-down');
            header.classList.add('scrolled-up');
        }
        lastScroll = currentScroll;
    });

    // Service Card Hover Effect
    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.querySelector('.service-icon').style.transform = 'scale(1.1) rotate(5deg)';
        });

        card.addEventListener('mouseleave', function() {
            this.querySelector('.service-icon').style.transform = 'scale(1) rotate(0deg)';
        });
    });

    // Add parallax effect to hero section
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const heroSection = document.querySelector('.hero-section');
        if (heroSection) {
            heroSection.style.backgroundPositionY = -(scrolled * 0.5) + 'px';
        }
    });
});
</script>
@endpush