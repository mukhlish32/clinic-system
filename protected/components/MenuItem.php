<?php

class MenuItem extends CApplicationComponent
{
    private function hasPermission($controller, $permissions)
    {
        if ($controller === 'auth') {
            return true;
        }

        foreach ($permissions as $permission) {
            $menuPart = strpos($controller, '/') === false ?
                explode('/', $permission->menu)[0] : $permission->menu;

            if ($menuPart === $controller) {
                return true;
            }
        }
        return false;
    }

    public function getMenuAccess()
    {
        $menuItems = Yii::app()->menu->getMenuItems();
        $userRole = Yii::app()->user->role;
        $permissions = Permission::model()->findAllByAttributes(['role_id' => $userRole]);

        $filteredMenuItems = [];
        foreach ($menuItems as $item) {
            $hasPermission = $this->hasPermission($item['controller'], $permissions);
            if ($hasPermission) {
                if (isset($item['subMenu'])) {
                    $filteredSubMenu = [];
                    foreach ($item['subMenu'] as $subItem) {
                        $hasSubPermission = $this->hasPermission($subItem['controller'], $permissions);
                        if ($hasSubPermission) {
                            $filteredSubMenu[] = $subItem;
                        }
                    }
                    $item['subMenu'] = $filteredSubMenu;
                }

                $filteredMenuItems[] = $item;
            }
        }

        return $filteredMenuItems;
    }

    public static function getMenuItems()
    {
        return [
            [
                'label' => 'Dashboard',
                'icon' => 'ri-dashboard-2-line',
                'url' => Yii::app()->createUrl('auth/dashboard'),
                'controller' => 'auth',
                'action' => 'dashboard',
            ],
            [
                'label' => 'Master',
                'icon' => 'ri-apps-2-line',
                'url' => '#sidebarMaster',
                'controller' => 'master',
                'subMenu' => [
                    [
                        'label' => 'Role',
                        'url' => Yii::app()->createUrl('master/role'),
                        'controller' => 'master/role',
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'permission']
                    ],
                    [
                        'label' => 'Wilayah',
                        'url' => Yii::app()->createUrl('master/wilayah'),
                        'controller' => 'master/wilayah',
                        'actions' => ['index', 'view', 'create', 'update', 'delete']
                    ],
                    [
                        'label' => 'Pegawai',
                        'url' => Yii::app()->createUrl('master/pegawai'),
                        'controller' => 'master/pegawai',
                        'actions' => ['index', 'view', 'create', 'update', 'delete']
                    ],
                    [
                        'label' => 'User',
                        'url' => Yii::app()->createUrl('master/user'),
                        'controller' => 'master/user',
                        'actions' => ['index', 'view', 'create', 'update', 'delete']
                    ],
                    [
                        'label' => 'Tindakan',
                        'url' => Yii::app()->createUrl('master/tindakan'),
                        'controller' => 'master/tindakan',
                        'actions' => ['index', 'view', 'create', 'update', 'delete']
                    ],
                    [
                        'label' => 'Obat',
                        'url' => Yii::app()->createUrl('master/obat'),
                        'controller' => 'master/obat',
                        'actions' => ['index', 'view', 'create', 'update', 'delete']
                    ]
                ]
            ],
            [
                'label' => 'Transaksi',
                'icon' => 'ri-menu-2-line',
                'url' => '#sidebarTransaksi',
                'controller' => 'transaksi',
                'subMenu' => [
                    [
                        'label' => 'Pasien & Pendaftaran',
                        'url' => Yii::app()->createUrl('transaksi/pasien'),
                        'controller' => 'transaksi/pasien',
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'register']
                    ],
                    [
                        'label' => 'Tindakan & Obat',
                        'url' => Yii::app()->createUrl('transaksi/transaksi'),
                        'controller' => 'transaksi/transaksi',
                        'actions' => ['index','view','createTindakan','updateTindakan','createObat','updateObat','setSelesai','setBatal','tagihan']
                    ],
                    [
                        'label' => 'Laporan',
                        'url' => Yii::app()->createUrl('transaksi/laporan'),
                        'controller' => 'transaksi/laporan',
                        'actions' => ['index']
                    ]
                ]
            ]
        ];
    }
}
