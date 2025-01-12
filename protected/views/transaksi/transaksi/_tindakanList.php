<?php
$totalTindakan = 0;
foreach ($listTindakan as $tindakan) {
    $totalTindakan += $tindakan->total;
}
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Tindakan</th>
            <th>Tgl Transaksi</th>
            <th>Nama Dokter</th>
            <th>Status</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($listTindakan): ?>
            <?php foreach ($listTindakan as $tindakan): ?>
                <?php $totalTindakan += $tindakan->total; ?>
                <tr>
                    <td><?php echo CHtml::encode($tindakan->tindakan->nama); ?></td>
                    <td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd-MM-yyyy HH:mm', strtotime($tindakan->tgl_transaksi))); ?></td>
                    <td><?php echo CHtml::encode($tindakan->pegawai->nama); ?></td>
                    <td>
                        <?php
                        $statusBayar = ($tindakan->status_bayar == 0) ? 'Belum Dibayar' : 'Dibayar';
                        echo CHtml::encode($statusBayar);
                        ?>
                    </td>
                    <td style="text-align: right;">Rp <?php echo number_format($tindakan->harga, 0, ',', '.'); ?></td>
                    <td style="text-align: right;"><?php echo CHtml::encode($tindakan->jumlah); ?></td>
                    <td style="text-align: right;">Rp <?php echo number_format($tindakan->total, 0, ',', '.'); ?></td>
                    <td>
                        <a href="<?php echo Yii::app()->createUrl('transaksi/transaksi/updateTindakan', ['norm' => $pasienDaftar->id, 'id' => $tindakan->id]); ?>" class="btn btn-sm btn-warning btn-label">
                            <i class="ri-edit-line label-icon align-middle me-1"></i>
                            <span>Edit</span>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="7" style="text-align: right;"><strong>Rp <?php echo number_format($totalTindakan, 0, ',', '.'); ?></strong></td>
                <td></td>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="8" style="text-align: center;">Data Kosong</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>