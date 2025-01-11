<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Wilayah</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Transaksi</a>
                        </li>
                        <li class="breadcrumb-item active">Pasien</li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header card-primary d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-white">Detail Pasien</h5>
        </div>

        <div class="card-body">
            <?php $this->renderPartial('//partials/_notifications'); ?>
            <!-- Personal Information and Address Section -->
            <div class="row mb-3">
                <!-- Personal Information Section -->
                <div class="col-md-6 d-flex align-items-stretch">
                    <div class="border p-3 rounded bg-light w-100">
                        <!-- Nama -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Nama</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo CHtml::textField('nama', CHtml::encode($model->nama), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                            </div>
                        </div>

                        <!-- NIK and No BPJS -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>NIK</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo CHtml::textField('nik', CHtml::encode($model->nik), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>No BPJS</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo CHtml::textField('no_bpjs', CHtml::encode($model->no_bpjs), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                            </div>
                        </div>

                        <!-- Tanggal Lahir and Jenis Kelamin -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Tanggal Lahir</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo CHtml::textField('tgl_lahir', CHtml::encode($model->tgl_lahir), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Jenis Kelamin</strong>
                            </div>
                            <div class="col-md-8">
                                <?php
                                $gender = $model->jns_kelamin == 'L' ? 'Laki-Laki' : ($model->jns_kelamin == 'P' ? 'Perempuan' : '');
                                echo CHtml::textField('jns_kelamin', CHtml::encode($gender), ['class' => 'form-control bg-light', 'readonly' => true]);
                                ?>
                            </div>
                        </div>

                        <!-- Telepon and Email -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Telepon</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo CHtml::textField('telp', CHtml::encode($model->telp), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
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

                        <!-- Golongan Darah and Agama -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Golongan Darah</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo CHtml::textField('gol_darah', CHtml::encode($model->gol_darah), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Agama</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo CHtml::textField('agama', CHtml::encode($model->agama), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Status</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo CHtml::textField('row_status', CHtml::encode(StatusEnum::getStatusLabel($model->status)), ['class' => 'form-control bg-light', 'readonly' => true]); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Section -->
                <div class="col-md-6 d-flex align-items-stretch">
                    <div class="border p-3 rounded bg-light w-100">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Alamat</strong>
                            </div>
                            <div class="col-md-8">
                                <?php echo CHtml::textArea('alamat', CHtml::encode($model->alamat), ['class' => 'form-control bg-light', 'rows' => 3, 'readonly' => true]); ?>
                            </div>
                        </div>

                        <!-- Kelurahan and Kecamatan -->
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

                        <!-- Kota, Provinsi, and Kode Pos -->
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
                    </div>
                </div>
            </div>

            <?php $this->renderPartial('//partials/_actions-view', [
                'model' => $model,
                'location' => 'transaksi/pasien',
            ]); ?>
        </div>
    </div>
</div>
