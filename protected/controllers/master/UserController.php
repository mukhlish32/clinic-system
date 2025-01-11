<?php

class UserController extends Controller
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
        $fields = ['username', 'email']; // Excluding 'role_id' and 'pegawai_id' here

        // Search functionality
        if (isset($_GET['search']['value']) && !empty($_GET['search']['value'])) {
            $searchValue = $_GET['search']['value'];
            foreach ($fields as $field) {
                $conditions[] = 'LOWER(' . $field . ') LIKE :' . $field;
                $criteria->params[':' . $field] = '%' . strtolower($searchValue) . '%';
            }
            $criteria->addCondition(implode(' OR ', $conditions));
        }

        // Field-specific filters
        foreach ($fields as $field) {
            if (isset($_GET[$field]) && !empty($_GET[$field])) {
                $criteria->addCondition('LOWER(' . $field . ') LIKE :' . $field);
                $criteria->params[':' . $field] = '%' . strtolower($_GET[$field]) . '%';
            }
        }

        // Role-specific filter (filtering based on 'role.nama')
        if (isset($_GET['role']) && !empty($_GET['role'])) {
            $criteria->join = 'JOIN role r ON t.role_id = r.id'; // Join with the role table
            $criteria->addCondition('LOWER(r.nama) LIKE :role');
            $criteria->params[':role'] = '%' . strtolower($_GET['role']) . '%';
        }

        // Pegawai-specific filter (filtering based on 'pegawai.nama')
        if (isset($_GET['pegawai']) && !empty($_GET['pegawai'])) {
            // Join with the pegawai table
            $criteria->join .= ' LEFT JOIN pegawai p ON t.id = p.user_id';
            $criteria->addCondition('LOWER(p.nama) LIKE :pegawai');
            $criteria->params[':pegawai'] = '%' . strtolower($_GET['pegawai']) . '%';
        }

        // Pagination
        $criteria->limit = $_GET['length'];
        $criteria->offset = $_GET['start'];

        // Total records
        $totalRecords = User::model()->count();

        // Filtered records
        $recordsFiltered = User::model()->count($criteria);

        // Get data
        $users = User::model()->findAll($criteria);

        $data = [];
        foreach ($users as $user) {
            $pegawai = $user->pegawai;
            $status = $pegawai ? $pegawai->getStatus() : 'Tidak Aktif';

            $data[] = [
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role ? $user->role->nama : '-',
                'pegawai' => $pegawai ? $pegawai->nama : '-',
                'status' => StatusEnum::getStatusLabel($status),
                'aksi' => $this->renderPartial('//partials/_actions', [
                    'model' => $user,
                    'location' => 'master/user'
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
        $model = new User;

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

            if ($model->password !== $model->confirm_password) {
                Yii::app()->user->setFlash('error', 'Password and Confirm Password must match.');
                $this->render('create', ['model' => $model]);
                return;
            }

            // Check if a pegawai is selected
            if (isset($_POST['pegawai_id'])) {
                $pegawai = Pegawai::model()->findByPk($_POST['pegawai_id']);
                if ($pegawai) {
                    if ($model->save()) {
                        $pegawai->user_id = $model->id;
                        $pegawai->save();

                        Yii::app()->user->setFlash('success', 'User berhasil ditambahkan.');
                        $this->redirect(['index']);
                    } else {
                        Yii::app()->user->setFlash('error', 'Gagal menambahkan user.');
                    }
                }
            } else {
                Yii::app()->user->setFlash('error', 'Please select a pegawai.');
            }
        }

        $this->render('create', ['model' => $model]);
    }


    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

            // Avoid overwriting the password with an empty value
            if (empty($model->password)) {
                unset($model->password);
            }

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'User berhasil diperbarui.');
                $this->redirect(['index']);
            } else {
                Yii::app()->user->setFlash('error', 'Gagal memperbarui user.');
            }
        }

        $this->render('update', ['model' => $model]);
    }


    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        if ($model->delete()) {
            Yii::app()->user->setFlash('success', 'User berhasil dihapus.');
        } else {
            Yii::app()->user->setFlash('error', 'Gagal menghapus user.');
        }

        if (isset($_GET['ajax'])) {
            echo CJSON::encode(['status' => 'success', 'message' => 'User berhasil dihapus']);
        } else {
            $this->redirect(['index']);
        }

        Yii::app()->end();
    }

    protected function loadModel($id)
    {
        $model = User::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
}
