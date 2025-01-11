<?php

class Pegawai extends CrudModel
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'pegawai';
    }

    public function rules()
    {
        return [
            ['nama, email', 'required'],
            ['email', 'email'],
            ['telp', 'length', 'max' => 15],
            ['kode_pos', 'length', 'max' => 5],
            ['user_id', 'numerical', 'integerOnly' => true],
            ['created_at, updated_at, deleted_at', 'safe'],
            ['nama, nik, nip, alamat, telp, email, jns_kelamin, tgl_lahir, jabatan, kelurahan, kecamatan, kota, provinsi, kode_pos, status, created_by, updated_by', 'safe'],
            ['id', 'safe', 'on' => 'search'],
        ];
    }

    public function relations()
    {
        return [
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'nik' => 'No. NIK',
            'nip' => 'No. NIP',
            'alamat' => 'Alamat',
            'telp' => 'Telepon',
            'email' => 'Email',
            'jns_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jabatan' => 'Jabatan',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'kota' => 'Kota',
            'provinsi' => 'Provinsi',
            'kode_pos' => 'Kode Pos',
            'status' => 'Status',
            'created_by' => 'Dibuat Oleh',
            'updated_by' => 'Diperbarui Oleh',
        ];
    }

    public function getStatus()
    {
        if ($this->user_id === null || $this->status == 0 || $this->deleted_at !== null) {
            return 0;
        }
        return 1;
    }
}
