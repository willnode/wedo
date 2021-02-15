<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
    <?= view('shared/navbar_index') ?>
      <div class="container py-4">
        <div class="card">
          <div class="card-body">
            <?php /** @var \App\Entities\Penjualan[] $data */ ?>
            <h1 class="mb-3">Daftar Transaksi Pembelian</h1>
            <div class="row user-choose">
              <?php foreach ($data as $item) : ?>
                <?php $nota = $item->nota ?>
                <div class="col-12">
                  <div class="p-3">
                    <a href="/history/view/<?= $item->id ?>" class="item d-flex flex-row align-items-center">
                      <img class="mr-2" src="/uploads/logo/<?= $nota[0]->barang->logo ?>" alt="" width="100px">
                      <h4 class="mr-auto"><?= $nota[0]->barang->nama ?><?= isset($nota[1]) ? ', ...' : '' ?></h4>
                      <h5 class="text-black-50 mx-4"><?= $item->created_at->humanize() ?></h5>
                      <h4><?= \App\Models\PenjualanModel::$statusesInHtml[$item->status] ?></h4>
                    </a>
                  </div>
                </div>
              <?php endforeach ?>
            </div>
            <?= view('shared/pagination') ?>
            <div class="alert">
              <i class="fas fa-info mr-2"></i> Segala update tentang transaksi anda akan di beritahukan melalui nomor WhatsApp anda.
            </div>
          </div>
        </div>
      </div>
</body>

</html>