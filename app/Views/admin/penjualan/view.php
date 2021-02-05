<!DOCTYPE html>
<html lang="en">
<?= view('shared/head') ?>

<body>
  <div class="wrapper">
    <?= view('shared/navbar_admin') ?>
    <?php /** @var \App\Entities\Penjualan $item */ ?>
    <?php $user = $item->user ?>
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
                      <th><?= esc($user->name) ?></th>
                    </tr>
                    <tr>
                      <td>Nomor HP</td>
                      <th><a href="../wa/<?= $item->id ?>" target="_blank"><?= esc($user->nohp) ?></a></th>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <th><a href="../maps/<?= $item->id ?>" target="_blank"><?= esc($user->alamat) ?></a></th>
                    </tr>
                    <tr>
                      <td>Avatar</td>
                      <th><img src="<?= $user->getAvatarUrl() ?>" width="60px" alt=""></th>
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
                        (<?= $item->created_at->humanize() ?>)<br>
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
                          <a href="/user/barang/view/<?= $x->barang_id ?>">
                            <?= '<img src="/uploads/logo/' . $x->barang->logo . '" alt="" class="mr-2 logo">' . esc($x->barang->nama) ?>
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
                      <th colspan="3">Total</th>
                      <th style="vertical-align: middle;"><?= rupiah(\App\Models\CartModel::getTotal($item->nota)) ?></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="card">
              <form method="POST" class="card-body">
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
          <a href="/admin/penjualan/" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i></a>
        </div>
      </div>
    </div>
  </div>

  <form method="POST" action="/admin/penjualan/delete/<?= $item->id ?>">
    <input type="submit" hidden id="delete-form" onclick="return confirm('Do you want to delete this article permanently?')">
  </form>
  <?= view('shared/summernote') ?>
</body>

</html>