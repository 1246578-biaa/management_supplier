<?php include __DIR__.'/template/header.php'; ?>

<div class="container-fluid mt-4">
    <h3 class="mb-3">Pesanan</h3>

    <!-- =============================== -->
    <!-- PANEL TAMBAH PESANAN -->
    <!-- =============================== -->
    <div class="panel panel-primary">
        <div class="panel-heading">Tambah Pesanan</div>
        <div class="panel-body">

            <form action="index.php?controller=pesanan&action=simpan" method="post" id="formPesanan">

                <div class="row">

                    <!-- Supplier -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Supplier</label>
                            <select name="id_supplier" id="supplierSelect" class="form-control" required>
                                <option value="">-- Pilih Supplier --</option>
                                <?php foreach($suppliers as $s): ?>
                                    <option value="<?= $s['id_supplier'] ?>">
                                        <?= $s['id_supplier'].' - '.$s['nama_supplier'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Tanggal -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tgl_pesanan" class="form-control" required>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                                <option value="Dikirim">Dikirim</option>
                                <option value="Diambil">Diambil</option>
                            </select>
                        </div>
                    </div>

                    <!-- ID Toko -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>ID Toko</label>
                            <input type="text" name="id_toko" value="TOK001" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <hr>
                <h4>Detail Barang</h4>

                <!-- =============================== -->
                <!-- TABEL DETAIL BARANG -->
                <!-- =============================== -->
                <table class="table table-bordered" id="detailTable">
                    <thead>
                        <tr>
                            <th style="width:50px">No</th>
                            <th style="width:150px">ID Barang</th>
                            <th>Nama Barang</th>
                            <th style="width:120px">Jumlah</th>
                            <th style="width:120px">#</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="urut">1</td>

                            <!-- CONTROLLER MEMINTA item_input[] -->
                            <td>
                                <input type="text" name="item_input[]" class="form-control idBarang" readonly required>
                            </td>

                            <!-- Nama barang hanya display -->
                            <td>
                                <input type="text" class="form-control namaBarang" readonly>
                            </td>

                            <td>
                                <input type="number" name="jumlah[]" value="1" min="1" class="form-control" required>
                            </td>

                            <td>
                                <button type="button" class="btn btn-info btn-sm pilihBtn"
                                    data-toggle="modal" data-target="#barangModal">
                                    Pilih
                                </button>

                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="hapusRow(this)">
                                    X
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" class="btn btn-success btn-sm" onclick="tambahRow()">+ Tambah Barang</button>

                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-save"></span> Simpan Pesanan
                </button>
            </form>
        </div>
    </div>

    <!-- =============================== -->
    <!-- PANEL DAFTAR PESANAN -->
    <!-- =============================== -->
    <div class="panel panel-default">
        <div class="panel-heading">Daftar Pesanan</div>
        <div class="panel-body">
           
        <!-- ================================
         SEARCH + FILTER
    ===================================== -->
    <div class="card p-3 shadow-sm mb-4">
        <div class="row">
            <div class="col-md-4">
                <label>Cari Pesanan</label>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari ID / Supplier / Status...">
            </div>

            <div class="col-md-3">
                <label>Filter Status</label>
                <select id="filterStatus" class="form-control">
                    <option value="">Semua</option>
                    <option value="Dikirim">Dikirim</option>
                    <option value="Diambil">Diambil</option>
                </select>
            </div>

            <div class="col-md-3">
                <label>Filter Supplier</label>
                <select id="filterSupplier" class="form-control">
                    <option value="">Semua</option>
                    <?php foreach($suppliers as $s): ?>
                        <option value="<?= $s['nama_supplier'] ?>">
                            <?= $s['nama_supplier'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
           

            <br>

            <table class="table table-bordered" id="pesananTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Supplier</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no=1; foreach($pesanans as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p['id_pesanan'] ?></td>
                        <td><?= $p['tgl_pesanan'] ?></td>
                        <td><?= $p['status'] ?></td>
                        <td><?= $p['nama_supplier'] ?></td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="lihatDetail('<?= $p['id_pesanan'] ?>')">
                                Detail
                            </button>

                            <a href="index.php?controller=pesanan&action=edit&id=<?= $p['id_pesanan'] ?>"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <a href="index.php?controller=pesanan&action=hapus&id=<?= $p['id_pesanan'] ?>"
                               onclick="return confirm('Hapus pesanan ini?')"
                               class="btn btn-danger btn-sm">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>


<!-- =============================== -->
<!-- MODAL DETAIL PESANAN -->
<!-- =============================== -->
<div class="modal fade" id="detailModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Pesanan</h4>
      </div>

      <div class="modal-body" id="detailContent">Memuat...</div>
    </div>
  </div>
</div>


<!-- =============================== -->
<!-- MODAL PILIH BARANG -->
<!-- =============================== -->
<div class="modal fade" id="barangModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pilih Barang</h4>
            </div>

            <div class="modal-body">

                <input type="text" id="searchBarang" class="form-control"
                    placeholder="Cari nama / ID barang...">
                <br>

                <table class="table table-bordered" id="tabelCariBarang">
                    <thead>
                        <tr>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                    <tbody id="listBarangModal">
                        <!-- AJAX LOAD -->
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>



<script>
// ===============================
// Update nomor urut
// ===============================
function updateUrut(){
    $('#detailTable tbody tr').each(function(i){
        $(this).find('.urut').text(i+1);
    });
}

// ===============================
// Tambah Row Barang
// ===============================
function tambahRow(){
    var row = `
<tr>
    <td class="urut"></td>

    <td><input type="text" name="item_input[]" class="form-control idBarang" readonly required></td>
    <td><input type="text" class="form-control namaBarang" readonly></td>

    <td><input type="number" name="jumlah[]" value="1" min="1" class="form-control" required></td>

    <td>
        <button type="button" class="btn btn-info btn-sm pilihBtn" data-toggle="modal" data-target="#barangModal">Pilih</button>
        <button type="button" class="btn btn-danger btn-sm" onclick="hapusRow(this)">X</button>
    </td>
</tr>`;

    $('#detailTable tbody').append(row);
    updateUrut();
}

// Hapus row
function hapusRow(btn){
    $(btn).closest('tr').remove();
    updateUrut();
}

var targetRow = null;

// Saat klik tombol pilih barang
$(document).on("click", ".pilihBtn", function(){
    targetRow = $(this).closest("tr");
});

// Saat memilih barang dari modal
$(document).on("click", ".pilihBarang", function(){
    targetRow.find(".idBarang").val($(this).data("id"));
    targetRow.find(".namaBarang").val($(this).data("nama"));
});

// ===============================
// Search Barang di Modal
// ===============================
$("#searchBarang").on("keyup", function(){
    var val = $(this).val().toLowerCase();
    $("#tabelCariBarang tbody tr").filter(function(){
        $(this).toggle($(this).text().toLowerCase().indexOf(val) > -1);
    });
});

// ===============================
// Search Pesanan
// ===============================
$("#searchPesanan").on("keyup", function(){
    var val = $(this).val().toLowerCase();
    $("#pesananTable tbody tr").filter(function(){
        $(this).toggle($(this).text().toLowerCase().indexOf(val) > -1);
    });
});

// ===============================
// Load Barang Berdasarkan Supplier (AJAX)
// ===============================
$("#supplierSelect").change(function(){
    let id_supplier = $(this).val();

    if(id_supplier === ""){
        $("#listBarangModal").html("");
        return;
    }

    $.get("index.php?controller=pesanan&action=getBarangBySupplier&id_supplier=" + id_supplier,
        function(data){

        let html = "";

        data.forEach(function(b){
            html += `
                <tr>
                    <td>${b.id_barang}</td>
                    <td>${b.nama_barang}</td>
                    <td>
                        <button type="button" class="btn btn-success pilihBarang"
                            data-id="${b.id_barang}"
                            data-nama="${b.nama_barang}"
                            data-dismiss="modal">
                            Pilih
                        </button>
                    </td>
                </tr>
            `;
        });

        $("#listBarangModal").html(html);

    }, "json");
});

// ===============================
// Modal Detail Pesanan
// ===============================
function lihatDetail(id){
    $("#detailContent").html("Memuat...");
    $("#detailModal").modal("show");

    $.get("index.php?controller=pesanan&action=detail&id="+id, function(res){
        $("#detailContent").html(res);
    });
}
</script>

<?php include __DIR__.'/template/footer.php'; ?>
