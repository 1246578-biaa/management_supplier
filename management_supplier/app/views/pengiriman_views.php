<?php include __DIR__.'/template/header.php'; ?>
<div class="container-fluid mt-4">

<h3>Daftar Pengiriman</h3>
<button class="btn btn-success mb-3" data-toggle="modal" data-target="#addPengirimanModal">+ Tambah Pengiriman</button>

<table class="table table-bordered" id="pengirimanTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Supplier</th>
            <th>ID Pesanan</th>
            <th>Tanggal Kirim</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($data_pengiriman as $p): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $p['nama_supplier'] ?></td>
            <td><?= $p['id_pesanan'] ?></td>
            <td><?= $p['tgl_pengiriman'] ?></td>
            <td>
                <button class="btn btn-info btn-sm" onclick="lihatDetail('<?= $p['id_pengiriman'] ?>')">Detail</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- MODAL TAMBAH PENGIRIMAN -->
<div class="modal fade" id="addPengirimanModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="index.php?controller=pengiriman&action=add" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pengiriman</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label>Pilih Pesanan</label>
            <select name="id_pesanan" id="pesananSelect" class="form-control" required>
              <option value="">-- Pilih Pesanan --</option>
              <?php foreach($pesanan as $psn): ?>
                <option value="<?= $psn['id_pesanan'] ?>" data-supplier="<?= $psn['id_supplier'] ?>">
                  <?= $psn['id_pesanan'].' - '.$psn['nama_supplier'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <input type="hidden" name="id_supplier" id="id_supplier">

          <div class="form-group">
            <label>Tanggal Pengiriman</label>
            <input type="date" name="tgl_pengiriman" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control">
          </div>

          <h5>Detail Barang</h5>
          <table class="table table-bordered" id="detailTable">
            <thead>
              <tr>
                <th>No</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan Pengiriman</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL DETAIL PENGIRIMAN -->
<div class="modal fade" id="detailModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Pengiriman</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="detailContent">Memuat...</div>
    </div>
  </div>
</div>

<script>
$('#pesananSelect').change(function(){
    let id_pesanan = $(this).val();
    let supplier = $(this).find(':selected').data('supplier');
    $('#id_supplier').val(supplier);

    if(id_pesanan==='') {
        $('#detailTable tbody').html('');
        return;
    }

    $.get('index.php?controller=pengiriman&action=getDetailPesanan&id_pesanan='+id_pesanan, function(data){
        let html = '';
        data.forEach(function(d,i){
            html += `<tr>
                <td>${i+1}</td>
                <td><input type="text" name="barang[${i}][id_barang]" value="${d.id_barang}" class="form-control" readonly></td>
                <td>${d.nama_barang}</td>
                <td><input type="number" name="barang[${i}][jumlah_barang]" value="${d.jumlah}" class="form-control" min="1" required></td>
            </tr>`;
        });
        $('#detailTable tbody').html(html);
    }, 'json');
});

function lihatDetail(id){
    $('#detailContent').html('Memuat...');
    $('#detailModal').modal('show');

    $.get('index.php?controller=pengiriman&action=detail&id='+id, function(res){
        $('#detailContent').html(res);
    });
}
</script>

<?php include __DIR__.'/template/footer.php'; ?>
