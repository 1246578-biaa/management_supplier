<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Kondisi Barang</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataBarang as $row): ?>
            <tr>
                <td><?= $row['nama_barang']; ?></td>
                <td><?= $row['stok']; ?></td>
                <td><?= number_format($row['harga'], 2, ',', '.'); ?></td>
                <td><?= $row['kondisi_barang']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
