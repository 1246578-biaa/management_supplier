<?php include __DIR__ . "/template/header.php"; ?>

<div class="container">

    <h3>Edit Barang</h3>

    <form action="index.php?controller=barang&action=update" method="POST" enctype="multipart/form-data" class="form-horizontal">

        <input type="hidden" name="gambar_lama" value="<?= $barang['Gambar'] ?>">

        <div class="form-group">
            <label class="col-sm-2 control-label">ID Barang</label>
            <div class="col-sm-4">
                <input type="text" name="id_barang" value="<?= $barang['id_barang'] ?>" readonly class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Supplier</label>
            <div class="col-sm-4">
                <select name="id_supplier" class="form-control">
                    <?php foreach ($suppliers as $s): ?>
                    <option value="<?= $s['id_supplier'] ?>" <?= ($s['id_supplier'] == $barang['id_supplier']) ? "selected" : "" ?>>
                        <?= $s['nama_supplier'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Nama Barang</label>
            <div class="col-sm-4">
                <input type="text" name="nama_barang" value="<?= $barang['nama_barang'] ?>" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Stok</label>
            <div class="col-sm-4">
                <input type="number" name="stok" value="<?= $barang['stok'] ?>" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Harga</label>
            <div class="col-sm-4">
                <input type="number" name="harga" value="<?= $barang['harga'] ?>" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Gambar</label>
            <div class="col-sm-4">
                <input type="file" name="Gambar" class="form-control">
                <br>
                <?php if ($barang['Gambar']): ?>
                    <img src="assets/images/<?= $barang['Gambar'] ?>" width="80">
                <?php endif; ?>
            </div>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>

</div>

<?php include __DIR__ . "/template/footer.php"; ?>
