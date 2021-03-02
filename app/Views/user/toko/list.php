<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
  <?= view('user/navbar') ?>
  <div class="container py-4">
    <?php /** @var \App\Entities\Toko[] $data */ ?>
    <?= view('user/search') ?>
    <h2 class="my-3 text-center">Belanja Aneka Toko Disini:</h2>
    <div class="row user-choose justify-content-center">
      <?php foreach ($data as $toko) : ?>
        <div class="col-md-6 col-lg-4 col-xl-3 col-6">
          <a class="item" href="/toko/view/<?= $toko->id ?>">
            <img src="<?= $toko->logo ? "/uploads/logo/$toko->logo?w=400&h=300" : '/5wedo.png' ?>" alt="" width="100%">
            <h4><?= $toko->nama ?></h4>
          </a>
        </div>
      <?php endforeach ?>
    </div>
  </div>

  <?= view('shared/footer.php'); ?>
</body>

</html>