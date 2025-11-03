<div class="container mt-4">
    <h2>Data Barang</h2>
    <a href="?controller=barang&action=create" class="btn btn-primary mb-3">+ Tambah Barang</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Kondisi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?= $row['id_barang']; ?></td>
                <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                <td><?= htmlspecialchars($row['stok']); ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= htmlspecialchars($row['kondisi_barang']); ?></td>
                <td><?= $row['gambar'] ? $row['gambar'] : 'Tidak ada'; ?></td>
                <td>
                    <a href="?controller=barang&action=edit&id=<?= $row['id_barang']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?controller=barang&action=delete&id=<?= $row['id_barang']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus data ini?');">Hapus</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
