<!DOCTYPE html>
<html lang="en">
<?= view('shared/head') ?>

<body>
  <div class="wrapper">
    <?= view('admin/navbar') ?>

    <?php /** @var \App\Entities\User $item */ ?>
    <div class="content-wrapper p-4">
      <div class="container" style="max-width: 540px;">
        <div class="card">
          <div class="card-body">
            <form enctype="multipart/form-data" method="post">
              <div class="d-flex mb-3">
                <h1 class="h3 mb-0 mr-auto">Edit Profile</h1>
                <a href="/admin/" class="btn btn-outline-secondary ml-2">Kembali</a>
              </div>
              <label class="d-block mb-3">
                <span>Nama Lengkap</span>
                <input type="text" class="form-control" name="name" value="<?= esc($item->name) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>Nomor HP</span>
                <input type="text" class="form-control" name="nohp" value="<?= esc($item->nohp) ?>" required>
              </label>
              <label class="d-block mb-3">
                <span>Alamat</span>
                <textarea type="text" class="form-control" name="alamat" required><?= esc($item->alamat) ?></textarea>
              </label>
              <label class="d-block mb-3">
                <span>Avatar</span>
                <?= view('shared/file', [
                  'value' => $item->avatar,
                  'name' => 'avatar',
                  'path' => 'avatar',
                  'disabled' => false,
                ]) ?>
              </label>
              <label class="d-block mb-3">
                <span>Password</span>
                <input type="password" class="form-control" name="password" placeholder="<?= $item->id ? 'Masukkan apabila anda ingin mengganti dengan password baru' : '" required="required' ?>">
              </label>
              <div class="d-flex mb-3">
                <input type="submit" value="Simpan" class="btn btn-primary mr-auto">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>