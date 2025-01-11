<div class="action-buttons d-flex gap-2">
    <a href="<?php echo Yii::app()->createUrl($location . '/view', ['id' => $model->id]); ?>" class="btn btn-sm btn-info btn-label">
        <i class="ri-eye-line label-icon align-middle me-1"></i> 
        <span class="d-none d-md-inline">Detail</span> <!-- Hidden on smaller screens -->
    </a>
    <a href="<?php echo Yii::app()->createUrl($location . '/update', ['id' => $model->id]); ?>" class="btn btn-sm btn-warning btn-label">
        <i class="ri-edit-line label-icon align-middle me-1"></i> 
        <span class="d-none d-md-inline">Edit</span> <!-- Hidden on smaller screens -->
    </a>
    <?php echo CHtml::beginForm(Yii::app()->createUrl($location . '/delete', ['id' => $model->id]), 'post', ['style' => 'display:inline']); ?>
        <button type="submit" class="btn btn-sm btn-danger btn-label delete-button">
            <i class="ri-delete-bin-line label-icon align-middle me-1"></i> 
            <span class="d-none d-md-inline">Hapus</span> <!-- Hidden on smaller screens -->
        </button>
    <?php echo CHtml::endForm(); ?>
</div>
