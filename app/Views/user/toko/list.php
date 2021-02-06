<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
  <div class="wrapper">
    <?= view('shared/navbar') ?>
    <div class="content-wrapper p-4">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <?php /** @var \App\Entities\Toko[] $data */ ?>
            <h2 class="mb-3">Belanja Aneka Toko Disini:</h2>
            <div class="row user-choose">
              <?php foreach ($data as $toko) : ?>
                <div class="col-md-6 col-lg-4 col-xl-3 user-item">
                  <a href="/user/toko/view/<?= $toko->id ?>">
                    <img src="/uploads/logo/<?= $toko->logo ?>" alt="" width="100%">
                    <h4><?= $toko->nama ?></h4>
                  </a>
                </div>
              <?php endforeach ?>
            </div>
            <?= view('shared/pagination') ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>