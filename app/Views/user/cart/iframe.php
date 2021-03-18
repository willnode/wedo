<div class="card">
  <div class="card-body">
    <h3>Keranjang Anda</h3>
    <?php $cart =  \App\Libraries\CartProcessor::load() ?>
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
              <td><?= '<img src="/uploads/logo/' . $x->barang->logo[0] ?? '' . '" alt="" class="mr-2 logo">' . esc($x->barang->nama) ?></td>
              <td style="vertical-align: middle;">
                <form action="/cart/set/" method="POST">
                  <input type="hidden" name="barang_id" value="<?= $x->barang_id ?>">
                  <input class="form-control" style="width: 50px;" min="1" max="99" type="number" name="qty" value="<?= $x->qty ?>" onchange="event.target.form.submit()">
                </form>
              </td>
              <td style="vertical-align: middle;"><?= rupiah($x->total) ?></td>
              <td>
                <form action="/cart/delete/" method="POST">
                  <input type="hidden" name="barang_id" value="<?= $x->id ?>">
                  <input type="hidden" name="r" value="/barang/view/<?= $x->id ?>">
                  <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                </form>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
        <tfoot>
          <?php if (($page ?? '') === 'cart') : ?>
            <tr>
              <th colspan="2">
                Ongkos Kirim
              </th>
              <th colspan="2" style="vertical-align: middle;" id="ongkir">-</th>
            </tr>
          <?php endif ?>
          <tr>
            <th colspan="2">Total
              <br>
              <?php if (($page ?? '') !== 'cart') : ?>
                <div class="text-black-50 small">Belum termasuk ongkos kirim</div>
              <?php else : ?>
                <div class="text-black-50 small">Dibayar saat delivery</div>
              <?php endif ?>
            </th>
            <?php $total = \App\Models\CartModel::getTotal($cart) ?>
            <th colspan="2" style="vertical-align: middle;" id="total" data-value="<?= $total ?>"><?= rupiah($total) ?></th>
          </tr>
          <?php if (($page ?? '') !== 'cart') : ?>
            <tr>
              <th colspan="4">
                <a href="/cart/" class="btn btn-block btn-warning">
                  <i class="fa fa-shopping-cart"></i> Checkout
                </a>
              </th>
              </th>
            </tr>
          <?php endif ?>
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