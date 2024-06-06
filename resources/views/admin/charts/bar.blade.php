<!-- resources/views/admin/charts/bar.blade.php -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Grafik Penjualan</h3>
    </div>
    <div class="card-body">
        <canvas id="salesChart"></canvas>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line', // Ganti dengan 'bar' jika ingin grafik batang
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli'],
            datasets: [{
                label: 'Penjualan',
                data: [10, 20, 15, 25, 30, 45, 50],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Jumlah Penjualan'
                    }
                }
            }
        }
    });
});
</script>
