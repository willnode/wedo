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
            <div class="d-flex align-items-center">
              <h3 class="mr-auto">Ringkasan Penjualan</h3>
              <a href="/admin/penjualan/export" class="btn btn-success" download><i class="fas fa-download"></i></a>
            </div>
          <?= view('shared/table', [
              'data' => $data,
              'columns' => [
                'Tanggal' => function ($x) {
                  return substr($x->min_date, 0, 10).' s/d '.substr($x->max_date, 0, 10);
                },
                'Penjualan' => function ($x) {
                  return esc($x->qty);
                },
                'Bruto' => function ($x) {
                  return rupiah($x->gross);
                }
              ]
            ]) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>