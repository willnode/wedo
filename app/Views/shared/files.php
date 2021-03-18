<?php for ($i = 0; $i < $count; $i++) : ?>
    <div class="input-group mb-1">
        <input type="file" name="<?= $name ?>[]" class="form-control h-auto">
        <?php if ($value[$i] ?? '') : ?>
            <div class="input-group-append">
                <a href="<?= '/uploads/' . $path . '/' . $value[$i] ?>" download class="btn btn-success"><i class="fa fa-download"></i></a>
            </div>
        <?php endif ?>
    </div>
<?php endfor ?>
<p>Upload file baru akan menindih file lama</p>