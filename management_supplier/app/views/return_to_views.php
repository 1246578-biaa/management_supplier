<?php include __DIR__ . '/template/header.php'; ?>

<div class="container-fluid mt-4">
    <h3 class="mb-3">Daftar Retur (Supplier Datang Langsung)</h3>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <!-- Form tambah retur -->
    <div class="panel panel-primary mb-4 shadow-sm">
        <div class="panel-heading bg-primary text-white p-2"><b>Tambah Retur</b></div>
        <div class="panel-body p-3">
            <form action="index.php?controller=return_to&action=simpan" method="post">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>Supplier</label>
                        <select name="id_supplier" class="form-control" required>
                            <?php foreach($suppliers as $s): ?>
                                <option value="<?= $s['id_supplier']; ?>"><?= $s['nama_supplier']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Barang</label>
                        <select name="id_barang" class="form-control" required>
                            <?php foreach($barangs as $b): ?>
                                <option value="<?= $b['id_barang']; ?>"><?= $b['nama_barang']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label>Alasan</label>
                        <input type="text" name="alasan" class="form-control" required>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label>Tanggal Return</label>
                        <input type="date" name="tanggal_return" class="form-control" required>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-success mt-2">Simpan Retur</button>
            </form>
        </div>
    </div>

    <!-- Tabel daftar retur -->
    <div class="panel panel-default shadow-sm">
        <div class="panel-heading bg-secondary text-white p-2"><b>Daftar Retur</b></div>
        <div class="panel-body p-3">
            <div class="table-responsive">
                <table id="returTable" class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Retur</th>
                            <th>Supplier</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Alasan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $row): ?>
                        <tr>
                            <td><?= $row['id_return']; ?></td>
                            <td><?= $row['nama_supplier']; ?></td>
                            <td><?= $row['nama_barang']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                            <td><?= $row['alasan']; ?></td>
                            <td><?= $row['tanggal_return']; ?></td>
                            <td>
                                <a href="index.php?controller=return_to&action=edit&id=<?= $row['id_return']; ?>" 
                                class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?controller=return_to&action=hapus&id=<?= $row['id_return']; ?>" 
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus retur ini?');">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
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
    $('#returTable').DataTable({
        "order": [[0, "desc"]],
        "columnDefs": [
            { "orderable": false, "targets": 7 }
        ]
    });
});
</script>

<?php include __DIR__ . '/template/footer.php'; ?>
