<?php

class ObatController extends Controller
{
    public $layout = '//layouts/app';
    protected $srbac = 'master/obat';

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

        $criteria->limit = $_GET['length'];
        $criteria->offset = $_GET['start'];

        $totalRecords = Obat::model()->count('deleted_at IS NULL');
        $recordsFiltered = Obat::model()->count($criteria);
        $obat = Obat::model()->findAllByAttributes(['deleted_at' => null], $criteria);

        $data = [];
        foreach ($obat as $o) {
            $harga = number_format($o->harga, 2, ',', '.');
            $stok = number_format($o->stok, 0, ',', '.');
            $data[] = [
                'kode' => $o->kode,
                'nama' => $o->nama,
                'harga' => $harga,
                'stok' => $stok,
                'status' => $o->status ? 'Aktif' : 'Tidak Aktif',
                'aksi' => $this->renderPartial('//partials/_actions', [
                    'model' => $o,
                    'location' => 'master/obat'
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
        $model = new Obat;

        if (isset($_POST['Obat'])) {
            $model->attributes = $_POST['Obat'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Obat berhasil ditambahkan.');
                $this->redirect(['index']);
            } else {
                Yii::app()->user->setFlash('error', 'Gagal menambahkan obat.');
            }
        }

        $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $this->requireAccess($this->srbac, 'update');
        $model = $this->loadModel($id);

        if (isset($_POST['Obat'])) {
            $model->attributes = $_POST['Obat'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Obat berhasil diperbarui.');
                $this->redirect(['index']);
            } else {
                Yii::app()->user->setFlash('error', 'Gagal memperbarui obat.');
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
            Yii::app()->user->setFlash('success', 'Obat berhasil dihapus.');
        } else {
            Yii::app()->user->setFlash('error', 'Gagal menghapus obat.');
        }

        if (isset($_GET['ajax'])) {
            echo CJSON::encode(['status' => 'success', 'message' => 'Obat berhasil dihapus']);
        } else {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['index']);
        }

        Yii::app()->end();
    }

    protected function loadModel($id)
    {
        $model = Obat::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function actionGetHargaStok()
    {
        if (isset($_POST['id'])) {
            $obat = Obat::model()->findByPk($_POST['id']);
            if ($obat) {
                echo json_encode([
                    'harga' => $obat->harga,
                    'stok' => $obat->stok,
                ]);
            } else {
                echo json_encode([
                    'error' => 'Obat not found',
                ]);
            }
        }
        Yii::app()->end();
    }
}
