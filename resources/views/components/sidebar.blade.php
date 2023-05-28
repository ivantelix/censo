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
                    <p>Censos</p>
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
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
