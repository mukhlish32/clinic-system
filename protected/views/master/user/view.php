<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">User</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Master</a>
                        </li>
                        <li class="breadcrumb-item active">User</li>
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
                    <h5 class="mb-0 fw-bold text-white">Detail User</h5>
                </div>

                <div class="card-body">
                    <?php $this->renderPartial('//partials/_notifications'); ?>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Username</strong>
                        </div>
                        <div class="col-md-8">
                            <?php echo CHtml::textField('username', CHtml::encode($model->username), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Email</strong>
                        </div>
                        <div class="col-md-8">
                            <?php echo CHtml::textField('email', CHtml::encode($model->email), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Role</strong>
                        </div>
                        <div class="col-md-8">
                            <?php echo CHtml::textField('role', CHtml::encode($model->role ? $model->role->nama : '-'), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Pegawai</strong>
                        </div>
                        <div class="col-md-8">
                            <?php echo CHtml::textField('pegawai', CHtml::encode($model->pegawai ? $model->pegawai->nama : '-'), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                        </div>
                    </div>

                    <?php $this->renderPartial('//partials/_actions-view', [
                        'model' => $model,
                        'location' => 'master/user',
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
