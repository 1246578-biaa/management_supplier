<div class="container mt-4">
    <h2>Edit Barang</h2>
    <form method="POST" action="?controller=barang&action=edit&id=<?= $data['id_barang']; ?>">
        <input type="hidden" name="id_barang" value="<?= $data['id_barang']; ?>">
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="<?= $data['nama_barang']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="<?= $data['stok']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Kondisi</label>
            <select name="kondisi_barang" class="form-control">
                <option value="Layak" <?= $data['kondisi_barang'] == 'Layak' ? 'selected' : ''; ?>>Layak</option>
                <option value="tidak layak" <?= $data['kondisi_barang'] == 'tidak layak' ? 'selected' : ''; ?>>Tidak Layak</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Gambar</label>
            <input type="text" name="gambar" class="form-control" value="<?= $data['gambar']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="?controller=barang" class="btn btn-secondary">Kembali</a>
    </form>
</div>
