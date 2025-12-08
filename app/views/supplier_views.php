<?php include __DIR__ . '/template/header.php'; ?>

<div class="container-fluid mt-4">
    <h3 class="mb-3">Data Supplier</h3>

    <?php if($_SESSION['role'] === 'admin'): ?>
    <div class="panel panel-primary">
        <div class="panel-heading"><strong>Tambah Supplier</strong></div>
        <div class="panel-body">
            <form action="?controller=supplier&action=simpan" method="POST">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label>ID Supplier</label>
                        <input type="text" name="id_supplier" class="form-control" value="<?= $idBaru; ?>" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Nama Alias</label>
                        <input type="text" name="nama_alias" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>No. Telepon</label>
                        <input type="text" name="no_telp" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Tipe Supplier</label>
                        <select name="tipe_supplier" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="Mengirim">Mengirim</option>
                            <option value="Diambil">Diambil</option>
                            <option value="Datang_langsung">Datang langsung</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <br>
                        <button type="submit" class="btn btn-primary btn-block">Simpan Supplier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <!-- TABEL DATA SUPPLIER -->
    <div class="panel panel-default mt-4">
        <div class="panel-heading"><b>Daftar Supplier</b></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="supplierTable" class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Supplier</th>
                            <th>Nama Alias</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
                            <th>Tipe Supplier</th>
                            <?php if($_SESSION['role'] === 'admin'): ?>
                            <th width="120px">Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($suppliers)): ?>
                            <?php foreach($suppliers as $row): ?>
                                <tr>
                                    <td><?= $row['id_supplier']; ?></td>
                                    <td><?= $row['nama_supplier']; ?></td>
                                    <td><?= $row['nama_alias']; ?></td>
                                    <td><?= $row['no_telp']; ?></td>
                                    <td><?= $row['alamat']; ?></td>
                                    <td><?= $row['tipe_supplier']; ?></td>
                                    <?php if($_SESSION['role'] === 'admin'): ?>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="?controller=supplier&action=edit&id=<?= $row['id_supplier']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="?controller=supplier&action=delete&id=<?= $row['id_supplier']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data supplier ini?');">Hapus</a>
                                        </div>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="<?= $_SESSION['role'] === 'admin' ? 7 : 6 ?>" class="text-center">Tidak ada data supplier</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="admin/js/jquery-3.6.0.min.js"></script>
<script src="admin/js/plugins/dataTables/jquery.dataTables.min.js"></script>
<script src="admin/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $('#supplierTable').DataTable({
        "order": [[0, "asc"]],
        "columnDefs": [
            { "orderable": false, "targets": <?= $_SESSION['role'] === 'admin' ? 6 : '""' ?> }
        ]
    });
});
</script>

<?php include __DIR__ . '/template/footer.php'; ?>
