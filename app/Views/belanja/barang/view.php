<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body class="bg-dark-blue">
  <div class="wrapper">
    <?= view('shared/navbar') ?>
    <?php /** @var \App\Entities\Barang $item */ ?>
    <div class="content-wrapper p-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="d-flex">
                  <img class="mr-2" src="/uploads/logo/<?= $item->logo ?>" width="100px" height="100px" alt="">
                  <div>
                    <h1><?= esc($item->nama) ?></h1>
                    <p><?= rupiah($item->harga) ?></p>
                    <p><?= esc($item->content) ?></p>
                    <form action="/user/cart/add" method="POST" class="d-flex w-100 align-items-center">
                      <input type="hidden" name="barang_id" value="<?= $item->id ?>">
                      <input type="hidden" name="r" value="/user/barang/view/<?= $item->id ?>">
                      <label class="m-0">
                        <span>Beli: </span>
                      </label>
                      <input type="number" name="qty" value="1" min="1" max="99" class="form-control mx-3">
                      <button class="btn btn-warning btn-block" title="Tambah ke Keranjang">
                        <i class="fas fa-cart-plus mr-2"></i>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <?php foreach (($r = $item->reviews) as $review) : ?>
                  <?php $user = $review->user ?>
                  <div class="d-flex">
                    <img src="<?= $user->getAvatarUrl() ?>" width="80px" alt="">
                    <div>
                      <h5><?= esc($user->name) ?></h5>
                      <p><?= esc($review->content) ?></p>
                    </div>
                  </div>
                <?php endforeach ?>
                <?php if (!$r) : ?>
                  <i>Tidak ada review sejauh ini</i>
                <?php endif ?>
                <?= view('shared/pagination') ?>
              </div>
            </div>
            <div class="mb-3">
              <a href="/user/toko/view/<?= $item->toko_id ?>" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i></a>
            </div>
          </div>
          <div class="col-lg-6">
            <?= view('belanja/cart/iframe') ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>