<!DOCTYPE html>
<html lang="en">
<?= view('shared/head') ?>

<body>
  <div class="wrapper">
    <?= view('shared/panel_navbar') ?>
    <?php /** @var \App\Entities\Toko $item */ ?>
    <div class="content-wrapper p-4">
      <div class="container">
        <div class="card">
          <div class="card-body">
            <form method="post" enctype="multipart/form-data">
              <div class="d-flex mb-3">
                <h1 class="h3 mb-0 mr-auto">Edit Toko</h1>
                <a href="/admin/toko/" class="btn btn-outline-secondary ml-2">Back</a>
              </div>
              <label class="d-block mb-3">
                <span>Nama</span>
                <input type="text" class="form-control" name="nama" value="<?= esc($item->nama) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>Lokasi</span>
                <input type="text" class="form-control" name="lokasi" value="<?= esc($item->lokasi) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>Deskripsi</span>
                <textarea type="text" class="form-control" name="deskripsi"  required><?= esc($item->deskripsi) ?></textarea>
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
                <input type="submit" value="Save" class="btn btn-primary mr-auto">
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