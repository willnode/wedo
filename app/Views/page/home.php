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
          <div class="carousel-item">
            <div class="jumbotron bg-2" style="background: url('/artboard2.jpg'); background-position: center;"></div>
          </div>
          <div class="carousel-item">
            <div class="jumbotron" style="background: url('/artboard3.jpg'); background-position: center;"></div>
          </div>
          <div class="carousel-item">
            <div class="jumbotron" style="background: url('/artboard1.jpg'); background-position: center;"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="service-section py-5 mx-5">
      <div class="container">
        <h2 class="text-center">Layanan Kami</h2><br />
        <div class="row">
          <div class="col-sm-4">
            <a href="/toko/">
              <div class="card text-center">
                <div class="card-body">
                  <div><img src="/food-delivery.png" width="100" alt=""></div>
                  <h5>Pesan Makanan</h5>
                </div>
              </div>
            </a>
          </div>
          <div class="col-sm-4">
            <a href="/custom/">
              <div class="card text-center">
                <div class="card-body">
                  <div><img src="/food-delivery.png" width="100" alt=""></div>
                  <h5>Pesan Di Tempat Berbeda</h5>
                </div>
              </div>
            </a>
          </div>
          <div class="col-sm-4">
            <a href="/custom/">
              <div class="card text-center">
                <div class="card-body">
                  <div><img src="/food-delivery.png" width="100" alt=""></div>
                  <h5>Antar Jemput</h5>
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