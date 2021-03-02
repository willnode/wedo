<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
  <?= view('user/navbar') ?>
  <div class="container py-4">
    <div class="row">
      <div class="col-lg-6">
        <?= view('user/cart/iframe') ?>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h3>Selesaikan Pembayaran</h3>
            <?php if (\App\Libraries\CartProcessor::load()) : ?>
              <form method="POST" action="/cart/checkout">
                <label class="mb-3 w-100">
                  <span>Nama</span>
                  <input type="text" autocomplete="name" name="nama" class="form-control" required>
                </label>
                <label class="mb-3 w-100">
                  <span>Nomor HP (WA)</span>
                  <input type="text" autocomplete="tel" name="hp" class="form-control" required>
                </label>
                <label class="mb-3 w-100">
                  <span>Alamat</span>
                  <input type="text" autocomplete="street-address" name="alamat" class="form-control" required>
                  <p class="small text-black-50">Mohon masukkan alamat sedetail mungkin (nomor rumah, nama jalan, RT/RW)</p>
                  <div class="row">
                    <div class="col-6">
                      <select name="alamat_kota" class="form-control" id="kota" required onchange="refreshPrice()">
                        <option value="" selected disabled>Pilih Kota</option>
                        <?php foreach (explode(',', \App\Entities\Config::get()->kecamatan_dalam) as $str) : ?>
                          <option>Kota <?= $str ?></option>
                        <?php endforeach ?>
                        <?php foreach (explode(',', \App\Entities\Config::get()->kecamatan_luar) as $str) : ?>
                          <option>Kecamatan <?= $str ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <div class="col-6">
                      <select name="alamat_kab" class="form-control" required>
                        <option>Probolinggo</option>
                      </select>
                    </div>
                  </div>
                  <p class="small text-black-50">Jika kota anda tidak ada dalam pilihan maka kota anda berada diluar jangkauan layanan</p>
                </label>
                <button class="btn btn-block btn-warning"><i class="fa fa-shopping-cart"></i> Checkout</button>
              </form>
            <?php else : ?>
              <div class="text-center py-3">
                <p><i class="text-black-50 fas fa-gifts fa-4x"></i></p>
                <p>Sepertinya kamu belum memasukkan barang belanjaan kesini!</p>
                <a href="/toko/" class="btn btn-warning">Cari Barang Disini</a>
              </div>
            <?php endif ?>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script>
    function refreshPrice() {
      var formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
      });
      var tag = ('' + $('#kota').val()).startsWith('Kecamatan') ? '<?= \App\Entities\Config::get()->ongkir_luar ?>' : '<?= \App\Entities\Config::get()->ongkir_dalam ?>'
      $('#ongkir').text(formatter.format(parseInt(tag)));
      $('#total').text(formatter.format(parseInt($('#total').data('value')) + parseInt(tag)));
    }

    window.addEventListener('DOMContentLoaded', (event) => {
      refreshPrice();
    });
  </script>
</body>

</html>