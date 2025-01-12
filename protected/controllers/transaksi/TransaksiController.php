<?php

class TransaksiController extends Controller
{

    public $layout = '//layouts/app';
    protected $srbac = 'transaksi/transaksi';

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
        $fields = ['pasien_id', 'tgl_daftar', 'keterangan'];

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
        $totalRecords = PasienDaftar::model()->count('deleted_at IS NULL');

        // Filtered records count
        $recordsFiltered = PasienDaftar::model()->count($criteria);

        // Get data
        $pasienDaftar = PasienDaftar::model()->findAllByAttributes(['deleted_at' => null], $criteria);

        $data = [];
        foreach ($pasienDaftar as $p) {
            $data[] = [
                'pasien_id' => $p->pasien->nama, // Link to Pasien's name
                'tgl_daftar' => Yii::app()->dateFormatter->format('dd-MM-yyyy', $p->tgl_daftar),
                'status' => StatusDaftarEnum::getStatusLabel($p->status),
                'keterangan' => $p->keterangan,
                'aksi' => $this->renderPartial('//transaksi/transaksi/_actions', [
                    'model' => $p,
                    'location' => 'transaksi/transaksi'
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
        $pasienDaftar = PasienDaftar::model()->findByPk($id);
        if (!$pasienDaftar) {
            throw new CHttpException(404, 'Pasien tidak ditemukan.');
        }

        $listTindakan = PasienTindakan::model()->findAllByAttributes(
            ['pasien_daftar_id' => $id],
            ['order' => 'tgl_transaksi DESC']
        );

        $listObat = PasienObat::model()->findAllByAttributes(
            ['pasien_daftar_id' => $id],
            ['order' => 'tgl_transaksi DESC']
        );

        $this->render('view', [
            'pasienDaftar' => $pasienDaftar,
            'listTindakan' => $listTindakan,
            'listObat' => $listObat,
        ]);
    }

    public function actionCreateTindakan($norm)
    {
        $this->requireAccess($this->srbac, 'createTindakan');
        $model = new PasienTindakan;
        $model->jumlah = 1;
        $pasienDaftar = PasienDaftar::model()->findByPk($norm);

        if (isset($_POST['PasienTindakan'])) {
            $model->attributes = $_POST['PasienTindakan'];

            if (isset($_POST['PasienTindakan']['tgl_transaksi']) && isset($_POST['PasienTindakan']['time_transaksi'])) {
                $dateTime = $_POST['PasienTindakan']['tgl_transaksi'] . ' ' . $_POST['PasienTindakan']['time_transaksi'];
                $model->tgl_transaksi = date('Y-m-d H:i:s', strtotime($dateTime));
            }
            // $model->pegawai_id = Yii::app()->user->id;

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Tindakan pasien berhasil ditambahkan.');
                $this->redirect(['view', 'id' => $norm]);
            } else {
                $errors = $model->getErrors();
                var_dump($errors);
                Yii::app()->user->setFlash('error', 'Gagal menambahkan tindakan pasien.');
            }
        }

        $this->render('createTindakan', ['model' => $model, 'pasienDaftar' => $pasienDaftar]);
    }


    public function actionUpdateTindakan($norm, $id)
    {
        $this->requireAccess($this->srbac, 'updateTindakan');
        $model = PasienTindakan::model()->findByPk($id);
        $pasienDaftar = PasienDaftar::model()->findByPk($norm);

        if (!$model) {
            throw new CHttpException(404, 'Tindakan tidak ditemukan.');
        }

        if (isset($_POST['PasienTindakan'])) {
            $model->attributes = $_POST['PasienTindakan'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Tindakan pasien berhasil diubah.');
                $this->redirect(['view', 'id' => $model->pasien_daftar_id]);
            } else {
                Yii::app()->user->setFlash('error', 'Gagal mengubah tindakan pasien.');
            }
        }

        $this->render('updateTindakan', ['model' => $model, 'pasienDaftar' => $pasienDaftar]);
    }

    public function actionCreateObat($norm)
    {
        $this->requireAccess($this->srbac, 'createObat');
        $model = new PasienObat;
        $model->jumlah = 1;
        $pasienDaftar = PasienDaftar::model()->findByPk($norm);

        if (isset($_POST['PasienObat'])) {
            $model->attributes = $_POST['PasienObat'];

            if (isset($_POST['PasienObat']['tgl_transaksi']) && isset($_POST['PasienObat']['time_transaksi'])) {
                $dateTime = $_POST['PasienObat']['tgl_transaksi'] . ' ' . $_POST['PasienObat']['time_transaksi'];
                $model->tgl_transaksi = date('Y-m-d H:i:s', strtotime($dateTime));
            }

            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Obat pasien berhasil ditambahkan.');
                $this->redirect(['view', 'id' => $norm]);
            } else {
                $errors = $model->getErrors();
                var_dump($errors);
                Yii::app()->user->setFlash('error', 'Gagal menambahkan obat pasien.');
            }
        }

        $this->render('createObat', ['model' => $model, 'pasienDaftar' => $pasienDaftar]);
    }

    public function actionUpdateObat($norm, $id)
    {
        $this->requireAccess($this->srbac, 'updateObat');
        $model = PasienObat::model()->findByPk($id);
        $pasienDaftar = PasienDaftar::model()->findByPk($norm);

        if (!$model) {
            throw new CHttpException(404, 'Obat tidak ditemukan.');
        }

        if (isset($_POST['PasienObat'])) {
            $model->attributes = $_POST['Obat'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Obat pasien berhasil diubah.');
                $this->redirect(['view', 'id' => $model->pasien_daftar_id]);
            } else {
                $errors = $model->getErrors();
                var_dump($errors);
                Yii::app()->user->setFlash('error', 'Gagal mengubah obat pasien.');
            }
        }

        $this->render('updateObat', ['model' => $model, 'pasienDaftar' => $pasienDaftar]);
    }

    public function actionSelesai($id)
    {
        $this->requireAccess($this->srbac, 'setSelesai');
        $model = PasienDaftar::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404, 'Pasien tidak ditemukan.');
        }

