<?php 
include __DIR__ . '/template/header.php'; 

// cek role admin
if($role !== 'admin'){
    echo "<div class='alert alert-danger'>Akses ditolak: Anda tidak memiliki hak akses.</div>";
    include __DIR__ . '/template/footer.php';
    exit;
}

$allSuppliers = $suppliers;
$allBarangs = $barangs;
?>

<div class="container-fluid mt-4">
    <h3 class="mb-3">Edit Pesanan Dikirim</h3>

    <?php if($role === 'admin'): ?>
    <div class="panel panel-primary mb-4 shadow-sm">
        <div class="panel-heading bg-primary text-white p-2"><b>Form Edit Pesanan</b></div>
        <div class="panel-body p-3">
            <form action="index.php?controller=pesanan_dikirim&action=update" method="post">
                <input type="hidden" name="id_pesanan" value="<?= $pesanan['id_pesanan']; ?>">

                <!-- Supplier & Tanggal -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Supplier</label>
                        <select name="id_supplier" class="form-control" required>
                            <?php foreach($allSuppliers as $s): ?>
                                <option value="<?= $s['id_supplier']; ?>" <?= $s['id_supplier'] == $pesanan['id_supplier'] ? 'selected' : ''; ?>>
                                    <?= $s['nama_supplier']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= $pesanan['tgl_pesanan']; ?>" required>
                    </div>
                </div>

                <!-- Detail Barang -->
                <h6>Detail Barang</h6>
                <div id="detail-barang">
                    <?php foreach ($detail as $d): ?>
                    <div class="row mb-2 barang-row">
                        <div class="col-md-6">
                            <select name="id_barang[]" class="form-control" required>
                                <?php foreach($allBarangs as $b): ?>
                                    <option value="<?= $b['id_barang']; ?>" <?= $b['id_barang'] == $d['id_barang'] ? 'selected' : ''; ?>>
                                        <?= $b['nama_barang']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="jumlah[]" class="form-control" value="<?= $d['jumlah']; ?>" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-barang w-100">Hapus</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Tombol tambah barang -->
                <button type="button" class="btn btn-info mb-3" id="add-barang">Tambah Barang</button>
                <button type="submit" class="btn btn-success">Update Pesanan</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?controller=pesanan_dikirim&action=index'">Kembali</button>
            </form>
        </div>
    </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // Fungsi untuk membuat baris baru
    function createBarangRow() {
        let barangsOptions = '';
        <?php foreach($allBarangs as $b): ?>
            barangsOptions += '<option value="<?= $b['id_barang']; ?>"><?= addslashes($b['nama_barang']); ?></option>';
        <?php endforeach; ?>

        let newRow = `
        <div class="row mb-2 barang-row">
            <div class="col-md-6">
                <select name="id_barang[]" class="form-control" required>
                    ${barangsOptions}
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" name="jumlah[]" class="form-control" value="1" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-barang w-100">Hapus</button>
            </div>
        </div>`;
        return newRow;
    }

    // Tambah baris baru
    $('#add-barang').click(function(){
        $('#detail-barang').append(createBarangRow());
    });

    // Hapus baris
    $('#detail-barang').on('click', '.remove-barang', function(){
        if($('.barang-row').length > 1){
            $(this).closest('.barang-row').remove();
        } else {
            alert('Minimal harus ada 1 barang.');
        }
    });
});
</script>

<?php include __DIR__ . '/template/footer.php'; ?>
