<?php

class Permission extends CrudModel
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'permission';
    }

    public function rules()
    {
        return array(
            array('role_id, menu, actions', 'required'),
            array('actions', 'safe'),
        );
    }

    // Define relation to Role
    public function getRole()
    {
        return $this->belongsTo('Role', 'role_id');
    }
    
}
