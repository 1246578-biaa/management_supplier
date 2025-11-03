<?php include __DIR__ . '/../../template/header.php'; ?>

<div class="container mt-4">
    <h2>Tambah Barang</h2>
    <form method="POST" action="">
        <div class="form-group mb-2">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="form-group mb-2">
            <label>Kondisi Barang</label>
            <select name="kondisi_barang" class="form-control">
                <option value="Layak">Layak</option>
                <option value="Tidak Layak">Tidak Layak</option>
            </select>
        </div>
        <div class="form-group mb-3">   
            <label>Gambar (nama file)</label>
            <input type="text" name="gambar" class="form-control" placeholder="contoh.jpg">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="?controller=barang" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php include __DIR__ . '/../../template/footer.php'; ?>
