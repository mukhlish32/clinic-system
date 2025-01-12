<?php

class PasienController extends Controller
{
    public $layout = '//layouts/app';

    // Index action to list all Pasien
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
        $fields = ['nama', 'nik', 'no_bpjs', 'alamat', 'telp', 'email', 'jns_kelamin', 'tgl_lahir', 'status'];

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
        $totalRecords = Pasien::model()->count('deleted_at IS NULL');

        // Filtered records count
        $recordsFiltered = Pasien::model()->count($criteria);

        // Get data
        $pasiens = Pasien::model()->findAllByAttributes(['deleted_at' => null], $criteria);

        $data = [];
        foreach ($pasiens as $p) {
            $data[] = [
                'nama' => $p->nama,
                'nik' => $p->nik,
                'no_bpjs' => $p->no_bpjs,
                'tgl_lahir' => Yii::app()->dateFormatter->format('dd-MM-yyyy', $p->tgl_lahir),
                'jns_kelamin' => $p->jns_kelamin,
                'telp' => $p->telp,
                'alamat' => $p->alamat,
                'status' => StatusEnum::getStatusLabel($p->status),
                'aksi' => $this->renderPartial('//transaksi/pasien/_actions', [
                    'model' => $p,
                    'location' => 'transaksi/pasien'
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
        $model = new Pasien;

        if (isset($_POST['Pasien'])) {
            $model->attributes = $_POST['Pasien'];

            // Ensure status is set, default to Aktif if not set
            $model->status = isset($_POST['Pasien']['status']) ? $_POST['Pasien']['status'] : StatusEnum::AKTIF;

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Pasien berhasil ditambahkan.');
                $this->redirect(['index']);
            } else {
                Yii::app()->user->setFlash('error', 'Gagal menambahkan pasien.');
            }
        }

        $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Pasien'])) {
            $model->attributes = $_POST['Pasien'];
            $model->status = isset($_POST['Pasien']['status']) ? $_POST['Pasien']['status'] : StatusEnum::AKTIF;

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Pasien berhasil diperbarui.');
                $this->redirect(['index']);
            } else {
                Yii::app()->user->setFlash('error', 'Gagal memperbarui pasien.');
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
            Yii::app()->user->setFlash('success', 'Pasien berhasil dihapus.');
        } else {
            Yii::app()->user->setFlash('error', 'Gagal menghapus pasien.');
        }

        if (isset($_GET['ajax'])) {
            echo CJSON::encode(['status' => 'success', 'message' => 'Pasien berhasil dihapus']);
        } else {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['index']);
        }

        Yii::app()->end();
    }

    protected function loadModel($id)
    {
        $model = Pasien::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function actionDaftar($id)
    {
        $model = new PasienDaftar();
        $pasien = Pasien::model()->findByPk($id);

        if (isset($_POST['PasienDaftar'])) {
            $model->attributes = $_POST['PasienDaftar'];
            $model->pasien_id = $id;

            if (isset($_POST['PasienDaftar']['tgl_daftar']) && isset($_POST['PasienDaftar']['time_daftar'])) {
                $dateTime = $_POST['PasienDaftar']['tgl_daftar'] . ' ' . $_POST['PasienDaftar']['time_daftar'];
                $model->tgl_daftar = date('Y-m-d H:i:s', strtotime($dateTime));
            }

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Pendaftaran pasien berhasil. Silahkan masuk ke menu Transaksi Tindakan & Obat untuk melanjutkan proses pemeriksaan.');
                $this->redirect(['index']);
            } else {
                Yii::app()->user->setFlash('error', 'Gagal melakukan pendaftaran pasien.');
            }
        }

        // Pass the pasien name to the view
        $this->render('daftar', ['model' => $model, 'pasienId' => $id, 'pasien' => $pasien]);
    }
}
