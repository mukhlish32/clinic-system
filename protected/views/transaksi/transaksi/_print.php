<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .text-primary {
            color: #1e88e5;
        }
        .text-success {
            color: #4caf50;
        }
        .text-danger {
            color: #f44336;
        }
    </style>
</head>
<body>

    <h1 class="text-primary">Tagihan Pasien - <?php echo CHtml::encode($pasien->nama); ?></h1>

    <!-- Patient Info -->
    <h3 class="text-primary">Informasi Pasien</h3>
    <table class="table">
        <tr>
            <td><strong>Nama Pasien</strong></td>
            <td><?php echo CHtml::encode($pasien->nama); ?></td>
        </tr>
        <tr>
            <td><strong>ID Pasien</strong></td>
            <td><?php echo CHtml::encode($pasien->id); ?></td>
        </tr>
        <tr>
            <td><strong>Alamat</strong></td>
            <td><?php echo CHtml::encode($pasien->alamat); ?></td>
        </tr>
    </table>

    <hr>

    <!-- Tindakan Info -->
    <h3 class="text-success">Tindakan</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Tindakan</th>
                <th>Biaya</th>
                <th>Tgl Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tindakan as $item): ?>
                <tr>
                    <td><?php echo CHtml::encode($item->tindakan->nama); ?></td>
                    <td><?php echo CHtml::encode(number_format($item->total, 2)); ?></td>
                    <td>
                        <?php echo CHtml::encode(date("d F Y H:i:s", strtotime($item->tgl_transaksi))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <hr>

    <!-- Obat Info -->
    <h3 class="text-danger">Obat</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Obat</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th>Tgl Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($obat as $item): ?>
                <tr>
                    <td><?php echo CHtml::encode($item->obat->nama); ?></td>
                    <td><?php echo CHtml::encode($item->jumlah); ?></td>
                    <td><?php echo CHtml::encode(number_format($item->harga, 2)); ?></td>
                    <td><?php echo CHtml::encode(number_format($item->harga * $item->jumlah, 2)); ?></td>
                    <td>
                        <?php echo CHtml::encode(date("d F Y H:i:s", strtotime($item->tgl_transaksi))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <hr>

    <!-- Total Tagihan -->
    <h3 class="text-primary">Total Tagihan</h3>
    <p><strong>Total Biaya Tindakan dan Obat:</strong> <?php echo CHtml::encode(number_format($total, 2)); ?></p>

</body>
</html>
