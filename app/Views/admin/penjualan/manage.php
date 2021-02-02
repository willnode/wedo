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
            <?php /** @var \App\Entities\Penjualan[] $data */ ?>
            <div class="d-flex">
              <div class="ml-auto">
                <?= view('shared/button', [
                  'actions' => ['add'],
                  'target' => '',
                  'size' => 'btn-lg'
                ]); ?>
              </div>
            </div>
            <?= view('shared/table', [
              'data' => $data,
              'columns' => [
                'Nama' => function (\App\Entities\Penjualan $x) {
                  return '<img src="/uploads/logo/' . $x->logo . '" alt="" class="mr-2 logo">' . esc($x->nama);
                },
                'Lokasi' => function (\App\Entities\Penjualan $x) {
                  return esc($x->lokasi);
                },
                'Edit' => function (\App\Entities\Penjualan $x) {
                  return view('shared/button', [
                    'actions' => ['detail','edit','open'],
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