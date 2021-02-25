<nav class="navbar navbar-index sticky-top navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="https://wedoprb.com/">
    <img src="/7wedo.png" height="50px" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto ">
      <li class="nav-item  <?= ($page ?? '') == 'home' ? 'active' : '' ?>">
        <a class="nav-link" href="/">Beranda</a>
      </li>
      <li class="nav-item  <?= ($page ?? '') == 'toko' ? 'active' : '' ?>">
        <a class="nav-link" href="/toko/">Belanja</a>
      </li>
      <li class="nav-item  <?= ($page ?? '') == 'cart' ? 'active' : '' ?>">
        <a class="nav-link" href="/cart/">Cart
          <?php if ($c = count(\App\Libraries\CartProcessor::load())) : ?>
          <span class="badge badge-warning ml-1" style="font-size: 1em;"><?= $c ?></span>
          <?php endif ?>
        </a>
      </li>
      <?php if ($_SESSION['email'] ?? '') : ?>
        <li class="nav-item  <?= ($page ?? '') == 'history' ? 'active' : '' ?>">
          <a class="nav-link" href="/history/">History</a>
        </li>
      <?php endif ?>
      <li class="nav-item  <?= ($page ?? '') == 'custom' ? 'active' : '' ?>">
        <a class="nav-link" href="/custom/">Custom Order</a>
      </li>
    </ul>
  </div>
</nav>
<?php if (($page ?? '') !== 'home' && !\App\Entities\Config::get()->isOpen()) : ?>
  <div class="alert alert-danger text-center">
    Mohon maaf saat ini layanan aplikasi berada diluar jam operasional (<?= \App\Entities\Config::get()->operasional_buka ?> - <?= \App\Entities\Config::get()->operasional_tutup ?>).
  </div>
<?php endif ?>