<?php
$this->pageTitle = "Tagihan Pasien - " . $pasien->nama;
?>

<div class="container-fluid">
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Pasien</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Transaksi</a>
                        </li>
                        <li class="breadcrumb-item active">Pasien</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title -->

    <div class="container mt-4">
        <center>
            <h1 class="mb-4">Tagihan Pasien - <?php echo $pasien->nama ?></h1>
        </center>

        <!-- Patient Info Section -->
        <div class="patient-info">
            <h3 class="text-primary">Informasi Pasien</h3>
            <table class="table table-borderless table-no-gap">
                <tr>
                    <td width="20%"><strong>Nama Pasien</strong></td>
                    <td>:</td>
                    <td><?php echo CHtml::encode($pasien->nama); ?></td>
                </tr>
                <tr>
                    <td><strong>ID Pasien</strong></td>
                    <td>:</td>
                    <td><?php echo CHtml::encode($pasien->id); ?></td>
                </tr>
                <tr>
                    <td><strong>Alamat</strong></td>
                    <td>:</td>
                    <td><?php echo CHtml::encode($pasien->alamat); ?></td>
                </tr>
                <tr>
                    <td><strong>Tanggal Pendaftaran</strong></td>
                    <td>:</td>
                    <td>
                        <?php
                        $formattedDate = Yii::app()->dateFormatter->format("EEEE, dd MMMM yyyy", strtotime($pasienDaftar->tgl_daftar));
                        echo CHtml::encode($formattedDate);
                        ?>
                    </td>
                </tr>
            </table>
        </div>

        <hr>

        <!-- Tindakan Section -->
        <div class="tindakan-info mb-4">
            <h3 class="text-success">Tindakan</h3>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Tindakan</th>
                        <th>Biaya</th>
                        <th>Tgl Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tindakan as $item): ?>
                        <tr>
                            <td><?php echo CHtml::encode($item->tindakan->nama); ?></td>
                            <td><?php echo CHtml::encode(number_format($item->total, 2)); ?></td>
                            <td>
                                <?php
                                $tglTransaksi = isset($item->tgl_transaksi) ? date("d F Y H:i:s", strtotime($item->tgl_transaksi)) : '';
                                echo CHtml::encode($tglTransaksi);
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <hr>

        <!-- Obat Section -->
        <div class="obat-info mb-4">
            <h3 class="text-danger">Obat</h3>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Obat</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                        <th>Tgl Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($obat as $item): ?>
                        <tr>
                            <td><?php echo CHtml::encode($item->obat->nama); ?></td>
                            <td><?php echo CHtml::encode($item->jumlah); ?></td>
                            <td><?php echo CHtml::encode(number_format($item->harga, 2)); ?></td>
                            <td><?php echo CHtml::encode(number_format($item->harga * $item->jumlah, 2)); ?></td>
                            <td>
                                <?php
                                $tglTransaksi = isset($item->tgl_transaksi) ? date("d F Y H:i:s", strtotime($item->tgl_transaksi)) : '';
                                echo CHtml::encode($tglTransaksi);
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <hr>

        <!-- Total Tagihan Section -->
        <div class="total-info mb-4">
            <h3 class="text-primary">Total Tagihan</h3>
            <p><strong>Total Biaya Tindakan dan Obat:</strong> <?php echo CHtml::encode(number_format($total, 2)); ?></p>
        </div>

        <hr>

        <!-- Payment Button -->
        <div class="payment-action text-center">
            <button type="button" class="btn btn-primary w-md mb-3" onclick="history.back()">Kembali</button>
            <a href="<?php echo Yii::app()->createUrl('transaksi/transaksi/printPdf', array('id' => $pasien->id)); ?>" class="btn btn-info w-md mb-3">Print</a>
            <a href="#" class="btn btn-success w-md mb-3">Bayar</a>
        </div>

    </div>
</div>


<style>
    .table-no-gap td,
    .table-no-gap th {
        padding: 0.25rem;
        /* Adjust padding as needed */
    }

    .table-no-gap {
        border-collapse: collapse;
        /* Ensure no space between cells */
    }
</style>