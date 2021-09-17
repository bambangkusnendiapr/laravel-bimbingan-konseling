<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{ asset('img/logo.png') }}" alt="Barbershop Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Bimbingan Konseling</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <!-- <div class="image">
        <img src="{{ asset('img/bukti_transfer/bukti.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div> -->
      <div class="info">
        <div class="nav-item">
          @role('superadmin')
            <a href="{{ route('profile.superadmin') }}" class="d-inline">{{ Auth::user()->name }}</a> &nbsp;
          @endrole
          @role('guru')
            <a href="{{ route('profile.teacher') }}" class="d-inline">{{ Auth::user()->name }}</a> &nbsp;
          @endrole
          @role('siswa')
            <a href="{{ route('profile.student') }}" class="d-inline">{{ Auth::user()->name }}</a> &nbsp;
          @endrole
          <span class="right badge badge-primary">{{ Auth::user()->roles->first()->display_name  }}</span>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
              @role('superadmin|guru')
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard')">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('teachers') }}" class="nav-link @yield('teachers')">
            <i class="nav-icon fas fa-user-tie"></i>
            <p>
              Guru
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('students') }}" class="nav-link @yield('students')">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Siswa
            </p>
          </a>
        </li>
        <li class="nav-item @yield('data-bimbingan')">
          <a href="#" class="nav-link @yield('data_bimbingan')">
            <i class="nav-icon fas fa-box-open"></i>
            <p>
              Bimbingan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('bimbingan') }}" class="nav-link @yield('bimbingan')">
                <i class="far fa-circle nav-icon"></i>
                <p>Bimbingan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('pelanggaran') }}" class="nav-link @yield('pelanggaran')">
                <i class="far fa-circle nav-icon"></i>
                <p>Pelanggaran</p>
              </a>
            </li>
          </ul>
        </li>
        @endrole
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>