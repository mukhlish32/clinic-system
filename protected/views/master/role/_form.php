<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'role-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal'),
));
?>

<div class="mb-3">
    <div class="form-group">
        <?php echo $form->label($model, 'nama', array('class' => 'form-label')); ?>
        <span style="color:red;">*</span>
        <?php echo $form->textField($model, 'nama', array('class' => 'form-control', 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'nama', array('class' => 'invalid-feedback')); ?>
    </div>
</div>

<div class="mb-3">
    <div class="form-group">
        <?php echo $form->labelEx($model, 'keterangan', array('class' => 'form-label')); ?>
        <span style="color:red;">*</span>
        <?php echo $form->textArea($model, 'keterangan', array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'keterangan', array('class' => 'invalid-feedback')); ?>
    </div>
</div>


<div class="action-buttons text-end">
<button type="button" class="btn btn-primary w-md mb-3" onclick="history.back()">Kembali</button>
    <!-- <?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Update', array('class' => 'btn btn-success w-md mb-3')); ?> -->
    <?php echo CHtml::submitButton('Simpan', array('class' => 'btn btn-success w-md mb-3')); ?>
</div>
<?php $this->endWidget(); ?>