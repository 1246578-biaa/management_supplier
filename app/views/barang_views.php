<?php include __DIR__ . "/template/header.php"; ?>

<div class="container-fluid mt-4">
<h3>Data Barang</h3>

<?php if ($_SESSION['admin']['role'] == 'admin'): ?>
<div class="panel panel-primary">
    <div class="panel-heading">Tambah Barang</div>
    <div class="panel-body">

        <form action="?controller=barang&action=simpan" method="POST" enctype="multipart/form-data">
            <div class="row">

                <div class="col-md-2">
                    <label>ID</label>
                    <input type="text" name="id_barang" class="form-control" value="<?= $idBaru ?>">
                </div>

                <div class="col-md-2">
                    <label>Supplier</label>
                    <select name="id_supplier" class="form-control" required>
                        <option value="">Pilih</option>
                        <?php foreach($suppliers as $s): ?>
                            <option value="<?= $s['id_supplier'] ?>"><?= $s['nama_supplier'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" required>
                </div>

                <div class="col-md-2">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>

                <div class="col-md-2">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>

                <div class="col-md-3 mt-2">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <div class="col-md-3 mt-2">
                    <br>
                    <button class="btn btn-primary">Simpan Barang</button>
                </div>

            </div>
        </form>

    </div>
</div>
<?php endif; ?>

<div class="panel panel-default">
    <div class="panel-heading">Cari Barang</div>
    <div class="panel-body">
        <input type="text" id="searchBarang" class="form-control" placeholder="Cari barang...">
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Daftar Barang</div>

    <div class="panel-body">

        <table class="table table-bordered table-striped" id="barangTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Supplier</th>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach($barangList as $b): ?>
                <tr>
                    <td><?= $b['id_barang'] ?></td>
                    <td><?= $b['nama_supplier'] ?></td>
                    <td><?= $b['nama_barang'] ?></td>
                    <td><?= $b['stok'] ?></td>
                    <td>Rp <?= number_format($b['harga']) ?></td>
                    <td>
                        <?php if ($b['gambar']): ?>
                            <img src="landing/assets/images/<?= $b['gambar'] ?>" width="60">
                        <?php else: ?>
                            -
                        <?php endif ?>
                    </td>

                    <td>
                        <?php if ($_SESSION['admin']['role'] == 'admin'): ?>
                            <a href="?controller=barang&action=edit&id=<?= $b['id_barang'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a onclick="return confirm('Hapus?')" href="?controller=barang&action=delete&id=<?= $b['id_barang'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                        <?php else: ?>
                            <small>-</small>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>

        <center>
        <ul class="pagination">
        <?php for ($i=1; $i <= $totalPage; $i++): ?>
            <li class="<?= ($i==$page?'active':'') ?>">
                <a href="?controller=barang&action=index&page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor ?>
        </ul>
        </center>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$("#searchBarang").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#barangTable tbody tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
});
</script>

<?php include __DIR__ . "/template/footer.php"; ?>
