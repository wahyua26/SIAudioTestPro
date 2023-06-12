<aside class="main-sidebar sidebar-light-primary elevation-4 bg-blue">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('AdminLTE/dist/img/logo7.png') }}" alt="SIATP Logo" class="brand-image" style="opacity: 1">
      <span class="span">
        SIATP
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('AdminLTE/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Presensi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('presensi-masuk') }}" class="nav-link">
                    <i class="fas fa-sign-in-alt"></i>
                  <p>Presensi Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('presensi-keluar') }}" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                  <p>Presensi Keluar</p>
                </a>
              </li>
            </ul>
          </li> --}}
          <li class="nav-item">
            <a href="{{ route('audiometri') }}" class="nav-link">
              <i class="nav-icon fas fa-scroll "></i>
              <p class="text-dark">Hasil Audiometri</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('pegawai') }}" class="nav-link">
                  <i class="fas fa-users"></i>
                  <p>Data Pegawai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('jabatan') }}" class="nav-link">
                  <i class="fas fa-user-friends"></i>
                  <p>Data Posisi Pegawai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('ruang') }}" class="nav-link">
                  <i class="fas fa-building"></i>
                  <p>Data Ruang Kerja</p>
                </a>
              </li>
            </ul>
          </li>
          <br>
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
            <p>Keluar</p>
          </a>
        </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>