        $model->status = 'selesai';
        $model->save();

        $this->redirect(['index']);
    }

    public function actionBatal($id)
    {
        $this->requireAccess($this->srbac, 'setBatal');
        $model = PasienDaftar::model()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404, 'Pasien tidak ditemukan.');
        }

        $model->status = 'batal';
        $model->save();

        $this->redirect(['index']);
    }

    public function actionPembayaran($pasien_daftar_id)
    {
        $pasienDaftar = PasienDaftar::model()->findByPk($pasien_daftar_id);

        if (!$pasienDaftar) {
            throw new CHttpException(404, 'Data pasien tidak ditemukan.');
        }

        $totalTindakan = PasienTindakan::model()->findAllByAttributes(['pasien_daftar_id' => $pasien_daftar_id]);
        $totalObat = PasienObat::model()->findAllByAttributes(['pasien_daftar_id' => $pasien_daftar_id]);

        $totalBiaya = array_sum(array_column($totalTindakan, 'harga')) +
            array_sum(array_column($totalObat, 'harga'));

        if (isset($_POST['Pembayaran'])) {
            PasienTindakan::model()->updateAll(['status_bayar' => 2], 'pasien_daftar_id=:id', [':id' => $pasien_daftar_id]);
            PasienObat::model()->updateAll(['status_bayar' => 2], 'pasien_daftar_id=:id', [':id' => $pasien_daftar_id]);

            Yii::app()->user->setFlash('success', 'Pembayaran berhasil diselesaikan.');
            $this->redirect(['index']);
        }

        $this->render('pembayaran', [
            'pasienDaftar' => $pasienDaftar,
            'totalBiaya' => $totalBiaya,
        ]);
    }

    public function actionTagihan($id)
    {
        $this->requireAccess($this->srbac, 'tagihan');
        $pasienDaftar = PasienDaftar::model()->findByPk($id);
        $pasien = $pasienDaftar->pasien;

        $tindakan = PasienTindakan::model()->findAllByAttributes(['pasien_daftar_id' => $id]);
        $obat = PasienObat::model()->findAllByAttributes(['pasien_daftar_id' => $id]);

        $total = 0;
        foreach ($tindakan as $item) {
            $total += $item->total;
        }
        foreach ($obat as $item) {
            $total += $item->total;
        }

        // Pass data to the view
        $this->render('tagihan', [
            'pasien' => $pasien,
            'pasienDaftar' => $pasienDaftar,
            'tindakan' => $tindakan,
            'obat' => $obat,
            'total' => $total,
        ]);
    }

    public function actionPrintPdf($id)
    {
        // Fetch the data
        $pasienDaftar = PasienDaftar::model()->findByPk($id);
        $pasien = $pasienDaftar->pasien;

        $tindakan = PasienTindakan::model()->findAllByAttributes(['pasien_daftar_id' => $id]);
        $obat = PasienObat::model()->findAllByAttributes(['pasien_daftar_id' => $id]);

        // Calculate the total
        $total = 0;
        foreach ($tindakan as $item) {
            $total += $item->total;
        }
        foreach ($obat as $item) {
            $total += $item->total;
        }

        try {
            $mpdf = new \Mpdf\Mpdf();

            $html = $this->renderPartial('_print', [
                'pasien' => $pasien,
                'tindakan' => $tindakan,
                'pasienDaftar' => $pasienDaftar,
                'obat' => $obat,
                'total' => $total,
            ], true);

            // Write HTML to PDF
            $mpdf->WriteHTML($html);
            $mpdf->Output('Tagihan_Pasien_' . $pasien->nama . '.pdf', 'I');  // Use 'D' for download, 'I' for inline

        } catch (\Mpdf\MpdfException $e) {
            echo "mPDF Error: " . $e->getMessage();
        }
    }
}
