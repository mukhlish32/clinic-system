<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Tindakan & Obat</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Transaksi</a>
                        </li>
                        <li class="breadcrumb-item active">Transaksi</li>
                        <li class="breadcrumb-item active">Tindakan & Obat</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <?php $this->renderPartial('_dataPasien', ['pasienDaftar' => $pasienDaftar]); ?>

    <ul class="nav nav-tabs nav-pills nav-justified" id="tindakanObatTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="tindakan-tab" data-bs-toggle="tab" data-bs-target="#tindakan" type="button" role="tab" aria-controls="tindakan" aria-selected="true"><b>TINDAKAN</b></button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="obat-tab" data-bs-toggle="tab" data-bs-target="#obat" type="button" role="tab" aria-controls="obat" aria-selected="false"><b>OBAT</b></button>
        </li>
    </ul>

    <div class="tab-content mt-3" id="tindakanObatTabContent">
        <div class="tab-pane fade show active" id="tindakan" role="tabpanel" aria-labelledby="tindakan-tab">
            <div class="card shadow-sm">
                <div class="card-header card-primary d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white">List Tindakan Pasien</h5>
                    <a href="<?php echo Yii::app()->createUrl('transaksi/transaksi/createTindakan', ['norm' => $pasienDaftar->id]); ?>" class="btn btn-sm btn-success btn-label">
                        <i class="ri-add-line label-icon align-middle me-1"></i> Tambah
                    </a>
                </div>

                <div class="card-body">
                    <?php $this->renderPartial('//partials/_notifications'); ?>
                    <?php $this->renderPartial('_tindakanList', ['listTindakan' => $listTindakan, 'pasienDaftar' => $pasienDaftar]); ?>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="obat" role="tabpanel" aria-labelledby="obat-tab">
            <div class="card shadow-sm">
                <div class="card-header card-primary d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white">List Obat Pasien</h5>
                    <a href="<?php echo Yii::app()->createUrl('transaksi/transaksi/createObat', ['norm' => $pasienDaftar->id]); ?>" class="btn btn-sm btn-success btn-label">
                        <i class="ri-add-line label-icon align-middle me-1"></i> Tambah
                    </a>
                </div>

                <div class="card-body">
                    <?php $this->renderPartial('//partials/_notifications'); ?>
                    <?php $this->renderPartial('_obatList', ['listObat' => $listObat, 'pasienDaftar' => $pasienDaftar]); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <button type="button" class="btn btn-primary w-md mb-3" onclick="history.back()">Kembali</button>
    </div>
</div>