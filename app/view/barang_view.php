<!DOCTYPE html>
<html>
<head>
    <title>Barang</title>
</head>
<body>
    <h1>Form Tambah Barang</h1>

    <form method="POST" action="landing.php">
        <input type="int" name="id_barang" planceholder=" id Barang" required><br><br>
        <input type="varchar" name="nama_barang" placeholder="Nama Barang" required><br><br>
        <input type="int" name="stok" placeholder="Stok" required><br><br>
        <input type="decimal" step="0.01" name="harga" placeholder="Harga" required><br><br>
        <select name="kondisi_barang" required>
            <option value="">-- Pilih Kondisi --</option>
            <option value="Layak"></option>
            <option value="tidak layak</option>
        </select><br><br>
        <button type="submit">Tambah Barang</button>
    </form>

    <h2>Daftar Barang</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>id barang</th>
            <th>Nama Barang</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Kondisi</th>
        </tr>
        <?php while($row = $data->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id_barang'] ?></td>
            <td><?= htmlspecialchars($row['nama_barang']) ?></td>
            <td><?= $row['stok'] ?></td>
            <td><?= number_format($row['harga'], 2) ?></td>
            <td><?= htmlspecialchars($row['kondisi_barang']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

