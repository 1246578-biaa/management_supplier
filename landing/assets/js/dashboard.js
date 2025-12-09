// data from PHP are printed into page as JSON via view
const pesananPerSupplier = <?= json_encode($data['pesananPerSupplier']) ?>;
const statusPesanan = <?= json_encode($data['statusPesanan']) ?>;

// bar chart (per supplier)
const barCtx = document.getElementById('barChart').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: pesananPerSupplier.map(r => r.nama_supplier),
        datasets: [{
            label: 'Jumlah Pesanan',
            data: pesananPerSupplier.map(r => Number(r.jumlah)),
            backgroundColor: '#3b82f6'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
    }
});

// pie chart (status)
const pieCtx = document.getElementById('pieChart').getContext('2d');
new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: statusPesanan.map(s => s.status),
        datasets: [{
            data: statusPesanan.map(s => Number(s.total)),
            backgroundColor: ['#3b82f6','#10b981','#f59e0b','#ef4444']
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

// search table
document.getElementById('searchInput').addEventListener('input', function () {
    const v = this.value.toLowerCase();
    document.querySelectorAll('#orderTableBody tr').forEach(tr => {
        tr.style.display = tr.innerText.toLowerCase().includes(v) ? '' : 'none';
    });
});
