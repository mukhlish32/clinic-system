<div class="container-fluid">
    <!-- start page title -->
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
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card shadow-sm">
        <div class="card-header card-primary d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-white">List Wilayah</h5>
            <a href="<?php echo Yii::app()->createUrl('master/wilayah/create'); ?>" class="btn btn-sm btn-success btn-label">
                <i class="ri-add-line label-icon align-middle me-1"></i> Tambah
            </a>
        </div>

        <div class="card-body">
        <?php $this->renderPartial('//partials/_notifications'); ?>
            <div class="container-fluid">
                <!-- Start Filter Section -->
                <div class="border p-3 mb-4 rounded bg-info-subtle">
                    <div class="row">
                        <div class="col-md-2 mb-2">
                            <label for="filter-kelurahan" class="form-label">Kelurahan</label>
                            <input type="text" id="filter-kelurahan" class="form-control form-control-sm filter-input" placeholder="Filter Kelurahan">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-kecamatan" class="form-label">Kecamatan</label>
                            <input type="text" id="filter-kecamatan" class="form-control form-control-sm filter-input" placeholder="Filter Kecamatan">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-kota" class="form-label">Kota</label>
                            <input type="text" id="filter-kota" class="form-control form-control-sm filter-input" placeholder="Filter Kota">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-provinsi" class="form-label">Provinsi</label>
                            <input type="text" id="filter-provinsi" class="form-control form-control-sm filter-input" placeholder="Filter Provinsi">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-kode_pos" class="form-label">Kode Pos</label>
                            <input type="text" id="filter-kode_pos" class="form-control form-control-sm filter-input" placeholder="Filter Kode Pos">
                        </div>
                    </div>
                </div>
                <!-- End Filter Section -->
            </div>

            <div class="table-responsive" style="max-width: 100%; overflow-x: auto;">
                <table id="wilayah-table" class="table table-bordered nowrap align-middle" style="width: 100%; table-layout: auto;">
                    <thead class="table-active">
                        <tr>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <th>Kode Pos</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
Yii::app()->clientScript->registerScript('wilayah-table-script', "
$(document).ready(function() {
    var table = $('#wilayah-table').DataTable({
        pageLength: 10,
        responsive: true,
        serverSide: true,
        scrollX: true,
        searchDelay: 1000,
        autoWidth: false, // Prevent automatic width calculation
        ajax: {
            url: '" . Yii::app()->createUrl('master/wilayah/index') . "',
            type: 'GET',
            data: function(d) {
                d.ajax = 1;
                d.kelurahan = $('#filter-kelurahan').val();
                d.kecamatan = $('#filter-kecamatan').val();
                d.kota = $('#filter-kota').val();
                d.provinsi = $('#filter-provinsi').val();
                d.kode_pos = $('#filter-kode_pos').val();
            },
            dataSrc: 'data'
        },
        columns: [
            { data: 'kelurahan' },
            { data: 'kecamatan' },
            { data: 'kota' },
            { data: 'provinsi' },
            { data: 'kode_pos' },
            { data: 'aksi', orderable: false, searchable: false }
        ],
        order: [[0, 'asc']]
    });

    $('.filter-input').on('keyup', function() {
        table.ajax.reload();
    });
});
", CClientScript::POS_END);
?>