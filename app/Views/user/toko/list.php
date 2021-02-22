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
          <div class="card">
            <div class="slick card-body invisible">
              <?php foreach ($data as $toko) : ?>
                <a class="item" href="/toko/view/<?= $toko->id ?>">
                <img src="/uploads/logo/<?= $toko->logo ?>" alt="" width="100px">
                <h4><?= $toko->nama ?></h4>
                 </a>
                 <a class="item" href="/toko/view/<?= $toko->id ?>">
                <img src="/uploads/logo/<?= $toko->logo ?>" alt="" width="100px">
                <h4><?= $toko->nama ?></h4>
                 </a>
              <?php endforeach ?>
            </div>
          </div>
        </div>
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
              slidesToShow: 2,
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