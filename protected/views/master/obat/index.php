<div class="container-fluid">
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Obat</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Master</a>
                        </li>
                        <li class="breadcrumb-item active">Obat</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <div class="card shadow-sm">
        <div class="card-header card-primary d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-white">List Obat</h5>
            <a href="<?php echo Yii::app()->createUrl('master/obat/create'); ?>" class="btn btn-sm btn-success btn-label">
                <i class="ri-add-line label-icon align-middle me-1"></i> Tambah
            </a>
        </div>

        <div class="card-body">
            <?php $this->renderPartial('//partials/_notifications'); ?>
            <div class="container-fluid">
                <!-- Start Filter Section -->
                <div class="border p-3 mb-4 rounded bg-info-subtle">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label for="filter-kode" class="form-label">Kode</label>
                            <input type="text" id="filter-kode" class="form-control form-control-sm filter-input" placeholder="Filter Kode">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="filter-nama" class="form-label">Nama</label>
                            <input type="text" id="filter-nama" class="form-control form-control-sm filter-input" placeholder="Filter Nama">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="filter-stok" class="form-label">Stok</label>
                            <input type="text" id="filter-stok" class="form-control form-control-sm filter-input" placeholder="Filter Stok">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="filter-status" class="form-label">Status</label>
                            <select id="filter-status" class="form-control form-control-sm filter-input">
                                <option value="">Filter Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- End Filter Section -->
            </div>

            <div class="table-responsive" style="max-width: 100%; overflow-x: auto;">
                <table id="obat-table" class="table table-bordered nowrap align-middle" style="width: 100%; table-layout: auto;">
                    <thead class="table-active">
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
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
Yii::app()->clientScript->registerScript('obat-table-script', "
$(document).ready(function() {
    var table = $('#obat-table').DataTable({
        pageLength: 10,
        responsive: true,
        serverSide: true,
        scrollX: true,
        searchDelay: 1000,
        autoWidth: false,
        ajax: {
            url: '" . Yii::app()->createUrl('master/obat/index') . "',
            type: 'GET',
            data: function(d) {
                d.ajax = 1;
                d.kode = $('#filter-kode').val();
                d.nama = $('#filter-nama').val();
                d.stok = $('#filter-stok').val();
                d.status = $('#filter-status').val();
            },
            dataSrc: 'data'
        },
        columns: [
            { data: 'kode' },
            { data: 'nama' },
            { data: 'harga' },
            { data: 'stok' },
            { data: 'status' },
            { data: 'aksi', orderable: false, searchable: false }
        ],
        order: [[0, 'asc']]
    });

    $('.filter-input').on('keyup change', function() {
        table.ajax.reload();
    });
});
", CClientScript::POS_END);
?>
