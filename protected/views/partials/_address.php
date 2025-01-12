<div class="form-group mb-3">
    <?php echo $form->label($model, 'alamat', array('class' => 'form-label')); ?>
    <span style="color:red;">*</span>
    <?php echo $form->textArea($model, 'alamat', array('class' => 'form-control', 'rows' => 3)); ?>
    <?php echo $form->error($model, 'alamat', array('class' => 'invalid-feedback')); ?>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <?php echo $form->label($model, 'provinsi', array('class' => 'form-label')); ?>
            <?php echo $form->dropDownList($model, 'provinsi', CHtml::listData(Wilayah::model()->findAll(), 'provinsi', 'provinsi'), [
                'class' => 'form-control select2',
                'id' => 'provinsi',
                'prompt' => '- Pilih Provinsi -',
                'value' => $model->provinsi,
                'ajax' => [
                    'type' => 'POST',
                    'url' => CController::createUrl('master/wilayah/getKotaByProvinsi'),
                    'data' => ['provinsi' => 'js:this.value'],
                    'success' => 'function(data) {
                            $("#kota").html(data);
                            $("#kecamatan").html("<option value=\"\">- Pilih Kecamatan -</option>");
                            $("#kelurahan").html("<option value=\"\">- Pilih Kelurahan -</option>");
                            $("#kode_pos").val("");
                        }'
                ]
            ]); ?>
            <?php echo $form->error($model, 'provinsi', array('class' => 'invalid-feedback')); ?>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            <?php echo $form->label($model, 'kota', array('class' => 'form-label')); ?>
            <?php echo $form->dropDownList($model, 'kota', CHtml::listData(Wilayah::model()->findAllByAttributes(['provinsi' => $model->provinsi]), 'kota', 'kota'), [
                'class' => 'form-control select2',
                'id' => 'kota',
                'prompt' => '- Pilih Kota/Kabupaten -',
                'value' => $model->kota,
                'ajax' => [
                    'type' => 'POST',
                    'url' => CController::createUrl('master/wilayah/getKecamatanByKota'),
                    'data' => ['kota' => 'js:this.value'],
                    'success' => 'function(data) {
                            $("#kecamatan").html(data);
                            $("#kelurahan").html("<option value=\"\">- Pilih Kelurahan -</option>");
                            $("#kode_pos").val("");
                        }'
                ]
            ]); ?>
            <?php echo $form->error($model, 'kota', array('class' => 'invalid-feedback')); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <?php echo $form->label($model, 'kecamatan', array('class' => 'form-label')); ?>
            <?php echo $form->dropDownList($model, 'kecamatan', CHtml::listData(Wilayah::model()->findAllByAttributes(['kota' => $model->kota]), 'kecamatan', 'kecamatan'), [
                'class' => 'form-control select2',
                'id' => 'kecamatan',
                'prompt' => '- Pilih Kecamatan -',
                'value' => $model->kecamatan,
                'ajax' => [
                    'type' => 'POST',
                    'url' => CController::createUrl('master/wilayah/getKelurahanByKecamatan'),
                    'data' => ['kecamatan' => 'js:this.value'],
                    'success' => 'function(data) {
                            $("#kelurahan").html(data);
                            $("#kode_pos").val("");
                        }'
                ]
            ]); ?>
            <?php echo $form->error($model, 'kecamatan', array('class' => 'invalid-feedback')); ?>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            <?php echo $form->label($model, 'kelurahan', array('class' => 'form-label')); ?>
            <?php echo $form->dropDownList($model, 'kelurahan', CHtml::listData(Wilayah::model()->findAllByAttributes(['kecamatan' => $model->kecamatan]), 'kelurahan', 'kelurahan'), [
                'class' => 'form-control select2',
                'id' => 'kelurahan',
                'prompt' => '- Pilih Kelurahan -',
                'value' => $model->kelurahan,
                'ajax' => [
                    'type' => 'POST',
                    'url' => CController::createUrl('master/wilayah/getKodePosByWilayah'),
                    'data' => [
                        'provinsi' => 'js:$("#provinsi").val()',
                        'kota' => 'js:$("#kota").val()',
                        'kecamatan' => 'js:$("#kecamatan").val()',
                        'kelurahan' => 'js:this.value'
                    ],
                    'success' => 'function(data) {
                            var parsedData = JSON.parse(data);
                            $("#kode_pos").val(parsedData.kode_pos);
                        }'
                ]
            ]); ?>
            <?php echo $form->error($model, 'kelurahan', array('class' => 'invalid-feedback')); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <?php echo $form->label($model, 'kode_pos', array('class' => 'form-label')); ?>
            <?php echo $form->textField($model, 'kode_pos', array('class' => 'form-control bg-light', 'id' => 'kode_pos', 'readonly' => true)); ?>
            <?php echo $form->error($model, 'kode_pos', array('class' => 'invalid-feedback')); ?>
        </div>
    </div>
</div>