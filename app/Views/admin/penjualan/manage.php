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
                  'actions' => ['timer', 'archive'],
                  'target' => '',
                  'size' => 'btn-lg'
                ]); ?>
              </div>
            </div>
            <?= view('shared/table', [
              'data' => $data,
              'columns' => [
                'Customer' => function (\App\Entities\Penjualan $x) {
                  return esc($x->name);
                },
                'Lokasi' => function (\App\Entities\Penjualan $x) {
                  return esc($x->alamat);
                },
                'Total' => function (\App\Entities\Penjualan $x) {
                  return rupiah($x->total);
                },
                'Status' => function (\App\Entities\Penjualan $x) {
                  return \App\Models\PenjualanModel::$statusesInHtml[$x->status];
                },
                'Edit' => function (\App\Entities\Penjualan $x) {
                  return view('shared/button', [
                    'actions' => ['wa', 'detail'],
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