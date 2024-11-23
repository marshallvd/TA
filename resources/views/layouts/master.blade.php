<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HRMS SEB - @yield('title')</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    
    <!-- CSS -->
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <link href='https://unpkg.com/@fullcalendar/core@5.10.1/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/daygrid@5.10.1/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/timegrid@5.10.1/main.min.css' rel='stylesheet' />
<link rel="stylesheet" href="{{ asset('css/hope-ui.css') }}">
    @stack('css')
</head>
<body class="  ">
    @include('layouts.partials.loader')
    
    <div class="wrapper">
        @include('layouts.partials.sidebar')
        
        <main class="main-content">
            @include('layouts.partials.navbar')
            
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                @yield('content')
            </div>
            
            @include('layouts.partials.footer')
        </main>
    </div>
    
    {{-- @include('layouts.partials.settings') --}}
    
    <!-- Core Scripts -->
    <script src="{{ asset('assets/js/core/libs.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/external.min.js') }}"></script>
    
    <!-- Widgetchart Script -->
    <script src="{{ asset('assets/js/charts/widgetcharts.js') }}"></script>
    
    <!-- Dashboard Script -->
    <script src="{{ asset('assets/js/charts/vectore-chart.js') }}"></script>
    <script src="{{ asset('assets/js/charts/dashboard.js') }}"></script>
    
    <!-- Plugin Scripts -->
    <script src="{{ asset('assets/js/plugins/fslightbox.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/setting.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/plugins/slider-tabs.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/hope-ui.js') }}" defer></script> --}}
    <script src="{{ asset('assets/js/plugins/form-wizard.js') }}"></script>
    
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- App Script -->
    <script src="{{ asset('assets/js/hope-ui.js') }}" defer></script>
    
    <script src='https://unpkg.com/@fullcalendar/interaction@5.10.1/main.min.js'></script>
    <script src="{{ asset('js/hope-ui.js') }}"></script>
<!-- Fullcalendar JavaScript -->
<script src='{{ asset('assets/js/fullcalendar/core/main.js') }}'></script>
<script src='{{ asset('assets/js/fullcalendar/daygrid/main.js') }}'></script>
<script src='{{ asset('assets/js/fullcalendar/timegrid/main.js') }}'></script>
<script src='{{ asset('assets/js/fullcalendar/list/main.js') }}'></script>


<script src='https://unpkg.com/@fullcalendar/core@5.10.1/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/daygrid@5.10.1/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/timegrid@5.10.1/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/interaction@5.10.1/main.min.js'></script>

    <script src='{{ asset('assets/css/fullcalendar/list/main.js') }}'></script>
    @stack('scripts')
    
    <!-- Flash Messages -->
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!', 
                text: "{{ session('success') }}",
                timer: 1000,
                timerProgressBar: true
            })
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                timer: 1000,
                timerProgressBar: true
            })
        @endif
    </script>
</body>
</html>