<?php include __DIR__ . "/template/header.php"; ?>

<div class="container-fluid mt-4">
    <h3 class="mb-3">Barang</h3>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <strong>Tambah Barang</strong>
        </div>

        <div class="panel-body">
            <form action="?controller=barang&action=simpan" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-3">
                        <label>ID Barang</label>
                        <input type="text" name="id_barang" class="form-control" value="<?= $idBaru ?>" readonly>
                    </div>

                    <div class="col-md-3">
                        <label>Supplier</label>
                        <select name="id_supplier" class="form-control" required>
                            <option value="">-- Pilih Supplier --</option>
                            <?php foreach ($suppliers as $s): ?>
                                <option value="<?= $s['id_supplier'] ?>">
                                    <?= $s['id_supplier'] . " - " . $s['nama_supplier'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" min="1" required>
                    </div>

                    <div class="col-md-3">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control" min="100" required>
                    </div>

                    <div class="col-md-3">
                        <label>Upload Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                </div>

                <br>
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-save"></span> Simpan Barang
                </button>
            </form>
        </div>
    </div>

   
    <h3 class="mb-3">Daftar Barang</h3>

    <div class="card p-3 shadow-sm mb-4">
        <label>Cari Barang</label>
        <input type="text" id="searchBarang" class="form-control" placeholder="Cari ID / Nama / Supplier...">
    </div>

    <div class="panel panel-default">
        <div class="panel-heading"><strong>Daftar Barang</strong></div>
        <div class="panel-body">

            <table class="table table-bordered table-striped" id="barangTable">
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th>Supplier</th>
                        <th>Nama Barang</th>
                        <th width="60">Stok</th>
                        <th width="120">Harga</th>
                        <th width="80">Gambar</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($barangList as $b): ?>
                    <tr>
                        <td><?= $b['id_barang'] ?></td>
                        <td><?= $b['nama_supplier'] ?></td>
                        <td><?= $b['nama_barang'] ?></td>
                        <td><?= $b['stok'] ?></td>
                        <td>Rp <?= number_format($b['harga']) ?></td>
                        <td>
                            <?php if ($b['Gambar']): ?>
                                <img src="assets/images/<?= $b['Gambar'] ?>" width="60" class="img-thumbnail">
                            <?php else: ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="?controller=barang&action=edit&id=<?= $b['id_barang'] ?>"
                               class="btn btn-warning btn-sm">
                               <span class="glyphicon glyphicon-pencil"></span> Edit
                            </a>

                            <a href="?controller=barang&action=hapus&id=<?= $b['id_barang'] ?>"
                               onclick="return confirm('Hapus barang ini?')"
                               class="btn btn-danger btn-sm">
                               <span class="glyphicon glyphicon-trash"></span> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<script>
$("#searchBarang").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#barangTable tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});
</script>

<?php include __DIR__ . "/template/footer.php"; ?>
