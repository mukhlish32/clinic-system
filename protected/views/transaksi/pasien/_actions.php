<div class="action-buttons d-flex flex-column gap-2">
    <div class="d-flex gap-2">
        <?php if ($this->checkAccess($location, 'register')): ?>
            <a href="<?php echo Yii::app()->createUrl($location . '/daftar', ['id' => $model->id]); ?>" class="btn btn-sm btn-success btn-label w-md">
                <i class="ri-list-check label-icon align-middle me-1"></i>
                <span>Daftar</span>
            </a>
        <?php endif; ?>
        <?php if ($this->checkAccess($location, 'view')): ?>
            <a href="<?php echo Yii::app()->createUrl($location . '/view', ['id' => $model->id]); ?>" class="btn btn-sm btn-info btn-label w-md">
                <i class="ri-eye-line label-icon align-middle me-1"></i>
                <span>Detail</span>
            </a>
        <?php endif; ?>
    </div>
    <div class="d-flex gap-2">
        <?php if ($this->checkAccess($location, 'update')): ?>
            <a href="<?php echo Yii::app()->createUrl($location . '/update', ['id' => $model->id]); ?>" class="btn btn-sm btn-warning btn-label w-md">
                <i class="ri-edit-line label-icon align-middle me-1"></i>
                <span>Edit</span>
            </a>
        <?php endif; ?>
        <?php if ($this->checkAccess($location, 'delete')): ?>
            <?php echo CHtml::beginForm(Yii::app()->createUrl($location . '/delete', ['id' => $model->id]), 'post', ['style' => 'display:inline']); ?>
            <button type="submit" class="btn btn-sm btn-danger btn-label w-md delete-button">
                <i class="ri-delete-bin-line label-icon align-middle me-1"></i>
                <span>Hapus</span>
            </button>
        <?php endif; ?>
        <?php echo CHtml::endForm(); ?>
    </div>
</div>