<!DOCTYPE html>
<html>
<head>
    <title>Data Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #fafafa; }
        h2 { color: #333; }
        table { border-collapse: collapse; width: 90%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:hover { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h2>Data Supplier</h2>
    <table>
        <tr>
            <th>ID Supplier</th>
            <th>Nama Supplier</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
            <th>Tipe Supplier</th>
            <th>Jadwal Pengiriman</th>
        </tr>
        <?php while($row = $data->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id_supplier'] ?></td>
                <td><?= $row['nama_supplier'] ?></td>
                <td><?= $row['no_telp'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['tipe_supplier'] ?></td>
                <td><?= $row['jadwal_pengiriman'] ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
