<?php include __DIR__ . '/template/header.php'; ?>

<div class="container-fluid mt-4">
    <h3 class="mb-3">Edit Pesanan Diambil</h3>

    <div class="panel panel-primary mb-4 shadow-sm">
        <div class="panel-heading bg-warning text-white p-2"><b>Form Edit Pesanan</b></div>

        <div class="panel-body p-3">
            <form action="index.php?controller=pesanan_diambil&action=update" method="post">
                <input type="hidden" name="id_pesanan" value="<?= $pesanan['id_pesanan']; ?>">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Supplier</label>
                        <select name="id_supplier" class="form-control" required>
                            <?php while($s = $suppliers->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option value="<?= $s['id_supplier']; ?>" <?= $s['id_supplier'] == $pesanan['id_supplier'] ? 'selected' : ''; ?>>
                                    <?= $s['nama_supplier']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= $pesanan['tgl_pesanan']; ?>" required>
                    </div>
                </div>

                <h6>Detail Barang</h6>
                <div id="detail-barang">
                    <?php foreach ($detail as $d) { ?>
                    <div class="row mb-2 barang-row">
                        <div class="col-md-6">
                            <select name="id_barang[]" class="form-control" required>
                                <?php foreach($barangs as $b) { ?>
                                    <option value="<?= $b['id_barang']; ?>" <?= $b['id_barang'] == $d['id_barang'] ? 'selected' : ''; ?>>
                                        <?= $b['nama_barang']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <input type="number" name="jumlah[]" class="form-control" value="<?= $d['jumlah']; ?>" required>
                        </div>

                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-barang w-100">Hapus</button>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <br>
                <button type="button" class="btn btn-info mb-3" id="add-barang">Tambah Barang</button>
                <button type="submit" class="btn btn-success">Update Pesanan</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?controller=pesanan_diambil&action=index'">Kembali</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#add-barang').click(function(){
        let row = $('.barang-row:first').clone();
        row.find('input').val('');
        row.find('select').prop('selectedIndex',0);
        row.find('.col-md-2').html('<button type="button" class="btn btn-danger remove-barang w-100">Hapus</button>');
        $('#detail-barang').append(row);
    });

    $('#detail-barang').on('click', '.remove-barang', function(){
        $(this).closest('.barang-row').remove();
    });
});
</script>

<?php include __DIR__ . '/template/footer.php'; ?>
