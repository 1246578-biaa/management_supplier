<?php include __DIR__ . "/template/header.php"; ?>

<!-- CEK AKSES (OWNER TIDAK BOLEH EDIT) -->
<?php if ($_SESSION['admin']['role'] != 'admin'): ?>
    <script>
        alert('Anda tidak punya akses untuk mengedit barang!');
        window.location='?controller=barang';
    </script>
<?php exit; endif; ?>

<div class="container-fluid mt-4">
    <h3>Edit Barang</h3>

    <form action="?controller=barang&action=update" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id_barang" value="<?= $barang['id_barang'] ?>">
        <input type="hidden" name="gambar_lama" value="<?= $barang['gambar'] ?>">

        <div class="form-group mb-2">
            <label>Supplier</label>
            <select name="id_supplier" class="form-control" required>
                <?php foreach($suppliers as $s): ?>
                    <option value="<?= $s['id_supplier'] ?>" 
                            <?= ($s['id_supplier'] == $barang['id_supplier'] ? 'selected' : '') ?>>
                        <?= $s['nama_supplier'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group mb-2">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?= $barang['nama_barang'] ?>" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>Stok</label>
            <input type="number" name="stok" value="<?= $barang['stok'] ?>" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>Harga</label>
            <input type="number" name="harga" value="<?= $barang['harga'] ?>" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>Gambar Sekarang</label><br>
            <img src="landing/assets/images/<?= $barang['gambar'] ?>" width="200" class="mb-2" style="object-fit:cover;">
        </div>

        <div class="form-group mb-2">
            <label>Gambar Baru (optional)</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button class="btn btn-success mt-2">Update</button>
        <a href="?controller=barang" class="btn btn-secondary mt-2">Batal</a>
    </form>
</div>

<?php include __DIR__ . "/template/footer.php"; ?>
