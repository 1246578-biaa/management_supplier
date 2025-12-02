<?php include __DIR__ . '/template/header.php'; ?>

<div class="container-fluid mt-4">
    <h3 class="mb-3">Detail Pesanan Dikirim #<?= $pesanan['id_pesanan']; ?></h3>

    <!-- =============================== -->
    <!-- PANEL GABUNG INFORMASI + DETAIL -->
    <!-- =============================== -->
    <div class="panel panel-primary mb-4 shadow-sm">

        <div class="panel-heading bg-primary text-white p-2">
            <b>Informasi & Detail Pesanan</b>
        </div>

        <div class="panel-body p-3">

            <!-- Informasi Pesanan -->
            <p><b>Tanggal Pesanan:</b> <?= $pesanan['tgl_pesanan']; ?></p>
            <p><b>Supplier:</b> <?= $pesanan['nama_supplier']; ?></p>
            <p><b>Status:</b> <?= $pesanan['status']; ?></p>

            <hr>

            <!-- Detail Barang -->
            <h5 class="mb-3"><b>Detail Barang</b></h5>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($detail as $i => $d){ ?>
                            <tr>
                                <td><?= $i+1; ?></td>
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
    <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?controller=pesanan_dikirim&action=index'">Kembali</button>

</div>

<?php include __DIR__ . '/template/footer.php'; ?>
