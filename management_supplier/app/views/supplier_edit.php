<?php include __DIR__ . '/template/header.php'; ?>

<div class="container-fluid mt-4">
    <h3 class="mb-3">Edit Supplier</h3>

    <div class="panel panel-primary mb-4 shadow-sm">
        <div class="panel-heading bg-primary text-white p-2"><b>Edit Supplier</b></div>
        <div class="panel-body p-3">
            <form method="POST" action="index.php?controller=supplier&action=update">
                <input type="hidden" name="id_supplier" value="<?= $data['id_supplier']; ?>">

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Nama Supplier</label>
                        <input type="text" name="nama_supplier" value="<?= $data['nama_supplier']; ?>" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Nama Alias</label>
                        <input type="text" name="nama_alias" value="<?= $data['nama_alias']; ?>" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>No. Telepon</label>
                        <input type="text" name="no_telp" value="<?= $data['no_telp']; ?>" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Alamat</label>
                        <input type="text" name="alamat" value="<?= $data['alamat']; ?>" class="form-control" required>
                    </div>
                </div>

                <div class="mb-2">
                    <label>Tipe Supplier</label>
                    <select name="tipe_supplier" class="form-control" required>
                        <option value="Mengirim" <?= ($data['tipe_supplier'] == 'Mengirim') ? 'selected' : ''; ?>>Mengirim</option>
                        <option value="Diambil" <?= ($data['tipe_supplier'] == 'Diambil') ? 'selected' : ''; ?>>Diambil</option>
                        <option value="Datang_langsung" <?= ($data['tipe_supplier'] == 'Datang_langsung') ? 'selected' : ''; ?>>Datang Langsung</option>
                    </select>
                </div>

                <br>
                <button type="submit" class="btn btn-success mt-2">Update Supplier</button>
                <a href="index.php?controller=supplier&action=index" class="btn btn-secondary mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/template/footer.php'; ?>
