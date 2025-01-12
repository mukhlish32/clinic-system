<div class="card shadow-sm">
    <div class="card-header card-primary d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-white">Laporan Grafik Pendaftaran Pasien</h5>
    </div>
    <div class="card-body">
        <br />
        <!-- Filter Form -->
        <div class="container mb-5">
            <form method="get" action="<?php echo Yii::app()->createUrl('transaksi/laporan/index'); ?>" class="row g-3 p-4 border rounded shadow-sm">
                <div class="col-md-3">
                    <label for="start_date" class="form-label">Start Date:</label>
                    <input type="date" name="start_date" value="<?php echo $startDate; ?>" class="form-control" required />
                </div>

                <div class="col-md-3">
                    <label for="end_date" class="form-label">End Date:</label>
                    <input type="date" name="end_date" value="<?php echo $endDate; ?>" class="form-control" required />
                </div>

                <div class="col-md-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <select name="gender" class="form-select">
                        <option value="all" <?php echo $gender == 'all' ? 'selected' : ''; ?>>Semua</option>
                        <option value="L" <?php echo $gender == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                        <option value="P" <?php echo $gender == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="timescale" class="form-label">Time Scale:</label>
                    <select name="timescale" class="form-select">
                        <option value="daily" <?php echo $timeScale == 'daily' ? 'selected' : ''; ?>>Per Hari</option>
                        <option value="weekly" <?php echo $timeScale == 'weekly' ? 'selected' : ''; ?>>Per Minggu</option>
                        <option value="monthly" <?php echo $timeScale == 'monthly' ? 'selected' : ''; ?>>Per Bulan</option>
                    </select>
                </div>

                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary">Tampilkan Laporan</button>
                </div>
            </form>
        </div>

        <!-- Chart Section -->
        <div class="container">
            <div class="row g-3 p-4 border rounded shadow-sm">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var dates = <?php echo json_encode($dates); ?>;
    var counts = <?php echo json_encode($counts); ?>;

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dates, // X-axis labels
            datasets: [{
                label: 'Jumlah Pasien Terdaftar',
                data: counts, // Y-axis data
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false,
                pointRadius: 5,
                pointBackgroundColor: 'rgba(75, 192, 192, 1)'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 5
                    }
                }
            },
            plugins: {
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    footerColor: '#fff'
                }
            }
        }
    });
</script>