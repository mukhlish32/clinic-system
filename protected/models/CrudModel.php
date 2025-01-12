<?php

class CrudModel extends CActiveRecord
{
    public $created_by;
    public $updated_by;
    public $skipBeforeSave = false;

    protected function beforeSave()
    {
        if ($this->skipBeforeSave) {
            return true;
        }

        if ($this->isNewRecord) {
            $this->created_at = new CDbExpression('NOW()');
            $this->created_by = Yii::app()->user->name;
        } else {
            $this->updated_at = new CDbExpression('NOW()');
            $this->updated_by = Yii::app()->user->name;
        }

        return parent::beforeSave();
    }

    public static function findNonDeleted()
    {
        return self::model()->findAllByAttributes(
            array('deleted_at' => null)
        );
    }
}
