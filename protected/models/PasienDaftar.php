<?php

class PasienDaftar extends CrudModel
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'pasien_daftar';
    }

    public function rules()
    {
        return [
            ['pasien_id, tgl_daftar, status', 'required'],
            ['keterangan, created_by, updated_by', 'safe'],
            ['pasien_id', 'numerical', 'integerOnly' => true],
            ['status', 'in', 'range' => [0, 1, 2]], // Valid values: 0 (batal), 1 (proses), 2 (selesai)
            ['created_at, updated_at, deleted_at', 'safe'],
        ];
    }

    public function relations()
    {
        return [
            'pasien' => [self::BELONGS_TO, 'Pasien', 'pasien_id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pasien_id' => 'Pasien ID',
            'tgl_daftar' => 'Tanggal Daftar',
            'keterangan' => 'Keterangan',
            'status' => 'Status',
            'created_at' => 'Tgl. Dibuat',
            'updated_at' => 'Tgl. Diubah',
            'deleted_at' => 'Tgl. Dihapus',
            'created_by' => 'Dibuat Oleh',
            'updated_by' => 'Diubah Oleh',
        ];
    }
}
