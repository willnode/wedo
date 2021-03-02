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
    <?= view('admin/navbar') ?>
    <div class="content-wrapper p-4">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <?php /** @var \App\Entities\Toko[] $data */ ?>
            <div class="d-flex flex-column flex-md-row">
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
                'Nama' => function (\App\Entities\Toko $x) {
                  return '<img src="/uploads/logo/' . $x->logo . '?w=150&h=150" alt="" class="mr-2 logo">' . esc($x->nama);
                },
                'Lokasi' => function (\App\Entities\Toko $x) {
                  return esc($x->lokasi);
                },
                'Edit' => function (\App\Entities\Toko $x) {
                  return view('shared/button', [
                    'actions' => ['barang','edit','open'],
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