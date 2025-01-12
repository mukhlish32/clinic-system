<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'obat-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal'),
));
?>

<div class="row">
    <div class="col-md-9">
        <div class="mb-3">
            <div class="form-group">
                <?php echo $form->label($pasienDaftar, 'pasien_nama', array('class' => 'form-label')); ?>
                <span style="color:red;">*</span>
                <?php
                echo $form->textField($pasienDaftar, 'pasien_nama', array(
                    'class' => 'form-control bg-light',
                    'value' => CHtml::encode($pasienDaftar->pasien->nama),
                    'readonly' => true,
                    'maxlength' => 50
                ));
                ?>
                <?php echo $form->error($pasienDaftar, 'pasien_nama', array('class' => 'invalid-feedback')); ?>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            <div class="form-group">
                <?php echo $form->label($model, 'pasien_daftar_id', array('class' => 'form-label')); ?>
                <span style="color:red;">*</span>
                <?php
                echo $form->textField($model, 'pasien_daftar_id', array(
                    'class' => 'form-control bg-light',
                    'value' => CHtml::encode($pasienDaftar->id),
                    'readonly' => true,
                    'maxlength' => 50
                ));
                ?>
                <?php echo $form->error($model, 'pasien_daftar_id', array('class' => 'invalid-feedback')); ?>
            </div>
        </div>
    </div>
</div>

<div class="form-group mb-3">
    <?php echo $form->label($model, 'obat_id', array('class' => 'form-label')); ?>
    <span style="color:red;">*</span>
    <?php echo $form->dropDownList(
        $model,
        'obat_id',
        CHtml::listData(Obat::model()->findAll(), 'id', 'nama'),
        array('class' => 'form-control select2', 'prompt' => '- Pilih Obat -')
    ); ?>
    <?php echo $form->error($model, 'obat_id', array('class' => 'invalid-feedback')); ?>
</div>

<div class="mb-3">
    <div class="form-group">
        <?php echo $form->label($model, 'tgl_transaksi', array('class' => 'form-label')); ?>
        <div class="row">
            <div class="col-7">
                <?php
                $tglTransaksiDate = isset($model->tgl_transaksi) ? date("Y-m-d", strtotime($model->tgl_transaksi)) : date("Y-m-d");
                echo $form->dateField($model, 'tgl_transaksi', array(
                    'class' => 'form-control',
                    'value' => CHtml::encode($tglTransaksiDate),
                ));
                ?>
                <?php echo $form->error($model, 'tgl_transaksi', array('class' => 'invalid-feedback')); ?>
            </div>

            <div class="col-5">
                <?php
                $tglTransaksiTime = isset($model->tgl_transaksi) ? date("H:i", strtotime($model->tgl_transaksi)) : date("H:i");
                echo $form->timeField($model, 'time_transaksi', array(
                    'class' => 'form-control',
                    'value' => CHtml::encode($tglTransaksiTime),
                ));
                ?>
                <?php echo $form->error($model, 'time_transaksi', array('class' => 'invalid-feedback')); ?>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <div class="form-group">
        <?php echo $form->label($model, 'pegawai_id', array('class' => 'form-label')); ?>
        <span style="color:red;">*</span>
        <?php echo $form->dropDownList($model, 'pegawai_id', CHtml::listData(Pegawai::model()->findAll(), 'id', 'nama'), array('class' => 'form-control select2')); ?>
        <?php echo $form->error($model, 'pegawai_id', array('class' => 'invalid-feedback')); ?>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <div class="mb-3">
            <div class="form-group">
                <?php echo $form->label($model, 'harga', array('class' => 'form-label')); ?>
                <span style="color:red;">*</span>
                <?php echo $form->textField($model, 'harga', array('class' => 'form-control bg-light harga', 'readonly' => true)); ?>
                <?php echo $form->error($model, 'harga', array('class' => 'invalid-feedback')); ?>
            </div>
        </div>
    </div>

    <div class="col-2">
        <div class="mb-3">
            <div class="form-group">
                <?php echo $form->label($model, 'stok', array('class' => 'form-label')); ?>
                <span id="stok-display" class="form-control-plaintext text-secondary">-</span> <!-- Display stock -->
                <?php echo CHtml::hiddenField('stok_value', '', array('id' => 'stok-value')); ?> <!-- Hidden field for validation -->
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="mb-3">
            <div class="form-group">
                <?php echo $form->label($model, 'jumlah', array('class' => 'form-label')); ?>
                <span style="color:red;">*</span>
                <?php echo $form->numberField($model, 'jumlah', array('class' => 'form-control', 'min' => 1)); ?>
                <?php echo $form->error($model, 'jumlah', array('class' => 'invalid-feedback')); ?>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="mb-3">
            <div class="form-group">
                <?php echo $form->label($model, 'total', array('class' => 'form-label')); ?>
                <span style="color:red;">*</span>
                <?php echo $form->textField($model, 'total', array('class' => 'form-control', 'readonly' => true)); ?>
                <?php echo $form->error($model, 'total', array('class' => 'invalid-feedback')); ?>
            </div>
        </div>
    </div>
</div>

<div class="action-buttons text-end">
    <button type="button" class="btn btn-primary w-md mb-3" onclick="history.back()">Kembali</button>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Update', array('class' => 'btn btn-success w-md mb-3')); ?>
</div>

<?php
Yii::app()->clientScript->registerScript('initialize-custom-field', "
$(document).ready(function() {
    initializeCustomField();

    // Trigger calculation of total on 'harga' or 'jumlah' input
    $('#" . CHtml::activeId($model, 'harga') . "').on('input', calculateTotal);
    $('#" . CHtml::activeId($model, 'jumlah') . "').on('input', validateJumlah);

    // Trigger action when an 'obat' is selected
    $('#" . CHtml::activeId($model, 'obat_id') . "').on('change', function() {
        var selectedObatId = $(this).val();
        if (selectedObatId) {
            $.ajax({
                type: 'POST',
                url: '" . $this->createUrl('master/obat/getHargaStok') . "',
                data: {id: selectedObatId},
                success: function(data) {
                    var parsedData = JSON.parse(data);
                    $('#" . CHtml::activeId($model, 'harga') . "').val(parsedData.harga);
                    $('#stok-display').text(parsedData.stok);
                    $('#stok-value').val(parsedData.stok);
                    calculateTotal();
                }
            });
        }
    });

    // Function to calculate total based on harga and jumlah
    function calculateTotal() {
        var harga = parseFloat($('#" . CHtml::activeId($model, 'harga') . "').val()) || 0;
        var jumlah = parseInt($('#" . CHtml::activeId($model, 'jumlah') . "').val()) || 0;
        var total = harga * jumlah;

        $('#" . CHtml::activeId($model, 'total') . "').val(total.toFixed(2)); // Set the total value
    }

    // Function to validate jumlah against stok
    function validateJumlah() {
        var jumlah = parseInt($('#" . CHtml::activeId($model, 'jumlah') . "').val()) || 0;
        var stok = parseInt($('#stok-value').val()) || 0;

        if (jumlah > stok) {
            $('#" . CHtml::activeId($model, 'jumlah') . "').val(stok); // Reset to max stok
        }
        calculateTotal(); // Recalculate total in case of adjustment
    }
    
    // Initialize total on page load
    calculateTotal();
});
", CClientScript::POS_END);
?>

<?php $this->endWidget(); ?>