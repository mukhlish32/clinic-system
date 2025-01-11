<div class="action-buttons text-end">
    <!-- View Button -->
    <a href="<?php echo Yii::app()->createUrl($location . '/index', ['id' => $model->id]); ?>" class="btn btn-primary w-md mb-3">Kembali</a>

    <!-- Edit Button -->
    <a href="<?php echo Yii::app()->createUrl($location . '/update', ['id' => $model->id]); ?>" class="btn btn-warning  w-md mb-3">Edit</a>

    <!-- Delete Button -->
    <?php echo CHtml::beginForm(Yii::app()->createUrl($location . '/delete', ['id' => $model->id]), 'post', ['style' => 'display:inline']); ?>
    <button type="submit" class="btn btn-danger w-md mb-3 delete-button">Hapus</button>
    <?php echo CHtml::endForm(); ?>
</div>
