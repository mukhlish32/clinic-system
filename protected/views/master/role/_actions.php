<?php
/* @var $this RoleController */
/* @var $role Role */
?>

<div class="action-buttons">
    <a href="<?php echo Yii::app()->createUrl('master/role/view', ['id' => $role->id]); ?>" class="btn btn-info btn-sm">View</a>
    <a href="<?php echo Yii::app()->createUrl('master/role/update', ['id' => $role->id]); ?>" class="btn btn-warning btn-sm">Edit</a>
    
    <!-- Delete form -->
    <?php echo CHtml::beginForm(Yii::app()->createUrl('master/role/delete', ['id' => $role->id]), 'post', ['style' => 'display:inline']); ?>
        <button type="submit" class="btn btn-danger btn-sm delete-button" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
    <?php echo CHtml::endForm(); ?>
</div>
