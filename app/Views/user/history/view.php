<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
  <div class="wrapper">
    <?= view('shared/navbar') ?>
    <?php /** @var \App\Entities\Penjualan $item */ ?>
    <div class="content-wrapper p-4">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <table class="table my-3">
              <h4>Order: #<?= $item->id ?></h4>
              <h4>Status: <?= \App\Models\PenjualanModel::$statusesInHtml[$item->status] ?></h4>
              <h4>Tanggal Pembelian: <?= $item->created_at->toDateTimeString() ?></h4>
              <thead>
                <tr>
                  <th>Barang</th>
                  <th>Harga</th>
                  <th>Qty</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($item->nota as $x) : ?>
                  <tr>
                    <td><?= '<img src="/uploads/logo/' . $x->barang->logo . '" alt="" class="mr-2 logo">' . esc($x->barang->nama) ?></td>
                    <td style="vertical-align: middle;"><?= rupiah($x->barang->harga) ?></td>
                    <td style="vertical-align: middle;"> &times; <?= esc($x->qty) ?> </td>
                    <td style="vertical-align: middle;"><?= rupiah($x->barang->harga * $x->qty) ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="3">Total</th>
                  <th style="vertical-align: middle;"><?= rupiah(\App\Models\CartModel::getTotal($item->nota)) ?></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>

        <div class="mb-3">
          <a href="/user/history/" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i></a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>