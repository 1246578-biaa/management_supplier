<?php include __DIR__ . '/template/header.php'; ?>

<div class="container-fluid mt-4">
    <h3 class="mb-3">Pesanan Dikirim (Supplier Mengirim)</h3>

    <div class="panel panel-primary mb-4 shadow-sm">
        <div class="panel-heading bg-primary text-white p-2"><b>Tambah Pesanan</b></div>
        <div class="panel-body p-3">
            <form action="index.php?controller=pesanan_dikirim&action=simpan" method="post">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Supplier</label>
                        <select name="id_supplier" class="form-control" required>
                            <?php foreach($suppliers as $s) { ?>
                                <option value="<?= $s['id_supplier']; ?>"><?= $s['nama_supplier']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                </div>

                <h6>Detail Barang</h6>
                <div id="detail-barang">
                    <div class="row mb-3 barang-row">
                        <div class="col-md-6">
                            <select name="id_barang[]" class="form-control" required>
                                <?php foreach($barangs as $b) { ?>
                                    <option value="<?= $b['id_barang']; ?>"><?= $b['nama_barang']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="jumlah[]" class="form-control" required placeholder="Jumlah">
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>

                <br>
                <button type="button" id="add-barang" class="btn btn-info mb-3">Tambah Barang</button>
                <button type="submit" class="btn btn-success mt-2">Simpan Pesanan</button>
            </form>
        </div>
    </div>

    <!-- TABEL PESANAN -->
    <div class="panel panel-default shadow-sm">
        <div class="panel-heading bg-secondary text-white p-2"><b>Daftar Pesanan</b></div>
        <div class="panel-body p-3">
            <div class="table-responsive">
                <table id="pesananTable" class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $row) { ?>
                        <tr>
                            <td><?= $row['id_pesanan']; ?></td>
                            <td><?= $row['tgl_pesanan']; ?></td>
                            <td><?= $row['nama_supplier']; ?></td>
                            <td><?= $row['status']; ?></td>
                            <td>
                                <a href="index.php?controller=pesanan_dikirim&action=detail&id=<?= $row['id_pesanan']; ?>" class="btn btn-info btn-sm">Detail</a>
                                <a href="index.php?controller=pesanan_dikirim&action=edit&id=<?= $row['id_pesanan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <?php if($row['status'] != 'Selesai Dikirim'): ?>
                                    <a href="index.php?controller=pesanan_dikirim&action=selesai&id=<?= $row['id_pesanan']; ?>" class="btn btn-success btn-sm" onclick="return confirm('Selesaikan pesanan?')">Selesai</a>
                                <?php endif; ?>
                                <a href="index.php?controller=pesanan_dikirim&action=hapus&id=<?= $row['id_pesanan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pesanan?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$barangsArray = [];
foreach($barangs as $b){
    $barangsArray[] = ['id'=>$b['id_barang'],'nama'=>$b['nama_barang']];
}
$barangsJson = json_encode($barangsArray);
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="admin/js/plugins/dataTables/jquery.dataTables.min.js"></script>
<script src="admin/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
<script>
let barangs = <?= $barangsJson ?>;

$(document).ready(function(){
    $('#pesananTable').DataTable({
        "order": [[0,"desc"]],
        "paging": false,
        "searching": false,
        "info": false
    });

    $('#add-barang').click(function(){
        let newRow = $('<div class="row mb-3 barang-row">'+
            '<div class="col-md-6"><select name="id_barang[]" class="form-control" required></select></div>'+
            '<div class="col-md-4"><input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah" required></div>'+
            '<div class="col-md-2"><button type="button" class="btn btn-danger remove-barang w-100">Hapus</button></div>'+
        '</div>');

        let select = newRow.find('select');
        barangs.forEach(function(b){
            select.append('<option value="'+b.id+'">'+b.nama+'</option>');
        });

        $('#detail-barang').append(newRow);
    });

    $('#detail-barang').on('click','.remove-barang',function(){
        $(this).closest('.barang-row').remove();
    });
});
</script>

<?php include __DIR__.'/template/footer.php'; ?>
