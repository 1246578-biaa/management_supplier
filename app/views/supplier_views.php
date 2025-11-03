<?php include __DIR__ . '/../../template/header.php'; ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Master Supplier</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Supplier dari Database
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Supplier</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Tipe supplier</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id_supplier']); ?></td>
                                    <td><?= htmlspecialchars($row['nama_supplier']); ?></td>
                                    <td><?= htmlspecialchars($row['alamat']); ?></td>
                                    <td><?= htmlspecialchars($row['no_telp']); ?></td>
                                    <td><?= htmlspecialchars($row['tipe_supplier']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../template/footer.php'; ?>
