<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HRMS SEB - @yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo_app.png') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="{{ asset('assets/css/core/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/hope-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dark.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customizer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rtl.min.css') }}">
    
    <!-- Fullcalendar CSS -->
    <link rel='stylesheet' href='{{ asset('assets/css/fullcalendar/core/main.css') }}' />
    <link rel='stylesheet' href='{{ asset('assets/css/fullcalendar/daygrid/main.css') }}' />
    <link rel='stylesheet' href='{{ asset('assets/css/fullcalendar/timegrid/main.css') }}' />
    
    <!-- Third-party CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link href='https://unpkg.com/@fullcalendar/core@5.10.1/main.min.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/daygrid@5.10.1/main.min.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/timegrid@5.10.1/main.min.css' rel='stylesheet' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 80px;
            --transition-speed: 0.3s;
        }


        .wrapper {
            display: flex;
            height: 100vh;
            width: 100%;
            
        }
        .content-wrapper {
            flex-grow: 1;
            
            height: calc(100vh - [height of navbar]); /* Adjust height based on navbar */
        }
        .sidebar-container {
            transition: all var(--transition-speed) ease;
            overflow: hidden;
        }

        .sidebar-container.collapsed {
            width: var(--sidebar-collapsed-width) !important;
            max-width: var(--sidebar-collapsed-width) !important;
            min-width: var(--sidebar-collapsed-width) !important;
        }

        .sidebar-container.collapsed .sidebar-body {
            overflow-x: hidden;
        }

        .sidebar-container.collapsed .nav-item span.item-name,
        .sidebar-container.collapsed .nav-item .right-icon,
        .sidebar-container.collapsed .nav-item .static-item .default-icon,
        .sidebar-container.collapsed .sidebar-header .logo-title,
        .sidebar-container.collapsed .sidebar-header .logo-normal {
            display: none;
        }

        .sidebar-container.collapsed .sidebar-header .logo-mini {
            display: block !important;
        }

        .sidebar-body {
            flex-grow: 1;
            overflow-y: auto;
            overflow-x: hidden;
            transition: all var(--transition-speed) ease;
        }

        .content-wrapper {
            transition: all var(--transition-speed) ease;
            width: calc(100% - var(--sidebar-width)); /* Tambahkan ini */
            
        }

        .content-wrapper.sidebar-collapsed {
            width: calc(100% - var(--sidebar-collapsed-width));

        }

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .sidebar-container {
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                transform: translateX(-100%);
                transition: transform var(--transition-speed) ease;
                box-shadow: 0 0 20px rgba(0,0,0,0.1);
            }

            .sidebar-container.collapsed {
                transform: translateX(0);
                width: 250px !important;
                max-width: 250px !important;
                min-width: 250px !important;
            }

            .content-wrapper {
                width: 100%;
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Loader -->
    @include('layouts.partials.loader')

    <div class="wrapper">
        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        <!-- Sidebar Container -->
        <div id="sidebar-container" class="sidebar-container">
            <div id="admin-sidebar" style="display:none;">
                @include('layouts.partials.sidebar')
            </div>
            <div id="hrd-sidebar" style="display:none;">
                @include('layouts.partials.hrd_sidebar')
            </div>
            <div id="pegawai-sidebar" style="display:none;">
                @include('layouts.partials.pegawai_sidebar')
            </div>
        </div>
        
        <!-- Content Wrapper -->
        <div class="content-wrapper" id="content-wrapper">
            <!-- Navbar -->
            <div class="navbar-container">
                @include('layouts.partials.navbar')
            </div>
            
            <!-- Main Content -->
            <main class="main-content" id="main-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
            
            <!-- Footer -->
            @include('layouts.partials.footer')
        </div>
    </div>

    <!-- JavaScript Dependencies -->
    <script src="{{ asset('assets/js/core/libs.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/external.min.js') }}"></script>
    
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- FullCalendar -->
    <script src='https://unpkg.com/@fullcalendar/core@5.10.1/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/daygrid@5.10.1/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/timegrid@5.10.1/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/interaction@5.10.1/main.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- App Scripts -->
<!-- Verify these paths -->
<script src="{{ asset('assets/js/hope-ui.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sidebar.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/hope-ui.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables Core -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>

<!-- Tambahan ekstensi untuk tombol -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

<!-- jsPDF untuk PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<!-- html2canvas untuk menangkap elemen HTML -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<!-- SheetJS untuk Excel dan CSV -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <!-- Authentication and Role Management Script -->
    <script>

// Fungsi toggle sidebar yang sudah ada di master layout
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar-container');
    const contentWrapper = document.getElementById('content-wrapper');
    const screenWidth = window.innerWidth;

    // Log variabel CSS untuk debugging
    const rootStyles = getComputedStyle(document.documentElement);
    const sidebarWidth = rootStyles.getPropertyValue('--sidebar-width').trim();
    const collapsedWidth = rootStyles.getPropertyValue('--sidebar-collapsed-width').trim();

    console.log('CSS Sidebar Width:', sidebarWidth);
    console.log('CSS Collapsed Width:', collapsedWidth);

    // Log sebelum toggle
    console.log('Sebelum Toggle:');
    console.log('Sidebar Width:', sidebar.offsetWidth + 'px');
    console.log('Content Wrapper Width:', contentWrapper.offsetWidth + 'px');
    console.log('Sidebar Class:', sidebar.classList.contains('collapsed') ? 'Collapsed' : 'Expanded');

    const isCollapsed = sidebar.classList.contains('collapsed');

    if (screenWidth > 992) {
        if (isCollapsed) {
            // Expand
            sidebar.classList.remove('collapsed');
            contentWrapper.classList.remove('sidebar-collapsed');
        } else {
            // Collapse
            sidebar.classList.add('collapsed');
            contentWrapper.classList.add('sidebar-collapsed');
        }
    } else {
        // Mobile view logic
        if (isCollapsed) {
            sidebar.style.transform = 'translateX(-100%)';
            sidebar.classList.remove('collapsed');
            contentWrapper.style.width = '100%';
            contentWrapper.style.marginLeft = '0';
        } else {
            sidebar.style.transform = 'translateX(0)';
            sidebar.classList.add('collapsed');
            contentWrapper.style.width = '100%';
            contentWrapper.style.marginLeft = '0';
        }
    }

    // Log setelah toggle
    setTimeout(() => {
        console.log('\nSetelah Toggle:');
        console.log('Sidebar Width:', sidebar.offsetWidth + 'px');
        console.log('Content Wrapper Width:', contentWrapper.offsetWidth + 'px');
        console.log('Sidebar Class:', sidebar.classList.contains('collapsed') ? 'Collapsed' : 'Expanded');
        console.log('----------------------------');
    }, 300);
}

// Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar-container');
    const contentWrapper = document.getElementById('content-wrapper');

    // Pantau perubahan
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                console.log('Sidebar Class Changed');
                console.log('Current Sidebar Width:', sidebar.offsetWidth + 'px');
                console.log('Current Content Wrapper Width:', contentWrapper.offsetWidth + 'px');
            }
        });
    });

    observer.observe(sidebar, { attributes: true });
});




document.addEventListener('DOMContentLoaded', function() {
    const token = localStorage.getItem('token');
    
    if (token) {
        fetch('{{ url("/api/auth/me") }}', {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch user data');
            }
            return response.json();
        })
        .then(userData => {
            const roleId = userData.user.id_role;
            
            // Hide all sidebars first
            const adminSidebar = document.getElementById('admin-sidebar');
            const hrdSidebar = document.getElementById('hrd-sidebar');
            const pegawaiSidebar = document.getElementById('pegawai-sidebar');

            // Show the correct sidebar based on role
            switch(roleId) {
                case 1: // Admin
                    adminSidebar.style.display = 'block';
                    break;
                case 2: // HRD
                    hrdSidebar.style.display = 'block';
                    break;
                case 3: // Pegawai
                    pegawaiSidebar.style.display = 'block';
                    break;
                default:
                    console.error('Unknown role:', roleId);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Invalid user role'
                    });
                    return;
            }
        })
        .catch(error => {
            console.error('Error fetching user role:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to load user data',
                didClose: () => {
                    window.location.href = '{{ url("/login") }}';
                }
            });
        });
    } else {
        // Redirect to login if no token
        window.location.href = '{{ url("/login") }}';
    }
});
    </script>

    <!-- Flash Messages Script -->
    <script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 2000,
            timerProgressBar: true
        });
    @endif
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{{ session('error') }}",
            timer: 2000,
            timerProgressBar: true
        });
    @endif
    </script>
<script>
    const BASE_URL = "{{ env('APP_URL') }}";
    const API_BASE_URL = "{{ env('API_BASE_URL') }}";
</script>

    @stack('scripts')
</body>
</html>