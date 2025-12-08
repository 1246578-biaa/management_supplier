<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <tr><th>ID Pesanan</th><td><?= $dataPesanan['id_pesanan'] ?></td></tr>
        <tr><th>Tanggal</th><td><?= $dataPesanan['tgl_pesanan'] ?></td></tr>
        <tr><th>Status</th><td><?= $dataPesanan['status'] ?></td></tr>
        <tr><th>Supplier</th><td><?= $dataPesanan['id_supplier'] ?></td></tr>
    </table>

    <h5>Detail Barang</h5>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1; 
            $grandTotal = 0;
            foreach($dataDetail as $d): 
                $grandTotal += $d['total_harga'];
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['id_barang'] ?></td>
                <td><?= $d['nama_barang'] ?></td>
                <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
                <td><?= $d['jumlah'] ?></td>
                <td>Rp <?= number_format($d['total_harga'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

        <!-- TOTAL AKHIR -->
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">Grand Total</th>
                <th>Rp <?= number_format($grandTotal, 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>
</div>
