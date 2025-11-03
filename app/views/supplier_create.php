<?php include __DIR__ . '/../../template/header.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Tambah Supplier</h2>
    </div>
</div>

<form action="" method="POST">
    <div class="form-group">
        <label>Nama Supplier</label>
        <input type="text" name="nama_supplier" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <input type="text" name="alamat" class="form-control" required>
    </div>

    <div class="form-group">
        <label>No Telepon</label>
        <input type="text" name="no_telp" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Tipe Supplier</label>
        <input type="text" name="tipe_supplier" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="?controller=supplier" class="btn btn-default">Kembali</a>
</form>

<?php include __DIR__ . '/../../template/footer.php'; ?>
