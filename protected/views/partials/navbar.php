<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?php echo Yii::app()->createUrl('site/index'); ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo Yii::app()->baseUrl; ?>/images/logo/logo-color-notext.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo Yii::app()->baseUrl; ?>/images/logo/logo-horizontal.png" alt="" height="25">
            </span>
        </a>

        <a href="<?php echo Yii::app()->createUrl('site/index'); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo Yii::app()->baseUrl; ?>/images/logo/logo-white.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo Yii::app()->baseUrl; ?>/images/logo/logo-horizontal-white.png" alt="" height="25">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    <div id="scrollbar">
        <div class="container-fluid" style="max-width: 100%;">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="<?php echo Yii::app()->createUrl('dashboard/index'); ?>">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMaster" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarMaster">
                        <i class="ri-apps-2-line"></i>
                        <span data-key="t-dashboards">Master</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMaster">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('master/role'); ?>" class="nav-link" data-key="t-analytics">
                                    Role
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('dashboard/crm'); ?>" class="nav-link" data-key="t-crm">
                                    Wilayah
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('dashboard/ecommerce'); ?>" class="nav-link" data-key="t-ecommerce">
                                    Pegawai
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('dashboard/crypto'); ?>" class="nav-link" data-key="t-crypto">
                                    User
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('dashboard/projects'); ?>" class="nav-link" data-key="t-projects">
                                    Tindakan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('dashboard/nft'); ?>" class="nav-link" data-key="t-nft">
                                    Obat
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>