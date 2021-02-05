<!DOCTYPE html>
<html lang="en">
<?= view("shared/head.php")?>

<body>

    <?= view('shared/navbar_index.php'); ?>

    <section class="banner">

        <div class="hero">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="jumbotron bg-1" style="background-image: url('/gambar1.jpg'); background-position: center;"></div>
                    </div>
                    <div class="carousel-item">
                        <div class="jumbotron" style="background: url('/gambar2.jpg'); background-position: center;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="service-section">
            <div class="container">
              <h2 class="text-center">Layanan Kami</h2><br />
                <div class="row">
                    <div class="col-4">
                        <a href="user/index.php">
                            <div class="card text-center">
                                <div class="card-body">
                                    <img src="/food-delivery.png" width="100" alt="">
                                    <h5 class="card-title">Antar Barang</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="#" data-toggle="modal" data-target="#sendModal">
                            <div class="card text-center">
                                <div class="card-body">
                                    <img src="/food-delivery.png" width="100" alt="">
                                    <h5 class="card-title">Jemput Barang</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="#" data-toggle="modal" data-target="#shopModal">
                            <div class="card text-center">
                                <div class="card-body">
                                    <img src="/food-delivery.png" width="100" alt="">
                                    <h5 class="card-title">Antar Orang</h5>
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
            <h3 class="text-center">Pengen beli makanan favorit kamu dari rumah ?<br>Langsung daftarkan diri anda</h3>
            <p class="text-center mt-5">
                <a href="/login" class="btn btn-order">Klik Disini</a>
            </p>
        </div>
    </div>

    <?= view('shared/footer.php'); ?>

</body>

<?= view('shared/script.php') ?>

</html>