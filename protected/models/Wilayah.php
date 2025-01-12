<?php

class Wilayah extends CrudModel
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'wilayah';
    }

    public function rules()
    {
        return [
            ['kelurahan, kecamatan, kota, provinsi, kode_pos', 'required'],
            ['kelurahan, kecamatan, kota, provinsi', 'length', 'max' => 255],
            ['kode_pos', 'length', 'max' => 5],
            ['kode_pos', 'numerical', 'integerOnly' => true],
            ['created_at, updated_at, deleted_at', 'safe'],
            ['created_by, updated_by', 'length', 'max' => 255],
        ];
    }


    public function getKotaByProvinsi($provinsi)
    {
        return CHtml::listData(Wilayah::model()->findAllByAttributes(['provinsi' => $provinsi]), 'kota', 'kota');
    }

    public function getKecamatanByKota($kota)
    {
        return CHtml::listData(Wilayah::model()->findAllByAttributes(['kota' => $kota]), 'kecamatan', 'kecamatan');
    }

    public function getKelurahanByKecamatan($kecamatan)
    {
        return CHtml::listData(Wilayah::model()->findAllByAttributes(['kecamatan' => $kecamatan]), 'kelurahan', 'kelurahan');
    }

    public function getKodePosByWilayah($provinsi, $kota, $kecamatan, $kelurahan)
    {
        $wilayah = Wilayah::model()->findByAttributes([
            'provinsi' => $provinsi,
            'kota' => $kota,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan
        ]);
        return $wilayah ? $wilayah->kode_pos : null;
    }
}
