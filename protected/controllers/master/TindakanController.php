<?php

class TindakanController extends Controller
{
    public $layout = '//layouts/app';
    protected $srbac = 'master/tindakan';

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
        $fields = ['kode', 'nama'];

        if (isset($_GET['search']['value']) && !empty($_GET['search']['value'])) {
            $searchValue = $_GET['search']['value'];
            foreach ($fields as $field) {
                $conditions[] = 'LOWER(' . $field . ') LIKE :' . $field;
                $criteria->params[':' . $field] = '%' . strtolower($searchValue) . '%';
            }

            $criteria->addCondition(implode(' OR ', $conditions));
        }

        foreach ($fields as $field) {
            if (isset($_GET[$field]) && !empty($_GET[$field])) {
                $criteria->addCondition('LOWER(' . $field . ') LIKE :' . $field);
                $criteria->params[':' . $field] = '%' . strtolower($_GET[$field]) . '%';
            }
        }

        // Apply pagination
        $criteria->limit = $_GET['length'];
        $criteria->offset = $_GET['start'];

        // Total records
        $totalRecords = Tindakan::model()->count('deleted_at IS NULL');

        // Filtered records
        $recordsFiltered = Tindakan::model()->count($criteria);

        // Get data
        $tindakan = Tindakan::model()->findAllByAttributes(['deleted_at' => null], $criteria);

        $data = [];
        foreach ($tindakan as $t) {
            $harga = number_format($t->harga, 2, ',', '.');
            $data[] = [
                'kode' => $t->kode,
                'nama' => $t->nama,
                'harga' => $harga,
                'status' => $t->status ? 'Aktif' : 'Tidak Aktif',
                'aksi' => $this->renderPartial('//partials/_actions', [
                    'model' => $t,
                    'location' => 'master/tindakan'
                ], true),
            ];
        }

        echo CJSON::encode([
            'draw' => $_GET['draw'],
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
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
        $model = new Tindakan;

        if (isset($_POST['Tindakan'])) {
            $model->attributes = $_POST['Tindakan'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Tindakan berhasil ditambahkan.');
                $this->redirect(['index']);
            } else {
                Yii::app()->user->setFlash('error', 'Gagal menambahkan tindakan.');
            }
        }

        $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $this->requireAccess($this->srbac, 'update');
        $model = $this->loadModel($id);

        if (isset($_POST['Tindakan'])) {
            $model->attributes = $_POST['Tindakan'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Tindakan berhasil diperbarui.');
                $this->redirect(['index']);
            } else {
                Yii::app()->user->setFlash('error', 'Gagal memperbarui tindakan.');
            }
        }

        $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $this->requireAccess($this->srbac, 'delete');
        $model = $this->loadModel($id);

        $model->skipBeforeSave = true;
        $model->deleted_at = new CDbExpression('NOW()');
        $model->updated_by = Yii::app()->user->name;

        if ($model->save(false)) {
            Yii::app()->user->setFlash('success', 'Tindakan berhasil dihapus.');
        } else {
            Yii::app()->user->setFlash('error', 'Gagal menghapus tindakan.');
        }

        if (isset($_GET['ajax'])) {
            echo CJSON::encode(['status' => 'success', 'message' => 'Tindakan berhasil dihapus']);
        } else {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['index']);
        }

        Yii::app()->end();
    }

    protected function loadModel($id)
    {
        $model = Tindakan::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function actionGetHarga()
    {
        if (isset($_POST['id'])) {
            $tindakan = Tindakan::model()->findByPk($_POST['id']);
            $harga = $tindakan ? $tindakan->harga : 0;

            echo CJSON::encode(array('harga' => $harga));
        }
        Yii::app()->end();
    }
}
