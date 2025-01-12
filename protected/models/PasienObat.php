<?php

class PasienObat extends CrudModel
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'pasien_obat';
    }

    public function rules()
    {
        return [
            ['pasien_daftar_id, obat_id, pegawai_id, harga, jumlah, total, tgl_transaksi', 'required'],
            ['pasien_daftar_id, obat_id, pegawai_id, jumlah, status_bayar', 'numerical', 'integerOnly' => true],
            ['harga, total', 'numerical'],
            ['created_at, updated_at, deleted_at', 'safe'],
            ['created_by, updated_by', 'length', 'max' => 255],
        ];
    }

    public function relations()
    {
        return [
            'pasienDaftar' => [self::BELONGS_TO, 'PasienDaftar', 'pasien_daftar_id'],
            'obat' => [self::BELONGS_TO, 'Obat', 'obat_id'],
            'pegawai' => [self::BELONGS_TO, 'Pegawai', 'pegawai_id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pasien_daftar_id' => 'No. Registrasi',
            'obat_id' => 'Obat',
            'pegawai_id' => 'Pegawai',
            'harga' => 'Harga',
            'jumlah' => 'Jumlah',
            'total' => 'Total',
            'tgl_transaksi' => 'Tanggal Transaksi',
            'status_bayar' => 'Status Bayar',
        ];
    }
}
