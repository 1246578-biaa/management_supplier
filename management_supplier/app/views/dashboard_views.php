<?php include __DIR__.'/template/header.php'; ?>

<link rel="stylesheet" href="/management_supplier/admin/css/custom-dashboard.css?v=<?= time(); ?>">

<div class="main-content">
    <h2 class="title">Dashboard</h2>

    <!-- Stat cards -->
    <div class="row">
        <div class="col-md-2">
            <div class="total-box">
                <h4>Total Pesanan</h4>
                <span><?= htmlspecialchars($totalPesanan) ?></span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="total-box">
                <h4>Pesanan Dikirim</h4>
                <span><?= htmlspecialchars($totalDikirim) ?></span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="total-box">
                <h4>Pesanan Diambil</h4>
                <span><?= htmlspecialchars($totalDiambil) ?></span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="total-box">
                <h4>Total Barang</h4>
                <span><?= htmlspecialchars($totalBarang) ?></span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="total-box">
                <h4>Total Supplier</h4>
                <span><?= htmlspecialchars($totalSupplier) ?></span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="total-box">
                <h4>Total Return</h4>
                <span><?= htmlspecialchars($totalReturn) ?></span>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="charts">
        <div class="chart-box">
            <h4>Pesanan per Supplier</h4>
            <canvas id="chartSupplier"></canvas>
        </div>
        <div class="chart-box">
            <h4>Pesanan per Waktu</h4>
            <select id="periodeSelect" class="form-control" style="margin-bottom:10px;">
                <option value="minggu">Minggu</option>
                <option value="bulan" selected>Bulan</option>
                <option value="tahun">Tahun</option>
            </select>
            <canvas id="chartTime"></canvas>
        </div>
    </div>

    <!-- Table Pesanan -->
    <div class="table-box">
        <h4>Pesanan Terbaru</h4>
        <input type="text" id="searchInput" class="search-box" placeholder="Cari pesanan...">
        <table class="table-dashboard">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Supplier</th>
                </tr>
            </thead>
            <tbody id="orderTableBody">
                <?php foreach ($pesananTerbaru as $p): ?>
                <tr>
                    <td><?= $p['id_pesanan'] ?></td>
                    <td><?= $p['tgl_pesanan'] ?></td>
                    <td>
                        <span class="status <?= strtolower($p['status']) ?>"><?= $p['status'] ?></span>
                    </td>
                    <td><?= $p['nama_supplier'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const chartSupplierData = <?= json_encode($chartSupplier) ?>;
let chartTimeData = <?= json_encode($chartTime) ?>;

// Chart Supplier
const ctxSupplier = document.getElementById('chartSupplier').getContext('2d');
const chartSupplier = new Chart(ctxSupplier, {
    type:'bar',
    data:{
        labels: chartSupplierData.map(r=>r.nama_alias),
        datasets:[{label:'Jumlah Pesanan', data: chartSupplierData.map(r=>r.total), backgroundColor:'#3b82f6'}]
    },
    options:{responsive:true, maintainAspectRatio:false, scales:{y:{beginAtZero:true, ticks:{stepSize:1}}}}
});

// Chart Waktu
const ctxTime = document.getElementById('chartTime').getContext('2d');
let chartTime = new Chart(ctxTime,{
    type:'line',
    data:{
        labels: chartTimeData.map(r=>r.label),
        datasets:[{label:'Pesanan', data: chartTimeData.map(r=>r.total), borderColor:'#10b981', fill:false, borderWidth:2}]
    },
    options:{responsive:true, maintainAspectRatio:false, scales:{y:{beginAtZero:true, ticks:{stepSize:1}}}}
});

// Filter waktu chart
$('#periodeSelect').change(function(){
    const periode = $(this).val();
    $.ajax({
        url: '?controller=dashboard&action=filterChart&periode='+periode,
        method:'GET',
        success:function(data){
            const result = JSON.parse(data);
            chartTime.data.labels = result.map(r=>r.label);
            chartTime.data.datasets[0].data = result.map(r=>r.total);
            chartTime.update();
        }
    });
});

// Search table
$('#searchInput').on('input',function(){
    const q = $(this).val().toLowerCase();
    $('#orderTableBody tr').each(function(){
        $(this).toggle($(this).text().toLowerCase().includes(q));
    });
});
</script>

<?php include __DIR__.'/template/footer.php'; ?>
