<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
  <?= view('user/navbar') ?>
  <?php /** @var \App\Entities\Penjualan $item */ ?>
  <?php $rm = new \App\Models\ReviewModel() ?>
  <div class="container py-4">
    <div class="card">
      <div class="card-body">
        <h4>Nomor Order: #<?= $item->id ?></h4>
        <h4>Status Order: <?= \App\Models\PenjualanModel::$statusesInHtml[$item->status] ?></h4>
        <h4>Waktu Order: <?= humanize($item->created_at) ?></h4>
        <small>(<?= $item->created_at->toDateTimeString() ?> WIB)</small>
        <table class="table my-3">
          <thead>
            <tr>
              <th>Barang</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($item->nota as $x) : ?>
              <tr>
                <td>
                  <a href="/barang/view/<?= $x->barang_id ?>">
                    <?= '<img src="/uploads/logo/' . ($x->barang->logo[0] ?? '') . '?w=64&h=64" alt="" class="mr-2 logo">' . esc($x->barang->nama) ?>
                  </a>
                </td>
                <td style="vertical-align: middle;"><?= rupiah($x->barang->harga) ?></td>
                <td style="vertical-align: middle;"> &times; <?= esc($x->qty) ?> </td>
                <td style="vertical-align: middle;"><?= rupiah($x->barang->harga * $x->qty) ?></td>
                <th>
                  <?php if ($item->status == 'diterima') : ?>
                    <?php $rr = $rm->atBarangUser($x->barang_id, $item->hp) ?>
                    <button type="button" onclick="updateRatingBox(this)" class="btn <?= $rr ? 'btn-success' : 'btn-outline-success' ?>" title="Review Barang Ini" data-toggle="modal" data-target="#exampleModal" data-barang="<?= $x->barang_id ?>" data-rating="<?= $rr->rating ?? 0 ?>" data-content="<?= esc($rr->content ?? '') ?>">
                      <i class="<?= $rr ? 'fas' : 'far' ?> fa-star"></i>
                    </button>
                  <?php endif ?>
                </th>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="3">Ongkis Kirim</th>
              <th style="vertical-align: middle;"><?= rupiah($item->ongkir) ?></th>
              <th></th>
            </tr>
            <tr>
              <th colspan="3">Total Belanja</th>
              <th style="vertical-align: middle;"><?= rupiah($item->total) ?></th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

    <div class="mb-3">
      <a href="/history/" class="btn btn-outline-secondary"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
    </div>
  </div>
  <!-- Modal -->
  <form class="modal fade" method="POST" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Review Barang Ini</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" id="barang" name="barang_id" hidden>
          <input type="number" id="rating" hidden name="rating" min="1" max="5" required>
          <div class="d-flex justify-content-center">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
              <button type="button" id="ratingHUD_<?= $i ?>" onclick="$('#rating').val(<?= $i ?>); updateStarHUD()" class="btn">
                <i class="far fa-2x fa-star"></i>
              </button>
            <?php endfor ?>
          </div>
          <textarea name="content" id="content" class="form-control"></textarea>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </form>

  <script>
    function updateRatingBox(event) {
      var rating = $(event).data('rating');
      var content = $(event).data('content');
      var barang = $(event).data('barang');
      $('#rating').val(rating);
      $('#content').val(content);
      $('#barang').val(barang);
      updateStarHUD();
    }

    function updateStarHUD() {
      var rating = parseInt($('#rating').val());
      for (let i = 1; i <= 5; i++) {
        $('#ratingHUD_' + i + ' i').removeClass(rating >= i ? 'far' : 'fas').addClass(rating >= i ? 'fas' : 'far');
      }
    }
  </script>
</body>

</html>