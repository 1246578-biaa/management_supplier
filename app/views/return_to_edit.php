<?php include __DIR__ . '/template/header.php'; ?>

<div class="container-fluid mt-4">
    <h3 class="mb-3">Edit Return</h3>

    <?php 
    // Cek apakah user admin
    if(!isset($_SESSION['admin']['role']) || $_SESSION['admin']['role'] !== 'admin'):
    ?>
        <div class="alert alert-danger">Anda tidak memiliki akses untuk mengedit return.</div>
        <a href="index.php?controller=return_to&action=index" class="btn btn-secondary mt-2">Kembali</a>
    <?php else: ?>
    
    <div class="panel panel-primary mb-4 shadow-sm">
        <div class="panel-heading bg-primary text-white p-2"><b>Edit Return</b></div>
        <div class="panel-body p-3">
            <form action="index.php?controller=return_to&action=update" method="post">
                <input type="hidden" name="id_return" value="<?= $data['id_return']; ?>">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>Supplier</label>
                        <select name="id_supplier" class="form-control" required>
                            <?php foreach($suppliers as $s): ?>
                                <option value="<?= $s['id_supplier']; ?>" <?= $s['id_supplier']==$data['id_supplier']?'selected':''; ?>>
                                    <?= $s['nama_supplier']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Barang</label>
                        <select name="id_barang" class="form-control" required>
                            <?php foreach($barangs as $b): ?>
                                <option value="<?= $b['id_barang']; ?>" <?= $b['id_barang']==$data['id_barang']?'selected':''; ?>>
                                    <?= $b['nama_barang']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah']; ?>" required>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label>Tanggal Return</label>
                        <input type="date" name="tanggal_return" class="form-control" value="<?= $data['tanggal_return']; ?>" required>
                    </div>
                </div>
                <br>
                <div class="mb-2">
                    <label>Alasan</label>
                    <input type="text" name="alasan" class="form-control" value="<?= $data['alasan']; ?>">
                </div>
                <br>
                <button type="submit" class="btn btn-success mt-2">Update Return</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?controller=return_to&action=index'">Kembali</button>
            </form>
        </div>
    </div>

    <?php endif; ?>
</div>

<?php include __DIR__ . '/template/footer.php'; ?>
