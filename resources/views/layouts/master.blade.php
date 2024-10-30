<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HRMS SEB - @yield('title')</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/core/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hope-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('css')
</head>
<body>
    @include('layouts.partials.loader')
    
    <div class="wrapper">
        @include('layouts.partials.sidebar')
        
        <div class="main-panel">
            @include('layouts.partials.navbar')
            
            <div class="content">
                @yield('content')
            </div>
            
            @include('layouts.partials.footer')
        </div>
    </div>
    
    @include('layouts.partials.settings')
    
    <!-- Scripts -->
    <script src="{{ asset('js/core/libs.min.js') }}"></script>
    <script src="{{ asset('js/hope-ui.js') }}"></script>
    @stack('scripts')
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 3000,
                timerProgressBar: true
            })
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                timer: 3000,
                timerProgressBar: true
            })
        @endif
    </script>
</body>
</html>