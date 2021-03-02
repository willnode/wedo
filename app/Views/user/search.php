<form method="GET" action="/search/" class="input-group mb-3 mr-sm-2">
    <input type="search" name="s" class="form-control" value="<?= esc($_GET['s'] ?? '')?>" placeholder="Cari Aneka Toko dan Barang">
    <div class="input-group-append">
        <button class="input-group-text"><i class="fas fa-search"></i></button>
    </div>
</form>