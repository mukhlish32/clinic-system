<?php

class Tindakan extends CrudModel
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tindakan';
    }

    public function rules()
    {
        return [
            ['kode, nama, harga', 'required'],
            ['kode', 'length', 'max' => 255],
            ['nama', 'length', 'max' => 255],
            ['harga', 'numerical', 'integerOnly' => true, 'min' => 0, 'message' => 'Harga harus valid dan tidak boleh negatif.'],
            ['status', 'in', 'range' => [0, 1]],
            ['created_at, updated_at', 'safe'],
            ['created_by, updated_by', 'safe'],
        ];
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('kode', $this->kode, true);
        $criteria->compare('nama', $this->nama, true);
        $criteria->compare('harga', $this->harga);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
