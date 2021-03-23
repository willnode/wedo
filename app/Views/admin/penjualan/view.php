<!DOCTYPE html>
<html lang="en">
<?= view('shared/head') ?>

<body>
  <div class="wrapper">
    <?= view('admin/navbar') ?>
    <?php /** @var \App\Entities\Penjualan $item */ ?>
    <div class="content-wrapper p-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">

            <div class="card">
              <div class="card-body">
                <h4>Identitas Customer</h4>
                <table class="table table-sm">
                  <tbody>
                    <tr>
                      <td>Nama</td>
                      <th><?= esc($item->nama) ?></th>
                    </tr>
                    <tr>
                      <td>Nomor HP</td>
                      <th><a href="../wa/<?= $item->id ?>" target="_blank"><?= esc($item->hp) ?></a></th>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <th><a href="../maps/<?= $item->id ?>" target="_blank"><?= esc($item->alamat) ?></a></th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <h4>Detail Order</h4>
                <table class="table table-sm">
                  <tbody>
                    <tr>
                      <td>Nomor Order</td>
                      <th>
                        #<?= $item->id ?>
                      </th>
                    </tr>
                    <tr>
                      <td>Waktu Order</td>
                      <th>
                        (<?= humanize($item->created_at) ?>)<br>
                        <?= $item->created_at->toDateTimeString() ?>
                      </th>
                    </tr>
                    <tr>
                      <td>Status Order</td>
                      <th>
                        <h5>
                          <?= \App\Models\PenjualanModel::$statusesInHtml[$item->status] ?>
                        </h5>
                      </th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <table class="table my-3">
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
                        <td>
                          <a href="/barang/view/<?= $x->barang_id ?>">
                            <?= '<img src="/uploads/logo/' . ($x->barang->logo[0] ?? '') . '?w=64&h=64" alt="" class="mr-2 logo">' . esc($x->barang->nama) ?>
                          </a>
                        </td>
                        <td style="vertical-align: middle;"><?= rupiah($x->barang->harga) ?></td>
                        <td style="vertical-align: middle;"> &times; <?= esc($x->qty) ?> </td>
                        <td style="vertical-align: middle;"><?= rupiah($x->barang->harga * $x->qty) ?></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="3">Ongkos Kirim</th>
                      <th style="vertical-align: middle;"><?= $item->rpOngkir ?></th>
                    </tr>
                    <tr>
                      <th colspan="3">Total Belanja</th>
                      <th style="vertical-align: middle;"><?= $item->rpTotal ?></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="card">
              <form method="POST" class="card-body">
                <label class="d-block mb-3">
                  <span>Kurir</span>
                  <select name="kurir" class="form-control">
                    <option value="">-- Belum Ditentukan --</option>
                    <?= implode('', array_map(function ($x) use ($item) {
                      return '<option ' . ($item->kurir === $x ? 'selected' : '') .
                        ' value="' . $x . '">' . ucfirst($x) . '</option>';
                    }, explode(',', \App\Entities\Config::get()->agen_kurir))) ?>
                  </select>
                </label>
                <label class="d-block mb-3">
                  <span>Status</span>
                  <select name="status" class="form-control">
                    <?= implode('', array_map(function ($x) use ($item) {
                      return '<option ' . ($item->status === $x ? 'selected' : '') .
                        ' value="' . $x . '">' . ucfirst($x) . '</option>';
                    }, \App\Models\PenjualanModel::$statuses)) ?>
                  </select>
                </label>
                <div class="d-flex mb-3">
                  <input type="submit" value="Simpan" class="btn btn-primary mr-auto">
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="d-flex mb-3">
          <a href="/admin/penjualan/" class="btn btn-outline-secondary mr-auto"><i class="fa fa-arrow-left"></i></a>
          <?php if ($item->id) : ?>
            <label for="delete-form" class="btn btn-danger mb-0"><i class="fa fa-trash"></i></label>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>

  <form method="POST" action="/admin/penjualan/delete/<?= $item->id ?>">
    <input type="submit" hidden id="delete-form" onclick="return confirm('Hapus penjualan secara permanen?')">
  </form>
  <?= view('shared/summernote') ?>
</body>

</html>