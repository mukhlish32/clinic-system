<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal'),
));
?>

<div class="form-group mb-3">
    <?php echo $form->label($model, 'pegawai_id', array('class' => 'form-label')); ?>
    <span style="color:red;">*</span>
    <?php
    if ($model->isNewRecord) {
        $pegawaiList = CHtml::listData(
            Pegawai::model()->findAll('user_id IS NULL'),
            'id',
            'nama'
        );

        echo CHtml::dropDownList(
            'pegawai_id',
            '',
            $pegawaiList,
            array('class' => 'form-control select2', 'prompt' => '- Pilih Pegawai -')
        );
    } else {
        $pegawai = Pegawai::model()->findByPk($model->id);
        $pegawaiName = $pegawai ? $pegawai->nama : '-';

        echo CHtml::textField(
            'pegawai_id',
            $pegawaiName,
            array('class' => 'form-control bg-light', 'readonly' => true) // Make it readonly
        );
    }
    ?>
    <?php echo $form->error($model, 'pegawai_id', array('class' => 'invalid-feedback')); ?>
</div>


<div class="form-group mb-3">
    <?php echo $form->label($model, 'username', array('class' => 'form-label')); ?>
    <span style="color:red;">*</span>

    <?php
    if (!$model->isNewRecord) {
        echo $form->textField($model, 'username', array(
            'class' => 'form-control bg-light',
            'maxlength' => 255,
            'readonly' => true
        ));
    } else {
        echo $form->textField($model, 'username', array(
            'class' => 'form-control',
            'maxlength' => 255
        ));
    }
    ?>
    <?php echo $form->error($model, 'username', array('class' => 'invalid-feedback')); ?>
</div>

<div class="form-group mb-3">
    <?php echo $form->label($model, 'email', array('class' => 'form-label')); ?>
    <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'maxlength' => 255)); ?>
    <?php echo $form->error($model, 'email', array('class' => 'invalid-feedback')); ?>
</div>

<?php if ($model->isNewRecord): ?>
    <div class="form-group mb-3">
        <?php echo $form->label($model, 'password', array('class' => 'form-label')); ?>
        <span style="color:red;">*</span>
        <div class="position-relative auth-pass-inputgroup mb-3">
            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control pe-5 password-input', 'maxlength' => 255, 'required' => true)); ?>
            <button type="button" class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon">
                <i class="ri-eye-fill align-middle"></i> <!-- Eye open icon -->
            </button>
        </div>
        <?php echo $form->error($model, 'password', array('class' => 'invalid-feedback')); ?>
    </div>

    <div class="form-group mb-3">
        <?php echo $form->label($model, 'confirm_password', array('class' => 'form-label')); ?>
        <span style="color:red;">*</span>
        <div class="position-relative auth-pass-inputgroup mb-3">
            <?php echo $form->passwordField($model, 'confirm_password', array('class' => 'form-control pe-5 password-input', 'maxlength' => 255, 'required' => true)); ?>
            <button type="button" class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon">
                <i class="ri-eye-fill align-middle"></i> <!-- Eye open icon -->
            </button>
        </div>
        <?php echo $form->error($model, 'confirm_password', array('class' => 'invalid-feedback')); ?>
    </div>
<?php endif; ?>

<div class="form-group mb-3">
    <?php echo $form->label($model, 'role_id', array('class' => 'form-label')); ?>
    <span style="color:red;">*</span>
    <?php echo $form->dropDownList(
        $model,
        'role_id',
        CHtml::listData(Role::model()->findAll(), 'id', 'nama'),
        array('class' => 'form-control select2', 'prompt' => '- Pilih Role -')
    ); ?>
    <?php echo $form->error($model, 'role_id', array('class' => 'invalid-feedback')); ?>
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

Yii::app()->clientScript->registerScript('password-toggle', "
    $(document).ready(function () {
        // Handle toggle for all password fields dynamically
        $('.password-addon').on('click', function () {
            var input = $(this).siblings('.password-input'); // Find the password field associated with the button
            var icon = $(this).find('i'); // Find the icon inside the button

            // Toggle password visibility
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');  // Show password
                icon.removeClass('ri-eye-fill').addClass('ri-eye-off-fill');  // Change icon to closed eye
            } else {
                input.attr('type', 'password');  // Hide password
                icon.removeClass('ri-eye-off-fill').addClass('ri-eye-fill');  // Change icon to open eye
            }
        });
    });
", CClientScript::POS_READY);
?>