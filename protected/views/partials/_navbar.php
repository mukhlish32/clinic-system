<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
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
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <?php

                // $menuItems = Yii::app()->menu->getMenuItems();
                $menuItems = Yii::app()->menu->getMenuAccess();

                foreach ($menuItems as $item): ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo (Yii::app()->controller->id == $item['controller'] && Yii::app()->controller->action->id == $item['action']) ? 'active' : ''; ?>" href="<?php echo $item['url']; ?>"
                            <?php echo isset($item['subMenu']) ? 'data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMaster"' : ''; ?>>
                            <i class="<?php echo $item['icon']; ?>"></i>
                            <span data-key="t-dashboards"><?php echo $item['label']; ?></span>
                        </a>

                        <?php if (isset($item['subMenu'])): ?>
                            <div class="collapse menu-dropdown <?php echo (strpos(Yii::app()->controller->id, $item['controller']) === 0) ? 'show' : ''; ?>" id="sidebar<?php echo ucfirst($item['controller']); ?>">
                                <ul class="nav nav-sm flex-column">
                                    <?php foreach ($item['subMenu'] as $subItem): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo $subItem['url']; ?>" class="nav-link <?php echo (Yii::app()->controller->id == $subItem['controller']) ? 'active' : ''; ?>">
                                                <?php echo $subItem['label']; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>