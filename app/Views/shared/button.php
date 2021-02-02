<div>
    <?php foreach ($actions as $value) : ?>
        <?php switch ($value) {
            case 'delete':
        ?>
                <a href="<?= $value . '/' . $target ?>" class="btn <?= $size ?> btn-danger"><i class="fa fa-delete"></i></a>
            <?php
                break;
            case 'edit':
            ?>
                <a href="<?= $value . '/' . $target ?>" class="btn <?= $size ?> btn-warning"><i class="fa fa-edit"></i></a>
            <?php
                break;
            case 'detail':
            ?>
                <a href="<?= $value . '/' . $target ?>" class="btn <?= $size ?> btn-primary"><i class="fa fa-info-circle"></i></a>
            <?php
                break;
            case 'barang':
            ?>
                <a href="<?= $value . '/' . $target ?>" class="btn <?= $size ?> btn-primary"><i class="fa fa-shopping-cart"></i></a>
            <?php
                break;
            case 'review':
            ?>
                <a href="<?= $value . '/' . $target ?>" class="btn <?= $size ?> btn-primary"><i class="fa fa-star"></i></a>
            <?php
                break;
            case 'open':
            ?>
                <a href="<?= $value . '/' . $target ?>" target="_blank" class="btn <?= $size ?> btn-success"><i class="fa fa-external-link-alt"></i></a>
            <?php
                break;
            case 'add':
            ?>
                <a href="<?= $value . '/' . $target ?>" class="btn <?= $size ?> btn-success"><i class="fa fa-plus-circle"></i></a>
            <?php
                break;
            case 'view':
            ?>
                <a href="?view=<?= ($_GET['view'] ?? '') === 'grid' ? 'list' : 'grid' ?>" class="btn <?= $size ?> btn-info"><i class="fa fa-<?= ($_GET['view'] ?? '') === 'grid' ? 'list' : 'th' ?>"></i></a>
            <?php
                break;
            case 'timer':
            ?>
                <a href="?<?= ($_GET['timer'] ?? '') === 'y' ? '' : 'timer=y' ?>" class="btn <?= $size ?> btn-info"><i class="fa-clock fa<?= ($_GET['timer'] ?? '') === 'y' ? 's' : 'r' ?>"></i></a>
            <?php
                break;
            case 'archive':
            ?>
                <a href="?<?= ($_GET['archive'] ?? '') === 'y' ? '' : 'archive=y' ?>" class="btn <?= $size ?> btn-dark"><i class="fa-file-archive fa<?= ($_GET['archive'] ?? '') === 'y' ? 's' : 'r' ?>"></i></a>
            <?php
                break;
            case 'download':
            ?>
                <a href="<?= $value . '/' . $target ?>" class="btn <?= $size ?> btn-success"><i class="fa fa-download"></i></a>
            <?php
                break;
            case 'wa':
            ?>
                <a href="<?= $value . '/' . $target ?>" target="_blank" class="btn <?= $size ?> btn-success"><i class="fab fa-whatsapp"></i></a>
        <?php
                break;
        } ?>
    <?php endforeach ?>
</div>