<?php

class Pasien extends CrudModel
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'pasien';
    }

    public function rules()
    {
        return [
            ['nama, nik, no_bpjs, jns_kelamin, telp, alamat', 'required'],
            ['status', 'numerical', 'integerOnly' => true],
            ['nama, telp', 'length', 'max' => 100],
            ['nik', 'length', 'max' => 16],
            ['no_bpjs', 'length', 'max' => 13],
            ['jns_kelamin', 'in', 'range' => ['L', 'P']],
            ['id, nama, nik, no_bpjs, email, no_telp, jns_kelamin, tgl_lahir, kelurahan, kecamatan, kota, provinsi, kode_pos, status, created_by, updated_by', 'safe'],
        ];
    }

    public function relations()
    {
        return [];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'nik' => 'NIK',
            'no_bpjs' => 'No. BPJS',
            'jns_kelamin' => 'Jenis Kelamin',
            'telp' => 'Telepon',
            'alamat' => 'Alamat',
            'status' => 'Status',
        ];
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nama', $this->nama, true);
        $criteria->compare('nik', $this->nik, true);
        $criteria->compare('no_bpjs', $this->no_bpjs, true);
        $criteria->compare('jns_kelamin', $this->jns_kelamin);
        $criteria->compare('telp', $this->telp, true);
        $criteria->compare('alamat', $this->alamat, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }
}
