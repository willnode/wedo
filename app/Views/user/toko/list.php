<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
  <?= view('shared/navbar_index') ?>
  <div class="container py-4">
    <?php /** @var \App\Entities\Toko[] $data */ ?>
    <h2 class="mb-3">Belanja Aneka Toko Disini:</h2>
    <div class="row user-choose">
        <div class="col-lg-10 col-md-8">
          <div class="card-body">
            <div class="col-md-6 col-lg-4 col-xl-3 user-item">
              <?php foreach ($data as $toko) : ?>
                <a class="item" style="width: 20%;" href="/toko/view/<?= $toko->id ?>">
                  <img src="/uploads/logo/<?= $toko->logo ?>" alt="" width="100%">
                  <h4><?= $toko->nama ?></h4>
                </a>
                <a class="item" style="width: 20%;" href="/toko/view/<?= $toko->id ?>">
                  <img src="/uploads/logo/<?= $toko->logo ?>" alt="" width="100%">
                  <h4><?= $toko->nama ?></h4>
                </a>
              <?php endforeach ?>
            </div>
          </div>
        </div>
    </div>
  </div>

  <?= view('shared/footer.php'); ?>
</body>

</html>