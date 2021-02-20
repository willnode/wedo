<nav class="main-header navbar navbar-expand navbar-light -yellow elevation-2">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/admin/" class="nav-link">Dashboard</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/admin/profile/" class="nav-link">Edit Profil</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item">
      <a class="nav-link" href="/logout">
        <i class="fa fa-sign-out-alt mr-2"></i> Keluar
      </a>
    </li>
  </ul>
</nav>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-yellow elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
    <img src="/6wedo.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
    <span class="brand-text font-weight-light">WEDO Admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= \Config\Services::login()->getAvatarUrl() ?>" alt="">
      </div>
      <div class="info">
        <a href="/admin/profile/" class="d-block"><?= \Config\Services::login()->name ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item">
          <a href="/" target="_blank" class="nav-link">
            <i class="nav-icon fas fa-globe"></i>
            <p>
              Website
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/" class="nav-link <?= ($page ?? '') === 'dashboard' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/toko/" class="nav-link <?= ($page ?? '') === 'toko' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-store-alt"></i>
            <p>
              Toko
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/penjualan/" class="nav-link <?= ($page ?? '') === 'penjualan' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Penjualan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/penjualan/laporan/" class="nav-link <?= ($page ?? '') === 'laporan' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-scroll"></i>
            <p>
              Laporan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/config/" class="nav-link <?= ($page ?? '') === 'config' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Pengaturan Web
            </p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="/admin/users/" class="nav-link <?= ($page ?? '') === 'users' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Users
            </p>
          </a>
        </li> -->

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>