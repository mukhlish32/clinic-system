<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'tindakan-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal'),
));
?>

<div class="mb-3">
    <div class="form-group">
        <?php echo $form->label($model, 'kode', array('class' => 'form-label')); ?>
        <span style="color:red;">*</span>
        <?php echo $form->textField($model, 'kode', array('class' => 'form-control', 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'kode', array('class' => 'invalid-feedback')); ?>
    </div>
</div>

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
        <?php echo $form->label($model, 'harga', array('class' => 'form-label')); ?>
        <span style="color:red;">*</span>
        <?php echo $form->numberField($model, 'harga', array('class' => 'form-control', 'maxlength' => 20, 'min' => 0)); ?>
        <?php echo $form->error($model, 'harga', array('class' => 'invalid-feedback')); ?>
    </div>
</div>


<div class="mb-3">
    <div class="form-group">
        <?php echo $form->label($model, 'status', array('class' => 'form-label')); ?>
        <span style="color:red;">*</span>
        <?php echo $form->dropDownList($model, 'status', 
            array(1 => 'Aktif', 0 => 'Tidak Aktif'), 
            array('class' => 'form-control')
        ); ?>
        <?php echo $form->error($model, 'status', array('class' => 'invalid-feedback')); ?>
    </div>
</div>

<div class="action-buttons text-end">
    <button type="button" class="btn btn-primary w-md mb-3" onclick="history.back()">Kembali</button>
    <?php echo CHtml::submitButton('Simpan', array('class' => 'btn btn-success w-md mb-3')); ?>
</div>

<?php $this->endWidget(); ?>
