<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Tindakan</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Master</a>
                        </li>
                        <li class="breadcrumb-item active">Tindakan</li>
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
                    <h5 class="mb-0 fw-bold text-white">Detail Tindakan</h5>
                </div>

                <div class="card-body">
                    <?php $this->renderPartial('//partials/_notifications'); ?>

                    <!-- Nama Tindakan -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Nama Tindakan</strong>
                        </div>
                        <div class="col-md-8">
                            <?php echo CHtml::textField('nama', CHtml::encode($model->nama), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Harga</strong>
                        </div>
                        <div class="col-md-8">
                            <?php echo CHtml::textField('harga', CHtml::encode(number_format($model->harga, 2, ',', '.')), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Status</strong>
                        </div>
                        <div class="col-md-8">
                            <?php echo CHtml::textField('row_status', CHtml::encode(StatusEnum::getStatusLabel($model->status)), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                        </div>
                    </div>

                    <?php $this->renderPartial('//partials/_actions-view', [
                        'model' => $model,
                        'location' => 'master/tindakan',
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>