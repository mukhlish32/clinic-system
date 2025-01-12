<div class="card">
    <div class="card-header card-primary d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-white">Data Pasien</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Nama Pasien</th>
                <td><?php echo CHtml::encode($pasienDaftar->pasien->nama); ?></td>
            </tr>
            <tr>
                <th>Tanggal Daftar</th>
                <td><?php echo CHtml::encode(date('d-m-Y', strtotime($pasienDaftar->tgl_daftar))); ?></td>
            </tr>
        </table>
    </div>
</div>