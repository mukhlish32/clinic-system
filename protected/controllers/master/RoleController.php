<?php

class RoleController extends Controller
{
    public $layout = '//layouts/app';
    protected $srbac = 'master/role';

    public function actionIndex()
    {
        $this->requireAccess($this->srbac, 'index');
        if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
            $this->fetchAjax();
        }

        $this->render('index');
    }

    private function fetchAjax()
    {
        $criteria = new CDbCriteria;

        if (isset($_GET['search']['value']) && !empty($_GET['search']['value'])) {
            $searchValue = $_GET['search']['value'];
            $criteria->addCondition('LOWER(nama) LIKE :searchValue OR LOWER(keterangan) LIKE :searchValue');
            $criteria->params = array(':searchValue' => '%' . strtolower($searchValue) . '%');
        }

        // Apply pagination
        $criteria->limit = $_GET['length'];  // Number of records per page
        $criteria->offset = $_GET['start'];  // Starting record for this page

        // Get total record count for pagination
        $criteriaForCount = new CDbCriteria;
        $criteriaForCount->addCondition('deleted_at IS NULL');
        $totalRecords = Role::model()->count($criteriaForCount);

        // Get the data for the current page
        $roles = Role::model()->findAllByAttributes(['deleted_at' => null], $criteria);
        $data = [];
        foreach ($roles as $role) {
            $data[] = [
                'nama' => $role->nama,
                'keterangan' => $role->keterangan,
                'aksi' => $this->renderPartial('_actions', [
                    'model' => $role,
                    'location' => 'master/role'
                ], true),
            ];
        }

        echo CJSON::encode([
            'draw' => $_GET['draw'],
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ]);
        Yii::app()->end();
    }

    public function actionView($id)
    {
        $this->requireAccess($this->srbac, 'view');
        $this->render('view', array('model' => $this->loadModel($id)));
    }

    public function actionCreate()
    {
        $this->requireAccess($this->srbac, 'create');
        $model = new Role;

        if (isset($_POST['Role'])) {
            $model->attributes = $_POST['Role'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Role berhasil ditambahkan.');
                $this->redirect(array('index'));
            } else {
                Yii::app()->user->setFlash('error', 'Gagal menambahkan role.');
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $this->requireAccess($this->srbac, 'update');
        $model = $this->loadModel($id);

        if (isset($_POST['Role'])) {
            $model->attributes = $_POST['Role'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Role ' . $model->nama . ' berhasil diperbarui.');
                $this->redirect(array('index'));
            } else {
                Yii::app()->user->setFlash('error', 'Gagal memperbarui role.');
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionDelete($id)
    {
        $this->requireAccess($this->srbac, 'delete');
        $model = $this->loadModel($id);

        $model->skipBeforeSave = true;

        $model->deleted_at = new CDbExpression('NOW()');
        $model->updated_by = Yii::app()->user->name;
        if ($model->save(false)) {
            Yii::app()->user->setFlash('success', 'Role ' . $model->nama . '  berhasil dihapus.');
        } else {
            Yii::app()->user->setFlash('error', 'Gagal menghapus role.');
        }

        if (isset($_GET['ajax'])) {
            echo CJSON::encode(['status' => 'success', 'message' => 'Role berhasil dihapus']);
        } else {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['index']);
        }

        Yii::app()->end();
    }

    protected function loadModel($id)
    {
        $model = Role::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function actionPermissions($id)
    {
        $this->requireAccess($this->srbac, 'permission');
        $model = $this->loadModel($id);
        $permissions = MenuItem::getMenuItems();
        $existingPermissions = Permission::model()->findAllByAttributes(['role_id' => $id]);

        $existingPermissionsArr = [];
        foreach ($existingPermissions as $permission) {
            $existingPermissionsArr[$permission->menu] = explode(',', $permission->actions);
        }

        if (isset($_POST['permissions'])) {
            $this->savePermissions($id, $_POST['permissions']);
            Yii::app()->user->setFlash('success', 'Hak akses berhasil diubah.');
            $this->redirect(['index']);
        }

        $this->render('permissions', [
            'model' => $model,
            'permissions' => $permissions,
            'existingPermissions' => $existingPermissionsArr,
        ]);
    }

    protected function savePermissions($roleId, $permissions)
    {
        Permission::model()->deleteAllByAttributes(['role_id' => $roleId]);
        foreach ($permissions as $menu => $actions) {
            $permission = new Permission();
            $permission->role_id = $roleId;
            $permission->menu = $menu;
            $permission->actions = implode(',', $actions);
            $permission->save();
        }
    }
}
