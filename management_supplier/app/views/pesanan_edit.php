<?php include __DIR__.'/template/header.php'; ?>

<div class="container-fluid mt-4">
    <h3>Edit Pesanan</h3>

    <form action="index.php?controller=pesanan&action=update" method="post" id="formPesanan">
        <input type="hidden" name="id_pesanan" value="<?= $pesanan['id_pesanan'] ?>">
        
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Supplier</label>
                    <select name="id_supplier" class="form-control" required>
                        <?php foreach($suppliers as $s): ?>
                            <option value="<?= $s['id_supplier'] ?>" <?= $s['id_supplier']==$pesanan['id_supplier']?'selected':'' ?>>
                                <?= $s['id_supplier'].' - '.$s['nama_supplier'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tgl_pesanan" value="<?= $pesanan['tgl_pesanan'] ?>" class="form-control" required>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Dikirim" <?= $pesanan['status']=='Dikirim'?'selected':'' ?>>Dikirim</option>
                        <option value="Diambil" <?= $pesanan['status']=='Diambil'?'selected':'' ?>>Diambil</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>ID Toko</label>
                    <input type="text" name="id_toko" value="<?= $pesanan['id_toko'] ?>" class="form-control" readonly>
                </div>
            </div>
        </div>

        <hr>
        <h5>Detail Barang</h5>
        <datalist id="barangList"></datalist>
        <table class="table table-bordered" id="detailTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID / Nama Barang</th>
                    <th>Jumlah</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach($detail as $d): ?>
                <tr>
                    <td class="urut"><?= $i++ ?></td>
                    <td>
                       <input type="text" name="item_input[]" class="form-control itemInput" list="barangList"
                        value="<?= $d['id_barang'].' - '.$d['nama_barang'] ?>"
                        placeholder="BRG001 - Nama Barang atau ketik manual" required>
                    </td>
                    <td><input type="number" name="jumlah[]" class="form-control" value="<?= $d['jumlah'] ?>" min="1" required></td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="hapusRow(this)">X</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button type="button" class="btn btn-success btn-sm" onclick="tambahRow()">+ Tambah Barang</button>
        <a href="index.php?controller=pesanan&action=index" class="btn btn-default">Batal</a>
        <button type="submit" class="btn btn-primary">Update Pesanan</button>
    </form>
</div>

<script>
function updateUrut(){
    document.querySelectorAll("#detailTable tbody tr").forEach((tr,i)=>{
        tr.querySelector(".urut").innerText = i+1;
    });
}
function tambahRow(){
    const tbody = document.querySelector("#detailTable tbody");
    const tr = document.createElement("tr");
    tr.innerHTML = `
        <td class="urut"></td>
        <td><input type="text" name="item_input[]" class="form-control itemInput" list="barangList" placeholder="BRG001 - Nama Barang atau ketik manual" required></td>
        <td><input type="number" name="jumlah[]" class="form-control" value="1" min="1" required></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="hapusRow(this)">X</button></td>
    `;
    tbody.appendChild(tr);
    updateUrut();
    focusLastItem();
}
function hapusRow(btn){ btn.closest("tr").remove(); updateUrut(); }
function focusLastItem(){ const inputs=document.querySelectorAll(".itemInput"); if(inputs.length) inputs[inputs.length-1].focus(); }
updateUrut();

// Load datalist barang saat supplier berubah
$('#supplierSelect').on('change', function(){
    const id_supplier = $(this).val();
    const $list = $('#barangList');
    $list.empty();
    if(!id_supplier) return;
    $.getJSON('index.php?controller=pesanan&action=getBarangBySupplier&id_supplier='+encodeURIComponent(id_supplier), function(data){
        data.forEach(it=>{
            const opt=document.createElement('option');
            opt.value=it.id_barang+' - '+it.nama_barang;
            $list.append(opt);
        });
    });
});

// Submit minimal 1 item
$('#formPesanan').on('submit', function(){
    if($('#detailTable tbody tr').length===0){ alert('Tambahkan minimal 1 item'); return false; }
    return true;
});
</script>

<?php include __DIR__.'/template/footer.php'; ?>
