<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title><?php echo CHtml::encode($this->pageTitle); ?> | Sistem Informasi Klinik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Sistem Informasi Klinik" name="description" />
    <meta content="Muhammad Mukhlish Syarif" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/images/logo/logo-color-notext.png">

    <!-- Layout config Js -->
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css -->
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom Css -->
    <link href="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/css/custom.min.css" rel="stylesheet" type="text/css" />

    <?php if (!empty($this->customCss)) {
        foreach ($this->customCss as $cssFile) {
            echo CHtml::cssFile(Yii::app()->baseUrl . $cssFile);
        }
    } ?>
</head>

<body>
    <div class="auth-page-wrapper pt-5">
        <!-- Auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>
            <?php if (!in_array($this->route, ['vendor/showRegister'])): ?>
                <div class="shape">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                         viewBox="0 0 1440 120">
                        <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z">
                        </path>
                    </svg>
                </div>
            <?php endif; ?>
        </div>

        <!-- Auth page content -->
        <div class="auth-page-content">
            <?php echo $content; ?>
        </div>
        <!-- End auth page content -->

        <!-- Footer -->
        <?php $this->renderPartial('//partials/_footer'); ?>
    </div>

    <!-- JAVASCRIPT -->
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/libs/feather-icons/feather.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/js/plugins.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/assets/velzon/js/pages/select2.init.js"></script>

    <?php if (!empty($this->customScripts)) {
        foreach ($this->customScripts as $scriptFile) {
            echo CHtml::scriptFile(Yii::app()->baseUrl . $scriptFile);
        }
    } ?>
</body>
</html>
