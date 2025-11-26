<?php
// partial untuk modal detail (dipanggil oleh controller detail())
if(empty($dataPesanan)){
    echo '<div class="alert alert-danger">Pesanan tidak ditemukan.</div>';
    return;
}
?>
<div class="table-responsive">
<table class="table table-bordered">
    <tr><th style="width:150px">ID Pesanan</th><td><?= htmlspecialchars($dataPesanan['id_pesanan']) ?></td></tr>
    <tr><th>Tanggal</th><td><?= htmlspecialchars($dataPesanan['tgl_pesanan']) ?></td></tr>
    <tr><th>Status</th><td><?= htmlspecialchars($dataPesanan['status']) ?></td></tr>
    <tr><th>Supplier</th><td><?= htmlspecialchars($dataPesanan['nama_supplier'] ?? $dataPesanan['id_supplier']) ?></td></tr>
</table>
</div>

<h5>Detail Barang</h5>
<div class="table-responsive">
<table class="table table-striped table-bordered">
    <thead>
        <tr><th>No</th><th>ID Barang</th><th>Nama Barang</th><th>Jumlah</th></tr>
    </thead>
    <tbody>
        <?php if(empty($dataDetail)): ?>
            <tr><td colspan="4" class="text-center">Tidak ada item</td></tr>
        <?php else: $no=1; foreach($dataDetail as $d): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($d['id_barang']) ?></td>
                <td><?= htmlspecialchars($d['nama_barang']) ?></td>
                <td><?= htmlspecialchars($d['jumlah']) ?></td>
            </tr>
        <?php endforeach; endif; ?>
    </tbody>
</table>
</div>
