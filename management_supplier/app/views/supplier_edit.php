<?php include __DIR__ . '/template/header.php'; ?>

<h2>Edit Supplier</h2>

<form method="POST" action="">
    <input type="hidden" name="id_supplier" value="<?= $data['id_supplier']; ?>">

    <div class="form-group">
        <label>Nama Supplier</label>
        <input type="text" name="nama_supplier" value="<?= $data['nama_supplier']; ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Nama Alias</label>
        <input type="text" name="nama_alias" value="<?= $data['nama_alias']; ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>No. Telepon</label>
        <input type="text" name="no_telp" value="<?= $data['no_telp']; ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <input type="text" name="alamat" value="<?= $data['alamat']; ?>" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Tipe Supplier</label>
        <select name="tipe_supplier" class="form-control" required>
            <option value="Mengirim" <?= ($data['tipe_supplier'] == 'Mengirim') ? 'selected' : ''; ?>>Mengirim</option>
            <option value="Diambil" <?= ($data['tipe_supplier'] == 'Diambil') ? 'selected' : ''; ?>>Diambil</option>
            <option value="Datang_langsung" <?= ($data['tipe_supplier'] == 'Datang_langsung') ? 'selected' : ''; ?>>Datang Langsung</option>
        </select>
    </div>

    <div class="form-group">
        <label>Jadwal Pengiriman</label>
        <input type="date" name="jadwal_pengiriman" value="<?= $data['jadwal_pengiriman']; ?>" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="?controller=supplier" class="btn btn-secondary">Batal</a>
</form>

<?php include __DIR__ . '/template/footer.php'; ?>
