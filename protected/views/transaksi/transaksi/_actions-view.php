<div class="action-buttons text-end">
    <a href="<?php echo Yii::app()->createUrl($location . '/index'); ?>" class="btn btn-primary w-md mb-3">Kembali</a>
    <a href="<?php echo Yii::app()->createUrl($location . '/daftar', ['id' => $model->id]); ?>" class="btn btn-success  w-md mb-3">Daftar</a>
    <a href="<?php echo Yii::app()->createUrl($location . '/update', ['id' => $model->id]); ?>" class="btn btn-warning  w-md mb-3">Edit</a>
    <?php echo CHtml::beginForm(Yii::app()->createUrl($location . '/delete', ['id' => $model->id]), 'post', ['style' => 'display:inline']); ?>
    <button type="submit" class="btn btn-danger w-md mb-3 delete-button">Hapus</button>
    <?php echo CHtml::endForm(); ?>
</div>
