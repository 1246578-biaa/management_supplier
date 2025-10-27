<!DOCTYPE html>
<html>
<head>
    <title>Data Pesanan</title>
</head>
<body>
    <h1>Data Pesanan</h1>

    <form action="<?= site_url('pesanan/tambah') ?>" method="POST">
        <label>Tanggal Pesanan:</label>
        <input type="date" name="tgl_pesanan" required><br>

        <label>Status:</label>
        <select name="status" required>
            <option value="Diproses">Diproses</option>
            <option value="Dikirim">Dikirim</option>
            <option value="Selesai">Selesai</option>
        </select><br>

        <label>Jumlah:</label>
        <input type="number" name="jumlah" required><br>

        <label>Supplier:</label>
        <select name="supplier" required>
            <?php foreach($supplier as $s): ?>
                <option value="<?= $s->Id_Supplier ?>"><?= $s->Nama_Supplier ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Toko:</label>
        <select name="toko" required>
            <?php foreach($toko as $t): ?>
                <option value="<?= $t->Id_Toko ?>"><?= $t->Nama_Toko ?></option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Tambah Pesanan</button>
    </form>

    <h2>Daftar Pesanan</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Jumlah</th>
            <th>Supplier</th>
            <th>Toko</th>
        </tr>
        <?php foreach($pesanan as $p): ?>
        <tr>
            <td><?= $p->Id_Pesanan ?></td>
            <td><?= $p->Tgl_Pesanan ?></td>
            <td><?= $p->Status ?></td>
            <td><?= $p->Jumlah ?></td>
            <td><?= $p->Nama_Supplier ?></td>
            <td><?= $p->Nama_Toko ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

