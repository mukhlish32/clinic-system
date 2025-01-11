<?php

class RoleController extends Controller
{
    public $layout = '//layouts/app';
    public function actionIndex()
    {
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
                'aksi' => $this->renderPartial('//partials/actions', [
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
        $this->render('view', array('model' => $this->loadModel($id)));
    }

    public function actionCreate()
    {
        $model = new Role;

        if (isset($_POST['Role'])) {
            $model->attributes = $_POST['Role'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Role'])) {
            $model->attributes = $_POST['Role'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        $model->skipBeforeSave = true;

        $model->deleted_at = new CDbExpression('NOW()');
        $model->updated_by = Yii::app()->user->name;
        $model->save(false);

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
}
