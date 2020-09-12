<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->


  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="/clever/img/lokerprogrammer.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user() ? Auth::user()->name : ""}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library  has-treeview menu-open -->
        <li class="nav-item">
          <a href="/admin/dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              {{--  <i class="right fas fa-angle-left"></i>  --}}
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview ">
        <a href="{{route('surat.index')}}" class="nav-link  {{ Request::is('contents/surat') ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Surat
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="{{route('pegawai.index')}}" class="nav-link {{ Request::is('contents/pegawai') ? 'active' : '' }}">
            <i class="far fa-user nav-icon"></i>
            <p>Pegawai</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>