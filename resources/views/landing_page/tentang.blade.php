@extends('layouts.landing_pelamar')

@section('title', 'Tentang BPR Saraswati Eka Bumi')

@section('content')
<div class="landing-page about-page">
<!-- Hero Section dengan Carousel -->
<header class="hero-section">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" aria-label="Carousel Profil">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active" style="background-image: url('{{ asset('assets/images/landing_page/landing1.jpg') }}');">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <div class="content-wrapper" data-aos="fade-up">
                        <h1 class="display-4 fw-bold mb-4">Komitmen Kami Memberdayakan Ekonomi Lokal</h1>
                        <p class="lead mb-4">
                            BPR Saraswati Ekabumi berkomitmen tinggi dalam mendukung 
                            pembangunan ekonomi masyarakat Bali.
                        </p>
                        <a href="#visi-misi" class="btn btn-primary btn-lg scroll-link">
                            <i class="fas fa-eye me-2"></i>Lihat Visi Misi
                        </a>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('{{ asset('assets/images/landing_page/landing2.jpg') }}');">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <div class="content-wrapper" data-aos="fade-up">
                        <h2 class="display-4 mb-4">Pengembangan Berkelanjutan</h2>
                        <p class="lead mb-4">
                            Kami terus berinovasi untuk memberikan solusi keuangan 
                            yang inklusif dan berkelanjutan.
                        </p>
                        <a href="#team" class="btn btn-primary btn-lg scroll-link">
                            <i class="fas fa-users me-2"></i>Tim Kami
                        </a>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('{{ asset('assets/images/landing_page/landing3.jpg') }}');">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <div class="content-wrapper" data-aos="fade-up">
                        <h2 class="display-4 mb-4">Integritas dan Kepercayaan</h2>
                        <p class="lead mb-4">
                            Menjunjung tinggi prinsip-prinsip tata kelola yang baik 
                            untuk menjaga kepercayaan masyarakat.
                        </p>
                        <a href="#values" class="btn btn-primary btn-lg scroll-link">
                            <i class="fas fa-shield-alt me-2"></i>Nilai-Nilai Kami
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
    <!-- Improved Visi Misi Section -->
    <section class="about-section vision-mission">
        <div class="container">
            <div class="vision-mission-wrapper">
                <div class="vision-box" data-aos="fade-right">
                    <div class="vision-content">
                        <div class="icon-wrapper">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h2>Visi</h2>
                        <p>
                            Menjadi BPR yang terus berkembang sehingga dapat mensejahterakan 
                            masyarakat, karyawan dan pemilik.
                        </p>
                    </div>
                </div>
                <div class="mission-box" data-aos="fade-left">
                    <div class="mission-content">
                        <div class="icon-wrapper">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h2>Misi</h2>
                        <div class="mission-items">
                            <div class="mission-item">
                                <div class="mission-number">01</div>
                                <p>Menjadi mitra usaha masyarakat dengan memberikan pelayanan yang terbaik.</p>
                            </div>
                            <div class="mission-item">
                                <div class="mission-number">02</div>
                                <p>Menjadi BPR yang terkemuka dan diperhitungkan di Bali (5 besar di Bali).</p>
                            </div>
                            <div class="mission-item">
                                <div class="mission-number">03</div>
                                <p>Menjadi BPR pilihan nasabah dengan berupaya melayani di semua segmen 
                                dan tetap mempertahankan saling hormat menghormati.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section remains the same as it's well designed -->
    <!-- Motto Section - Added after carousel and before vision-mission -->
    <section class="about-section motto-section py-5">
        <div class="container">
            <div class="motto-wrapper text-center" data-aos="fade-up">
                <h2 class="section-title">Motto Kami</h2>
                <div class="motto-content p-4 bg-white rounded-lg shadow-lg">
                    <p class="lead fw-bold text-primary">
                        "Menjadi mitra keuangan yang terpercaya dan terdepan di industri perbankan khususnya BPR di Indonesia."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Mission Section remains the same -->
    <section class="about-section vision-mission">
        <!-- Existing vision-mission content -->
    </section>

    <!-- Corporate Culture Section - Added after vision-mission -->
    <section class="about-section culture-section py-5 bg-light">
        <div class="container">
            <div class="culture-wrapper" data-aos="fade-up">
                <h2 class="section-title text-center">Budaya Perusahaan</h2>
                <div class="culture-content p-4 bg-white rounded-lg shadow-lg">
                    <p class="text-center">
                        Budaya perusahaan yang sudah dibentuk saat ini adalah sesuai dengan prinsip tata kelola perusahaan yang baik, yaitu Transparan, Akuntabilitas, Responsibel, Independen dan Fair agar terbentuk citra yang baik bagi seluruh pemangku kepentingan (stakeholder).
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- History Section - Added after culture section -->
    <section class="about-section history-section py-5">
        <div class="container">
            <h2 class="section-title text-center" data-aos="fade-up">Sejarah Bank Perekonomian Rakyat Saraswati Eka Bumi</h2>
            
            <div class="history-intro mb-5" data-aos="fade-up">
                <p class="lead text-center">
                    Bank Perekonomian Rakyat Saraswati Eka Bumi, didirikan dengan tujuan untuk memberikan layanan keuangan yang inklusif dan berkelanjutan bagi masyarakat. Sejak awal berdirinya, kami telah mengutamakan pelayanan yang ramah, transparan, dan profesional kepada nasabah. Dengan fokus pada pemberdayaan ekonomi lokal, sehingga telah berhasil membangun hubungan yang kuat dengan nasabah dan masyarakat sekitar.
                </p>
            </div>

            <div class="timeline">
                <div class="timeline-item" data-aos="fade-right">
                    <div class="timeline-date">31 Oktober 1988</div>
                    <div class="timeline-content">
                        <p>Nyonya Made Martina Iswara, Tuan I Wayan Wikana, Nyonya Ni Made Wiryanti, Tuan Frans Nyoman Sudibya dan Tuan Doktorandus Yan Ketut Rantun Widhiarsa sepakat untuk menghadap Notaris Amir Sjarifuddin untuk mendirikan Perseroan Terbatas dengan nama Perseroan Terbatas Bank Perkreditan Rakyat atau disingkat PT. BPR Bhuwana Bhakti bertempat kedudukan di Desa/Kecamatan Kuta, Daerah Tingkat II Badung.</p>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-left">
                    <div class="timeline-date">14 Juni 1989</div>
                    <div class="timeline-content">
                        <p>Mendapat persetujuan prinsip pendirian Bank Perkreditan Rakyat dari Menteri Keuangan Republik Indonesia dengan surat nomor : S-731/MK.13/1989</p>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-right">
                    <div class="timeline-date">22 Desember 1989</div>
                    <div class="timeline-content">
                        <p>Dengan akta nomor 58 hal Perubahan Anggaran Dasar, diadakan perubahan pada nama perusahaan dari PR. BPR Bhuwana Bhakti menjadi PT. BPR Saraswati Ekabumi.</p>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-left">
                    <div class="timeline-date">12 Februari 1990</div>
                    <div class="timeline-content">
                        <p>Persetujuan atas akta pendirian Perseroan Terbatas Keputusan Menteri Kehakiman Republik Indonesia nomor : C2-715.HT.01.01.TH'90 tanggal 12 Pebruari 1990 memberikan persetujuan atas akta pendirian Perseroan Terbatas : Perseroan Terbatas Bank Perkreditan Rakyat Saraswati Ekabumi, disingkat P.T. BPR SARASWATI EKABUMI.</p>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-right">
                    <div class="timeline-date">28 Oktober 2021</div>
                    <div class="timeline-content">
                        <p>Akta nomor 43 tanggal 28 Oktober 2021 hal pernyataan keputusan rapat PT. BPR Saraswati Ekabumi dengan surat dari Kementerian Hukum Dan Hak Asasi Manusia Republik Indonesia nomor : AHU-AH.01.03-0466532.</p>
                    </div>
                </div>

                <div class="timeline-item" data-aos="fade-left">
                    <div class="timeline-date">14 Maret 2024</div>
                    <div class="timeline-content">
                        <p>Surat Keputusan Menteri Hukum dan hak Asasi Manusia NOMOR AHU-0016255.AH.01.02.TAHUN 2024 tentang Persetujuan Perubahan Anggaran Dasar Perseroan Terbatas PT. Bank Perekonomian Rakyat Saraswati Eka Bumi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Improved Ownership Structure Section -->
    <section class="about-section ownership">
        <div class="container">
            <h2 class="section-title text-center" data-aos="fade-up">Struktur Kepemilikan</h2>
            <div class="ownership-wrapper">
                @php
                $shareholders = [
                    [
                        'name' => 'M.A Cahyani Saraswati Dewi',
                        'role' => 'Pemegang Saham',
                        'share' => '33.3%',
                        'image' => getAvatarForPerson('M.A Cahyani Saraswati Dewi')
                    ],
                    [
                        'name' => 'M.I Dwi Wahyuni Saraswati',
                        'role' => 'Pemegang Saham Pengendali',
                        'share' => '33.4%',
                        'image' => getAvatarForPerson('M.I Dwi Wahyuni Saraswati')
                    ],
                    [
                        'name' => 'M.M Wulandari Tri Lestari',
                        'role' => 'Pemegang Saham',
                        'share' => '33.3%',
                        'image' => getAvatarForPerson('M.M Wulandari Tri Lestari')
                    ]
                ];
                @endphp
                
                @foreach($shareholders as $shareholder)
                <div class="ownership-card" data-aos="fade-up">
                    <div class="ownership-image">
                        <img src="{{ asset('assets/images/avatars/' . $shareholder['image']) }}" alt="{{ $shareholder['name'] }}">
                        <div class="share-percentage">{{ $shareholder['share'] }}</div>
                    </div>
                    <div class="ownership-info">
                        <h4>{{ $shareholder['name'] }}</h4>
                        <p>{{ $shareholder['role'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Improved Financial Stats -->
            <div class="financial-stats-wrapper">
                <div class="stats-grid">
                    @php
                    $finances = [
                        [
                            'label' => 'Modal Dasar',
                            'value' => '20 M',
                            'icon' => 'fa-coins'
                        ],
                        [
                            'label' => 'Modal Inti',
                            'value' => '24 M',
                            'icon' => 'fa-chart-line'
                        ],
                        [
                            'label' => 'Modal Disetor',
                            'value' => '15 M',
                            'icon' => 'fa-money-bill-wave'
                        ],
                        [
                            'label' => 'Total Aset',
                            'value' => '254 M',
                            'icon' => '- fa-seedling'
                        ]
                    ];
                    @endphp

                    @foreach($finances as $finance)
                    <div class="stat-item" data-aos="zoom-in">
                        <div class="stat-icon">
                            <i class="fas {{ $finance['icon'] }}"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $finance['value'] }}</h3>
                            <p>{{ $finance['label'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <br>
    <div class="header-line"></div>
    <!-- Unified Style for Management and Ownership -->
    <section class="about-section team-structure">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <h2 class="section-title">Tim Manajemen & Struktur Kepemilikan</h2>
                
                <p class="section-subtitle">Dipimpin oleh profesional berpengalaman dengan dukungan struktur kepemilikan yang kokoh</p>
            </div>

            <!-- Management Team -->
            <div class="team-grid">
                @php
                function getAvatarForPerson($name) {
                    // Get consistent number between 1-20 based on name
                    $nameHash = md5(strtolower($name));
                    $avatarNumber = (hexdec(substr($nameHash, 0, 8)) % 20) + 1;
                    
                    // Return avatar filename in the format "avatar (N).png"
                    return "avatar ({$avatarNumber}).png";
                }

                $management = [
                    [
                        'name' => 'I Wayan Sudarya, SP',
                        'role' => 'Direktur Utama',
                        'image' => getAvatarForPerson('I Wayan Sudarya')
                    ],
                    [
                        'name' => 'I Wayan Subadi, SE',
                        'role' => 'Direktur Kepatuhan',
                        'image' => getAvatarForPerson('I Wayan Subadi')
                    ],
                    [
                        'name' => 'M.I Dwi Wahyuni, SE.MM',
                        'role' => 'Komisaris Utama',
                        'image' => getAvatarForPerson('M.I Dwi Wahyuni')
                    ],
                    [
                        'name' => 'I Putu S Ari Adnyana, SE',
                        'role' => 'Komisaris',
                        'image' => getAvatarForPerson('I Putu S Ari Adnyana')
                    ]
                ];
                @endphp

                @foreach($management as $person)
                <div class="team-card management-card" data-aos="fade-up">
                    <div class="card-inner">
                        <div class="member-image">
                            <img src="{{ asset('assets/images/avatars/' . $person['image']) }}" alt="{{ $person['name'] }}">
                        </div>
                        <div class="member-info">
                            <h4>{{ $person['name'] }}</h4>
                            <p class="member-role">{{ $person['role'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </section>

    <!-- Improved Why Choose Us Section -->
    <section class="about-section why-choose-us">
        <div class="container">
            <h2 class="section-title text-center" data-aos="fade-up">Kenapa Memilih Kami?</h2>
            <div class="choose-us-grid">
                @php
                $advantages = [
                    [
                        'title' => 'Kinerja Keuangan yang Kokoh',
                        'description' => 'Kami berhasil mencatat pertumbuhan yang stabil dan konsisten dalam aset, laba, dan pertumbuhan bisnis secara keseluruhan.',
                        'icon' => 'fa-chart-pie'
                    ],
                    [
                        'title' => 'Kontribusi Terhadap Pengembangan Ekonomi Lokal',
                        'description' => 'Kami aktif dalam program pemberdayaan ekonomi masyarakat, pendidikan keuangan, dan kegiatan sosial.',
                        'icon' => 'fa-hand-holding-heart
'
                    ],
                    [
                        'title' => 'Inovasi Produk dan Layanan',
                        'description' => 'Senantiasa menghadirkan produk-produk yang kompetitif dan sesuai dengan tren pasar terkini.',
                        'icon' => 'fa-lightbulb'
                    ],
                    [
                        'title' => 'Komitmen Terhadap Kualitas Layanan',
                        'description' => 'Tim profesional kami memberikan solusi keuangan yang sesuai dengan kebutuhan nasabah.',
                        'icon' => 'fa-star'
                    ]
                ];
                @endphp

                @foreach($advantages as $advantage)
                <div class="choose-us-card" data-aos="fade-up">
                    <div class="icon-box">
                        <i class="fas {{ $advantage['icon'] }}"></i>
                    </div>
                    <div class="content">
                        <h4>{{ $advantage['title'] }}</h4>
                        <p>{{ $advantage['description'] }}</p>
                    </div>
                </div>
                @endforeach
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
    <!-- Contact section and footer remain the same -->
</div>
@endsection

@push('styles')
<style>

/* Added Motto Section Styles */
.motto-section {
    background-color: #f8f9fa;
}

.motto-content {
    max-width: 800px;
    margin: 0 auto;
    border-left: 5px solid var(--primary-color);
}

/* Added History Timeline Styles */
.timeline {
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 0;
}

.timeline::after {
    content: '';
    position: absolute;
    width: 6px;
    background-color: var(--primary-color);
    top: 0;
    bottom: 0;
    left: 50%;
    margin-left: -3px;
    border-radius: 3px;
}

.timeline-item {
    padding: 10px 40px;
    position: relative;
    width: 50%;
    margin-bottom: 30px;
}

.timeline-item:nth-child(odd) {
    left: 0;
}

.timeline-item:nth-child(even) {
    left: 50%;
}

.timeline-date {
    background: var(--primary-color);
    color: white;
    padding: 10px 20px;
    border-radius: 20px;
    display: inline-block;
    margin-bottom: 15px;
    font-weight: bold;
}

.timeline-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.timeline-item::before {
    content: '';
    position: absolute;
    width: 25px;
    height: 25px;
    background-color: white;
    border: 4px solid var(--primary-color);
    border-radius: 50%;
    top: 15px;
    z-index: 1;
}

.timeline-item:nth-child(odd)::before {
    right: -12px;
}

.timeline-item:nth-child(even)::before {
    left: -13px;
}

@media screen and (max-width: 768px) {
    .timeline::after {
        left: 31px;
    }
    
    .timeline-item {
        width: 100%;
        padding-left: 70px;
        padding-right: 25px;
    }
    
    .timeline-item:nth-child(even) {
        left: 0;
    }
    
    .timeline-item::before {
        left: 18px;
    }
}

/* Culture Section Styles */
.culture-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.culture-content {
    max-width: 900px;
    margin: 0 auto;
    line-height: 1.8;
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
    background: linear-gradient(135deg, rgba(42, 78, 197, 0.8), rgba(0, 0, 0, 0.6));
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

.content-wrapper {
    max-width: 800px;
    margin: 0 auto;
}
    .about-hero {
    background: linear-gradient(135deg, rgba(42, 78, 197, 0.95), rgba(30, 58, 138, 0.9));
    min-height: 80vh;
    display: flex;
    align-items: center;
    color: white;
    position: relative;
}

.hero-content {
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
    padding: 4rem 0;
}

.hero-description {
    background: rgba(255, 255, 255, 0.1);
    padding: 2rem;
    border-radius: 20px;
    backdrop-filter: blur(10px);
    margin-top: 2rem;
}

/* Section Header */
.section-header {
    margin-bottom: 4rem;
}

.header-line {
    width: 100px;
    height: 4px;
    background: var(--primary-color);
    margin: 1rem auto;
    border-radius: 2px;
}

.section-subtitle {
    color: #666;
    max-width: 700px;
    margin: 1rem auto 0;
}

/* Unified Team Cards */
.team-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    padding: 2rem 0;
}

.team-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.member-image {
    position: relative;
    height: 300px;
    overflow: hidden;
}

.member-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.3s ease;
}

.team-card:hover .member-image img {
    transform: scale(1.1);
}

.share-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: var(--primary-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: bold;
}

.member-info {
    padding: 1.5rem;
    text-align: center;
    background: white;
}

.member-info h4 {
    margin: 0;
    color: var(--primary-dark);
    font-size: 1.2rem;
}

.member-role {
    color: #666;
    margin: 0.5rem 0 0;
    font-size: 0.9rem;
}

/* Footer Enhancements */
.footer {
    background: linear-gradient(135deg, #1a237e, #283593);
}

.social-links a {
    transition: all 0.3s ease;
}

.social-links a:hover {
    color: var(--primary-light) !important;
    transform: translateY(-3px);
}

/* Responsive Adjustments */
@media (max-width: 1200px) {
    .team-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .hero-content {
        padding: 2rem 1rem;
    }
    
    .team-grid {
        grid-template-columns: 1fr;
        padding: 1rem;
    }
    
    .member-image {
        height: 250px;
    }
}
:root {
    --primary-color: #2a4ec5;
    --primary-dark: #1e3a8a;
    --primary-light: #3b82f6;
    --secondary-color: #f59e0b;
    --transition-base: all 0.3s ease;
}

/* Vision Mission Section */
.vision-mission-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    padding: 2rem;
}

.vision-box, .mission-box {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    height: 100%;
}

.icon-wrapper {
    width: 80px;
    height: 80px;
    background: var(--primary-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.icon-wrapper i {
    font-size: 2rem;
    color: white;
}

.mission-items {
    margin-top: 2rem;
}

.mission-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.mission-number {
    font-size: 1.5rem;
    font-weight: bold;
    color: var(--primary-color);
    min-width: 50px;
}

/* Ownership Section */
.ownership-wrapper {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    margin-bottom: 4rem;
}

.ownership-card {
    position: relative;
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: var(--transition-base);
}

.ownership-card:hover {
    transform: translateY(-10px);
}

.ownership-image {
    position: relative;
    height: 300px;
}

.ownership-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.share-percentage {
    position: absolute;
    top: 20px;
    right: 20px;
    background: var(--primary-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: bold;
}

.ownership-info {
    padding: 1.5rem;
    text-align: center;
}

/* Financial Stats */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    margin-top: 4rem;
}

.stat-item {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: var(--transition-base);
}

.stat-item:hover {
    transform: translateY(-10px);
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: var(--primary-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}

.stat-icon i {
    font-size: 1.5rem;
    color: white;
}

.stat-content h3 {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

/* Management Section */
.management-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    padding: 2rem;
}

.management-card {
    position: relative;
    height: 400px;
    perspective: 1000px;
}

.card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    border-radius: 20px;
    overflow: hidden;
}

.card-front img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);{
    padding: 2rem;
    color: white;
    transform: translateY(100%);
    transition: var(--transition-base);
}

.management-card:hover .overlay {
    transform: translateY(0);
}

.overlay h4 {
    margin-bottom: 0.5rem;
    font-size: 1.2rem;
}

/* Why Choose Us Section */
.choose-us-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    padding: 2rem;
}

.choose-us-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: var(--transition-base);
}

.choose-us-card:hover {
    transform: translateY(-10px);
}

.icon-box {
    width: 70px;
    height: 70px;
    background: var(--primary-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.icon-box i {
    font-size: 1.8rem;
    color: white;
}

.choose-us-card h4 {
    margin-bottom: 1rem;
    color: var(--primary-dark);
}

.choose-us-card p {
    color: #666;
    line-height: 1.6;
}

/* Section Title Styles */
.section-title {
    position: relative;
    padding-bottom: 2rem;
    margin-bottom: 4rem;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: var(--primary-color);
    border-radius: 2px;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .stats-grid,
    .choose-us-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .management-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 992px) {
    .vision-mission-wrapper {
        grid-template-columns: 1fr;
    }
    
    .ownership-wrapper {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .management-card {
        height: 350px;
    }
}

@media (max-width: 768px) {
    .ownership-wrapper,
    .stats-grid,
    .choose-us-grid {
        grid-template-columns: 1fr;
    }
    
    .management-grid {
        grid-template-columns: 1fr;
        padding: 1rem;
    }
    
    .management-card {
        height: 400px;
    }
    
    .vision-box, 
    .mission-box {
        padding: 1.5rem;
    }
    
    .icon-wrapper {
        width: 60px;
        height: 60px;
    }
    
    .stat-item {
        padding: 1.5rem;
    }
}

/* Animation Classes */
.fade-up {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

.fade-up.visible {
    opacity: 1;
    transform: translateY(0);
}

/* Additional Enhancement Styles */
.section-bg-pattern {
    position: relative;
    overflow: hidden;
}

.section-bg-pattern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, var(--primary-light) 25%, transparent 25%) -50px 0,
                linear-gradient(-45deg, var(--primary-light) 25%, transparent 25%) -50px 0,
                linear-gradient(45deg, transparent 75%, var(--primary-light) 75%),
                linear-gradient(-45deg, transparent 75%, var(--primary-light) 75%);
    background-size: 100px 100px;
    opacity: 0.05;
    z-index: 0;
}

/* Hover Effects */
.vision-box:hover,
.mission-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.stat-item:hover .stat-icon {
    transform: scale(1.1);
}

.choose-us-card:hover .icon-box {
    background: var(--primary-dark);
}

/* Loading Animation */
@keyframes cardPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.card-loading {
    animation: cardPulse 2s infinite;
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
    // Initialize AOS with custom settings
    AOS.init({
        duration: 1000,
        once: false,
        mirror: false,
        offset: 50,
        easing: 'ease-out-cubic'
    });

    // Add smooth scroll behavior
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

    // Add intersection observer for fade effects
    const observerOptions = {
        root: null,
        threshold: 0.1,
        rootMargin: '0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

    // Add hover effect for management cards
    document.querySelectorAll('.management-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.querySelector('.overlay').style.transform = 'translateY(0)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.querySelector('.overlay').style.transform = 'translateY(100%)';
        });
    });


});
document.addEventListener('DOMContentLoaded', function() {
    // Carousel Configuration
    const heroCarousel = new bootstrap.Carousel(document.querySelector('#heroCarousel'), {
        interval: 5000,
        touch: true,
        pause: 'hover'
    });

    // Smooth Scroll for Navigation Links
    document.querySelectorAll('.scroll-link').forEach(anchor => {
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
});

</script>
@endpush