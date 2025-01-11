<?php

class Obat extends CrudModel
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'obat';
    }

    public function rules()
    {
        return [
            ['kode, nama, harga, stok', 'required'],
            ['kode, nama', 'length', 'max' => 255],
            ['harga', 'numerical', 'integerOnly' => true, 'min' => 0, 'message' => 'Harga harus valid dan tidak boleh negatif.'],
            ['stok', 'numerical', 'integerOnly' => true],
            ['status', 'in', 'range' => [0, 1]],
            ['created_at, updated_at, deleted_at, created_by, updated_by', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'nama' => 'Nama',
            'harga' => 'Harga',
            'stok' => 'Stok',
            'status' => 'Status',
        ];
    }
}
