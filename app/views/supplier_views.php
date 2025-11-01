<div class="container mt-4">
    <h2>Data Supplier</h2>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>No Telepon</th>
            </tr>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['id_supplier']); ?></td>
                    <td><?= htmlspecialchars($row['nama_supplier']); ?></td>
                    <td><?= htmlspecialchars($row['alamat']); ?></td>
                    <td><?= htmlspecialchars($row['no_telp']); ?></td>
                </tr>
            <?php } ?>
        </table>
</div>
