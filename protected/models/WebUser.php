<?php

class WebUser extends CWebUser
{
    private $_roleId;

    public function getRoleId()
    {
        if ($this->_roleId === null) {
            $user = User::model()->findByPk($this->id);
            $this->_roleId = $user ? $user->role_id : null;
        }
        return $this->_roleId;
    }
}
