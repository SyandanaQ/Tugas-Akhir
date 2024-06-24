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
    var data = {!! json_encode($data) !!}.map(Number); // Konversi data menjadi numerik

    // Debugging untuk memeriksa data
    console.log('Labels:', labels);
    console.log('Data:', data);

    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Penjualan',
                data: data, // Menggunakan seluruh data
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
@else
<p>Data tidak tersedia untuk grafik penjualan.</p>
@endif

</body>
</html>
