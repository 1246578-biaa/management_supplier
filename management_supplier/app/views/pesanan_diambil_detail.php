<?php include __DIR__ . '/template/header.php'; ?>

<div class="container-fluid mt-4">

    <h3 class="mb-3">Detail Pesanan #<?= $pesanan['id_pesanan']; ?></h3>

    <!-- =============================== -->
    <!-- PANEL INFORMASI + DETAIL (GABUNG) -->
    <!-- =============================== -->
    <div class="panel panel-primary mb-4 shadow-sm">

        <div class="panel-heading bg-primary text-white p-2">
            <b>Informasi & Detail Pesanan</b>
        </div>

        <div class="panel-body p-3">

            <!-- Informasi Pesanan (isi asli, tidak diubah) -->
            <p><b>Tanggal:</b> <?= $pesanan['tgl_pesanan']; ?></p>
            <p><b>Supplier:</b> <?= $pesanan['nama_supplier']; ?></p>

            <hr>

            <!-- Detail Barang (isi asli, tidak diubah) -->
            <h5 class="mb-3"><b>Detail Barang</b></h5>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($detail as $d) { ?>
                            <tr>
                                <td><?= $d['nama_barang']; ?></td>
                                <td><?= $d['jumlah']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <!-- TOMBOL KEMBALI -->
    <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?controller=pesanan_diambil&action=index'">Kembali</button>

</div>

<?php include __DIR__ . '/template/footer.php'; ?>
