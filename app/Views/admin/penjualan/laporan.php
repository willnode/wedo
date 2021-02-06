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