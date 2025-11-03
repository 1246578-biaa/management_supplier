<?php include __DIR__ . '/../../template/header.php'; ?>

<h2>Edit Supplier</h2>

<form method="POST" action="">
    <input type="hidden" name="id_supplier" value="<?= $data['id_supplier']; ?>">
    <div class="form-group">
        <label>Nama Supplier</label>
        <input type="text" name="nama_supplier" value="<?= $data['nama_supplier']; ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <input type="text" name="alamat" value="<?= $data['alamat']; ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>No. Telepon</label>
        <input type="text" name="no_telp" value="<?= $data['no_telp']; ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Tipe Supplier</label>
        <input type="text" name="tipe_supplier" value="<?= $data['tipe_supplier']; ?>" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="?controller=supplier" class="btn btn-secondary">Batal</a>
</form>

<?php include __DIR__ . '/../../template/footer.php'; ?>
