
@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
{{-- <div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <!-- Slider Insights -->
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
                <div class="overflow-hidden d-slider1 ">
                    <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-01" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                                        <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Total Pegawai</p>
                                        <h4 id="total-pegawai" class="counter">0</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-02" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                                        <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Pegawai Aktif</p>
                                        <h4 id="pegawai-aktif" class="counter">0</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-03" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                                        <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">User Aktif</p>
                                        <h4 id="user-aktif" class="counter">0</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div id="circle-progress-04" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="60" data-type="percent">
                                        <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Divisi Terbanyak</p>
                                        <h4 id="divisi-terbanyak" class="counter">-</h4>
                                        <small id="divisi-terbanyak-jumlah">0 Pegawai</small>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="swiper-button swiper-button-next"></div>
                    <div class="swiper-button swiper-button-prev"></div>
                </div>
            </div>
        </div>

        <!-- Grafik & Tabel -->
        <div class="col-md-12 col-lg-8">
         <div class="row">
             <!-- Komposisi Pegawai per Divisi -->
             <div class="col-md-12 col-xl-6">
                 <div class="card" data-aos="fade-up" data-aos-delay="900">
                     <div class="flex-wrap card-header d-flex justify-content-between">
                         <div class="header-title">
                             <h4 class="card-title">Komposisi Pegawai per Divisi</h4>            
                         </div>
                         <div class="dropdown">
                             <a href="#" class="text-gray dropdown-toggle" id="divisiDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                 Filter
                             </a>
                             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="divisiDropdown">
                                 <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                                 <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                             </ul>
                         </div>
                     </div>
                     <div class="card-body">
                         <div class="flex-wrap d-flex align-items-center justify-content-between">
                             <div id="divisi-chart" class="col-md-12 col-lg-12" style="height: 500px;"></div>
                         </div>
                     </div>
                 </div>
             </div>

             <!-- Komposisi Pegawai per Jabatan -->
             <div class="col-md-12 col-xl-6">
                 <div class="card" data-aos="fade-up" data-aos-delay="1000">
                     <div class="flex-wrap card-header d-flex justify-content-between">
                         <div class="header-title">
                             <h4 class="card-title">Komposisi Jabatan</h4>
                         </div>
                         <div class="dropdown">
                             <a href="#" class="text-gray dropdown-toggle" id="jabatanDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                 Filter
                             </a>
                             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="jabatanDropdown">
                                 <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                                 <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                             </ul>
                         </div>
                     </div>
                     <div class="card-body">
                         <div class="flex-wrap d-flex align-items-center justify-content-between">
                             <div id="jabatan-chart" class="col-md-12 col-lg-12" style="height: 500px;"></div>
                         </div>
                     </div>
                 </div>
             </div>

             <!-- Ringkasan Pegawai -->
             <div class="col-md-12 col-lg-12">
                 <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                     <div class="flex-wrap card-header d-flex justify-content-between">
                         <div class="header-title">
                             <h4 class="mb-2 card-title">Ringkasan Pegawai</h4>
                         </div>
                     </div>
                     <div class="p-0 card-body">
                         <div class="mt-4 table-responsive">
                             <table id="pegawai-summary" class="table mb-0 table-striped">
                                 <thead>
                                     <tr>
                                         <th>Nama Pegawai</th>
                                         <th>Jabatan</th>
                                         <th>Divisi</th>
                                         <th>Tanggal Masuk</th>
                                         <th>Status</th>
                                     </tr>
                                 </thead>
                                 <tbody id="pegawai-summary-body">
                                     <!-- Rows will be populated here -->
                                 </tbody>
                             </table>
                             <nav>
                                 <ul id="pagination" class="pagination justify-content-center">
                                     <!-- Pagination will be populated here -->
                                 </ul>
                             </nav>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    const ITEMS_PER_PAGE = 10;
    let currentPage = 1;
    let totalPegawai = [];
    let divisiData = []; // Store predefined divisi data

    // Predefined Divisi Data
    const DIVISI_LIST = [
        {id_divisi: 1, nama_divisi: "Komisaris"},
        {id_divisi: 2, nama_divisi: "Direksi"},
        {id_divisi: 3, nama_divisi: "Kredit"},
        {id_divisi: 4, nama_divisi: "Dana"},
        {id_divisi: 5, nama_divisi: "Operasional"},
        {id_divisi: 6, nama_divisi: "Legal"},
        {id_divisi: 7, nama_divisi: "IT"},
        {id_divisi: 8, nama_divisi: "SDM"},
        {id_divisi: 9, nama_divisi: "Umum"},
        {id_divisi: 10, nama_divisi: "Accounting & Keuangan"},
        {id_divisi: 11, nama_divisi: "Marketing"},
        {id_divisi: 12, nama_divisi: "Pengawasan Kredit"},
        {id_divisi: 13, nama_divisi: "SPI"},
        {id_divisi: 14, nama_divisi: "Kepatuhan"}
    ];

    async function fetchDashboardData() {
        try {
            const [pegawaiResponse, userResponse] = await Promise.all([
                fetch('http://127.0.0.1:8000/api/pegawai', {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                }),
                fetch('http://127.0.0.1:8000/api/users', {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                })
            ]);

            const pegawaiData = await pegawaiResponse.json();
            const userData = await userResponse.json();

            // Comprehensive Statistics Calculation
            const stats = calculateComprehensiveStats(pegawaiData.data, userData);

            // Update Dashboard Cards
            updateDashboardCards(stats);

            // Store total pegawai data for pagination
            totalPegawai = pegawaiData.data;

            // Enhanced Charts with Color Schemes
            createEnhancedPieCharts(pegawaiData.data);

            // Detailed Summary Table
            createDetailedPegawaiSummary();
            createPagination();

        } catch (error) {
            console.error('Dashboard Data Fetch Error:', error);
            handleErrorDisplay(error);
        }
    }

    function calculateComprehensiveStats(pegawaiData, userData) {
        const totalPegawaiCount = pegawaiData.length;
        const aktivPegawai = pegawaiData.filter(p => p.status_kepegawaian === 'aktif').length;
        const userAktif = userData.filter(u => u.status === 'aktif').length;

        const divisiStats = calculateDivisiStats(pegawaiData);
        const jabatanStats = calculateJabatanStats(pegawaiData);

        return {
            totalPegawai: totalPegawaiCount,
            aktivPegawai: aktivPegawai,
            userAktif: userAktif,
            divisiTerbanyak: divisiStats.terbanyak,
            jabatanTerbanyak: jabatanStats.terbanyak,
            divisiComposition: divisiStats.composition,
            jabatanComposition: jabatanStats.composition
        };
    }

    function calculateDivisiStats(pegawaiData) {
        const divisiCount = {};
        DIVISI_LIST.forEach(divisi => {
            divisiCount[divisi.nama_divisi] = 0;
        });

        pegawaiData.forEach(pegawai => {
            const namaDivisi = pegawai.divisi.nama_divisi;
            divisiCount[namaDivisi]++;
        });

        const terbanyak = Object.entries(divisiCount).reduce((a, b) => 
            b[1] > a[1] ? { nama: b[0], jumlah: b[1] } : a, 
            { nama: '', jumlah: 0 }
        );

        return {
            terbanyak: terbanyak,
            composition: Object.entries(divisiCount).map(([name, count]) => ({ name, count }))
        };
    }

    function calculateJabatanStats(pegawaiData) {
        const jabatanCount = {};
        pegawaiData.forEach(pegawai => {
            const namaJabatan = pegawai.jabatan.nama_jabatan;
            jabatanCount[namaJabatan] = (jabatanCount[namaJabatan] || 0) + 1;
        });

        const terbanyak = Object.entries(jabatanCount).reduce((a, b) => 
            b[1] > a[1] ? { nama: b[0], jumlah: b[1] } : a, 
            { nama: '', jumlah: 0 }
        );

        return {
            terbanyak: terbanyak,
            composition: Object.entries(jabatanCount).map(([name, count]) => ({ name, count }))
        };
    }

    // Add this inside your fetchDashboardData function, replacing the previous card update logic
function updateDashboardCards(stats) {
    const cardConfigurations = [
        {
            id: 'total-pegawai',
            title: 'Total Pegawai',
            value: stats.totalPegawai,
            icon: 'users',
            progressClass: 'circle-progress-primary',
            progressValue: 90,
            trend: 'up'
        },
        {
            id: 'pegawai-aktif',
            title: 'Pegawai Aktif',
            value: stats.aktivPegawai,
            icon: 'user-check',
            progressClass: 'circle-progress-info',
            progressValue: 80,
            trend: 'up'
        },
        {
            id: 'user-aktif',
            title: 'User Aktif',
            value: stats.userAktif,
            icon: 'monitor',
            progressClass: 'circle-progress-success',
            progressValue: 70,
            trend: 'up'
        },
        {
            id: 'divisi-terbanyak',
            title: 'Divisi Terbanyak',
            value: stats.divisiTerbanyak.nama,
            subValue: `${stats.divisiTerbanyak.jumlah} Pegawai`,
            icon: 'briefcase',
            progressClass: 'circle-progress-warning',
            progressValue: 60,
            trend: 'neutral'
        }
    ];

    const swiper = document.querySelector('.d-slider1 .swiper-wrapper');
    swiper.innerHTML = ''; // Clear existing slides

    cardConfigurations.forEach(card => {
        const slideElement = document.createElement('li');
        slideElement.classList.add('swiper-slide', 'card', 'card-slide');
        slideElement.setAttribute('data-aos', 'fade-up');
        slideElement.setAttribute('data-aos-delay', '700');

        slideElement.innerHTML = `
            <div class="card-body">
                <div class="progress-widget">
                    <div id="${card.id}-progress" 
                         class="text-center circle-progress-01 circle-progress ${card.progressClass}" 
                         data-min-value="0" 
                         data-max-value="100" 
                         data-value="${card.progressValue}" 
                         data-type="percent">
                        <svg class="card-slide-arrow icon-24" width="24" viewBox="0 0 24 24">
                            <path fill="currentColor" 
                                  d="${getTrendIcon(card.trend)}" />
                        </svg>
                    </div>
                    <div class="progress-detail">
                        <p class="mb-2">${card.title}</p>
                        <h4 id="${card.id}" class="counter">${card.value}</h4>
                        ${card.subValue ? `<small id="${card.id}-sub">${card.subValue}</small>` : ''}
                    </div>
                </div>
            </div>
        `;

        swiper.appendChild(slideElement);
    });

    // Reinitialize Swiper after dynamically adding slides
    new Swiper('.d-slider1', {
        slidesPerView: 4,
        spaceBetween: 20,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            320: { slidesPerView: 1 },
            550: { slidesPerView: 2 },
            750: { slidesPerView: 3 },
            1100: { slidesPerView: 4 }
        }
    });
}

// Helper function to get trend icons
function getTrendIcon(trend) {
    const trendIcons = {
        'up': 'M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z',
        'down': 'M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z',
        'neutral': 'M12,2C6.48,2 2,6.48 2,12C2,17.52 6.48,22 12,22C17.52,22 22,17.52 22,12C22,6.48 17.52,2 12,2Z'
    };
    return trendIcons[trend] || trendIcons['neutral'];
}

    function createEnhancedPieCharts(pegawaiData) {
        const colorPalettes = {
            divisi: [
                '#3366CC', '#DC3912', '#FF9900', '#109618', 
                '#990099', '#0099C6', '#DD4477', '#66AA00'
            ],
            jabatan: [
                '#1F77B4', '#FF7F0E', '#2CA02C', '#D62728', 
                '#9467BD', '#8C564B', '#E377C2', '#7F7F7F'
            ]
        };

        const chartConfigurations = [
            { elementId: 'divisi-chart', type: 'Divisi', palette: colorPalettes.divisi },
            { elementId: 'jabatan-chart', type: 'Jabatan', palette: colorPalettes.jabatan }
        ];

        chartConfigurations.forEach(config => {
            const countData = {};
            pegawaiData.forEach(pegawai => {
                const key = config.type === 'Divisi' 
                    ? pegawai.divisi.nama_divisi 
                    : pegawai.jabatan.nama_jabatan;
                countData[key] = (countData[key] || 0) + 1;
            });

            const chartData = {
                series: Object.values(countData),
                labels: Object.keys(countData)
            };

            const options = {
                series: chartData.series,
                labels: chartData.labels,
                colors: config.palette.slice(0, chartData.series.length),
                chart: {
                    type: 'pie',
                    height: 500,
                    width: '100%'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: { width: '100%' },
                        legend: { position: 'bottom' }
                    }
                }],
                legend: {
                    position: 'right',
                    offsetY: 0,
                    height: 500
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                total: { show: true, label: config.type }
                            }
                        }
                    }
                }
            };

            const chart = new ApexCharts(
                document.querySelector(`#${config.elementId}`), 
                options
            );
            chart.render();
        });
    }

    function createDetailedPegawaiSummary() {
        const tableBody = document.getElementById('pegawai-summary-body');
        tableBody.innerHTML = '';

        const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
        const endIndex = startIndex + ITEMS_PER_PAGE;
        const paginatedData = totalPegawai.slice(startIndex, endIndex);

        paginatedData.forEach(pegawai => {
            const row = document.createElement('tr');
            row.classList.add('hover:bg-gray-100', 'transition', 'duration-200');
            row.innerHTML = `
                <td class="px-4 py-2 font-medium">${pegawai.nama_lengkap}</td>
                <td class="px-4 py-2">${pegawai.jabatan.nama_jabatan}</td>
                <td class="px-4 py-2">${pegawai.divisi.nama_divisi}</td>
                <td class="px-4 py-2">${formatDate(pegawai.tanggal_masuk)}</td>
                <td class="px-4 py-2">
                    <span class="badge ${getStatusClass(pegawai.status_kepegawaian)}">
                        ${pegawai.status_kepegawaian}
                    </span>
                </td>
            `;
            tableBody.appendChild(row);
        });
    }

    function formatDate(dateString) {
        return new Date(dateString).toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }

    function getStatusClass(status) {
        const statusClasses = {
            'aktif': 'bg-green-100 text-green-800',
            'tidak aktif': 'bg-red-100 text-red-800',
            'default': 'bg-gray-100 text-gray-800'
        };
        return statusClasses[status.toLowerCase()] || statusClasses['default'];
    }

    function handleErrorDisplay(error) {
        const errorContainer = document.createElement('div');
        errorContainer.classList.add('alert', 'alert-danger');
        errorContainer.textContent = `Error Loading Dashboard: ${error.message}`;
        document.body.prepend(errorContainer);
    }

    function createPagination() {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = ''; // Clear existing pagination

    const totalPages = Math.ceil(totalPegawai.length / ITEMS_PER_PAGE);

    // Pagination Strategy:
    // 1. Always show first and last page
    // 2. Show current page and adjacent pages
    // 3. Use ellipsis (...) for skipped pages

    function createPageButton(pageNum, isActive = false, isDisabled = false) {
        const li = document.createElement('li');
        li.classList.add('page-item');
        
        if (isActive) li.classList.add('active');
        if (isDisabled) li.classList.add('disabled');

        const link = document.createElement('a');
        link.classList.add('page-link');
        link.href = '#';
        link.textContent = pageNum;

        if (!isDisabled && !isActive) {
            link.addEventListener('click', () => {
                currentPage = pageNum;
                createPegawaiSummary();
                createPagination();
            });
        }

        li.appendChild(link);
        return li;
    }

    function createEllipsis() {
        const li = document.createElement('li');
        li.classList.add('page-item', 'disabled');
        const span = document.createElement('span');
        span.classList.add('page-link');
        span.textContent = '...';
        li.appendChild(span);
        return li;
    }

    // Previous button
    const prevLi = document.createElement('li');
    prevLi.classList.add('page-item', currentPage === 1 ? 'disabled' : '');
    const prevLink = document.createElement('a');
    prevLink.classList.add('page-link');
    prevLink.href = '#';
    prevLink.innerHTML = '&laquo;'; // Left arrow
    prevLink.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            createPegawaiSummary();
            createPagination();
        }
    });
    prevLi.appendChild(prevLink);
    pagination.appendChild(prevLi);

    // Intelligent page number generation
    const generatePageNumbers = () => {
        const pageNumbers = [];

        // Always show first page
        if (currentPage > 2) {
            pagination.appendChild(createPageButton(1));
            if (currentPage > 3) {
                pagination.appendChild(createEllipsis());
            }
        }

        // Generate range of pages around current page
        const startPage = Math.max(1, currentPage - 1);
        const endPage = Math.min(totalPages, currentPage + 1);

        for (let i = startPage; i <= endPage; i++) {
            pagination.appendChild(createPageButton(i, i === currentPage));
        }

        // Always show last page
        if (currentPage < totalPages - 1) {
            if (currentPage < totalPages - 2) {
                pagination.appendChild(createEllipsis());
            }
            pagination.appendChild(createPageButton(totalPages));
        }
    };

    generatePageNumbers();

    // Next button
    const nextLi = document.createElement('li');
    nextLi.classList.add('page-item', currentPage === totalPages ? 'disabled' : '');
    const nextLink = document.createElement('a');
    nextLink.classList.add('page-link');
    nextLink.href = '#';
    nextLink.innerHTML = '&raquo;'; // Right arrow
    nextLink.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            createPegawaiSummary();
            createPagination();
        }
    });
    nextLi.appendChild(nextLink);
    pagination.appendChild(nextLi);

    // Styling for better visual hierarchy
    pagination.classList.add('flex', 'items-center', 'justify-center', 'space-x-2');
}

     fetchDashboardData(); // Call this function to fetch data and populate the dashboard
 });
</script> --}}
@endsection