<div class="container mt-4">
    <h2>Data Barang</h2>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Kondisi</th>
                <th>Gambar</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['id_barang']); ?></td>
                <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                <td><?= htmlspecialchars($row['stok']); ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= htmlspecialchars($row['kondisi_barang']); ?></td>
                <td>
                    <img src="image/<?= htmlspecialchars($row['Gambar'] ?: 'no-image.png'); ?>" 
                        width="80" height="80"
                        style="object-fit: cover;"
                        alt="Gambar Barang">
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
