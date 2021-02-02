<div class="card">
  <div class="card-body">
    <h3>Keranjang Anda</h3>
    <?php $cart =  (new \App\Models\CartModel())->withUser(\Config\Services::login()->id)->asCart() ?>
    <table class="table my-3">
      <thead>
        <tr>
          <th>Barang</th>
          <th>Qty</th>
          <th>Harga</th>
          <th></th>
        </tr>
      </thead>
      <?php if ($cart) : ?>
        <tbody>
          <?php foreach ($cart as $x) : ?>
            <tr>
              <td><?= '<img src="/uploads/logo/' . $x->logo . '" alt="" class="mr-2 logo">' . esc($x->nama) ?></td>
              <td style="vertical-align: middle;">
                <form action="/user/cart/set/" method="POST">
                  <input type="hidden" name="barang_id" value="<?= $x->id ?>">
                  <input class="form-control" style="width: 50px;" min="1" max="99" type="number" name="qty" value="<?= $x->qty ?>"
                    onchange="event.target.form.submit()">
                </form>
              </td>
              <td style="vertical-align: middle;"><?= rupiah($x->total) ?></td>
              <td>
                <form action="/user/cart/delete/" method="POST">
                  <input type="hidden" name="barang_id" value="<?= $x->id ?>">
                  <input type="hidden" name="r" value="/user/barang/view/<?= $x->id ?>">
                  <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                </form>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="2">Total</th>
            <th colspan="2" style="vertical-align: middle;"><?= rupiah(\App\Models\CartModel::getTotal($cart)) ?></th>
          </tr>
          <tr>
            <th colspan="4">
              <form action="/user/cart/checkout/" method="POST">
                <button class="btn btn-block btn-warning"><i class="fa fa-shopping-cart"></i> Checkout</button>
              </form>
            </th>
            </th>
          </tr>
        </tfoot>
      <?php else : ?>
        <tr>
          <td colspan="4" class="text-center text-muted">
            Belum ada barang disini
          </td>
        </tr>
      <?php endif ?>
    </table>
  </div>
  <?= view('shared/pagination') ?>
</div>