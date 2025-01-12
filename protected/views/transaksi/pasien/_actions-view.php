<div class="action-buttons text-end">
    <?php if ($this->checkAccess($location, 'index')): ?>
        <a href="<?php echo Yii::app()->createUrl($location . '/index'); ?>" class="btn btn-primary w-md mb-3">Kembali</a>
    <?php endif; ?>
    <?php if ($this->checkAccess($location, 'register')): ?>
        <a href="<?php echo Yii::app()->createUrl($location . '/daftar', ['id' => $model->id]); ?>" class="btn btn-success  w-md mb-3">Daftar</a>
    <?php endif; ?>
    <?php if ($this->checkAccess($location, 'update')): ?>
        <a href="<?php echo Yii::app()->createUrl($location . '/update', ['id' => $model->id]); ?>" class="btn btn-warning  w-md mb-3">Edit</a>
    <?php endif; ?>
    <?php if ($this->checkAccess($location, 'delete')): ?>
        <?php echo CHtml::beginForm(Yii::app()->createUrl($location . '/delete', ['id' => $model->id]), 'post', ['style' => 'display:inline']); ?>
        <button type="submit" class="btn btn-danger w-md mb-3 delete-button">Hapus</button>
    <?php endif; ?>
    <?php echo CHtml::endForm(); ?>
</div>