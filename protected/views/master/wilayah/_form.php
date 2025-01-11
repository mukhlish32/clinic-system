<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'wilayah-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal'),
));
?>

<div class="mb-3">
    <div class="form-group">
        <?php echo $form->label($model, 'kelurahan', array('class' => 'form-label')); ?>
        <span style="color:red;">*</span>
        <?php echo $form->textField($model, 'kelurahan', array('class' => 'form-control', 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'kelurahan', array('class' => 'invalid-feedback')); ?>
    </div>
</div>

<div class="mb-3">
    <div class="form-group">
        <?php echo $form->label($model, 'kecamatan', array('class' => 'form-label')); ?>
        <span style="color:red;">*</span>
        <?php echo $form->textField($model, 'kecamatan', array('class' => 'form-control', 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'kecamatan', array('class' => 'invalid-feedback')); ?>
    </div>
</div>

<div class="mb-3">
    <div class="form-group">
        <?php echo $form->label($model, 'kota', array('class' => 'form-label')); ?>
        <span style="color:red;">*</span>
        <?php echo $form->textField($model, 'kota', array('class' => 'form-control', 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'kota', array('class' => 'invalid-feedback')); ?>
    </div>
</div>

<div class="mb-3">
    <div class="form-group">
        <?php echo $form->label($model, 'provinsi', array('class' => 'form-label')); ?>
        <span style="color:red;">*</span>
        <?php echo $form->textField($model, 'provinsi', array('class' => 'form-control', 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'provinsi', array('class' => 'invalid-feedback')); ?>
    </div>
</div>

<div class="mb-3">
    <div class="form-group">
        <?php echo $form->label($model, 'kode_pos', array('class' => 'form-label')); ?>
        <span style="color:red;">*</span>
        <?php echo $form->textField($model, 'kode_pos', array('class' => 'form-control', 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'kode_pos', array('class' => 'invalid-feedback')); ?>
    </div>
</div>

<div class="action-buttons text-end">
    <button type="button" class="btn btn-primary w-md mb-3" onclick="history.back()">Kembali</button>
    <?php echo CHtml::submitButton('Simpan', array('class' => 'btn btn-success w-md mb-3')); ?>
</div>

<?php $this->endWidget(); ?>
