<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Pegawai</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Master</a>
                        </li>
                        <li class="breadcrumb-item active">Pegawai</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card shadow-sm">
        <div class="card-header card-primary d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-white">List Pegawai</h5>
            <a href="<?php echo Yii::app()->createUrl('master/pegawai/create'); ?>" class="btn btn-sm btn-success btn-label">
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
                            <label for="filter-nama" class="form-label">Nama</label>
                            <input type="text" id="filter-nama" class="form-control form-control-sm filter-input" placeholder="Filter Nama">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-nik" class="form-label">NIK</label>
                            <input type="text" id="filter-nik" class="form-control form-control-sm filter-input" placeholder="Filter NIK">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-nip" class="form-label">NIP</label>
                            <input type="text" id="filter-nip" class="form-control form-control-sm filter-input" placeholder="Filter NIP">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-jabatan" class="form-label">Jabatan</label>
                            <input type="text" id="filter-jabatan" class="form-control form-control-sm filter-input" placeholder="Filter Jabatan">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-jns_kelamin" class="form-label">Jenis Kelamin</label>
                            <select id="filter-jns_kelamin" class="form-control form-control-sm filter-input">
                                <option value="">- Pilih Jenis Kelamin -</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-telp" class="form-label">Telepon</label>
                            <input type="text" id="filter-telp" class="form-control form-control-sm filter-input" placeholder="Filter Telepon">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-alamat" class="form-label">Alamat</label>
                            <input type="text" id="filter-alamat" class="form-control form-control-sm filter-input" placeholder="Filter Alamat">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="filter-status" class="form-label">Status</label>
                            <select id="filter-status" class="form-control form-control-sm filter-input">
                                <option value="">- Pilih Status -</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- End Filter Section -->
            </div>

            <div class="table-responsive" style="max-width: 100%; overflow-x: auto;">
                <table id="pegawai-table" class="table table-bordered nowrap align-middle" style="width: 100%; table-layout: auto;">
                    <thead class="table-active">
                        <tr>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th width="10px">JK</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
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
Yii::app()->clientScript->registerScript('pegawai-table-script', "
$(document).ready(function() {
    var table = $('#pegawai-table').DataTable({
        pageLength: 10,
        responsive: true,
        serverSide: true,
        scrollX: true,
        searchDelay: 1000,
        autoWidth: false, // Prevent automatic width calculation
        ajax: {
            url: '" . Yii::app()->createUrl('master/pegawai/index') . "',
            type: 'GET',
            data: function(d) {
                d.ajax = 1;
                d.nama = $('#filter-nama').val();
                d.nik = $('#filter-nik').val();
                d.nip = $('#filter-nip').val();
                d.jabatan = $('#filter-jabatan').val();
                d.jns_kelamin = $('#filter-jns_kelamin').val();
                d.status = $('#filter-status').val(); // Include status in the filter
                d.telp = $('#filter-telp').val();
                d.alamat = $('#filter-alamat').val();
            },
            dataSrc: 'data'
        },
        columns: [
            { data: 'nama' },
            { data: 'nik' },
            { data: 'nip' },
            { data: 'jabatan' },
            { data: 'jns_kelamin' },
            { data: 'telp' },
            { data: 'alamat' },
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
