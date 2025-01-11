<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Wilayah</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Master</a>
                        </li>
                        <li class="breadcrumb-item active">Wilayah</li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header card-primary d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white">Detail Wilayah</h5>
                </div>

                <div class="card-body">
                    <?php $this->renderPartial('//partials/_notifications'); ?>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Kelurahan</strong>
                        </div>
                        <div class="col-md-8">
                            <?php echo CHtml::textField('kelurahan', CHtml::encode($model->kelurahan), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Kecamatan</strong>
                        </div>
                        <div class="col-md-8">
                            <?php echo CHtml::textField('kecamatan', CHtml::encode($model->kecamatan), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Kota</strong>
                        </div>
                        <div class="col-md-8">
                            <?php echo CHtml::textField('kota', CHtml::encode($model->kota), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Provinsi</strong>
                        </div>
                        <div class="col-md-8">
                            <?php echo CHtml::textField('provinsi', CHtml::encode($model->provinsi), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Kode Pos</strong>
                        </div>
                        <div class="col-md-8">
                            <?php echo CHtml::textField('kode_pos', CHtml::encode($model->kode_pos), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                        </div>
                    </div>

                    <?php $this->renderPartial('//partials/_actions-view', [
                        'model' => $model,
                        'location' => 'master/wilayah',
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>