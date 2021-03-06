<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body class="bg-dark-blue">
  <?= view('user/navbar') ?>
  <?php /** @var \App\Entities\Barang $item */ ?>
  <div class="container py-4">
    <?= view('user/search') ?>
    <div class="row justify-content-center">
      <div class="col-lg-6 mb-3">
        <div class="card overflow-hidden">
          <div class="mb-3 slick">
            <?php foreach ($item->logo ?: [] as $logo) : ?>
              <img src="/uploads/logo/<?= $logo ?>?w=600&h=300" alt="" width="100%" height="100%" style="object-fit: cover;">
            <?php endforeach ?>
          </div>
          <div class="card-body">
            <div class="d-flex flex-column flex-md-row">
              <div>
                <div class="text-black-50">Dari Toko <a href="/toko/view/<?= $item->toko_id ?>"><?= $item->toko->nama ?></a></div>
                <h1><?= esc($item->nama) ?></h1>
                <p><?= rupiah($item->harga) ?></p>
                <p><?= esc($item->content) ?></p>
                <form action="/cart/add" method="POST" class="d-flex w-100 align-items-center">
                  <input type="hidden" name="barang_id" value="<?= $item->id ?>">
                  <input type="hidden" name="r" value="/barang/view/<?= $item->id ?>">
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
              <div class="d-flex">
                <img src="<?= $review->getAvatarUrl() ?>" width="80px" alt="" class="mr-3">
                <div>
                  <h5><?= esc($review->nama) ?></h5>
                  <h6><?= str_repeat('<i class="fa fa-star"></i>', $review->rating) ?></h6>
                  <div>
                    <?= esc($review->content) ?>
                    <br>
                    <small class="text-black-50"><?= humanize($review->updated_at) ?></small>
                  </div>
                </div>
              </div>
            <?php endforeach ?>
            <?php if (!$r) : ?>
              <p class="my-3"><i>Tidak ada review sejauh ini</i></p>
            <?php endif ?>
            <?= view('shared/pagination') ?>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-3">
        <?= view('user/cart/iframe') ?>
        <?php $related = $item->toko->getBarang() ?>
      </div>
      <div class="col-12 col-lg-10 mb-3">
        <div class="card">
          <div class="card-body">
            <?php if (count($related) > 1) : ?>
              <h3 class="mb-3 text-center">Mungkin kamu suka</h3>
              <div class="row user-choose justify-content-center">
                <?php foreach (array_slice($related, 0, 3) as $barang) : ?>
                  <?php if ($barang->id == $item->id) continue; ?>
                  <a class="item col-4 mb-3" href="/barang/view/<?= $barang->id ?>">
                    <img src="/uploads/logo/<?= $barang->logo[0] ?? '' ?>?w=400&h=200" alt="" width="100%">
                    <h4><?= $barang->nama ?></h4>
                    <div class="text-center text-black-50"><?= rupiah($barang->harga) ?></div>
                  </a>
                <?php endforeach ?>
              </div>
            <?php endif ?>
            <a href="/toko/view/<?= $item->toko_id ?>" class="btn btn-outline-warning btn-block">Lihat Semua Barang di Toko</a>
            <a href="/toko/" class="btn btn-warning btn-block">Belanja Lainnya</a>
          </div>
        </div>
      </div>
      <script>
        window.addEventListener('DOMContentLoaded', (event) => {
          $('.slick').slick({
            dots: true,
            autoplay: true,
          });
        });
      </script>
    </div>
  </div>
  <?= view('shared/footer.php'); ?>

</body>

</html>