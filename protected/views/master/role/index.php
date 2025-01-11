<div class="container-fluid">
    <!-- start page title -->
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
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- <div class="row project-wrapper"> -->
    <div class="card shadow-sm">
        <div class="card-header card-primary d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-white">List Role</h5>
            <a href="<?php echo Yii::app()->createUrl('master/role/create'); ?>" class="btn btn-sm btn-success btn-label">
                <i class="ri-add-line label-icon align-middle me-1"></i> Tambah
            </a>
        </div>

        <div class="card-body">
    <div class="table-responsive" style="max-width: 100%; overflow-x: auto;">
        <table id="role-table" class="table nowrap align-middle" style="width: 100%; table-layout: auto;">
            <thead class="table-active">
                <tr>
                    <th>Nama</th>
                    <th data-ordering="false">Keterangan</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data rows go here -->
            </tbody>
        </table>
    </div>
</div>



        <!-- </div> -->

    </div>
    <!-- </div> -->

</div>



<?php
Yii::app()->clientScript->registerScript('role-table-script', "
$(document).ready(function() {
    var table = $('#role-table').DataTable({
        pageLength: 10,
        responsive: true,
        serverSide: true,
        scrollX: true,
        searchDelay: 1000,
        autoWidth: false, // Prevent automatic width calculation
        ajax: {
            url: '" . Yii::app()->createUrl('master/role/index') . "',
            type: 'GET',
            data: function(d) {
                d.ajax = 1;
            },
            dataSrc: 'data'
        },
        columns: [
            { data: 'nama' },  // 'name' will map to the 'Nama' column in the table
            { data: 'keterangan' }, // 'description' will map to the 'Keterangan' column
            { data: 'aksi', orderable: false, searchable: false }  // Action buttons (View, Update, Delete)
        ],
        order: [[1, 'asc']] // Default sorting (sort by name in ascending order)
    });
});
", CClientScript::POS_END);
?>