<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title><?php echo CHtml::encode($this->pageTitle); ?> | Vendorbest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Vendorbest" name="description" />
    <meta content="Muhammad Mukhlish Syarif" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/images/logo/logo-color-notext.png">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">

    <!-- Other Stylesheets -->
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/css/custom.min.css" rel="stylesheet" type="text/css" />
    <?php if (isset($this->styles)) echo $this->styles; ?>
</head>

<body>
    <div id="layout-wrapper">
        <!-- Header -->
        <?php $this->renderPartial('//partials/header'); ?>

        <!-- Sidebar -->
        <?php $this->renderPartial('//partials/navbar'); ?>

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-content">
                <?php echo $content; ?>
            </div>

            <!-- Footer -->
            <?php $this->renderPartial('//partials/footer'); ?>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/libs/feather-icons/feather.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/js/plugins.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <!-- Custom JS for SweetAlert Delete Confirmation -->
    <?php
    Yii::app()->clientScript->registerScript('sweetalert-js', '
        $(document).on("click", ".delete-button", function(e) {
            e.preventDefault();
            var form = $(this).closest("form");
            var name = form.closest("tr").find("td").eq(1).text();
            
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Data \"" + name + "\" akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    ', CClientScript::POS_END);
    ?>

    <!-- Other JS Libraries -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/js/pages/datatables.init.js"></script>

    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/js/app.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/js/custom.js"></script>

    <?php if (isset($this->scripts)) echo $this->scripts; ?>
</body>

</html>