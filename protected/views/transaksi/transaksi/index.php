<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Pasien Daftar</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Transaksi</a>
                        </li>
                        <li class="breadcrumb-item active">Transaksi</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card shadow-sm">
        <div class="card-header card-primary d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-white">List Pasien Daftar</h5>
            <a href="<?php echo Yii::app()->createUrl('transaksi/transaksi/create'); ?>" class="btn btn-sm btn-success btn-label">
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
                            <label for="filter-nama" class="form-label">Nama Pasien</label>
                            <input type="text" id="filter-nama" class="form-control form-control-sm filter-input" placeholder="Filter Nama Pasien">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-tgl_daftar" class="form-label">Tanggal Daftar</label>
                            <input type="text" id="filter-tgl_daftar" class="form-control form-control-sm filter-input" placeholder="Filter Tanggal Daftar">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-status" class="form-label">Status</label>
                            <select id="filter-status" class="form-control form-control-sm filter-input">
                                <option value="">- Pilih Status -</option>
                                <option value="1" selected>Proses</option>
                                <option value="2">Selesai</option>
                                <option value="0">Batal</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- End Filter Section -->
            </div>

            <div class="table-responsive" style="max-width: 100%; overflow-x: auto;">
                <table id="pasien-daftar-table" class="table table-bordered nowrap align-middle" style="width: 100%; table-layout: auto;">
                    <thead class="table-active">
                        <tr>
                            <th>Nama Pasien</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Keterangan</th>
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
Yii::app()->clientScript->registerScript('pasien-daftar-table-script', "
$(document).ready(function() {
    var table = $('#pasien-daftar-table').DataTable({
        pageLength: 10,
        responsive: true,
        serverSide: true,
        scrollX: true,
        searchDelay: 1000,
        autoWidth: false,
        ajax: {
            url: '" . Yii::app()->createUrl('transaksi/transaksi/index') . "',
            type: 'GET',
            data: function(d) {
                d.ajax = 1;
                d.nama = $('#filter-nama').val();
                d.status = $('#filter-status').val();
                d.tgl_daftar = $('#filter-tgl_daftar').val();
            },
            dataSrc: 'data'
        },
        columns: [
            { data: 'pasien_id' },
            { data: 'tgl_daftar' },
            { data: 'status' },
            { data: 'keterangan' },
            { data: 'aksi', orderable: false, searchable: false }
        ],
        order: [[1, 'desc']]
    });

    $('.filter-input').on('keyup change', function() {
        table.ajax.reload();
    });
});
", CClientScript::POS_END);
?>