<?php
if (!Yii::app()->user->isGuest) {
    $pegawai = Yii::app()->user->getState('pegawai');
}
?>

<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
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
                </div>

                <button type="button"
                    class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <!-- User Name -->
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                    <?php echo $pegawai->nama ?? 'name'; ?>
                                </span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- Profile -->
                        <!-- <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('profile/view'); ?>">
                            <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle">Profil</span>
                        </a> -->
                        <!-- Change Password -->
                        <!-- <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('profile/editPassword'); ?>">
                            <i class="mdi mdi-key text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle" data-key="t-logout">Ubah Password</span>
                        </a> -->
                        <!-- Logout -->
                        <form action="<?php echo Yii::app()->createUrl('auth/logout'); ?>" method="POST">
                            <button type="submit" class="dropdown-item">
                                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle" data-key="t-logout">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>