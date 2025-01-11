<?php

class PegawaiController extends Controller
{
    public $layout = '//layouts/app';

    // Index action to list all Pegawai
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
        $fields = ['nama', 'nik', 'nip', 'alamat', 'telp', 'email', 'jns_kelamin', 'jabatan'];

        // Add search functionality across fields
        if (isset($_GET['search']['value']) && !empty($_GET['search']['value'])) {
            $searchValue = $_GET['search']['value'];
            foreach ($fields as $field) {
                $conditions[] = 'LOWER(' . $field . ') LIKE :' . $field;
                $criteria->params[':' . $field] = '%' . strtolower($searchValue) . '%';
            }

            $criteria->addCondition(implode(' OR ', $conditions));
        }

        // Apply additional field filters
        foreach ($fields as $field) {
            if (isset($_GET[$field]) && !empty($_GET[$field])) {
                $criteria->addCondition('LOWER(' . $field . ') LIKE :' . $field);
                $criteria->params[':' . $field] = '%' . strtolower($_GET[$field]) . '%';
            }
        }

        // Apply status filter
        if (isset($_GET['status']) && $_GET['status'] !== '') {
            $criteria->compare('status', $_GET['status']);
        }

        // Apply pagination
        $criteria->limit = $_GET['length'];
        $criteria->offset = $_GET['start'];

        // Total records count
        $totalRecords = Pegawai::model()->count('deleted_at IS NULL');

        // Filtered records count
        $recordsFiltered = Pegawai::model()->count($criteria);

        // Get data
        $pegawai = Pegawai::model()->findAllByAttributes(['deleted_at' => null], $criteria);

        $data = [];
        foreach ($pegawai as $p) {
            $data[] = [
                'nama' => $p->nama,
                'nik' => $p->nik,
                'nip' => $p->nip,
                'jns_kelamin' => $p->jns_kelamin,
                'jabatan' => $p->jabatan,
                'telp' => $p->telp,
                'alamat' => $p->alamat,
                'status' => StatusEnum::getStatusLabel($p->status),
                'aksi' => $this->renderPartial('//partials/_actions', [
                    'model' => $p,
                    'location' => 'master/pegawai'
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
        $this->render('view', array('model' => $this->loadModel($id)));
    }

    public function actionCreate()
    {
        $model = new Pegawai;

        if (isset($_POST['Pegawai'])) {
            $model->attributes = $_POST['Pegawai'];

            // Ensure status is set, default to Aktif if not set
            $model->status = isset($_POST['Pegawai']['status']) ? $_POST['Pegawai']['status'] : StatusEnum::AKTIF;

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Pegawai berhasil ditambahkan.');
                $this->redirect(['index']);
            } else {
                Yii::app()->user->setFlash('error', 'Gagal menambahkan pegawai.');
            }
        }

        $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Pegawai'])) {
            $model->attributes = $_POST['Pegawai'];
            $model->status = isset($_POST['Pegawai']['status']) ? $_POST['Pegawai']['status'] : StatusEnum::AKTIF;

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Pegawai berhasil diperbarui.');
                $this->redirect(['index']);
            } else {
                Yii::app()->user->setFlash('error', 'Gagal memperbarui pegawai.');
            }
        }

        $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        $model->skipBeforeSave = true;
        $model->deleted_at = new CDbExpression('NOW()');
        $model->updated_by = Yii::app()->user->name;

        if ($model->save(false)) {
            Yii::app()->user->setFlash('success', 'Pegawai berhasil dihapus.');
        } else {
            Yii::app()->user->setFlash('error', 'Gagal menghapus pegawai.');
        }

        if (isset($_GET['ajax'])) {
            echo CJSON::encode(['status' => 'success', 'message' => 'Pegawai berhasil dihapus']);
        } else {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['index']);
        }

        Yii::app()->end();
    }

    protected function loadModel($id)
    {
        $model = Pegawai::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
}
