<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'pendaftaran-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal'),
));
?>

<div class="mb-3">
    <div class="form-group">
        <?php echo $form->label($pasien, 'pasien_id', array('class' => 'form-label')); ?>
        <span style="color:red;">*</span>
        <?php
        echo $form->textField($pasien, 'pasien_id', array(
            'class' => 'form-control bg-light',
            'value' => CHtml::encode($pasien->nama),
            'readonly' => true,
            'maxlength' => 50
        ));
        ?>
        <?php echo $form->error($model, 'pasien_id', array('class' => 'invalid-feedback')); ?>
    </div>
</div>

<div class="mb-3">
    <div class="form-group">
        <?php echo $form->label($model, 'keterangan', array('class' => 'form-label')); ?>
        <?php echo $form->textArea($model, 'keterangan', array('class' => 'form-control', 'rows' => 5)); ?>
        <?php echo $form->error($model, 'keterangan', array('class' => 'invalid-feedback')); ?>
    </div>
</div>

<div class="mb-3">
    <div class="form-group">
        <?php echo $form->label($model, 'tgl_daftar', array('class' => 'form-label')); ?>
        <div class="row">
            <div class="col-2">
                <?php
                $tglDaftarDate = isset($model->tgl_daftar) ? date("Y-m-d", strtotime($model->tgl_daftar)) : date("Y-m-d");
                echo $form->dateField($model, 'tgl_daftar', array(
                    'class' => 'form-control',
                    'value' => CHtml::encode($tglDaftarDate),
                ));
                ?>
                <?php echo $form->error($model, 'tgl_daftar', array('class' => 'invalid-feedback')); ?>
            </div>

            <div class="col-2">
                <?php
                $tglDaftarTime = isset($model->tgl_daftar) ? date("H:i", strtotime($model->tgl_daftar)) : date("H:i");
                echo $form->timeField($model, 'time_daftar', array(
                    'class' => 'form-control',
                    'value' => CHtml::encode($tglDaftarTime),
                ));
                ?>
                <?php echo $form->error($model, 'time_daftar', array('class' => 'invalid-feedback')); ?>
            </div>
        </div>

    </div>
</div>





<div class="action-buttons text-end">
    <button type="button" class="btn btn-primary w-md mb-3" onclick="history.back()">Kembali</button>
    <?php echo CHtml::submitButton('Daftar', array('class' => 'btn btn-success w-md mb-3')); ?>
</div>

<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript('initialize-custom-field', "
    $(document).ready(function() {
        initializeCustomField();
    });
", CClientScript::POS_END);
?>