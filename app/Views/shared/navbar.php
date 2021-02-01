<?php $login_name = \Config\Services::login()->name ?? ''; ?>
<nav class="main-header navbar navbar-expand navbar-yellow navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item">
      <a class="nav-link" href="/user/logout">
        <i class="fa fa-sign-in-alt mr-2"></i> Logout
      </a>
    </li>
  </ul>
</nav>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-yellow elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
    <img src="/logo_light.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
    <span class="brand-text font-weight-light">WEDO
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <?php if ($login_name) : ?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="info">
          <a href="/user/" class="d-block"><i class="fa fa-user mr-2"></i><?= $login_name ?></a>
        </div>
      </div>
    <?php endif ?>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item">
          <a href="/" class="nav-link <?= ($page ?? '') == 'home' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/category/news/" class="nav-link <?= ($page ?? '') == 'news' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>
              News
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/category/info/" class="nav-link <?= ($page ?? '') == 'akun' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-info"></i>
            <p>
              Akun
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>