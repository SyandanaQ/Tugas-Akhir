<!DOCTYPE html>
<html>
<head>
    <title>Grafik Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Grafik Penjualan</h3>
    </div>
    <div class="card-body">
        <canvas id="salesChart"></canvas>
    </div>
</div>

@if(isset($labels) && isset($data))
<script>
document.addEventListener('DOMContentLoaded', function () {
    var labels = {!! json_encode($labels) !!};
    var data = {!! json_encode($data) !!};

    // Data untuk prediksi
    var predictionIndex = labels.length - 1;
    var predictionData = data[predictionIndex];

    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line', // Ganti dengan 'bar' jika ingin grafik batang
        data: {
            labels: labels,
            datasets: [{
                label: 'Penjualan',
                data: data.slice(0, predictionIndex),
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false
            }, {
                label: 'Prediksi',
                data: Array(data.length - 1).fill(null).concat([predictionData]),
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: false,
                borderDash: [10, 5]
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
@else
<p>Data tidak tersedia untuk grafik penjualan.</p>
@endif

</body>
</html>
