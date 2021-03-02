<!DOCTYPE html>
<html lang="en">

<?= view('shared/head') ?>

<body>
    <div class="wrapper">
        <?= view('user/navbar') ?>
        <?php /** @var \App\Entities\Penjualan[] $data */ ?>
        <div class="content-wrapper p-4">
            <div class="container">
                <?= view('user/cart/iframe') ?>
            </div>
        </div>
    </div>
</body>

</html>