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
                    <a class="nav-link menu-link <?php echo (Yii::app()->controller->id == 'auth' && Yii::app()->controller->action->id == 'dashboard') ? 'active' : ''; ?>" href="<?php echo Yii::app()->createUrl('auth/dashboard'); ?>">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (strpos(Yii::app()->controller->id, 'master/') === 0) ? 'active' : ''; ?>" href="#sidebarMaster" data-bs-toggle="collapse" role="button" aria-expanded="<?php echo (strpos(Yii::app()->controller->id, 'master/') === 0) ? 'true' : 'false'; ?>" aria-controls="sidebarMaster">
                        <i class="ri-apps-2-line"></i>
                        <span data-key="t-dashboards">Master</span>
                    </a>
                    <div class="collapse menu-dropdown <?php echo (strpos(Yii::app()->controller->id, 'master/') === 0) ? 'show' : ''; ?>" id="sidebarMaster">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('master/role'); ?>" class="nav-link <?php echo (Yii::app()->controller->id == 'master/role') ? 'active' : ''; ?>" data-key="t-analytics">
                                    Role
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('master/wilayah'); ?>" class="nav-link <?php echo (Yii::app()->controller->id == 'master/wilayah') ? 'active' : ''; ?>" data-key="t-crm">
                                    Wilayah
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('master/pegawai'); ?>" class="nav-link <?php echo (Yii::app()->controller->id == 'master/pegawai') ? 'active' : ''; ?>" data-key="t-ecommerce">
                                    Pegawai
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('master/user'); ?>" class="nav-link <?php echo (Yii::app()->controller->id == 'master/user') ? 'active' : ''; ?>" data-key="t-crypto">
                                    User
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('master/tindakan'); ?>" class="nav-link <?php echo (Yii::app()->controller->id == 'master/tindakan') ? 'active' : ''; ?>" data-key="t-projects">
                                    Tindakan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('master/obat'); ?>" class="nav-link <?php echo (Yii::app()->controller->id == 'master/obat') ? 'active' : ''; ?>" data-key="t-nft">
                                    Obat
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (strpos(Yii::app()->controller->id, 'transaksi/') === 0) ? 'active' : ''; ?>" href="#sidebarTransaksi" data-bs-toggle="collapse" role="button" aria-expanded="<?php echo (strpos(Yii::app()->controller->id, 'transaksi/') === 0) ? 'true' : 'false'; ?>" aria-controls="sidebarTransaksi">
                        <i class="ri-menu-2-line"></i>
                        <span data-key="t-dashboards">Transaksi</span>
                    </a>
                    <div class="collapse menu-dropdown <?php echo (strpos(Yii::app()->controller->id, 'transaksi/') === 0) ? 'show' : ''; ?>" id="sidebarTransaksi">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('transaksi/pasien'); ?>" class="nav-link <?php echo (Yii::app()->controller->id == 'transaksi/pasien') ? 'active' : ''; ?>">
                                    Pasien & Pendaftaran
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('transaksi/transaksi'); ?>" class="nav-link <?php echo (Yii::app()->controller->id == 'transaksi/transaksi') ? 'active' : ''; ?>">
                                    Tindakan & Obat
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo Yii::app()->createUrl('transaksi/laporan'); ?>" class="nav-link <?php echo (Yii::app()->controller->id == 'transaksi/laporan') ? 'active' : ''; ?>">
                                    Laporan
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