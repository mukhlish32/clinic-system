<?php

class LaporanController extends Controller
{
    public $layout = '//layouts/app';
    protected $srbac = 'transaksi/laporan';

    public function actionIndex()
    {
        $this->requireAccess($this->srbac, 'index');
        // Default values for date range and gender
        $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
        $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');
        $gender = isset($_GET['gender']) ? $_GET['gender'] : 'all';
        $timeScale = isset($_GET['timescale']) ? $_GET['timescale'] : 'daily';

        // Base query to count patient registrations
        $query = Yii::app()->db->createCommand()
            ->select('DATE(tgl_daftar) as date, COUNT(*) as patient_count')
            ->from('pasien_daftar')
            ->where('tgl_daftar BETWEEN :startDate AND :endDate', [
                ':startDate' => $startDate,
                ':endDate' => $endDate
            ]);

        // Apply gender filter
        if ($gender !== 'all') {
            $query->join('pasien', 'pasien.id = pasien_daftar.pasien_id AND pasien.jns_kelamin = :gender', [':gender' => $gender]);
        }

        // Group data by the selected time scale (daily, weekly, monthly)
        switch ($timeScale) {
            case 'weekly':
                $query->select('DATE_TRUNC(\'week\', tgl_daftar) as date, COUNT(*) as patient_count');
                break;
            case 'monthly':
                $query->select('DATE_TRUNC(\'month\', tgl_daftar) as date, COUNT(*) as patient_count');
                break;
            default: // Daily
                $query->select('DATE(tgl_daftar) as date, COUNT(*) as patient_count');
                break;
        }

        $query->group('date');
        $data = $query->queryAll();

        // Prepare data for the graph
        $dates = [];
        $counts = [];
        foreach ($data as $row) {
            $dates[] = $row['date'];
            $counts[] = (int)$row['patient_count'];
        }

        // Pass data to the view
        $this->render('index', [
            'dates' => $dates,
            'counts' => $counts,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'gender' => $gender,
            'timeScale' => $timeScale,
        ]);
    }
}
