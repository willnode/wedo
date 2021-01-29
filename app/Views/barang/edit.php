<!DOCTYPE html>
<html lang="en">
<?= view('shared/head') ?>

<body>
  <div class="wrapper">
    <?= view('shared/panel_navbar') ?>
    <?php /** @var \App\Entities\Barang $item */ ?>
    <?php /** @var \App\Entities\Toko $toko */ ?>
    <div class="content-wrapper p-4">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
              <div class="d-flex mb-3">
                <h1 class="h3 mb-0 mr-auto">Edit Barang</h1>
                <a href="/admin/barang/?toko_id=<?= esc($toko->id) ?>" class="btn btn-outline-secondary ml-2">Kembali</a>
              </div>
              <label class="d-block mb-3">
                <span>Toko</span>
                <input class="form-control" value="<?= esc($toko->nama) ?>" disabled>
                <input class="form-control" hidden name="toko_id" value="<?= esc($toko->id) ?>">
              </label>
              <label class="d-block mb-3">
                <span>Nama</span>
                <input type="text" class="form-control" name="nama" value="<?= esc($item->nama) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>Harga</span>
                <input type="number" class="form-control" name="harga" value="<?= esc($item->harga) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>Deskripsi</span>
                <textarea type="text" class="form-control" name="content" required><?= esc($item->content) ?></textarea>
              </label>
              <label class="d-block mb-3">
                <span>Logo</span>
                <?= view('shared/file', [
                  'value' => $item->logo,
                  'name' => 'logo',
                  'path' => 'logo',
                  'disabled' => false,
                ]) ?>
              </label>
              <div class="d-flex mb-3">
                <input type="submit" value="Simpan" class="btn btn-primary mr-auto">
                <?php if ($item->id) : ?>
                  <label for="delete-form" class="btn btn-danger mb-0"><i class="fa fa-trash"></i></label>
                <?php endif ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <form method="POST" action="/user/article/delete/<?= $item->id ?>">
    <input type="submit" hidden id="delete-form" onclick="return confirm('Do you want to delete this article permanently?')">
  </form>
  <?= view('shared/summernote') ?>
</body>

</html>