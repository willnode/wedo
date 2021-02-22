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
        <div class="col-lg-2 col-md-4">
          <a class="item" href="/toko/view/<?= $toko->id ?>">
            <img src="/uploads/logo/<?= $toko->logo ?>" alt="" width="100px">
            <h4><?= $toko->nama ?></h4>
          </a>
        </div>
        <div class="col-lg-10 col-md-8">
          <div class="card">
            <div class="slick card-body invisible">
              <?php foreach ($toko->getBarang() as $barang) : ?>
                <a class="item" style="width: 20%;" href="/barang/view/<?= $barang->id ?>">
                  <img src="/uploads/logo/<?= $barang->logo ?>" alt="" width="100%">
                  <h4><?= $barang->nama ?></h4>
                  <div class="text-center text-black-50"><?= rupiah($barang->harga) ?></div>
                </a>
              <?php endforeach ?>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>

  <?= view('shared/footer.php'); ?>
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      $('.slick').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: true,
        responsive: [{
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
      })
      $('.slick').removeClass('invisible');
    });
  </script>
</body>

</html>