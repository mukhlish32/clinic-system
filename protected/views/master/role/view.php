<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Role</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Master</a>
                        </li>
                        <li class="breadcrumb-item active">Role</li>
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
                    <h5 class="mb-0 fw-bold text-white">Detail Role</h5>
                </div>

                <div class="card-body">
                    <!-- Display errors if there are any -->
                    <?php if ($model->hasErrors()): ?>
                        <div class="alert alert-danger">
                            <?php echo CHtml::errorSummary($model); ?>
                        </div>
                    <?php endif; ?>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Nama</strong>
                        </div>
                        <div class="col-md-8">
                            <?php echo CHtml::textField('nama', CHtml::encode($model->nama), ['class' => 'form-control', 'readonly' => true]); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Keterangan</strong>
                        </div>
                        <div class="col-md-8">
                            <?php echo CHtml::textArea('keterangan', CHtml::encode($model->keterangan), ['class' => 'form-control', 'readonly' => true]); ?>
                        </div>
                    </div>

                    <!-- Render action buttons from the partial -->
                    <?php $this->renderPartial('//partials/actions-view', [
                        'model' => $model,
                        'location' => 'master/role',
                    ]); ?>

                </div>
            </div>
        </div>
    </div>
</div>
