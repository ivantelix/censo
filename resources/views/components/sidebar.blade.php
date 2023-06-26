<!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/censos" class="nav-link {{ request()->is('censo') ? 'active' : ''}}">
                <i class="nav-icon fa fa-users"></i>
                    <p>Nuevo Censo</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/buildings" class="nav-link {{ request()->is('locations') ? 'active' : ''}}">
                <i class="nav-icon fa fa-building"></i>
                    <p>Edificios</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/apartments" class="nav-link {{ request()->is('locations') ? 'active' : ''}}">
                <i class="nav-icon fa fa-cubes"></i>
                    <p>Apartamentos</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
            
                    <i class="fa fa-power-off nav-icon"></i>
                    <p>{{ __('Logout') }}</p>
                </a>
            
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
      <!-- /.sidebar-menu -->

