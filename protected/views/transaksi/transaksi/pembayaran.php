<div class="container-fluid">
    <h4 class="mb-4">Pembayaran Pasien: <?php echo CHtml::encode($pasienDaftar->pasien->nama); ?></h4>
    <div class="card">
        <div class="card-body">
            <p><strong>Total Biaya:</strong> Rp <?php echo number_format($totalBiaya, 0, ',', '.'); ?></p>

            <form method="post">
                <div class="form-group">
                    <label for="payment-amount">Jumlah yang Dibayarkan</label>
                    <input type="text" id="payment-amount" name="Pembayaran[jumlah]" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Selesaikan Pembayaran</button>
                    <a href="<?php echo Yii::app()->createUrl('transaksi/transaksi/index'); ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
