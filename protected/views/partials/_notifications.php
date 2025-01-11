<?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible fade show material-shadow" role="alert">
        <?php echo Yii::app()->user->getFlash('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show material-shadow" role="alert">
        <?php echo Yii::app()->user->getFlash('error'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
