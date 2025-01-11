<?php

class Role extends CrudModel
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'role';
    }

    public function rules()
    {
        return array(
            array('nama', 'required'),
            array('keterangan', 'safe'),
        );
    }
}
