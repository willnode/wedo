<!DOCTYPE html>
<html lang="en">
<?= view("shared/head") ?>

<body>

  <?= view('user/navbar'); ?>

  <section class="banner">
    <div class="hero">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" style="max-height: 80vh;">
          <div class="slick">
            <?php foreach (\App\Entities\Config::get()->banner ?: [] as $banner) : ?>
              <img src="/uploads/banner/<?= $banner ?>?w=1920&h=1024" alt="" width="100%" height="100%" style="object-fit: cover;">
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>
    <script>
      window.addEventListener('DOMContentLoaded', (event) => {
        $('.slick').slick({
          dots: true,
          navs: true,
          autoplay: true,
        });
      });
    </script>
    <div class="service-section py-5 mx-5">
      <div class="fluid-container">
        <h2 class="text-center">Layanan Kami</h2><br />
        <div class="row">
          <div class="col-6 col-md-3">
            <a href="<?= \App\Entities\Config::get()->link_wefood ?>">
              <div class="card text-center">
                <div class="card-body">
                  <img src="/images/WEFOOD.png" width="100%" alt="">
                  <h5>Pesan Makanan</h5>
                </div>
              </div>
            </a>
          </div>
          <div class="col-6 col-md-3">
            <a href="<?= \App\Entities\Config::get()->link_webox ?>">
              <div class="card text-center">
                <div class="card-body">
                  <img src="/images/WETRANS.png" width="100%" alt="">
                  <h5>Antar Jemput</h5>
                </div>
              </div>
            </a>
          </div>
          <div class="col-6 col-md-3">
            <a href="<?= \App\Entities\Config::get()->link_wetrans ?>">
              <div class="card text-center">
                <div class="card-body">
                  <img src="/images/WEBOX.png" width="100%" alt="">
                  <h5>Kirim Barang</h5>
                </div>
              </div>
            </a>
          </div>
          <div class="col-6 col-md-3">
            <a href="<?= \App\Entities\Config::get()->link_custom_order ?>">
              <div class="card text-center">
                <div class="card-body">
                  <img src="/images/CUSTOMORDER.png" width="100%" alt="">
                  <h5>Custom Order</h5>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>

  </section>

  <div class="not-list-section">
    <div class="container">
      <h3 class="text-center">Bantu kami untuk mengetahui cara mengoptimalkan kinerja kami<br>Ulas kami dengan</h3>
      <p class="text-center mt-5">
        <a href="<?= \App\Entities\Config::get()->link_feedback ?>" class="btn btn-order">Klik Disini</a>
      </p>
    </div>
  </div>

  <?= view('shared/footer'); ?>

</body>

</html>