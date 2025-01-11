<div class="container-fluid">
    <!-- start page title -->
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
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card shadow-sm">
        <div class="card-header card-primary d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-white">List User</h5>
            <a href="<?php echo Yii::app()->createUrl('master/user/create'); ?>" class="btn btn-sm btn-success btn-label">
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
                            <label for="filter-username" class="form-label">Username</label>
                            <input type="text" id="filter-username" class="form-control form-control-sm filter-input" placeholder="Filter Username">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-email" class="form-label">Email</label>
                            <input type="text" id="filter-email" class="form-control form-control-sm filter-input" placeholder="Filter Email">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-role" class="form-label">Role</label>
                            <input type="text" id="filter-role" class="form-control form-control-sm filter-input" placeholder="Filter Role">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-pegawai" class="form-label">Pegawai</label>
                            <input type="text" id="filter-pegawai" class="form-control form-control-sm filter-input" placeholder="Filter Pegawai">
                        </div>
                    </div>
                </div>
                <!-- End Filter Section -->
            </div>

            <div class="table-responsive" style="max-width: 100%; overflow-x: auto;">
                <table id="user-table" class="table table-bordered nowrap align-middle" style="width: 100%; table-layout: auto;">
                    <thead class="table-active">
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Pegawai</th>
                            <!-- <th>Status</th> -->
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
Yii::app()->clientScript->registerScript('user-table-script', "
$(document).ready(function() {
    var table = $('#user-table').DataTable({
        pageLength: 10,
        responsive: true,
        serverSide: true,
        scrollX: true,
        searchDelay: 1000,
        autoWidth: false,
        ajax: {
            url: '" . Yii::app()->createUrl('master/user/index') . "',
            type: 'GET',
            data: function(d) {
                d.ajax = 1;
                d.username = $('#filter-username').val();
                d.email = $('#filter-email').val();
                d.role = $('#filter-role').val();
                d.pegawai = $('#filter-pegawai').val();
                d.status = $('#filter-status').val();
            },
            dataSrc: 'data'
        },
        columns: [
            { data: 'username' },
            { data: 'email' },
            { data: 'role' },
            { data: 'pegawai' },
            // { data: 'status' },
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
