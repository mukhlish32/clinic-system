<?php
/* @var $this Controller */
$this->pageTitle = Yii::app()->name . ' - Dashboard';
?>

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Dashboard</h4>

                <?php /*
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Projects</li>
                    </ol>
                </div>
                */ ?>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row project-wrapper">
        <!-- Add project content or widgets here -->
    </div>

</div>

<?php
// Registering external scripts
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl . '/assets/velzon/libs/apexcharts/apexcharts.min.js',
    CClientScript::POS_END
);

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl . '/assets/velzon/js/pages/dashboard-projects.init.js',
    CClientScript::POS_END
);
?>
