<?php

class PasienTindakan extends CrudModel
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'pasien_tindakan';
    }

    public function rules()
    {
        return [
            ['pasien_daftar_id, tindakan_id, pegawai_id, harga, jumlah, total, tgl_transaksi', 'required'],
            ['pasien_daftar_id, tindakan_id, pegawai_id, status_bayar', 'numerical', 'integerOnly' => true],
            ['harga, total', 'numerical'],
            ['created_at, updated_at', 'safe'],
        ];
    }

    public function relations()
    {
        return [
            'pasienDaftar' => [self::BELONGS_TO, 'PasienDaftar', 'pasien_daftar_id'],
            'tindakan' => [self::BELONGS_TO, 'Tindakan', 'tindakan_id'],
            'pegawai' => [self::BELONGS_TO, 'Pegawai', 'pegawai_id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pasien_daftar_id' => 'No. Registrasi',
            'tindakan_id' => 'Tindakan',
            'pegawai_id' => 'Pegawai',
            'harga' => 'Harga',
            'jumlah' => 'Jumlah',
            'total' => 'Total',
            'tgl_transaksi' => 'Tanggal Transaksi',
            'status_bayar' => 'Status Bayar',
        ];
    }

    public static function getSumPasien($id)
    {
        return Yii::app()->db->createCommand()
            ->select('SUM(harga)')
            ->from('pasien_tindakan')
            ->where('pasien_daftar_id = :id', [':id' => $id])
            ->queryScalar();
    }
}
