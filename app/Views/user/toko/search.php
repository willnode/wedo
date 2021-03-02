<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
  <?= view('user/navbar') ?>
  <div class="container py-4">
    <?php /** @var \App\Entities\Toko[] $data */ ?>
    <?= view('user/search') ?>
    <h3 class="my-3 text-center">Aneka toko dan barang dalam kata "<?= esc($_GET['s']) ?>"</h3>
    <hr>

    <?php if (!$tokodata) : ?>
      <div class="text-center"><i>Tidak ada toko sesuai pencarian</i></div>
    <?php else : ?>
      <p class="text-center"><i>Ditemukan <?= count($tokodata) ?> toko</i></p>
    <?php endif ?>
    <div class="row user-choose justify-content-center">
      <?php foreach ($tokodata as $toko) : ?>
        <div class="col-md-6 col-lg-4 col-xl-3 col-6 mb-3">
          <a class="item" href="/toko/view/<?= $toko->id ?>">
            <img src="<?= $toko->logo ? "/uploads/logo/$toko->logo?w=400&h=300" : '/5wedo.png' ?>" alt="" width="100%">
            <h4><?= $toko->nama ?></h4>
          </a>
        </div>
      <?php endforeach ?>
    </div>
    <hr>
    <?php if (!$barangdata) : ?>
      <div class="text-center"><i>Tidak ada barang sesuai pencarian</i></div>
    <?php else : ?>
      <p class="text-center"><i>Ditemukan <?= count($barangdata) ?> barang</i></p>
    <?php endif ?>
    <div class="row user-choose justify-content-center">

      <?php foreach ($barangdata as $barang) : ?>
        <div class="col-md-6 col-lg-4 col-xl-3 col-6 mb-3">
          <a class="item" href="/barang/view/<?= $barang->id ?>">
            <img src="<?= $barang->logo ? "/uploads/logo/$barang->logo?w=400&h=300" : '/5wedo.png' ?>" alt="" width="100%">
            <h4><?= $barang->nama ?></h4>
          </a>
        </div>
      <?php endforeach ?>
    </div>

    <hr>
    <div class="mb-3 text-center">
      <a href="/toko/" class="btn btn-warning">Belanja Lainnya</a>
    </div>
  </div>
  <?= view('shared/footer.php'); ?>
</body>

</html>