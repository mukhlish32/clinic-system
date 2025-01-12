<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Obat</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Transaksi</a>
                        </li>
                        <li class="breadcrumb-item active">Pelayanan Pasien</li>
                        <li class="breadcrumb-item active">Tindakan & Obat</li>
                        <li class="breadcrumb-item active">Obat</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header card-primary d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-white">Tambah Obat Pasien</h5>
                </div>

                <div class="card-body">
                    <?php $this->renderPartial('//partials/_notifications'); ?>
                    <?php echo $this->renderPartial('_formObat', array('model' => $model, 'pasienDaftar' => $pasienDaftar)); ?>
                </div>
            </div>
        </div>
    </div>
</div>