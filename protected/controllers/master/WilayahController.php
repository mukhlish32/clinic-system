<?php

class WilayahController extends Controller
{
    public $layout = '//layouts/app';
    protected $srbac = 'master/wilayah';

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
        $fields = ['kelurahan', 'kecamatan', 'kota', 'provinsi', 'kode_pos'];

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
        $totalRecords = Wilayah::model()->count('deleted_at IS NULL');

        // Filtered records
        $recordsFiltered = Wilayah::model()->count($criteria);

        // Get data
        $wilayah = Wilayah::model()->findAllByAttributes(['deleted_at' => null], $criteria);

        $data = [];
        foreach ($wilayah as $w) {
            $data[] = [
                'kelurahan' => $w->kelurahan,
                'kecamatan' => $w->kecamatan,
                'kota' => $w->kota,
                'provinsi' => $w->provinsi,
                'kode_pos' => $w->kode_pos,
                'aksi' => $this->renderPartial('//partials/_actions', [
                    'model' => $w,
                    'location' => 'master/wilayah'
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
        $model = new Wilayah;

        if (isset($_POST['Wilayah'])) {
            $model->attributes = $_POST['Wilayah'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Wilayah berhasil ditambahkan.');
                $this->redirect(['index']);
            } else {
                Yii::app()->user->setFlash('error', 'Gagal menambahkan wilayah.');
            }
        }

        $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $this->requireAccess($this->srbac, 'update');
        $model = $this->loadModel($id);

        if (isset($_POST['Wilayah'])) {
            $model->attributes = $_POST['Wilayah'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Wilayah berhasil diperbarui.');
                $this->redirect(['index']);
            } else {
                Yii::app()->user->setFlash('error', 'Gagal memperbarui wilayah.');
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
            Yii::app()->user->setFlash('success', 'Wilayah berhasil dihapus.');
        } else {
            Yii::app()->user->setFlash('error', 'Gagal menghapus wilayah.');
        }

        if (isset($_GET['ajax'])) {
            echo CJSON::encode(['status' => 'success', 'message' => 'Wilayah berhasil dihapus']);
        } else {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['index']);
        }

        Yii::app()->end();
    }

    protected function loadModel($id)
    {
        $model = Wilayah::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function actionGetKotaByProvinsi()
    {
        if (isset($_POST['provinsi'])) {
            $kotaList = Wilayah::model()->getKotaByProvinsi($_POST['provinsi']);
            echo CHtml::tag('option', array('value' => ''), '- Pilih Kota/Kabupaten -', true);
            foreach ($kotaList as $kota) {
                echo CHtml::tag('option', array('value' => $kota), CHtml::encode($kota), true);
            }
        }
    }

    public function actionGetKecamatanByKota()
    {
        if (isset($_POST['kota'])) {
            $kecamatanList = Wilayah::model()->getKecamatanByKota($_POST['kota']);
            echo CHtml::tag('option', array('value' => ''), '- Pilih Kecamatan -', true);
            foreach ($kecamatanList as $kecamatan) {
                echo CHtml::tag('option', array('value' => $kecamatan), CHtml::encode($kecamatan), true);
            }
        }
    }

    public function actionGetKelurahanByKecamatan()
    {
        if (isset($_POST['kecamatan'])) {
            $kelurahanList = Wilayah::model()->getKelurahanByKecamatan($_POST['kecamatan']);
            echo CHtml::tag('option', array('value' => ''), '- Pilih Kelurahan -', true);
            foreach ($kelurahanList as $kelurahan) {
                echo CHtml::tag('option', array('value' => $kelurahan), CHtml::encode($kelurahan), true);
            }
        }
    }

    public function actionGetKodePosByWilayah()
    {
        if (isset($_POST['provinsi']) && isset($_POST['kota']) && isset($_POST['kecamatan']) && isset($_POST['kelurahan'])) {
            $kodePos = Wilayah::model()->getKodePosByWilayah($_POST['provinsi'], $_POST['kota'], $_POST['kecamatan'], $_POST['kelurahan']);
            echo json_encode(['kode_pos' => $kodePos]);
        }
    }
}
