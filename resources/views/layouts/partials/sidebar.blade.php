<div class="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="HRMS Logo">
            <h2>HRMS SEB</h2>
        </div>
    </div>

    <div class="sidebar-menu">
        <ul>
            <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            @if(auth()->user()->hasRole('admin'))
            <li class="menu-header">Master Data</li>
            <li class="{{ Request::is('pegawai*') ? 'active' : '' }}">
                <a href="{{ route('pegawai.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Pegawai</span>
                </a>
            </li>
            <li class="{{ Request::is('divisi*') ? 'active' : '' }}">
                <a href="{{ route('divisi.index') }}">
                    <i class="fas fa-sitemap"></i>
                    <span>Divisi</span>
                </a>
            </li>
            @endif
            
            <!-- Add more menu items based on roles -->
        </ul>
    </div>
</div>