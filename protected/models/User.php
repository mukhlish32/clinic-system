<?php

class User extends CActiveRecord
{
    public $created_by;
    public $updated_by;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return array(
            array('username, password, role_id', 'required'),
            array('email', 'email'),
        );
    }

    public function relations()
    {
        return array(
            'role' => array(self::BELONGS_TO, 'Role', 'role_id'),
        );
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->created_at = new CDbExpression('NOW()');
            $this->created_by = Yii::app()->user->name;
        } else {
            $this->updated_at = new CDbExpression('NOW()');
            $this->updated_by = Yii::app()->user->name;
        }

        return parent::beforeSave();
    }

    protected function beforeDelete()
    {
        $this->deleted_at = new CDbExpression('NOW()');
        $this->updated_by = Yii::app()->user->name;
        $this->save();

        return parent::beforeDelete();
    }
}
