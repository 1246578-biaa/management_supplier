<?php include __DIR__ . '/template/header.php'; ?>

<div class="container-fluid mt-4">
    <h3 class="mb-3">Return Supplier Datang Langsung</h3>

    <?php if(!empty($notif)): ?>
        <div class="alert alert-info"><?= $notif ?></div>
    <?php endif; ?>

    <!-- =============================== -->
    <!-- PANEL TAMBAH RETURN -->
    <!-- =============================== -->
    <div class="panel panel-primary">
        <div class="panel-heading">Tambah Return</div>
        <div class="panel-body">

            <form action="index.php?controller=return_to&action=simpan" method="post">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>ID Return</label>
                            <input type="text" name="id_return" class="form-control" value="<?= $newId ?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Supplier</label>
                            <select name="id_supplier" id="id_supplier" class="form-control" required>
                                <option value="">-- Pilih Supplier --</option>
                                <?php foreach($suppliers as $s): ?>
                                    <option value="<?= $s['id_supplier'] ?>">
                                        <?= $s['id_supplier'] ?> - <?= $s['nama_supplier'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Barang</label>
                            <select name="id_barang" id="id_barang" class="form-control" required>
                                <option value="">-- Pilih Barang --</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" id="nama_barang" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" value="1" required>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alasan</label>
                            <input type="text" name="alasan" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tanggal Return</label>
                            <input type="date" name="tanggal_return" class="form-control" required>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-save"></span> Simpan Return
                </button>

            </form>

        </div>
    </div>

    <!-- =============================== -->
    <!-- PANEL DATA RETURN -->
    <!-- =============================== -->
    <div class="panel panel-default">
        <div class="panel-heading">Data Return</div>

        <div class="panel-body">

            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Return</th>
                        <th>Supplier</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Alasan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($returns as $r): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $r['id_return'] ?></td>
                        <td><?= $r['singkat_supplier'] ?></td>
                        <td><?= $r['nama_barang'] ?></td>
                        <td><?= $r['jumlah'] ?></td>
                        <td><?= $r['alasan'] ?></td>
                        <td><?= $r['tanggal_return'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
// AJAX: Load barang per supplier
document.getElementById('id_supplier').addEventListener('change', function() {
    const supplierId = this.value;
    const barangSelect = document.getElementById('id_barang');
    const namaBarang = document.getElementById('nama_barang');

    barangSelect.innerHTML = '<option value="">Memuat...</option>';
    namaBarang.value = '';

    if (!supplierId) {
        barangSelect.innerHTML = '<option value="">-- Pilih Barang --</option>';
        return;
    }

    fetch(`index.php?controller=return_to&action=getBarang&id_supplier=${supplierId}`)
        .then(res => res.json())
        .then(data => {
            barangSelect.innerHTML = '<option value="">-- Pilih Barang --</option>';
            data.forEach(b => {
                const option = document.createElement('option');
                option.value = b.id_barang;
                option.dataset.nama = b.nama_barang;
                option.textContent = b.id_barang + ' - ' + b.nama_barang;
                barangSelect.appendChild(option);
            });
        });
});

document.getElementById('id_barang').addEventListener('change', function() {
    const nama = this.options[this.selectedIndex].dataset.nama || '';
    document.getElementById('nama_barang').value = nama;
});
</script>

<?php include __DIR__ . '/template/footer.php'; ?>
