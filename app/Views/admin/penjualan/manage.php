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
            <div class="d-flex flex-column flex-md-row">
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
                  return esc($x->nama).' &bullet; <small>'.rupiah($x->total).'</small><br><small class="text-black-50">'.esc($x->alamat).'</small>';
                },
                'Status' => function (\App\Entities\Penjualan $x) {
                  if ($x->status == 'menunggu') {
                    $_GET['waiting'] = 'y';
                  }
                  return \App\Models\PenjualanModel::$statusesInHtml[$x->status].($x->kurir ? "<br><small class='text-black-50'>$x->kurir</small>" : "");
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
      <?php if ($_GET['timer'] ?? '') : ?>
        <script>
          setTimeout(function() {
            location.reload();
          }, 30000);
        </script>
        <?php if (isset($_GET['waiting'])) : ?>
          <script>
            var audio = new Audio('/notify.mp3');
            audio.play();
          </script>
        <?php endif ?>
      <?php endif ?>
    </div>
  </div>
</body>

</html>