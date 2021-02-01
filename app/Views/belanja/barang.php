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
            <?php /** @var \App\Entities\Toko $item */ ?>
           <?php foreach ($item->barang as $barang) : ?>
                <a href="/user/barang/<?= $barang->id?>">
               <img src="/uploads/logo/<?= $barang->logo?>">
               <?= $barang->nama?>
               <?= $barang->harga?>
               <?= $barang->content?>
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