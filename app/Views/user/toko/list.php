<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
  <?= view('shared/navbar_index') ?>
  <div class="container py-4">
    <?php /** @var \App\Entities\Toko[] $data */ ?>
    <h2 class="mb-3">Belanja Aneka Toko Disini:</h2>
    <div class="row user-choose">
      <?php foreach ($data as $toko) : ?>
        <div class="col-md-6 col-lg-4 col-xl-3 col-6 user-item">
          <a class="item" href="/toko/view/<?= $toko->id ?>">
            <img src="/uploads/logo/<?= $toko->logo ?>" alt="" width="100%">
            <h4><?= $toko->nama ?></h4>
          </a>
        </div>
      <?php endforeach ?>
    </div>
  </div>

  <?= view('shared/footer.php'); ?>
</body>

</html>