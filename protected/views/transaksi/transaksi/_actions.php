<div class="action-buttons d-flex flex-column gap-2">
    <div class="d-flex gap-2">
        <a href="<?php echo Yii::app()->createUrl($location . '/tindakan', ['id' => $model->id]); ?>" class="btn btn-sm btn-primary btn-label w-md">
            <i class="ri-service-line label-icon align-middle me-1"></i>
            <span>Tindakan</span>
        </a>

        <a href="<?php echo Yii::app()->createUrl($location . '/tagihan', ['id' => $model->id]); ?>" class="btn btn-sm btn-warning btn-label w-md">
            <i class="ri-wallet-line label-icon align-middle me-1"></i>
            <span>Tagihan</span>
        </a>
    </div>

    <div class="d-flex gap-2 mt-2">
        <a href="<?php echo Yii::app()->createUrl($location . '/selesai', ['id' => $model->id]); ?>" class="btn btn-sm btn-success btn-label w-md">
            <i class="ri-check-line label-icon align-middle me-1"></i>
            <span>Selesai</span>
        </a>
        <a href="<?php echo Yii::app()->createUrl($location . '/batal', ['id' => $model->id]); ?>" class="btn btn-sm btn-danger btn-label w-md">
            <i class="ri-close-line label-icon align-middle me-1"></i>
            <span>Batal</span>
        </a>
    </div>
</div>