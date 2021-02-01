<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
  <style>
  .logo {
    width: 64px;
  }
  </style>
  <div class="wrapper">
    <?= view('shared/navbar') ?>
    <div class="content-wrapper p-4">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <?php /** @var \App\Entities\Toko[] $data */ ?>
           <?php foreach ($data as $value) : ?>
                <a href="/user/toko/<?= $value->id?>">
               <img href="/uploads/logo/<?= $value->logo?>">
               <?= $value->nama?>
               </a>
          <?php endforeach?>
            <?= view('shared/pagination') ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>