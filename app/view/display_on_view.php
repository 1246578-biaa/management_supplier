<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Display On</title>
</head>
<body>
<h2>Edit Data Display On</h2>
<form method="POST" action="">
    <label>ID Barang (tidak bisa diubah):</label><br>
    <input type="number" name="id_barang" value="<?= $data['id_barang'] ?>" readonly><br><br>

    <label>ID Etalase:</label><br>
    <input type="number" name="id_etalase" value="<?= $data['id_etalase'] ?>" required><br><br>

    <button type="submit">Update</button>
</form>
</body>
</html>
