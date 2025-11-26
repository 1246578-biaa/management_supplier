<?php include __DIR__ . '/template/header.php'; ?>

<div class="container-fluid mt-4">
    <h3 class="mb-3">Data Supplier</h3>

    <!-- =============================== -->
    <!-- PANEL TAMBAH SUPPLIER -->
    <!-- =============================== -->
    <div class="panel panel-primary">
        <div class="panel-heading"><b>Tambah Supplier</b></div>
        <div class="panel-body">
            <form action="?controller=supplier&action=simpan" method="POST">

                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label>ID Supplier</label>
                        <input type="text" name="id_supplier" class="form-control" value="<?= $idBaru; ?>" readonly>
                    </div>

                    <div class="col-md-5 mb-2">
                        <label>Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-2">
                        <label>Nama Alias</label>
                        <input type="text" name="nama_alias" class="form-control">
                    </div>

                    <div class="col-md-4 mb-2">
                        <label>No. Telepon</label>
                        <input type="text" name="no_telp" class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-2">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>

                    <div class="col-md-2 mb-2">
                        <label>Tipe Supplier</label>
                        <select name="tipe_supplier" class="form-control" required>
                            <option value="">-- pilih --</option>
                            <option value="Mengirim">Mengirim</option>
                            <option value="Diambil">Diambil</option>
                            <option value="Datang_langsung">Datang langsung</option>
                        </select>
                    </div>

                    <!-- <div class="col-md-3 mb-2">
                        <label>Jadwal Pengiriman</label>
                        <input type="date" name="jadwal_pengiriman" class="form-control" required>
                    </div> -->
                </div>

                <br>
                <button type="submit" class="btn btn-primary mt-2">
                    Simpan Supplier
                </button>
            </form>
        </div>
    </div>

    <!-- =============================== -->
    <!-- TABEL DATA SUPPLIER -->
    <!-- =============================== -->
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
                            <th>Jadwal Pengiriman</th>
                            <th width="110px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?= $row['id_supplier']; ?></td>
                            <td><?= $row['nama_supplier']; ?></td>
                            <td><?= $row['nama_alias']; ?></td>
                            <td><?= $row['no_telp']; ?></td>
                            <td><?= $row['alamat']; ?></td>
                            <td><?= $row['tipe_supplier']; ?></td>
                            <td><?= $row['jadwal_pengiriman']; ?></td>
                            <td>
                                <a href="?controller=supplier&action=edit&id=<?= $row['id_supplier']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?controller=supplier&action=delete&id=<?= $row['id_supplier']; ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Hapus data supplier ini?');">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- DATATABLES -->
<script src="admin/js/jquery-3.6.0.min.js"></script>
<script src="admin/js/plugins/dataTables/jquery.dataTables.min.js"></script>
<script src="admin/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#supplierTable').DataTable({
        "order": [[0, "asc"]],
        "columnDefs": [
            { "orderable": false, "targets": 7 }
        ]
    });
});
</script>

<?php include __DIR__ . '/template/footer.php'; ?>
