<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
  <div class="wrapper">
    <?= view('shared/navbar') ?>
    <?php /** @var \App\Entities\Toko $item */ ?>
    <div class="content-wrapper p-4">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <div class="d-flex">
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
                  <a href="/user/barang/view/<?= $barang->id ?>">
                    <img src="/uploads/logo/<?= $barang->logo ?>" width="100%">
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
          <a href="/user/toko/" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i></a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>