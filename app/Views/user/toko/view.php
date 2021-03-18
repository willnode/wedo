<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
  <?= view('user/navbar') ?>
  <?php /** @var \App\Entities\Toko $item */ ?>
  <div class="container py-4">
    <?= view('user/search') ?>
    <div class="card">
      <div class="card-body text-center text-sm-left">
        <div class="d-flex flex-column flex-sm-row align-items-center">
          <img class="mr-3" src="/uploads/logo/<?= $item->logo ?>" width="150px" height="150px" alt="">
          <div>
            <h1 class="my-3"><?= $item->nama ?></h1>
            <p><?= $item->deskripsi ?></p>
            <p class="text-black-50">Alamat:<br><?= $item->lokasi ?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="row user-choose justify-content-center">
      <?php foreach ($item->barang as $barang) : $s = 1 ?>
        <div class="col-6 col-md-4 col-lg-3 user-item mb-3">
          <a class="item" href="/barang/view/<?= $barang->id ?>">
            <img src="/uploads/logo/<?= $barang->logo[0] ?? '' ?>?w=400&h=300" width="100%">
            <h4><?= $barang->nama ?></h4>
            <div class="text-center text-black-50 my-2"><?= rupiah($barang->harga) ?></div>
          </a>
        </div>
      <?php endforeach ?>
      <?php if (!isset($s)) : ?>
        <div class="col-12">
          Tidak ada barang di toko ini.
        </div>
      <?php endif ?>
    </div>
    <?= view('shared/pagination') ?>

    <div class="my-3 text-center">
      <a href="/toko/" class="btn btn-warning">Belanja Lainnya</a>
    </div>
  </div>
  <?= view('shared/footer.php'); ?>

</body>

</html>