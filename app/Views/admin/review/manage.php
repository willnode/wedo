<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
  <style>
    .logo {
      width: 64px;
    }
  </style>
  <div class="wrapper">
    <?= view('shared/navbar_admin') ?>
    <div class="content-wrapper p-4">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <?php /** @var \App\Entities\Barang[] $data */ ?>
            <?php /** @var \App\Entities\Toko $toko */ ?>
            <?php if ($toko) : ?>
              <div class="d-flex flex-column flex-md-row align-items-center">
                <a href="/admin/toko/" class="btn btn-lg btn-outline-secondary mr-2"><div class="fa fa-arrow-left"></div></a>
                <h1><?= esc($toko->nama) ?></h1>
                <div class="ml-auto">
                  <?= view('shared/button', [
                    'actions' => ['add'],
                    'target' => '?toko_id=' . $toko->id,
                    'size' => 'btn-lg'
                  ]); ?>
                </div>
              </div>
            <?php endif ?>
            <?= view('shared/table', [
              'data' => $data,
              'columns' => [
                'Nama' => function (\App\Entities\Barang $x) {
                  return '<img src="/uploads/logo/' . $x->logo . '" alt="" class="mr-2 logo">' . esc($x->nama);
                },
                'Harga' => function (\App\Entities\Barang $x) {
                  return rupiah($x->harga);
                },
                'Edit' => function (\App\Entities\Barang $x) {
                  return view('shared/button', [
                    'actions' => ['edit', 'open'],
                    'target' => $x->id,
                    'size' => 'btn-sm'
                  ]);
                }
              ]
            ]) ?>
            <?= view('shared/pagination') ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>