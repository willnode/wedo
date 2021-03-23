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
            <?php /** @var \App\Entities\Barang[] $data */ ?>
            <?php /** @var \App\Entities\Toko $toko */ ?>
            <?= view('shared/table', [
              'data' => $data,
              'columns' => [
                'Nama' => function (\App\Entities\Review $x) {
                  return esc($x->nama);
                },
                'Rating' => function (\App\Entities\Review $x) {
                  return $x->rating.'/5';
                },
                'Komentar' => function (\App\Entities\Review $x) {
                  return esc($x->content);
                },
                'Edit' => function (\App\Entities\Review $x) {
                  return view('shared/button', [
                    'actions' => ['open', 'delete'],
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