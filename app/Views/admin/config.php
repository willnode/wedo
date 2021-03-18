<!DOCTYPE html>
<html lang="en">
<?= view('shared/head') ?>

<body>
  <div class="wrapper">
    <?= view('admin/navbar') ?>
    <?php /** @var \App\Entities\Config $item */ ?>
    <div class="content-wrapper p-4">
      <div class="container" style="max-width: 540px;">
        <div class="card">
          <div class="card-body">
            <form enctype="multipart/form-data" method="post">
              <?php foreach ($item->toArray() as $key => $value) : ?>
                <label class="d-block mb-3">
                  <span><?= ucwords(str_replace('_', ' ', $key)) ?></span>
                  <?php if ($key == 'banner') : ?>
                    <?= view('shared/files', [
                      'value' => $item->banner ?? [],
                      'name' => "banner",
                      'count' => 8,
                      'path' => 'banner',
                    ]); ?>
                  <?php else : ?>
                    <input type="text" class="form-control" name="<?= $key ?>" value="<?= esc($value) ?>" required>
                  <?php endif ?>
                </label>
              <?php endforeach ?>
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
</body>

</html>