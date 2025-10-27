<!DOCTYPE html>
<html>
<head>
    <title>Data Pengiriman</title>
</head>
<body>
    <h1>Data Pengiriman Barang</h1>

    <form action="<?= site_url('mengirim/tambah') ?>" method="POST">
        <label>Supplier:</label>
        <select name="supplier" required>
            <?php foreach($supplier as $s): ?>
                <option value="<?= $s->Id_Supplier ?>"><?= $s->Nama_Supplier ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label>Barang:</label>
        <select name="barang" required>
            <?php foreach($barang as $b): ?>
                <option value="<?= $b->Id_Barang ?>"><?= $b->Nama_Barang ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label>Jumlah:</label>
        <input type="number" name="jumlah" required>
        <br>

        <button type="submit">Kirim</button>
    </form>

    <h2>Daftar Pengiriman</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Supplier</th>
            <th>Barang</th>
            <th>Jumlah</th>
        </tr>
        <?php foreach($pengiriman as $p): ?>
        <tr>
            <td><?= $p->id_pengiriman ?></td>
            <td><?= $p->Id_Supplier ?></td>
            <td><?= $p->Id_Barang ?></td>
            <td><?= $p->Jumlah ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

