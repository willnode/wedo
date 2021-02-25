<!DOCTYPE html>
<html lang="en">
<?= view("shared/head.php") ?>

<body>

  <?= view('shared/navbar_index.php'); ?>

  <section class="banner">

    <div class="hero">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="jumbotron bg-1" style="background-image: url('/artboard4.png'); background-position: center;"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="service-section">
      <div class="container">
        <h2 class="text-center">Layanan Kami</h2><br />
        <div class="row">
          <div class="col-4">
            <a href="/toko/">
              <div class="card text-center">
                <div class="card-body">
                  <img src="/artboard1.jpg" width="100" alt="">
                  <h5 class="card-title">Pesan Makanan</h5>
                </div>
              </div>
            </a>
          </div>
          <div class="col-4">
            <a href="/custom/">
              <div class="card text-center">
                <div class="card-body">
                  <img src="/artboard2.jpg" width="100" alt="">
                  <h5 class="card-title">Pesan Di Tempat Berbeda</h5>
                </div>
              </div>
            </a>
          </div>
          <div class="col-4">
            <a href="/custom/">
              <div class="card text-center">
                <div class="card-body">
                  <img src="/artboard3.jpg" width="100" alt="">
                  <h5 class="card-title">Antar Jemput</h5>
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
        <a href="https://forms.gle/ydsocJtz92Y7aRt86" class="btn btn-order">Klik Disini</a>
      </p>
    </div>
  </div>

  <?= view('shared/footer.php'); ?>

</body>

<?= view('shared/script.php') ?>

</html>