<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
  <?= view('shared/navbar_index') ?>
  <?php /** @var \App\Entities\Toko $item */ ?>
  <div class="container py-4">
    <div class="card">
      <div class="card-body">
        <div class="d-flex flex-column flex-md-row">
          <img class="mr-3" src="/uploads/logo/<?= $item->logo ?>" width="150px" height="150px" alt="">
          <div>
            <h1><?= $item->nama ?></h1>
            <p><?= $item->deskripsi ?></p>
            <p class="text-black-50">Alamat:<br><?= $item->lokasi ?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="row user-choose">
          <?php foreach ($item->barang as $barang) : ?>
            <div class="col-md-6 col-lg-4 col-xl-3 user-item">
              <a class="item" href="/barang/view/<?= $barang->id ?>">
                <img src="/uploads/logo/<?= $barang->logo ?>" width="100%" height="100px">
                <h4><?= $barang->nama ?></h4>
                <div class="text-center text-black-50"><?= rupiah($barang->harga) ?></div>
              </a>
            </div>
          <?php endforeach ?>
        </div>
        <?= view('shared/pagination') ?>
      </div>
    </div>

    <div class="mb-3">
      <a href="/toko/" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i></a>
    </div>
  </div>
</body>

</html>