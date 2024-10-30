<nav class="navbar">
    <div class="navbar-left">
        <button id="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    
    <div class="navbar-right">
        <div class="dropdown">
            <button class="dropdown-toggle">
                <img src="{{ auth()->user()->avatar ?? asset('images/default-avatar.png') }}" alt="Profile">
                <span>{{ auth()->user()->name }}</span>
            </button>
            <div class="dropdown-menu">
                <a href="{{ route('profile.edit') }}">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>