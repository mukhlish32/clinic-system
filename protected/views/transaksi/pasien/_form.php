<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'pasien-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal'),
));
?>

<div class="row mb-4">
    <div class="col-md-6 d-flex align-items-stretch">
        <div class="border p-3 rounded bg-light w-100">
            <h6 class="fw-bold mb-3">Informasi Pribadi</h6>

            <div class="form-group mb-3">
                <?php echo $form->label($model, 'nama', array('class' => 'form-label')); ?>
                <span style="color:red;">*</span>
                <?php echo $form->textField($model, 'nama', array('class' => 'form-control', 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'nama', array('class' => 'invalid-feedback')); ?>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <?php echo $form->label($model, 'nik', array('class' => 'form-label')); ?>
                        <span style="color:red;">*</span>
                        <?php echo $form->textField($model, 'nik', array('class' => 'form-control', 'maxlength' => 16)); ?>
                        <?php echo $form->error($model, 'nik', array('class' => 'invalid-feedback')); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <?php echo $form->label($model, 'no_bpjs', array('class' => 'form-label')); ?>
                        <?php echo $form->textField($model, 'no_bpjs', array('class' => 'form-control', 'maxlength' => 13)); ?>
                        <?php echo $form->error($model, 'no_bpjs', array('class' => 'invalid-feedback')); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <?php echo $form->label($model, 'tgl_lahir', array('class' => 'form-label')); ?>
                        <span style="color:red;">*</span>
                        <?php echo $form->dateField($model, 'tgl_lahir', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'tgl_lahir', array('class' => 'invalid-feedback')); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <?php echo $form->label($model, 'jns_kelamin', array('class' => 'form-label')); ?>
                        <span style="color:red;">*</span>
                        <?php echo $form->dropDownList(
                            $model,
                            'jns_kelamin',
                            array('' => '- Pilih Jenis Kelamin -', 'L' => 'Laki-Laki', 'P' => 'Perempuan'),
                            array('class' => 'form-control')
                        ); ?>
                        <?php echo $form->error($model, 'jns_kelamin', array('class' => 'invalid-feedback')); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <?php echo $form->label($model, 'telp', array('class' => 'form-label')); ?>
                        <span style="color:red;">*</span>
                        <?php echo $form->textField($model, 'telp', array('class' => 'form-control', 'maxlength' => 15)); ?>
                        <?php echo $form->error($model, 'telp', array('class' => 'invalid-feedback')); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <?php echo $form->label($model, 'email', array('class' => 'form-label')); ?>
                        <span style="color:red;">*</span>
                        <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'maxlength' => 255)); ?>
                        <?php echo $form->error($model, 'email', array('class' => 'invalid-feedback')); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <?php echo $form->label($model, 'gol_darah', array('class' => 'form-label')); ?>
                        <?php echo $form->dropDownList(
                            $model,
                            'gol_darah',
                            array(
                                '' => '- Pilih Golongan Darah -',
                                'A' => 'A',
                                'B' => 'B',
                                'AB' => 'AB',
                                'O' => 'O'
                            ),
                            array('class' => 'form-control')
                        ); ?>
                        <?php echo $form->error($model, 'gol_darah', array('class' => 'invalid-feedback')); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <?php echo $form->label($model, 'agama', array('class' => 'form-label')); ?>
                        <span style="color:red;">*</span>
                        <?php echo $form->dropDownList(
                            $model,
                            'agama',
                            array(
                                '' => '- Pilih Agama -',
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Katolik' => 'Katolik',
                                'Hindu' => 'Hindu',
                                'Buddha' => 'Buddha',
                                'Konghucu' => 'Konghucu'
                            ),
                            array('class' => 'form-control')
                        ); ?>
                        <?php echo $form->error($model, 'agama', array('class' => 'invalid-feedback')); ?>
                    </div>
                </div>
            </div>

            <?php if (!$model->isNewRecord): ?>
                <div class="form-group mb-3">
                    <?php echo $form->label($model, 'status', array('class' => 'form-label')); ?>
                    <?php echo $form->dropDownList($model, 'status', array(1 => 'Aktif', 0 => 'Tidak Aktif'), array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'status', array('class' => 'invalid-feedback')); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Address Section -->
    <div class="col-md-6 d-flex align-items-stretch">
        <div class="border p-3 rounded bg-light w-100">
            <h6 class="fw-bold mb-3">Alamat</h6>
            <?php $this->renderPartial('/partials/_address', ['model' => $model, 'form' => $form]); ?>
        </div>
    </div>
</div>

<div class="action-buttons text-end">
    <button type="button" class="btn btn-primary w-md mb-3" onclick="history.back()">Kembali</button>
    <?php echo CHtml::submitButton('Simpan', array('class' => 'btn btn-success w-md mb-3')); ?>
</div>

<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript('initialize-custom-field', "
    $(document).ready(function() {
        initializeCustomField();
    });
", CClientScript::POS_END);
?>