<?php 
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ?controller=supplier");
    exit;
}

include __DIR__ . "/template/header.php"; 
?>

<div class="container-fluid mt-4">
    <h3>Edit Supplier</h3>
    <div class="panel panel-primary">
        <div class="panel-heading"><b>Edit Supplier</b></div>
        <div class="panel-body">
            <form action="?controller=supplier&action=update" method="POST">
                <input type="hidden" name="id_supplier" value="<?= $supplier['id_supplier'] ?>">

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Nama Supplier</label>
                        <input type="text" name="nama_supplier" value="<?= $supplier['nama_supplier'] ?>" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Nama Alias</label>
                        <input type="text" name="nama_alias" value="<?= $supplier['nama_alias'] ?>" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>No Telepon</label>
                        <input type="text" name="no_telp" value="<?= $supplier['no_telp'] ?>" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Alamat</label>
                        <input type="text" name="alamat" value="<?= $supplier['alamat'] ?>" class="form-control" required>
                    </div>
                </div>

                <div class="mb-2">
                    <label>Tipe Supplier</label>
                    <select name="tipe_supplier" class="form-control" required>
                        <option value="Mengirim" <?= $supplier['tipe_supplier']=='Mengirim'?'selected':'' ?>>Mengirim</option>
                        <option value="Diambil" <?= $supplier['tipe_supplier']=='Diambil'?'selected':'' ?>>Diambil</option>
                        <option value="Datang_langsung" <?= $supplier['tipe_supplier']=='Datang_langsung'?'selected':'' ?>>Datang Langsung</option>
                    </select>
                </div>

                <br>
                <button class="btn btn-success">Update</button>
                <a href="?controller=supplier&action=index" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . "/template/footer.php"; ?>
